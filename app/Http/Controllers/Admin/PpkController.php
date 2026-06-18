<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ppk;
use Illuminate\Validation\ValidationException;

class PpkController extends Controller
{
    // List all PPKs
    public function index()
    {
        $ppks = Ppk::all();
        return view('admin.ppk.index', compact('ppks'));
    }

    // Store a new PPK via AJAX
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:ppks,email',
                'ic_no' => 'required|string|unique:ppks,ic_no',
                'phone' => 'nullable|string',
            ]);

            $ppk = Ppk::create($validated);

            return response()->json([
                'success' => true,
                'ppk' => $ppk
            ], 200);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong: ' . $e->getMessage()
            ], 500);
        }
    }

    // Delete a PPK via AJAX
    public function destroyPpk($id)
    {
        $ppk = Ppk::find($id);

        if (!$ppk) {
            return response()->json(['success' => false, 'message' => 'PPK not found.'], 404);
        }

        $ppk->delete();

        return response()->json(['success' => true], 200);
    }
}
