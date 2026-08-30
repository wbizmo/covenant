<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContractRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'title' => ['required','string','max:255'],
            'counterparty' => ['required','string','max:255'],
            'category_id' => ['nullable','exists:categories,id'],
            'value' => ['nullable','numeric'],
            'start_date' => ['nullable','date'],
            'end_date' => ['nullable','date'],
            'renewal_date' => ['nullable','date'],
            'description' => ['nullable','string'],
            'document' => ['nullable','file','mimes:pdf,doc,docx,txt','max:10240'],
        ];
    }
}
