<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddressesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('addresses')->insertOrIgnore([
            [
                'user_id' => 1,
                'postal_code' => '123-4567',
                'prefecture' => '大阪府',
                'city' => '大阪市北区',
                'address_line1' => '梅田1-2-3',
                'address_line2' => 'グランドピル501',
                'phone' => '06-1234-5678',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'postal_code' => '987-6543',
                'prefecture' => '東京都',
                'city' => '新宿区',
                'address_line1' => '西新宿区4-5-6',
                'address_line2' => 'サンプルマンション202',
                'phone' => '03-9876-5432',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
