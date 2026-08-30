<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContractRequest;
use App\Models\Category;
use App\Models\Contract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ContractController extends Controller
{
    private function assertOwner(Contract $contract): void
    {
        abort_unless($contract->user_id === auth()->id(), 404);
    }

    public function index(Request $request)
    {
        $categories = Category::orderBy('name')->get();

        $contracts = Contract::with('category')
            ->where('user_id', $request->user()->id)
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->search;
                $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', "%{$search}%")
                        ->orWhere('counterparty', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('category_id'), fn ($query) => $query->where('category_id', $request->category_id))
            ->when($request->filled('status'), function ($query) use ($request) {
                $today = now();
                if ($request->status === 'expired') {
                    $query->whereDate('end_date', '<', $today);
                }
                if ($request->status === 'expiring') {
                    $query->whereDate('end_date', '>=', $today)
                        ->whereDate('end_date', '<=', $today->copy()->addDays(30));
                }
                if ($request->status === 'active') {
                    $query->where(function ($query) use ($today) {
                        $query->whereNull('end_date')
                            ->orWhereDate('end_date', '>', $today->copy()->addDays(30));
                    });
                }
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('contracts.index', compact('contracts', 'categories'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('contracts.create', compact('categories'));
    }

    public function store(StoreContractRequest $request)
    {
        $documentPath = $request->hasFile('document')
            ? $request->file('document')->store('contracts', 'local')
            : null;

        Contract::create([
            'user_id' => $request->user()->id,
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

        return redirect()->route('contracts.index')->with('success', 'Contract created successfully.');
    }

    public function show(Contract $contract)
    {
        $this->assertOwner($contract);
        return view('contracts.show', compact('contract'));
    }

    public function edit(Contract $contract)
    {
        $this->assertOwner($contract);
        $categories = Category::orderBy('name')->get();
        return view('contracts.edit', compact('contract', 'categories'));
    }

    public function update(StoreContractRequest $request, Contract $contract)
    {
        $this->assertOwner($contract);
        $documentPath = $contract->document_path;

        if ($request->hasFile('document')) {
            if ($contract->document_path && Storage::disk('local')->exists($contract->document_path)) {
                Storage::disk('local')->delete($contract->document_path);
            }
            $documentPath = $request->file('document')->store('contracts', 'local');
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

        return redirect()->route('contracts.show', $contract)->with('success', 'Contract updated successfully.');
    }

    public function download(Contract $contract): StreamedResponse
    {
        $this->assertOwner($contract);
        abort_unless($contract->document_path && Storage::disk('local')->exists($contract->document_path), 404);

        return Storage::disk('local')->download(
            $contract->document_path,
            basename($contract->document_path),
            ['Cache-Control' => 'private, no-store']
        );
    }

    public function destroy(Contract $contract)
    {
        $this->assertOwner($contract);
        if ($contract->document_path && Storage::disk('local')->exists($contract->document_path)) {
            Storage::disk('local')->delete($contract->document_path);
        }
        $contract->delete();

        return redirect()->route('contracts.index')->with('success', 'Contract deleted successfully.');
    }
}
