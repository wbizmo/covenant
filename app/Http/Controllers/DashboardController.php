<?php

namespace App\Http\Controllers;

use App\Models\Contract;

class DashboardController extends Controller
{
    public function index()
    {
        $contracts = Contract::all();

        $totalContracts = $contracts->count();

        $activeContracts = $contracts
            ->filter(fn ($contract) => $contract->calculated_status === 'active')
            ->count();

        $expiringContracts = $contracts
            ->filter(fn ($contract) => $contract->calculated_status === 'expiring')
            ->count();

        $expiredContracts = $contracts
            ->filter(fn ($contract) => $contract->calculated_status === 'expired')
            ->count();

        $recentContracts = Contract::latest()
            ->take(5)
            ->get();

        $upcomingRenewals = Contract::whereNotNull('renewal_date')
            ->orderBy('renewal_date')
            ->take(5)
            ->get();

        return view('dashboard.index', compact(
            'totalContracts',
            'activeContracts',
            'expiringContracts',
            'expiredContracts',
            'recentContracts',
            'upcomingRenewals'
        ));
    }
}