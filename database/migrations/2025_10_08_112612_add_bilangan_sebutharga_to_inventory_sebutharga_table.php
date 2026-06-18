<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBilanganSebuthargaToInventorySebuthargaTable extends Migration
{
    public function up()
    {
        Schema::table('inventory_sebutharga', function (Blueprint $table) {
            $table->string('bilangan_sebutharga')->nullable()->after('bil_sh');
        });
    }

    public function down()
    {
        Schema::table('inventory_sebutharga', function (Blueprint $table) {
            $table->dropColumn('bilangan_sebutharga');
        });
    }
}