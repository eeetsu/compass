<?php

use Illuminate\Database\Seeder;

class SubCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sub_categories')->insert([
            [
                'main_category_id' => '1',
                'sub_category' => '国語',
            ],
            [
                'main_category_id' => '1',
                'sub_category' => '数学',
            ],
            [
                'main_category_id' => '1',
                'sub_category' => '英語',
            ],
            [
                'main_category_id' => '2',
                'sub_category' => '国語辞典',
            ],
            [
                'main_category_id' => '2',
                'sub_category' => '数学参考書',
            ],
            [
                'main_category_id' => '2',
                'sub_category' => '英単語帳',
            ],
        ]);
    }
}
