<?php

namespace App\Http\Controllers;

use App\Models\DevopsAdminEmail;
use Illuminate\Http\Request;

class DevopsAdminEmailController extends Controller
{
    public function emailIndex() {
        $devopsAdminEmails = DevopsAdminEmail::all();
        
        return view('devopsrequest.admin-email', compact('devopsAdminEmails'));
    }

    public function storeAdminEmail() {
        foreach (request('moreFields') as $key => $value) {
            DevopsAdminEmail::create($value);
        }

        return redirect()->route('devops-request.admin-emails')->with('success_message', 'New Data record was successfully added!');
    }

    public function destroyEmail(DevopsAdminEmail $devopsAdminEmail) {
        $devopsAdminEmail->delete();

        return redirect()->route('devops-request.admin-emails')->with('success_message', 'Data was successfully deleted!');
    }
}
