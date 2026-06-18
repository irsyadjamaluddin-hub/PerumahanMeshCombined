<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Biodata;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class DepartmentsController extends Controller
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
		
        $departments = Department::paginate(30);

        return view('departments.index', compact('departments'));
		
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
		
		$lastID = DB::table('departments')
				->count();
		$latestID = $lastID + 1;
		
		$code = $latestID;
		
        return view('departments.create', compact('code'));
		
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
            
            Department::create($data);

            return redirect()->route('departments.department.index')
                             ->with('success_message', 'Department was successfully added!');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    /**
     * Display the specified department.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
		
		if(Auth::user()->hasRole('ROLE_SUPERADMIN')  ||  Auth::user()->hasRole('ROLE_MAW_SECOND') ||  Auth::user()->hasRole('ROLE_MAW') ||  Auth::user()->hasRole('ROLE_MAW_ENDORSER')) 
		{
		
        $department = Department::findOrFail($id);

        return view('departments.show', compact('department'));
		
		}
		
		else {
			
			return redirect()->back();
			
		}
    }

    /**
     * Show the form for editing the specified department.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $department = Department::findOrFail($id);
        
        return view('departments.edit', compact('department'));
    }

    /**
     * Update the specified department in the storage.
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
            
            $department = Department::findOrFail($id);
            $department->update($data);

            return redirect()->route('departments.department.index')
                             ->with('success_message', 'Department was successfully updated!');

        } catch (Exception $exception) {
			
            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }        
    }

    /**
     * Remove the specified department from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $department = Department::findOrFail($id);
            $department->delete();

            return redirect()->route('departments.department.index')
                             ->with('success_message', 'Department was successfully deleted!');

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