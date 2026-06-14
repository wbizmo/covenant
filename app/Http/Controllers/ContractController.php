<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreContractRequest;

class ContractController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::orderBy('name')->get();

        $contracts = Contract::with('category')
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->search;

                $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', "%{$search}%")
                        ->orWhere('counterparty', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('category_id'), function ($query) use ($request) {
                $query->where('category_id', $request->category_id);
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                $today = now();

                if ($request->status === 'expired') {
                    $query->whereDate('end_date', '<', $today);
                }

                if ($request->status === 'expiring') {
                    $query
                        ->whereDate('end_date', '>=', $today)
                        ->whereDate('end_date', '<=', $today->copy()->addDays(30));
                }

                if ($request->status === 'active') {
                    $query->where(function ($query) use ($today) {
                        $query
                            ->whereNull('end_date')
                            ->orWhereDate('end_date', '>', $today->copy()->addDays(30));
                    });
                }
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('contracts.index', compact(
            'contracts',
            'categories'
        ));
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
                Storage::disk('public')->delete($contract->document_path);
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
            ->route('contracts.show', $contract)
            ->with('success', 'Contract updated successfully.');
    }

    public function destroy(Contract $contract)
    {
        if (
            $contract->document_path &&
            Storage::disk('public')->exists($contract->document_path)
        ) {
            Storage::disk('public')->delete($contract->document_path);
        }

        $contract->delete();

        return redirect()
            ->route('contracts.index')
            ->with('success', 'Contract deleted successfully.');
    }
}