<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpSalaryInfosTable extends Migration
{
    public function up()
    {
        Schema::create('emp_salary_infos', function (Blueprint $table) {
            $table->id();
            $table->string('ic_no')->nullable()->unique();
            $table->string('salaryscale_id')->nullable();
            $table->string('increment_date')->nullable();
            $table->string('division_id')->nullable();
            $table->string('salary')->nullable();
            $table->string('allowance_category_id')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('emp_salary_infos');
    }
}
