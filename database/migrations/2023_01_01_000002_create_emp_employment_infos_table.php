<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpEmploymentInfosTable extends Migration
{
    public function up()
    {
        Schema::create('emp_employment_infos', function (Blueprint $table) {
            $table->id();
            $table->string('ic_no')->nullable()->unique();
            $table->string('ministry_id')->nullable();
            $table->string('department_id')->nullable();
            $table->string('bahagian_id')->nullable();
            $table->string('bahagian_other')->nullable();
            $table->string('unit_id')->nullable();
            $table->string('unit_other')->nullable();
            $table->string('school_id')->nullable();
            $table->string('cluster_id')->nullable();
            $table->string('district_work_id')->nullable();
            $table->string('service_begin_date')->nullable();
            $table->string('first_service_place')->nullable();
            $table->string('retirement_date')->nullable();
            $table->string('current_designation_date')->nullable();
            $table->string('current_service_place')->nullable();
            $table->string('currrent_service_place')->nullable();
            $table->string('service_status_id')->nullable();
            $table->string('role')->nullable();
            $table->string('role_date_start')->nullable();
            $table->string('designation_id')->nullable();
            $table->string('current_designation_id')->nullable();
            $table->string('employment_status_id')->nullable();
            $table->string('division_id')->nullable();
            $table->string('salary_scale')->nullable();
            $table->string('salary')->nullable();
            $table->string('allowance_category_id')->nullable();
            $table->string('skim_perguruan')->nullable();
            $table->string('skim_perkhidmatan_id')->nullable();
            $table->string('ssm_reference_no')->nullable();
            $table->string('dept_reference_no')->nullable();
            $table->string('code_service')->nullable();
            $table->string('personnel_file')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('emp_employment_infos');
    }
}
