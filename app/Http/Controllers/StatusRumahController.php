<?php

namespace App\Http\Controllers;

use App\Models\StatusRumah;
use Illuminate\Http\Request;

class StatusRumahController extends Controller
{
    public function index()
    {
        $statuses = StatusRumah::orderBy('id')->get();
        return view('status_rumah.index', compact('statuses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'moreFields.*.status' => 'required|string|max:191',
        ]);

        foreach ($request->moreFields as $field) {
            StatusRumah::create([
                'status' => strtoupper($field['status']),
            ]);
        }

        return back()->with('success', 'Status Rumah berjaya ditambah');
    }

    public function destroy($id)
    {
        StatusRumah::findOrFail($id)->delete();
        return back()->with('success', 'Status Rumah berjaya dipadam');
    }
}
