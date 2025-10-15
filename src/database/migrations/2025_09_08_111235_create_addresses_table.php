<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->bigIncrements('id');

            // 外部キー
            $table->unsignedBigInteger('user_id')->unique();
            // 本体カラム
            $table->string('postal_code', 10);
            $table->string('prefecture', 100);
            $table->string('city', 150);
            $table->string('address_line1', 255);
            $table->string('address_line2', 255)->nullable();
            $table->string('phone', 20)->nullable()->after('address_line2');
            // タイムスタンプ
            $table->timestamp('created_at')->nullable(false);
            $table->timestamp('updated_at')->nullable(false);
            // 外部キー制約
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
