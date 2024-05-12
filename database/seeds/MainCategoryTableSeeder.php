<?php

use Illuminate\Database\Seeder;

class MainCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('main_categories')->insert([
            [
                'main_category' => '教科',
            ],
            [
                'main_category' => '参考書',
            ],
        ]);
    }
}
