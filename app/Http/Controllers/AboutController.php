<?php

namespace App\Http\Controllers;

class AboutController extends Controller
{
    public function index()
    {
        $stats = [
            'reports_count'  => 1200,
            'resolved_count' => 892,
            'regions_count'  => 15,
        ];

        return view('pages/about', compact('stats'));
    }
}
