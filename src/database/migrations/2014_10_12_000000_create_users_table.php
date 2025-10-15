<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // unsignedBigInteger, PK, NOT NULL
            $table->string('name', 50); // varchar(50), NOT NULL
            $table->string('email', 255)->unique(); // UNIQUE, NOT NULL
            $table->string('password', 255); // NOT NULL
            $table->string('avatar_path', 255)->nullable(); // NULL可
            $table->text('profile_text')->nullable(); //NULL可
            $table->timestamp('email_verified_at')->nullable(); //NULL可
            $table->string('remember_token', 100)->nullable(); //NULL可
            $table->timestamp('created_at')->nullable(false);
            $table->timestamp('updated_at')->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
