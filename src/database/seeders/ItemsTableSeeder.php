<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('items')->truncate();
        $now = now();
        $getCategoryId = function (string $name): int {
            return (int) (DB::table('categories')->where('name', $name)->value('id') ?? 1);
        };
        // 日本語 → 数値 (Item::CONDITIONS と対応 )
        $toCond = function (string $label): int {
            $map = [
                '良好' => 1,
                '目立った傷や汚れなし' => 2,
                'やや傷や汚れあり' => 3,
                '状態が悪い' => 4,
            ];
            return $map[$label] ?? 1;
        };
        $rows = [
            [
                'user_id' => 1,
                'category_id' => 1,
                'title' => '腕時計',
                'brand' => 'Rolax',
                'description' => 'スタイリッシュなデザインのメンズ腕時計',
                'price' => 15000,
                'condition' => 1, // 良好
                'category_name' => 'ファッション',
                'status' => 'listed',
                'stock' => 10,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'user_id' => 1,
                'category_id' => 2,
                'title' => 'HDD',
                'brand' => '西芝',
                'description' => '高速で信頼性の高いハードディスク',
                'price' => 5000,
                'condition' => 2, // 目立った傷や汚れなし
                'category_name' => '家電',
                'status' => 'listed',
                'stock' => 15,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'user_id' => 1,
                'category_id' => 3,
                'title' => '玉ねぎ3束',
                'brand' => null,
                'description' => '新鮮な玉ねぎ3束のセット',
                'price' => 300,
                'condition' => 3, // やや傷や汚れあり
                'category_name' => '食品',
                'status' => 'listed',
                'stock' => 20,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'user_id' => 2,
                'category_id' => 4,
                'title' => '革靴',
                'brand' => null,
                'description' => 'クラシックなデザインの革靴',
                'price' => 4000,
                'condition' => 4, // 状態が悪い
                'category_name' => 'ファッション',
                'status' => 'listed',
                'stock' => 5,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'user_id' => 2,
                'category_id' => 5,
                'title' => 'ノートPC',
                'brand' => null,
                'description' => '高性能なノートパソコン',
                'price' => 45000,
                'condition' => 1, // 良好
                'category_name' => '家電',
                'status' => 'listed',
                'stock' => 8,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'user_id' => 2,
                'category_id' => 6,
                'title' => 'マイク',
                'brand' => null,
                'description' => '高音質のレコーディング用マイク',
                'price' => 8000,
                'condition' => 2, // 目立った傷や汚れなし
                'category_name' => '家電',
                'status' => 'listed',
                'stock' => 12,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'user_id' => 3,
                'category_id' => 7,
                'title' => 'ショルダーバッグ',
                'brand' => null,
                'description' => 'おしゃれなショルダーバッグ',
                'price' => 3500,
                'condition' => 3, // やや傷や汚れあり
                'category_name' => 'ファッション',
                'status' => 'listed',
                'stock' => 7,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'user_id' => 3,
                'category_id' => 8,
                'title' => 'タンブラー',
                'brand' => null,
                'description' => '使いやすいタンブラー',
                'price' => 500,
                'condition' => 4, // 状態が悪い
                'category_name' => '生活雑貨',
                'status' => 'listed',
                'stock' => 25,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'user_id' => 3,
                'category_id' => 9,
                'title' => 'コーヒーミル',
                'brand' => 'Starbacks',
                'description' => '手動のコーヒーミル',
                'price' => 4000,
                'condition' => 1, // 良好
                'category_name' => 'コーヒー器具',
                'status' => 'listed',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'user_id' => 3,
                'category_id' => 10,
                'title' => 'メイクセット',
                'brand' => null,
                'description' => '便利なメイクアップセット',
                'price' => 2500,
                'condition' => 2, // 目立った傷や汚れなし
                'category_name' => 'コスメ',
                'status' => 'listed',
                'stock' => 9,
                'created_at' => $now,
                'updated_at' => $now,
            ],

        ];

        $items = [];
        foreach ($rows as $r) {
            $items[] = [
                'user_id' => 1,
                'category_id' => $getCategoryId($r['category_name']),
                'title' => $r['title'],
                'brand' => $r['brand'],
                'description' => $r['description'],
                'price' => $r['price'],
                'condition' => $toCond($r['condition']),
                'status' => 'listed',
                'stock' => 9,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        DB::table('items')->insert($items);
    }
}
