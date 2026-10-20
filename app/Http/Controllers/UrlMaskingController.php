<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UrlMaskingController extends Controller
{
    public function redirect($slug)
    {
        // Define your mapping for masked URLs here
        $urlMappings = [
            'postup' => 'http://127.0.0.1:8000/postup',
            // Add more mappings as needed
        ];

        if (isset($urlMappings[$slug])) {
            return redirect($urlMappings[$slug]);
        }

        // Handle the case where the slug doesn't match any mapping
        abort(404);
    }
}

