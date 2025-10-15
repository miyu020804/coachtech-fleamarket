<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id'); // PK, unsignedBigInteger
            $table->unsignedBigInteger('user_id'); // FK → users.id
            $table->unsignedBigInteger('category_id')->nullable(); // FK → categories.id

            // 本体カラム
            $table->string('title', 100); // NOT NULL
            $table->text('description'); // NOT NULL
            $table->integer('price'); // NOT NULL
            $table->tinyInteger('condition'); // NOT NULL
            $table->enum('status', ['listed', 'sold']); // NOT NULL
            $table->integer('stock'); // NOT NULL

            // タイムスタンプ (NOT NULL)
            $table->timestamp('created_at')->nullable(false);
            $table->timestamp('updated_at')->nullable(false);

            // 論理削除 (deleted_at, NULL)
            $table->softDeletes();

            // 外部キー制約
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreign('category_id')
                ->references('id')->on('categories')
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
        Schema::dropIfExists('items');
    }
}
