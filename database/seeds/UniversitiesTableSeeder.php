<?php

use Illuminate\Database\Seeder;

class UniversitiesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('universities')->delete();
        
        \DB::table('universities')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'จุฬาลงกรณ์มหาวิทยาลัย',
                'code' => 'CU',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'มหาวิทยาลัยเกษตรศาสตร์',
                'code' => 'KU',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'มหาวิทยาลัยขอนแก่น',
                'code' => 'KKU',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'มหาวิทยาลัยเชียงใหม่',
                'code' => 'CMU',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'มหาวิทยาลัยทักษิณ',
                'code' => 'TSU',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'มหาวิทยาลัยเทคโนโลยีพระจอมเกล้าธนบุรี',
                'code' => 'KMUTT',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'มหาวิทยาลัยเทคโนโลยีพระจอมเกล้าพระนครเหนือ',
                'code' => 'KMUTNB',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'มหาวิทยาลัยธรรมศาสตร์',
                'code' => 'TU',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'มหาวิทยาลัยนเรศวร',
                'code' => 'NU',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'มหาวิทยาลัยบูรพา',
                'code' => 'BUU',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'มหาวิทยาลัยมหาสารคาม',
                'code' => 'MSU',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'มหาวิทยาลัยมหิดล',
                'code' => 'MU',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'มหาวิทยาลัยแม่โจ้',
                'code' => 'MJU',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'มหาวิทยาลัยแม่ฟ้าหลวง',
                'code' => 'MFU',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'มหาวิทยาลัยรังสิต',
                'code' => 'RSU',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'มหาวิทยาลัยราชภัฏนครศรีธรรมราช',
                'code' => 'NSTRU',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'มหาวิทยาลัยรามคำแหง',
                'code' => 'RU',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'มหาวิทยาลัยศรีนครินทรวิโรฒ',
                'code' => 'SWU',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'มหาวิทยาลัยศิลปกร',
                'code' => 'SU',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'มหาวิทยาลัยสงขลานครินทร์',
                'code' => 'PSU',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'มหาวิทยาลัยหอการค้าไทย',
                'code' => 'UTCC',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'มหาวิทยาลัยอุบลราชธานี',
                'code' => 'UBU',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            22 => 
            array (
                'id' => 23,
                'name' => 'สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง',
                'code' => 'KMITL',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            23 => 
            array (
                'id' => 24,
                'name' => 'ไม่มีสังกัด',
                'code' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}