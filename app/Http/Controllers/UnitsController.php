<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Biodata;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class UnitsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the users.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
		if(Auth::user()->hasRole('ROLE_SUPERADMIN')  ||  Auth::user()->hasRole('ROLE_MAW_SECOND') ||  Auth::user()->hasRole('ROLE_MAW') ||  Auth::user()->hasRole('ROLE_MAW_ENDORSER')) 
		{
		
        $units = Unit::paginate(30);

        return view('units.index', compact('units'));
		
		}
		
		else {
			
			return redirect()->back();
			
		}
    }

    /**
     * Show the form for creating a new user.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
		
		if(Auth::user()->hasRole('ROLE_SUPERADMIN')  ||  Auth::user()->hasRole('ROLE_MAW_SECOND') ||  Auth::user()->hasRole('ROLE_MAW') ||  Auth::user()->hasRole('ROLE_MAW_ENDORSER')) 
		{
		
		$lastID = DB::table('units')
				->count();
		$latestID = $lastID + 1;
		
		$code = $latestID;
		
        return view('units.create', compact('code'));
		
		}
		
		else {
			
			return redirect()->back();
			
		}
		
    }

    /**
     * Store a new user in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            Unit::create($data);

            return redirect()->route('units.unit.index')
                             ->with('success_message', 'Unit was successfully added!');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    /**
     * Display the specified unit.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
		
		if(Auth::user()->hasRole('ROLE_SUPERADMIN')  ||  Auth::user()->hasRole('ROLE_MAW_SECOND') ||  Auth::user()->hasRole('ROLE_MAW') ||  Auth::user()->hasRole('ROLE_MAW_ENDORSER')) 
		{
		
        $unit = Unit::findOrFail($id);

        return view('units.show', compact('unit'));
		
		}
		
		else {
			
			return redirect()->back();
			
		}
    }

    /**
     * Show the form for editing the specified unit.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $unit = Unit::findOrFail($id);
        
        return view('units.edit', compact('unit'));
    }

    /**
     * Update the specified unit in the storage.
     *
     * @param  int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            $unit = Unit::findOrFail($id);
            $unit->update($data);

            return redirect()->route('units.unit.index')
                             ->with('success_message', 'Unit was successfully updated!');

        } catch (Exception $exception) {
			
            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }        
    }

    /**
     * Remove the specified unit from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $unit = Unit::findOrFail($id);
            $unit->delete();

            return redirect()->route('units.unit.index')
                             ->with('success_message', 'Unit was successfully deleted!');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    
    /**
     * Get the request's data from the request.
     *
     * @param Illuminate\Http\Request\Request $request 
     * @return array
     */
    protected function getData(Request $request)
    {
		
        $data = $request->validate([
            'code' => 'required|string|min:1|max:191',
			'label' => 'required|string|min:4|max:191',
        ]);


        return $data;
    }

}