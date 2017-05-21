<?php

namespace Atom26\Console\Commands;

use Atom26\Repositories\UserRepository;
use Atom26\Accounts\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use QRcode;

class GenerateCards extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cards:generate {--university=} {--id=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate ID cards for specified university or user.';

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
        if ($this->option('id') != null) {
            $this->info('Fetching attendees by ID(s)...');
            $users = User::find(explode(',', $this->option('id')));

            $this->universityID = 'misc';

        } elseif ($this->option('university') != null) {
            $this->universityID = $this->option('university');

            $this->info('Fetching attendees from university ID: '. $this->universityID . '...');

            $users = $this->userRepository->getUsersByUniversityID($this->universityID);
        }

        if (! isset($users) || $users->count() == 0) {
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
    public function generateCard($user)
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

        $typename = $this->userHasSpecialTypeName($user) ?: $user->info->type->name;

        imagettftext(
            $card, 32, 0,
            $this->getXCoordinate($card, 32, $typename), 1264,
            $colorYellow, $fontfile, $typename
        );

        imagettftext(
            $card, 42, 0,
            $this->getXCoordinate($card, 42, $user->info->university->name), 1348,
            $colorBlack, $fontfile, $user->info->university->name
        );

        imagecopy($card, $processedProfilePic, 150, 601, 0, 0, 500, 500);
        imagecopy($card, $qrCode, 675, 811, 0, 0, 290, 290);
        imagecopy($card, $typeImg, 675, 601, 0, 0, 290, 183);

        imagepng($card, $this->cardStorageDir($user->university()->id) . '/card_' . $user->getQRCode() . '.png');

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
    private function cardStorageDir($universityID)
    {
        return base_path() . '/public/files/card/uni_' . $universityID;
    }

    /**
     * Check if user has any special type name.
     *
     * @param \Atom26\Accounts\User $user
     * @return mixed
     */
    private function userHasSpecialTypeName($user)
    {
        $specialType = DB::table('special_types')->where('name', $user->fullname())->get();

        return $specialType->isEmpty() ? false : $specialType->first()->type_name;
    }
}
