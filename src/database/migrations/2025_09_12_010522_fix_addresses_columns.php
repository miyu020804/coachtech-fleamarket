<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixAddressesColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('addresses', function (Blueprint $table) {
            // user_id(NOT NULL)
            if (! Schema::hasColumn('addresses', 'user_id')) {
                $table->unsignedBigInteger('user_id')->after('id');
            }
            // postal_code VARCHAR(10) NOT NULL
            if (! Schema::hasColumn('addresses', 'postal_code')) {
                $table->string('postal_code', 10)->after('user_id');
            }
            // prefecture VARCHAR(50) NOT NULL
            if (! Schema::hasColumn('addresses', 'prefecture')) {
                $table->string('prefecture', 50)->after('postal_code');
            }
            // city VARCHAR(100) NOT NULL
            if (! Schema::hasColumn('addresses', 'city')) {
                $table->string('city', 100)->after('prefecture');
            }
            // address_line1 VARCHAR(255) NOT NULL
            if (! Schema::hasColumn('addresses', 'address_line1')) {
                $table->string('address_line1', 255)->after('city');
            }
            //address_line2 VARCHAR(255) NULL可
            if (! Schema::hasColumn('addresses', 'address_line2')) {
                $table->string('address_line2', 255)->nullable()->after('address_line1');
            }
            // NOT NULL created_at,updated_at
            if (! Schema::hasColumn('addresses', 'created_at')) {
                $table->timestamp('created_at')->nullable(false)->after('phone');
            }
            if (! Schema::hasColumn('addresses', 'updated_at')) {
                $table->timestamp('updated_at')->nullable(false)->after('created_at');
            }
        });
        // 外部キー
        Schema::table('addresses', function (Blueprint $table) {
            try {
                $table->foreign('user_id')->references('id')->on('users')
                    ->cascadeOnUpdate()->restrictOnDelete();
            } catch (\Throwable $e) {
            }
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
            try {
                $table->dropForeign(['user_id']);
            } catch (\Throwable $e) {
            }
            $drop = [
                'user_id',
                'postal_code',
                'prefecture',
                'city',
                'address_line1',
                'address_line2',
                'phone'
            ];
            $drop =
                array_values(array_filter($drop, fn($c) => Schema::hasColumn('addresses', $c)));
            if ($drop) {
                $table->dropColumn($drop);
            }
        });
    }
};
