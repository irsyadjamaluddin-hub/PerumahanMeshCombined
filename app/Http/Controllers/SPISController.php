<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SPISKPI;

class SPISController extends Controller
{
    public function index()
    {
        return view('spis.index');
    }

    public function indexPelan()
    {
        $kpis = SPISKPI::latest()->get();

        return view('spis.pelan.index', compact('kpis'));
    }

    public function create()
    {
        return view('spis.pelan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'owner' => 'required',
            'goal' => 'required',
            'title' => 'required',
            'strategic_objective' => 'required',
            'blueprint_link' => 'required|array',
            'kra' => 'required|array',
        ]);

        SPISKPI::create([
            'owner' => $request->owner,
            'goal' => $request->goal,
            'title' => $request->title,
            'strategic_objective' => $request->strategic_objective,
            'blueprint_link' => $request->blueprint_link,
            'kra' => $request->kra,
        ]);

        return redirect()->route('spis.pelan.index')
            ->with('success', 'KPI created successfully!');
    }

    public function edit($id)
    {
        $kpi = SPISKPI::findOrFail($id);

        return view('spis.pelan.edit', compact('kpi'));
    }

    public function destroy($id)
    {
        $kpi = SPISKPI::findOrFail($id);
        $kpi->delete();

        return redirect()->route('spis.pelan.index')
                        ->with('success', 'KPI deleted successfully!');
    }

    public function update(Request $request, $id)
    {
        $kpi = SPISKPI::findOrFail($id);

        $kpi->update([
            'owner' => $request->owner,
            'goal' => $request->goal,
            'title' => $request->title,
            'strategic_objective' => $request->strategic_objective,
            'blueprint_link' => $request->blueprint_link,
            'kra' => $request->kra,
        ]);

        return redirect()
            ->route('spis.pelan.index')
            ->with('success', 'KPI updated successfully!');
    }

    public function submit($id)
    {
        $kpi = SPISKPI::findOrFail($id);
        $kpi->status = 'submitted';
        $kpi->save();

        return back()->with('success', 'KPI submitted successfully.');
    }

    public function approve($id)
    {
        $kpi = SPISKPI::findOrFail($id);
        $kpi->status = 'approved';
        $kpi->save();

        return back()->with('success', 'KPI approved successfully.');
    }

    public function reject($id)
    {
        $kpi = SPISKPI::findOrFail($id);
        $kpi->status = 'rejected';
        $kpi->save();

        return back()->with('success', 'KPI rejected successfully');
    }

    public function indexAdmin()
    {
        $kpis = SPISKPI::whereIn('status', ['submitted', 'approved', 'rejected'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('spis.pelan.indexAdmin', compact('kpis'));
    }

    public function editApproved($id)
    {
        $kpi = SPISKPI::findOrFail($id);

        $allKpis = SPISKPI::all();

        $blueprintOptions = $allKpis
            ->pluck('blueprint_link')
            ->flatten()
            ->unique()
            ->values();

        $kraOptions = $allKpis
            ->pluck('kra')
            ->flatten()
            ->unique()
            ->values();

        $years = [
            'FY2022/2023',
            'FY2023/2024',
            'FY2024/2025',
            'FY2025/2026',
            'FY2026/2027',
            'FY2027/2028'
        ];

        return view('spis.pelan.editKPI', compact(
            'kpi',
            'blueprintOptions',
            'kraOptions',
            'years'
        ));
    }

    public function updateApproved(Request $request, $id)
    {
        $kpi = SPISKPI::findOrFail($id);

        $kpi->update([
            'kpi_id' => $request->kpi_id,
            'year' => $request->year,
            'baseline' => $request->baseline,
            'actual' => $request->actual,
            'target' => $request->target,
            'rag' => $request->rag,

            'budget_type' => $request->budget_type,
            'financial_year' => $request->financial_year,
            'account' => $request->account,
            'expenditure_type' => $request->expenditure_type,
            'priority' => $request->priority,
            'project_status' => $request->project_status,

            'initial_budget' => $request->initial_budget,
            'approved_budget' => $request->approved_budget,
            'po' => $request->po,
            'contract' => $request->contract,
            'journal' => $request->journal,
            'total_expenditure' => $request->total_expenditure,
            'balance' => $request->balance,

        ]);

        return redirect()
            ->route('spis.pelan.index')
            ->with('success', 'KPI updated successfully!');
    }


}