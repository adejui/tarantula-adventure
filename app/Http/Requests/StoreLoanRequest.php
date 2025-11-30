<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLoanRequest extends FormRequest
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
            'user_id' => [
                'nullable',
                'exists:users,id',
                'required_without:opa_id',   // minimal harus isi salah satu
                'prohibits:opa_id',          // kalau user_id diisi, opa_id tidak boleh diisi
            ],

            'opa_id' => [
                'nullable',
                'exists:opas,id',
                'required_without:user_id',  // minimal harus isi salah satu
                'prohibits:user_id',         // kalau opa_id diisi, user_id tidak boleh diisi
            ],
            'borrow_date' => 'required|date',
            'return_date' => 'required|date|after_or_equal:borrow_date',
            'status' => 'in:requested,approved,borrowed,returned,rejected,late',
            'notes' => 'nullable|string',
            'loan_document' => 'nullable|file|mimes:pdf|mimetypes:application/pdf|max:4096',
        ];
    }

    public function messages(): array
    {
        return [

            'user_id.prohibits' => 'Field anggota tidak boleh diisi jika OPA dipilih.',
            'opa_id.prohibits'  => 'Field OPA tidak boleh diisi jika anggota dipilih.',

            'user_id.required_without' => 'Pilih salah satu: anggota atau OPA.',
            'opa_id.required_without' => 'Pilih salah satu: anggota atau OPA.',

            'user_id.prohibited_with' => 'Tidak boleh memilih anggota dan OPA sekaligus.',
            'opa_id.prohibited_with' => 'Tidak boleh memilih anggota dan OPA sekaligus.',

            'borrow_date.required'   => 'Tanggal mulai wajib diisi.',
            'borrow_date.date'       => 'Tanggal mulai tidak valid.',

            'return_date.required'   => 'Tanggal kembali wajib diisi.',
            'return_date.date'       => 'Tanggal kembali tidak valid.',
            'return_date.after_or_equal' => 'Tanggal kembali harus lebih besar atau sama dengan tanggal pinjam.',

            'status.in'              => 'Status tidak valid.',

            'loan_document.file'     => 'Dokumen harus berupa file.',
            'loan_document.mimes' => 'Dokumen harus berformat PDF.',
            'loan_document.max'   => 'Ukuran dokumen maksimal 4 MB.',

        ];
    }
}
