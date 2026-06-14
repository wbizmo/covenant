<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contract;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreContractRequest;

class ContractController extends Controller
{
    public function index()
    {
        $contracts = Contract::with('category')
            ->latest()
            ->paginate(10);

        return view('contracts.index', compact('contracts'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('contracts.create', compact('categories'));
    }

    public function store(StoreContractRequest $request)
    {
        $documentPath = null;

        if ($request->hasFile('document')) {
            $documentPath = $request
                ->file('document')
                ->store('contracts', 'public');
        }

        Contract::create([
            'user_id' => auth()->id(),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'counterparty' => $request->counterparty,
            'value' => $request->value,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'renewal_date' => $request->renewal_date,
            'description' => $request->description,
            'document_path' => $documentPath,
            'status' => 'active',
        ]);

        return redirect()
            ->route('contracts.index')
            ->with('success', 'Contract created successfully.');
    }

    public function show(Contract $contract)
    {
        return view('contracts.show', compact('contract'));
    }

    public function edit(Contract $contract)
    {
        $categories = Category::orderBy('name')->get();

        return view('contracts.edit', compact(
            'contract',
            'categories'
        ));
    }

    public function update(StoreContractRequest $request, Contract $contract)
    {
        $documentPath = $contract->document_path;

        if ($request->hasFile('document')) {

            if (
                $contract->document_path &&
                Storage::disk('public')->exists($contract->document_path)
            ) {
                Storage::disk('public')->delete(
                    $contract->document_path
                );
            }

            $documentPath = $request
                ->file('document')
                ->store('contracts', 'public');
        }

        $contract->update([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'counterparty' => $request->counterparty,
            'value' => $request->value,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'renewal_date' => $request->renewal_date,
            'description' => $request->description,
            'document_path' => $documentPath,
        ]);

        return redirect()
            ->route('contracts.index')
            ->with('success', 'Contract updated successfully.');
    }

    public function destroy(Contract $contract)
    {
        if (
            $contract->document_path &&
            Storage::disk('public')->exists($contract->document_path)
        ) {
            Storage::disk('public')->delete(
                $contract->document_path
            );
        }

        $contract->delete();

        return redirect()
            ->route('contracts.index')
            ->with('success', 'Contract deleted successfully.');
    }
}