<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLoanDetailRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'loan_id' => 'required|exists:loans,id',
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer|min:1',
            'condition_on_return' => 'nullable|in:good,fair,broken',
            'notes' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'loan_id.required' => 'Loan tidak boleh kosong.',
            'loan_id.exists'   => 'Loan yang dipilih tidak valid.',

            'item_id.required' => 'Item tidak boleh kosong.',
            'item_id.exists'   => 'Item yang dipilih tidak valid.',

            'quantity.required' => 'Quantity wajib diisi.',
            'quantity.integer'  => 'Quantity harus berupa angka.',
            'quantity.min'      => 'Quantity minimal bernilai 1.',

            'condition_on_return.in' => 'Kondisi pengembalian harus salah satu: good, fair, atau broken.',

            'notes.string' => 'Notes harus berupa teks.',
        ];
    }
}
