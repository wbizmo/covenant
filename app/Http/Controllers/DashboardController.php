<?php

namespace App\Http\Controllers;

use App\Models\Contract;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', [

            'totalContracts' => Contract::count(),

            'activeContracts' => Contract::where(
                'status',
                'active'
            )->count(),

            'expiringContracts' => Contract::where(
                'status',
                'expiring'
            )->count(),

            'expiredContracts' => Contract::where(
                'status',
                'expired'
            )->count(),

            'recentContracts' => Contract::latest()
                ->take(5)
                ->get(),
        ]);
    }
}