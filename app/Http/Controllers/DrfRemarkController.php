<?php

namespace App\Http\Controllers;

use App\Models\DrfRemark;
use Illuminate\Http\Request;

class DrfRemarkController extends Controller
{
    public function destroy(DrfRemark $drfRemark) {
        $drfRemark->delete();

        return redirect()->back()->with('success', 'Remark deleted successfully');
    }
}
