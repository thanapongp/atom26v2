<?php

namespace Atom26\Console\Commands;

use Atom26\Repositories\UserRepository;
use Atom26\Sports\Sport;
use Illuminate\Console\Command;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExportAthletes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'export:athletes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export all athletes data into excel file.';

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * Create a new command instance.
     * @param UserRepository $userRepository
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
        $this->info('Fetching all available sport...');

        $sports = Sport::all();

        $this->info('Done! ' . $sports->count() . ' sports found.');

        $spreadsheet = new Spreadsheet();
        $spreadsheet->removeSheetByIndex(0);

        $sports->each(function ($sport) use ($spreadsheet) {

            $athletes = $this->userRepository->queryUserBySportID($sport->id);

            if ($athletes->count() == 0) {
                $this->info('No athlete found. Skipping...');
                return;
            }

            $sheet = new Worksheet($spreadsheet, $sport->name);

            $sheet->setCellValueByColumnAndRow(0, 1, 'ลำดับที่');
            $sheet->setCellValueByColumnAndRow(1, 1, 'QRCode');
            $sheet->setCellValueByColumnAndRow(2, 1, 'ชื่อ-สกุล');
            $sheet->setCellValueByColumnAndRow(3, 1, 'สถาบัน');

            $order = 1;
            $row = 2;

            $athletes->each(function ($user) use ($sheet, &$order, &$row){
                $sheet->setCellValueByColumnAndRow(0, $row, $order);
                $sheet->setCellValueByColumnAndRow(1, $row, $user->getQRCode());
                $sheet->setCellValueByColumnAndRow(2, $row, $user->fullname());
                $sheet->setCellValueByColumnAndRow(3, $row, $user->university()->name);

                $order++;
                $row++;
            });

            $spreadsheet->addSheet($sheet);
        });

        (new Xlsx($spreadsheet))->save(public_path() . '/files/athlete.xlsx');
    }
}
