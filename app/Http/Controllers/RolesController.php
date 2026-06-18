<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RolesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:ROLE_SUPERADMIN');
    }
    
    /**
     * Display a listing of the roles.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $roles = Role::paginate(25);

        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new role.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('roles.create');
    }

    /**
     * Store a new role in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            Role::create($data);

            return redirect()->route('roles.role.index')
                             ->with('success_message', 'Role was successfully added!');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    /**
     * Display the specified role.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $role = Role::findOrFail($id);

        return view('roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified role.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        

        return view('roles.edit', compact('role'));
    }

    /**
     * Update the specified role in the storage.
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
            
            $role = Role::findOrFail($id);
            $role->update($data);

            return redirect()->route('roles.role.index')
                             ->with('success_message', 'Role was successfully updated!');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }        
    }

    /**
     * Remove the specified role from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $role = Role::findOrFail($id);
            $role->delete();

            return redirect()->route('roles.role.index')
                             ->with('success_message', 'Role was successfully deleted!');

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
            'name' => 'required|string|min:1|max:191',
            'description' => 'required|string|min:1|max:191',
                
        ]);




        return $data;
    }

}