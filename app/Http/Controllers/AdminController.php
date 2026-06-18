<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Session;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:ROLE_SUPERADMIN');
    }
    
   public function index()
    {   
        return view('admin.home');    
        
    }

   
	
}
