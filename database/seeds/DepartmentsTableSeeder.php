<?php

use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('departments')->delete();
        
        \DB::table('departments')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'ฝ่ายอำนวยการ',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'ฝ่ายเลขานุการ',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'ฝ่ายการเงินและพัสดุ',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'ฝ่ายกิจกรรมสัมพันธ์',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'ฝ่ายจัดหารายได้',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'ฝ่ายเทคนิคกีฬา',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'ฝ่ายปฏิคมและลงทะเบียน',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'ฝ่ายประเมินผล',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'ฝ่ายพิธีการและการแสดง',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'ฝ่ายสวัสดิการและพยาบาล',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'ฝ่ายสารสนเทศและประชาสัมพันธ์',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'ฝ่ายอาคารสถานที่และยานพาหนะ',
            ),
        ));
        
        
    }
}