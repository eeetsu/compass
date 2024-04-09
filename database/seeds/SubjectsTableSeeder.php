<?php

use Illuminate\Database\Seeder;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subjects')->insert([
      [
          'subject' => '国語',
      ],
      [
          'subject' => '数学',
      ],
      [
          'subject' => '英語',
      ],
      [
          'subject' => '生徒',
      ],
    ]);
  }
}
