<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('ic_no')->unique()->nullable();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->string('bahagian_id')->nullable();
            $table->unsignedBigInteger('division_id')->nullable();
            $table->string('telephone_mobile')->nullable();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('remember_token', 100)->nullable();
            $table->integer('login_attempts')->default(0)->nullable();
            $table->timestamp('locked_until')->nullable();
            $table->string('ap1_name')->nullable();
            $table->string('ap1_email')->nullable();
            $table->string('ap2_name')->nullable();
            $table->string('ap2_email')->nullable();
            $table->string('approval_response')->nullable();
            $table->timestamp('approve_at')->nullable();
            $table->string('approval_response2')->nullable();
            $table->timestamp('approve_at2')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
