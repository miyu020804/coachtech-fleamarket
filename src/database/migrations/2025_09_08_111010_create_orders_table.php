<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id'); // PK
            $table->unsignedBigInteger('buyer_id');
            $table->unsignedBigInteger('seller_id');
            $table->unsignedBigInteger('item_id');
            $table->unique('item_id');


            // 本体カラム
            $table->integer('price');
            $table->enum('status', ['pending', 'completed']);
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('shipped_at')->nullable();
            $table->timestamp('received_at')->nullable();

            // タイムスタンプ
            //$table->timestamp('created_at')->nullable(false);
            //$table->timestamp('updated_at')->nullable(false);
            $table->timestamps();

            // 外部キー制約
            $table->foreign('buyer_id')
                ->references('id')->on('users')
                ->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('seller_id')
                ->references('id')->on('users')
                ->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('item_id')
                ->references('id')->on('items')
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
        Schema::dropIfExists('orders');
    }
}
