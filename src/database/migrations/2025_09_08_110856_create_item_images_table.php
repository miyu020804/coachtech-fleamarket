<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('item_images', function (Blueprint $table) {
            $table->id(); // PK: unsignedBigInteger

            // 外部キー
            $table->unsignedBigInteger('item_id');
            // 本体カラム
            $table->string('path', 255); // NOT NULL
            $table->tinyIncrements('sort_order'); // NOT NULL
            // タイムスタンプ
            $table->timestamp('created_at')->nullable(false);
            $table->timestamp('updated_at')->nullable(false);
            // 外部キー制約
            $table->foreign('item_id')->references('id')->on('items')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_images');
    }
}
