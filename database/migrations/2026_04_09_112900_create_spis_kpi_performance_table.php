<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpisKpiPerformanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spis_kpi_performance', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kpi_id')->constrained('spis_kpi')->cascadeOnDelete();

            $table->integer('year');

            // PERFORMANCE
            $table->string('baseline')->nullable();
            $table->string('actual')->nullable();
            $table->string('target')->nullable();
            $table->string('rag')->nullable();

            // BUDGET
            $table->string('budget_type')->nullable();
            $table->string('financial_year')->nullable();
            $table->string('account')->nullable();
            $table->string('expenditure_type')->nullable();
            $table->string('priority')->nullable();
            $table->string('project_status')->nullable();

            $table->decimal('initial_budget', 12, 2)->nullable();
            $table->decimal('approved_budget', 12, 2)->nullable();

            // EXPENDITURE
            $table->decimal('po', 12, 2)->nullable();
            $table->decimal('contract', 12, 2)->nullable();
            $table->decimal('journal', 12, 2)->nullable();

            $table->decimal('total_expenditure', 12, 2)->nullable();
            $table->decimal('balance', 12, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spis_kpi_performance');
    }
}
