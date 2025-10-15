<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        if (!Schema::hasColumn(
            'comments',
            'body'
        )) {
            Schema::table(
                'comments',
                function (Blueprint $table) {
                    $table->text('body')->after('user_id');
                }
            );
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        if (!Schema::hasColumn('comments', 'body')) {
            Schema::table('comments', function (Blueprint $table) {
                $table->dropColumn('body');
            });
        }
    }
};
