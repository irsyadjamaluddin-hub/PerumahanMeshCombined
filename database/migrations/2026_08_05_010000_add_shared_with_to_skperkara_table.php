<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('skperkara', function (Blueprint $table) {
            $table->text('shared_with')->nullable()->after('status');
        });
    }

    public function down()
    {
        Schema::table('skperkara', function (Blueprint $table) {
            $table->dropColumn('shared_with');
        });
    }
};
