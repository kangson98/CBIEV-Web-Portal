<?php

use Illuminate\Database\Seeder;

class MentorTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mentor_types')->insert([
            [
                'name' => 'Business Mentor',
                'description' => 'Business Mentor',
            ],
            [
                'name' => 'Technical Mentor',
                'description' => 'Technical Mentor',
            ],
        ]);
    }
}
