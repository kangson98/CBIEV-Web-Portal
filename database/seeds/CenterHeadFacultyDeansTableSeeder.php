<?php

use Illuminate\Database\Seeder;

class CenterHeadFacultyDeansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dean_heads')->insert([
            
            // [
            //     'faculty_center_id' => '1',
            //     'email' => 'wonghk@tarc.edu.my',
            //     'name' => 'Wong Hwa Kiong',
            //     'is_active' => '0'
            // ],
            // [
            //     'faculty_center_id' => '2',
            //     'email' => 'lokecf@tarc.edu.my',
            //     'name' => 'Loke Chui Fung',
            //     'is_active' => '0'
            // ],
            // [
            //     'faculty_center_id' => '3',
            //     'email' => 'limms@tarc.edu.my',
            //     'name' => 'Lim Mei Shyan',
            //     'is_active' => '0'
            // ],
            // [
            //     'faculty_center_id' => '4',
            //     'email' => 'ooily@tarc.edu.my',
            //     'name' => 'Ooi Lay Yong',
            //     'is_active' => '0'
            // ],
            // [
            //     'faculty_center_id' => '5',
            //     'email' => 'chewkh@tarc.edu.my',
            //     'name' => 'Chew Khoon Hee',
            //     'is_active' => '0'
            // ],  
            // [
            //     'faculty_center_id' => '6',
            //     'email' => 'keejc@tarc.edu.my',
            //     'name' => 'Dearna Kee June Chen',
            //     'is_active' => '0'
            // ],

            // [
            //     'faculty_center_id' => '7',
            //     'email' => ' karthiyani@tarc.edu.my',
            //     'name' => 'Karthiyani A/p Shanmugam',
            //     'is_active' => '0'
            // ],
            // [
            //     'faculty_center_id' => '8',
            //     'email' => 'yeohhs@tarc.edu.my',
            //     'name' => 'Yeoh Hock Seng',
            //     'is_active' => '0'
            // ],
            // [
            //     'faculty_center_id' => '9',
            //     'email' => 'leewp@tarc.edu.my',
            //     'name' => 'Lee Wah Pheng',
            //     'is_active' => '0'
            // ],
            [
                'faculty_center_id' => '17',
                'email' => 'tanzx-wa15@student.tarc.edu.my',
                'name' => 'fafb',
                'is_active' => '1'
            ],
            [
                'faculty_center_id' => '18',
                'email' => 'zxtan97@hotmail.com',
                'name' => 'foas',
                'is_active' => '1'
            ],
            [
                'faculty_center_id' => '19',
                'email' => 'zxtan97@hotmail.com',
                'name' => 'focs',
                'is_active' => '1'
            ],
            [
                'faculty_center_id' => '20',
                'email' => 'zxtan97@hotmail.com',
                'name' => 'fobe',
                'is_active' => '1'
            ],
            [
                'faculty_center_id' => '21',
                'email' => 'zxtan97@hotmail.com',
                'name' => 'foet',
                'is_active' => '1'
            ],
            [
                'faculty_center_id' => '22',
                'email' => 'zxtan97@hotmail.com',
                'name' => 'fcci',
                'is_active' => '1'
            ],
            [
                'faculty_center_id' => '23',
                'email' => 'zxtan97@hotmail.com',
                'name' => 'fssh',
                'is_active' => '1'
            ],
            [
                'faculty_center_id' => '4',
                'email' => 'zxtan97@hotmail.com',
                'name' => 'cpus',
                'is_active' => '1'
            ],
            [
                'faculty_center_id' => '5',
                'email' => 'zxtan97@hotmail.com',
                'name' => 'cpsr',
                'is_active' => '1'
            ],

        ]);
    }
}
