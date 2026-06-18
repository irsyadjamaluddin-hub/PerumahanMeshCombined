<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SPISPerformance extends Model
{
    protected $table = 'spis_kpi_performance';

    protected $fillable = [
        'kpi_id',
        'year',
        'baseline',
        'actual',
        'target',
        'rag',
        'budget_type',
        'financial_year',
        'account',
        'expenditure_type',
        'priority',
        'project_status',
        'initial_budget',
        'approved_budget',
        'po',
        'contract',
        'journal',
        'total_expenditure',
        'balance'
    ];
}