<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        foreach (
            [
                'orders',
                'favorites',
                'item_images',
                'items',
                'addresses',
                'categories',
                'users',
            ] as $table
        ) {
            try {
                DB::table($table)->truncate();
            } catch (\Throwable $e) {
                DB::table($table)->delete();
            }
        }
        $this->call([
            UsersTableSeeder::class,
            CategoriesTableSeeder::class,
            ItemsTableSeeder::class,
            ItemImagesTableSeeder::class,
            FavoritesTableSeeder::class,
            OrdersTableSeeder::class,
            AddressesTableSeeder::class,
        ]);
        Schema::enableForeignKeyConstraints();
    }
}
