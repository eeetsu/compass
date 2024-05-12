<?php

use Illuminate\Database\Seeder;

class PostCommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('post_comments')->insert([
            [
                'post_id' => '1',
                'user_id' => '1',
                'comment' => 'すごいですね！',
            ],
            [
                'post_id' => '2',
                'user_id' => '2',
                'comment' => '素敵ですね！',
            ],
            [
                'post_id' => '3',
                'user_id' => '3',
                'comment' => '応援してます！',
            ],
        ]);
    }
}
