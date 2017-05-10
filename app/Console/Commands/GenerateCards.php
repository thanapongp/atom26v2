<?php

namespace Atom26\Console\Commands;

use Atom26\Repositories\UserRepository;
use Illuminate\Console\Command;
use QRcode;

class GenerateCards extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cards:generate {university}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate ID cards for specified university.';

    /**
     * Instance of UserRepository.
     *
     * @var \Atom26\Repositories\UserRepository
     */
    protected $userRepository;

    /**
     * @var string
     */
    protected $universityID;

    /**
     * Create a new command instance.
     *
     * @param \Atom26\Repositories\UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        parent::__construct();

        $this->userRepository = $userRepository;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->universityID = $this->argument('university');

        $this->info('Fetching attendees from university ID: '. $this->universityID . '...');

        $users = $this->userRepository->getUsersByUniversityID($this->universityID);

        if ($users->count() == 0) {
            $this->info('No record found. No further action is required.');
            return;
        }

        $this->info('Done! ' . $users->count() . ' records found.');

        if (! is_dir($this->cardStorageDir())) {
            $this->info('Card storage directory is not existed. Create one now...');

            mkdir($this->cardStorageDir(), 0777, true);
        }

        $this->info('Generating cards. This will take sometime.');

        $progressBar = $this->output->createProgressBar($users->count());

        set_time_limit(6000);

        $progressBar->setFormat(' %current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s% %memory:6s%');

        $progressBar->display();

        $users->each(function ($user) use ($progressBar) {
            $this->generateCard($user);
            $progressBar->advance();
        });

        $this->output->newLine();

        $this->info('Done! All cards are saved at ' . $this->cardStorageDir());
    }

    /**
     * @param \Atom26\Accounts\User $user
     */
    private function generateCard($user)
    {
        try {
            $unprocessedProfilePic = imagecreatefromfile($this->getPicPath($user));

            list($originalWidth, $originalHeight) = getimagesize($this->getPicPath($user));

        } catch (\Exception $e) {
            $this->error($e->getMessage() . '. Skipping...');
            return;
        }

        // Resize picture to 500x500
        $processedProfilePic = imagecreatetruecolor(500, 500);

        imagecopyresampled(
            $processedProfilePic, $unprocessedProfilePic, 0, 0, 0, 0, 500, 500, $originalWidth, $originalHeight
        );
        imagedestroy($unprocessedProfilePic);

        // Generate QR Code
        QRcode::png($user->getQRCode(), $this->tempQRCodePath(), QR_ECLEVEL_L, 10);

        // Load necessary components
        $typeImg = imagecreatefrompng(resource_path() . '/images/types/' . $user->type()->code . '.png');
        $card = imagecreatefrompng(resource_path() . '/images/cardTC.png');
        $qrCode = imagecreatefrompng($this->tempQRCodePath());

        $fontfile = resource_path() . '/fonts/supermarket.TTF';

        // Allocate colors
        $colorBlack = imagecolorallocate($card, 0, 0, 0);
        $colorYellow =  imagecolorallocate($card, 255, 159, 0);

        imagettftext(
            $card, 56, 0,
            $this->getXCoordinate($card, 56, $user->fullname()), 1194,
            $colorBlack, $fontfile, $user->fullname()
        );

        imagettftext(
            $card, 32, 0,
            $this->getXCoordinate($card, 32, $user->info->type->name), 1264,
            $colorYellow, $fontfile, $user->info->type->name
        );

        imagettftext(
            $card, 42, 0,
            $this->getXCoordinate($card, 42, $user->info->university->name), 1348,
            $colorBlack, $fontfile, $user->info->university->name
        );

        imagecopy($card, $processedProfilePic, 150, 601, 0, 0, 500, 500);
        imagecopy($card, $qrCode, 675, 811, 0, 0, 290, 290);
        imagecopy($card, $typeImg, 675, 601, 0, 0, 290, 183);

        imagepng($card, $this->cardStorageDir() . '/card_' . $user->getQRCode() . '.png');

        imagedestroy($card);
        imagedestroy($processedProfilePic);
        imagedestroy($qrCode);
        imagedestroy($typeImg);

        usleep(500000);
    }

    /**
     * @param $user
     * @return string
     */
    private function getPicPath($user)
    {
        return base_path() . '/public/' . $user->info->pic;
    }

    /**
     * @return string
     */
    private function tempQRCodePath()
    {
        return resource_path() . '/images/temp_qr.png';
    }

    /**
     * @param $image
     * @param $fontsize
     * @param $text
     * @return float|int
     */
    private function getXCoordinate($image, $fontsize, $text)
    {
        $fontfile = resource_path() . '/fonts/supermarket.TTF';

        $dimensions = imagettfbbox($fontsize, 0, $fontfile, $text);
        $textwidth = abs($dimensions[4] - $dimensions[0]);
        return (imagesx($image) / 4) - ($textwidth / 2);
    }

    /**
     * @return string
     */
    private function cardStorageDir()
    {
        return base_path() . '/public/files/card/uni_' . $this->universityID;
    }
}
