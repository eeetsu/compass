<?php

use Illuminate\Database\Seeder;

class ReserveSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('reserve_settings')->insert([
            [
                'setting_reserve' => '2024-05-01',
                'setting_part' => '1',
                'limit_users' => '20',
            ],
            [
                'setting_reserve' => '2024-05-01',
                'setting_part' => '2',
                'limit_users' => '20',
            ],
            [
                'setting_reserve' => '2024-05-01',
                'setting_part' => '3',
                'limit_users' => '20',
            ],
        ]);
    }
}
