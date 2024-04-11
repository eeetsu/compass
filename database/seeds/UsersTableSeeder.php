<?php

use Illuminate\Database\Seeder;
use App\Models\Users\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        [
            'over_name' => '金城',
            'under_name' => '花子',
            'over_name_kana' => 'キンジョウ',
            'under_name_kana' => 'ハナコ',
            'mail_address' => 'kin12345@gmail.com',
            'sex' => 2,
            'birth_day' => '1980-12-12',
            'role' => 1,
            'password' => bcrypt('kin12345')
        ],
        [
            'over_name' => '赤嶺',
            'under_name' => '綾子',
            'over_name_kana' => 'アカミネ',
            'under_name_kana' => 'アヤコ',
            'mail_address' => 'aka12345@gmail.com',
            'sex' => 2,
            'birth_day' => '1980-10-12',
            'role' => 2,
            'password' => bcrypt('aka12345')
        ],
        [
            'over_name' => '比嘉',
            'under_name' => '太郎',
            'over_name_kana' => 'ヒガ',
            'under_name_kana' => 'タロウ',
            'mail_address' => 'higa12345@gmail.com',
            'sex' => 1,
            'birth_day' => '1983-01-15',
            'role' => 3,
            'password' => bcrypt('higa12345')
        ],
        [
            'over_name' => '安座間',
            'under_name' => '旬太',
            'over_name_kana' => 'アザマ',
            'under_name_kana' => 'シュンタ',
            'mail_address' => 'azaama12345@gmail.com',
            'sex' => 1,
            'birth_day' => '1986-07-13',
            'role' => 4,
        'password' => bcrypt('azama12345')
        ],
    ]);
}
}
