<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('perkaraevent', function (Blueprint $table) {
            $table->text('shared_with')->nullable()->after('email');
        });
    }

    public function down()
    {
        Schema::table('perkaraevent', function (Blueprint $table) {
            $table->dropColumn('shared_with');
        });
    }
};
