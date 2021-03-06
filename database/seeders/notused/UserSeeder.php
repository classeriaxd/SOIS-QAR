<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'course_id' => 1,
                'role_id' => 2,
                'gender_id' => 1,
                'email' => 'bsa@email.com', 
                'password' => Hash::make('bsa@email.com'),
                'student_number' => '2018-00001-TG-0', 
                'first_name' => 'John',
                'middle_name' => 'Faraday',
                'last_name' => 'Doe',
                'date_of_birth' => '2000-01-01',
                'mobile_number' => '+639123456700',
                'address' => 'Bulacan Malolos',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'status' => 0,
            ],
            [
                'course_id' => 2,
                'role_id' => 2,
                'gender_id'=> 1,
                'email' => 'ece@email.com', 
                'password' => Hash::make('ece@email.com'),
                'student_number' => '2018-00002-TG-0', 
                'first_name' => 'Isaak',
                'middle_name' => 'Santiago',
                'last_name' => 'Chase',
                'date_of_birth' => '2000-01-01',
                'mobile_number' => '+639123456701',
                'address' => 'Purok 13 South Daang Hari Taguig City',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'status' => 0,
            ],
            [
                'course_id' => 3,
                'role_id' => 2,
                'gender_id' => 2, 
                'email' => 'bsme@email.com', 
                'password' => Hash::make('bsme@email.com'),
                'student_number' => '2018-00003-TG-0', 
                'first_name' => 'Earl',
                'middle_name' => 'Vincent',
                'last_name' => 'Caroliner',
                'date_of_birth' => '2000-01-01',
                'mobile_number' => '+639123456702',
                'address' => 'Lower Bicutan Taguig City',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'status' => 0,
            ],
            [
                'course_id' => 4,
                'role_id' => 2,
                'gender_id' => 1, 
                'email' => 'bshr@email.com', 
                'password' => Hash::make('bshr@email.com'),
                'student_number' => '2018-00004-TG-0', 
                'first_name' => 'Zara',
                'middle_name' => 'Janloui',
                'last_name' => 'Needham',
                'date_of_birth' => '2000-01-01',
                'mobile_number' => '+639123456703',
                'address' => 'Bambang Sta Ana Signal Taguig City',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'status' => 0,
            ],
            [
                'course_id' => 5,
                'role_id' => 2,
                'gender_id' => 2, 
                'email' => 'bsmm@email.com', 
                'password' => Hash::make('bsmm@email.com'),
                'student_number' => '2018-00005-TG-0', 
                'first_name' => 'Tessa',
                'middle_name' => 'Mar',
                'last_name' => 'Johnson',
                'date_of_birth' => '2000-01-01',
                'mobile_number' => '+639123456704',
                'address' => 'Makati City',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'status' => 0,
            ],
            [
                'course_id' => 6,
                'role_id' => 2,
                'gender_id' => 2, 
                'email' => 'bsoa@email.com', 
                'password' => Hash::make('bsoa@email.com'),
                'student_number' => '2018-00006-TG-0', 
                'first_name' => 'Lilli',
                'middle_name' => 'Apurada',
                'last_name' => 'Magana',
                'date_of_birth' => '2000-01-01',
                'mobile_number' => '+639123456705',
                'address' => 'Western Bicutan Taguig City',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'status' => 0,
            ],
            [
                'course_id' => 7,
                'role_id' => 2,
                'gender_id' => 1, 
                'email' => 'bsede@email.com', 
                'password' => Hash::make('bsede@email.com'),
                'student_number' => '2018-00007-TG-0', 
                'first_name' => 'Luciana',
                'middle_name' => 'Astra',
                'last_name' => 'Ware',
                'date_of_birth' => '2000-01-01',
                'mobile_number' => '+639123456706',
                'address' => 'Lower Bicutan Taguig City',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'status' => 0,
            ],
            [
                'course_id' => 8,
                'role_id' => 2, 
                'gender_id' => 2,
                'email' => 'bsedm@email.com', 
                'password' => Hash::make('bsedm@email.com'),
                'student_number' => '2018-00008-TG-0', 
                'first_name' => 'Juan',
                'middle_name' => 'De Jesus',
                'last_name' => 'Zayden',
                'date_of_birth' => '2000-01-01',
                'mobile_number' => '+639123456707',
                'address' => 'Paranaque City',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'status' => 0,
            ],
            [
                'course_id' => 9,
                'role_id' => 2,
                'gender_id' => 2, 
                'email' => 'bsit@email.com', 
                'password' => Hash::make('bsit@email.com'),
                'student_number' => '2018-00009-TG-0', 
                'first_name' => 'Bonnie',
                'middle_name' => 'Carlo',
                'last_name' => 'Mair',
                'date_of_birth' => '2000-01-01',
                'mobile_number' => '+639123456708',
                'address' => 'Alabang Muntinlupa City',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'status' => 0,
            ],
            [
                'course_id' => 10,
                'role_id' => 2,
                'gender_id' => 2, 
                'email' => 'domt@email.com', 
                'password' => Hash::make('domt@email.com'),
                'student_number' => '2018-00010-TG-0', 
                'first_name' => 'Timothy',
                'middle_name' => 'Swift',
                'last_name' => 'Leigh',
                'date_of_birth' => '2000-01-01',
                'mobile_number' => '+639123456709',
                'address' => 'Lower Bicutan Taguig City',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'status' => 0, 
            ],
            [
                'course_id' => 11,
                'role_id' => 2,
                'gender_id' => 1, 
                'email' => 'dict@email.com', 
                'password' => Hash::make('dict@email.com'),
                'student_number' => '2018-00011-TG-0', 
                'first_name' => 'Kyle',
                'middle_name' => 'Partos',
                'last_name' => 'Fuller',
                'date_of_birth' => '2000-01-01',
                'mobile_number' => '+639123456710',
                'address' => 'Lower Bicutan Taguig City',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'status' => 0,       
            ],
           
            [
                'course_id' => 1,
                'role_id' => 2,
                'gender_id' => 2, 
                'email' => 'bsa-member@email.com', 
                'password' => Hash::make('bsa-member@email.com'),
                'student_number' => '2018-00012-TG-0', 
                'first_name' => 'BSA John',
                'middle_name' => 'Fitzgerald',
                'last_name' => 'Kennedy',
                'date_of_birth' => '2000-01-01',
                'mobile_number' => '+639123456710',
                'address' => 'Lower Bicutan Taguig City',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'status' => 0,       
            ],
            [
                'course_id' => 1,
                'role_id' => 2,
                'gender_id' => 2, 
                'email' => 'bsa-president@email.com', 
                'password' => Hash::make('bsa-president@email.com'),
                'student_number' => '2018-000013-TG-0', 
                'first_name' => 'BSA Presi Ronaldo',
                'middle_name' => 'Cristiano',
                'last_name' => 'Reagan',
                'date_of_birth' => '2000-01-01',
                'mobile_number' => '+639123456123',
                'address' => 'Bulacan Malolos',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'status' => 0,
            ],
            [
                'course_id' => NULL,
                'role_id' => 1,
                'gender_id' => NULL, 
                'email' => 'admin@email.com', 
                'password' => Hash::make('admin@email.com'),
                'student_number' => NULL, 
                'first_name' => 'Admin',
                'middle_name' => 'I',
                'last_name' => 'Am',
                'date_of_birth' => '2000-01-01',
                'mobile_number' => '+639123456124',
                'address' => 'Bulacan Malolos',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'status' => 0,
            ],
            
        ];

        DB::table('users')->insert($data);
    }
}