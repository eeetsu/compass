<?php

use Illuminate\Database\Seeder;

class LikeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('likes')->insert([
            [
                'like_user_id' => '1',
                'like_post_id' => '1',
            ],
            [
                'like_user_id' => '2',
                'like_post_id' => '2',
            ],
            [
                'like_user_id' => '3',
                'like_post_id' => '3',
            ],
        ]);
    }
}
