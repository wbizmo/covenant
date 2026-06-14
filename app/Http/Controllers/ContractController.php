<?php

namespace App\Http\Controllers;

use App\Models\Contract;

class ContractController extends Controller
{
    public function index()
    {
        $contracts = Contract::latest()->paginate(10);

        return view('contracts.index', compact('contracts'));
    }

    public function create()
    {
        return view('contracts.create');
    }

    public function store()
    {
        //
    }

    public function show(Contract $contract)
    {
        //
    }

    public function edit(Contract $contract)
    {
        //
    }

    public function update(Contract $contract)
    {
        //
    }

    public function destroy(Contract $contract)
    {
        //
    }
}