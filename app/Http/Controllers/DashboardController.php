<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Contract;

class DashboardController extends Controller
{
    public function index()
    {
        $totalContracts = Contract::count();

        $activeContracts = Contract::where(
            'status',
            'active'
        )->count();

        $expiredContracts = Contract::where(
            'status',
            'expired'
        )->count();

        $expiringContracts = Contract::where(
            'status',
            'expiring'
        )->count();

        $recentContracts = Contract::latest()
            ->take(5)
            ->get();

        $upcomingRenewals = Contract::whereNotNull(
                'renewal_date'
            )
            ->orderBy('renewal_date')
            ->take(5)
            ->get();

        return view('dashboard.index', compact(
            'totalContracts',
            'activeContracts',
            'expiredContracts',
            'expiringContracts',
            'recentContracts',
            'upcomingRenewals'
        ));
    }
}