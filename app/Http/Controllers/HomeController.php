<?php

namespace App\Http\Controllers;

use App\Models\Neighborhood;
use App\Models\Report;
use App\Models\User;

class HomeController extends Controller
{

    public function index()
    {
        $stats = [
            'reports_count' => Report::whereNotIn('status', ['rejected'])->count(),
            'resolved_count' => Report::where('status', 'resolved')->count(),
            'users_count' => User::where('role', '!=', 'admin')->where('status', true)->count(),
            'districts_count' => Neighborhood::where('status', true)->count(),
        ];

        return view('pages/home', compact('stats'));
    }
}
