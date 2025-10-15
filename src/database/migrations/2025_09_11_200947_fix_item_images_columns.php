<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixItemImagesColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('item_images', function (Blueprint $table) {
            $table->unsignedBigInteger('item_id')->after('id');
            $table->string('path', 255)->after('item_id');
            $table->tinyInteger('sort_order')->after('path');
            // 外部キー
            $table->foreign('item_id')
                ->references('id')->on('items')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('item_images', function (Blueprint $table) {
            $table->dropForeign(['item_id']);
            $table->dropColumn(['item_id', 'path', 'soft_order']);
        });
    }
}
