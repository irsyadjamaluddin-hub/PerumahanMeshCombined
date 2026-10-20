<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('kkk_sekolah', function (Blueprint $table) {
            if (! Schema::hasColumn('kkk_sekolah', 'kod')) {
                $table->string('kod', 10)->nullable(); // 01, 02 … within the kluster
            }
            if (! Schema::hasColumn('kkk_sekolah', 'rujukan_fail')) {
                // Not unique: SQL Server counts NULLs as duplicates. KkkSekolahSeeder keys on it instead.
                $table->string('rujukan_fail', 30)->nullable()->index(); // KP/UAD/K1-01
            }
        });
    }

    public function down()
    {
        Schema::table('kkk_sekolah', function (Blueprint $table) {
            $table->dropIndex(['rujukan_fail']);
            $table->dropColumn(['kod', 'rujukan_fail']);
        });
    }
};
