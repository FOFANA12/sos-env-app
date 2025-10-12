<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\Report;

class AboutController extends Controller
{
    public function index()
    {
        $stats = [
            'reports_count' => Report::whereNotIn('status', ['rejected'])->count(),
            'resolved_count' => Report::where('status', 'resolved')->count(),
            'regions_count' => Region::where('status', true)->count(),
        ];

        return view('pages/about', compact('stats'));
    }
}
