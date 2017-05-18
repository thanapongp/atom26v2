<?php

namespace Atom26\Console\Commands;

use Atom26\Repositories\UserRepository;
use Illuminate\Console\Command;
use Illuminate\Contracts\Encryption\DecryptException;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExportAttendeesData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'export:attendees {--university=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export attendees data into xlsx file.';

    /**
     * An instance of UserRepository
     *
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * Create new instance of ExportAttendeesData.
     * @param $userRepository
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
        $this->info('Fetching attendees from university ID: '. $this->option('university') . '...');

        $users = $this->userRepository->getUsersByUniversityID($this->option('university'));

        if ($users->count() == 0) {
            $this->info('No record found. No further action is required.');
            return;
        }

        $this->info('Done! ' . $users->count() . ' records found.');

        $spreadsheet = new Spreadsheet();
        $spreadsheet->removeSheetByIndex(0);

        $sheet = new Worksheet($spreadsheet, 'test1');

        $sheet->setCellValueByColumnAndRow(0, 1, 'ชื่อ');
        $sheet->setCellValueByColumnAndRow(1, 1, 'รหัสนักศึกษา');
        $sheet->setCellValueByColumnAndRow(2, 1, 'รหัสประชาชน');
        $sheet->setCellValueByColumnAndRow(3, 1, 'ว/ด/ป เกิด');

        $i = 2;

        $users->each(function ($user) use (&$i, $sheet) {
            $sheet->setCellValueByColumnAndRow(0, $i, $user->fullname());
            $sheet->setCellValueByColumnAndRow(1, $i, $user->info->student_id);
            try {
                $citizen_id = decrypt($user->info->citizen_id);
            } catch (DecryptException $e) {
                $citizen_id = '';
            }
            $sheet->setCellValueByColumnAndRow(2, $i, $citizen_id);
            $sheet->setCellValueByColumnAndRow(3, $i, $user->info->birthdate->format('d/m/Y'));

            $i++;
        });

        $spreadsheet->addSheet($sheet, 0);

        (new Xlsx($spreadsheet))->save(public_path() . '/files/test.xlsx');
    }
}
