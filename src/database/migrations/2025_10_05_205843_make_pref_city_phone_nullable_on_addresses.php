<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakePrefCityPhoneNullableOnAddresses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->string('prefecture', 50)->nullable()->change();
            $table->string('city', 100)->nullable()->change();
            $table->string('phone', 20)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->string('prefecture', 50)->nullable(false)->change();
            $table->string('city', 100)->nullable(false)->change();
            $table->string('phone', 20)->nullable(false)->change();
        });
    }
}
