<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id'); // PK
            $table->string('name', 50); // varchar(50), NOT NULL
            $table->unique('name');
            $table->unsignedBigInteger('parent_id') //FK
                ->nullable();
            $table->timestamp('created_at')->nullable(false);
            $table->timestamp('updated_at')->nullable(false);
            $table->foreign('parent_id')
                ->references('id')
                ->on('categories')
                ->cascadeOnUpdate()
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
