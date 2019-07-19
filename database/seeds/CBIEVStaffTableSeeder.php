<?php

use Illuminate\Database\Seeder;

class CBIEVStaffTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cbiev_staff')->insert([
            [
                'name' => 'Admin',
                'staff_id' => '1111',
                'email' => 'admin@mail.com',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => Str::random(10),
                'role' => '1',
                'access_level' => '1',
            ],
            [
                'name' => 'Manager',
                'staff_id' => '1111',
                'email' => 'manager@mail.com',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => Str::random(10),
                'role' => '2',
                'access_level' => '2',
            ],
            [
                'name' => 'Director',
                'staff_id' => '1111',
                'email' => 'director@mail.com',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token' => Str::random(10),
                'role' => '3',
                'access_level' => '3',
            ],
        ]);
    }
}
