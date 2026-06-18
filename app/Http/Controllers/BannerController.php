<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;
use Log;
use Carbon\Carbon;
use App\Models\Banner;

use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index(){

        $banners = Banner::all();

        return view('banner.index',compact('banners'));
    }

    public function store(Request $request)
    {
        $bn = new Banner;

        $currentdate = Carbon::now();
        $icNos = Auth::user()->ic_no;

        $file = $request->file('bn_image');
        $filename = time().'_'.$file->getClientOriginalName();

        $file->move(public_path('banner'), $filename);

        $bn->name = $request->name;
        $bn->ic_no = $icNos;
        $bn->bn_image = $file->getClientOriginalName();
        $bn->bn_image_path = 'banner/'.$filename;
        $bn->created_at = $currentdate;
        $bn->updated_at = $currentdate;

        $bn->save();

        return redirect()->route('bn.banner.index')
            ->with('success_message', 'Image was successfully added!');
    }

    public function delete($id){

        $user =  Auth::user();

        try {
            $bns = Banner::findOrFail($id);
            $bns->delete();

            return redirect()->route('bn.banner.index')
                            ->with('success_message', 'Image was successfully deleted!');

        } catch (Exception $exception) {

            return back()->withInput()
                        ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }

    }
}
