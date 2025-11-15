<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreItemRequest extends FormRequest
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
            'category_id' => 'required|integer|exists:categories,id',
            'name' => 'required|string|max:255',
            'quantity' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:items,code',
            'description' => 'nullable|string',
            'photos.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'category_id.required' => 'Kategori wajib diisi.',
            'name.required' => 'Nama alat wajib diisi.',
            'code.required' => 'Kode alat wajib diisi.',
            'code.unique' => 'Kode alat sudah digunakan.',
            'quantity.required' => 'Jumlah alat wajib diisi.',
            'photos.*.image' => 'Setiap file harus berupa gambar.',
            'photos.*.mimes' => 'Format gambar harus jpg, jpeg, atau png.',
            'photos.*.max' => 'Ukuran gambar maksimal 2MB.',
        ];
    }
}
