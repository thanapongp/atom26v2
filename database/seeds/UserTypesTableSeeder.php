<?php

use Illuminate\Database\Seeder;

class UserTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('user_types')->delete();
        
        \DB::table('user_types')->insert(array (
            0 => 
            array (
                'id' => 1,
                'code' => 'SCBT',
                'name' => 'กรรมการบริหารกีฬาวิทยาศาสตร์สัมพันธ์แห่งประเทศไทย',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'code' => 'B',
                'name' => 'กรรมการอำนวยการ/กรรมการดำเนินงาน',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'code' => 'Bo',
                'name' => 'อนุกรรมการ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'code' => 'D',
                'name' => 'กรรมการผู้ตัดสิน',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'code' => 'E',
                'name' => 'เจ้าหน้าที่จัดการแข่งขัน',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'code' => 'F',
                'name' => 'นักกีฬา/กิจกรรมสัมพันธ์',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'code' => 'Fo',
                'name' => 'ผู้จัดการ/ผู้ฝึกสอน/ผู้ช่วยผู้ฝึกสอน',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'code' => 'P',
                'name' => 'ช่างภาพ/สื่อมวลชน',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'code' => 'V',
                'name' => 'อาสาสมัคร',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'code' => 'O',
                'name' => 'ผู้เข้าร่วมงาน',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'code' => 'S ',
                'name' => 'ผู้ให้การสนับสนุน',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'code' => 'I',
                'name' => 'อาจารย์/บุคลากร',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}