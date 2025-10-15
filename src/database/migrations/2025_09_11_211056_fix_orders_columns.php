<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixOrdersColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('buyer_id')->after('id');
            $table->unsignedBigInteger('seller_id')->after('buyer_id');
            $table->unsignedBigInteger('item_id')->after('seller_id');
            $table->integer('price')->after('item_id');
            $table->enum('status', ['pending', 'completed'])->after('price');
            $table->timestamp('paid_at')->after('status');
            $table->timestamp('shipped_at')->nullable()->after('status');
            $table->timestamp('received_at')->nullable()->after('shipped_at');

            // 外部キー
            $table->foreign('buyer_id')->references('id')->on('users')
                ->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('seller_id')->references('id')->on('users')
                ->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('item_id')->references('id')->on('items')
                ->cascadeOnUpdate()->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['buyer_id']);
            $table->dropForeign(['seller_id']);
            $table->dropForeign(['item_id']);
            $table->dropColumn(['buyer_id', 'seller_id', 'item_id', 'price', 'status', 'paid_at', 'shipped_at', 'received_at']);
        });
    }
}
