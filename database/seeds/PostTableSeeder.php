<?php

use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
        [
          'user_id' => '1',
          'post_title' => '意気込み！',
          'post' => '目標達成させるために勉強頑張るぞ！！！',
        ],
        [
          'user_id' => '2',
          'post_title' => '今月の目標！！！！',
          'post' => '今月中にカリキュラムを終えたい！！！',
        ],
        [
          'user_id' => '3',
          'post_title' => '今日の目標！',
          'post' => 'バリデーションの設定を今日中に設定できるようにする！！！',
        ],
        [
          'user_id' => '4',
          'post_title' => '意気込み！',
          'post' => '気合い入れて頑張るぞ！！！',
        ],
      ]);
    }
}
