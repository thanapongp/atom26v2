<?php

use Illuminate\Database\Seeder;

class SportsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sports')->delete();
        
        \DB::table('sports')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'กรีฑา',
                'label' => 'athletics',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'บาสเกตบอล',
                'label' => 'basketball',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'ฟุตบอล',
                'label' => 'soccer',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'วอลเลย์บอล',
                'label' => 'volleyball',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'เปตอง',
                'label' => 'petanque',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'บริดจ์',
                'label' => 'bridge',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'หมากกระดาน',
                'label' => 'cheker',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'ฟุตซอล',
                'label' => 'futsal',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'E-sport',
                'label' => 'esport',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'วิชาการ',
                'label' => 'acedemic',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'เซปักตะกร้อ',
                'label' => 'sepak-takraw',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'Ambassador',
                'label' => 'ambassador',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'เชียร์ลีดเดอร์',
                'label' => 'cheerleader',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'สแตนเชียร์',
                'label' => 'cheerstand',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}