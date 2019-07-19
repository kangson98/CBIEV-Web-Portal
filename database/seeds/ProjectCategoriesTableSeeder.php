<?php

use Illuminate\Database\Seeder;

class ProjectCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('project_categories')->insert(
            array(
                'category_name' => 'Cat 1',
            )
        );
        DB::table('project_categories')->insert(
            array(
                'category_name' => 'Cat 2',
            )
        );
        DB::table('project_categories')->insert(
            array(
                'category_name' => 'Cat 3',
            )
        );
        DB::table('project_categories')->insert(
            array(
                'category_name' => 'Cat 4',
            )
        );
        DB::table('project_categories')->insert(
            array(
                'category_name' => 'Cat 5',
            )
        );
        DB::table('project_categories')->insert(
            array(
                'category_name' => 'Cat 6',
            )
        );
        DB::table('project_categories')->insert(
            array(
                'category_name' => 'Cat 7',
            )
        );
    }
}
