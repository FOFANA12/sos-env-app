<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{

    public function index()
    {
        $stats = [
            'reports_count' => 124,
            'resolved_count' => 87,
            'users_count' => 56,
            'districts_count' => 12,
        ];

        return view('pages/home', compact('stats'));
    }
    
}
