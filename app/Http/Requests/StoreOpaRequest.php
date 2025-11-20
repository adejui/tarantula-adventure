<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOpaRequest extends FormRequest
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
            'name'              => 'required',
            'organization_name' => 'required',
            'campus_name'       => 'required',
            'phone_number'      => 'required',
            'email'             => 'required|email|unique:opas,email',
        ];
    }

    public function messages()
    {
        return [
            'name.required'              => 'Nama wajib diisi.',
            'organization_name.required' => 'Organisasi wajib diisi.',
            'campus_name.required'       => 'Kampus wajib diisi.',
            'phone_number.required'      => 'Nomor telepon wajib diisi.',
            'email.required'             => 'Email wajib diisi.',
            'email.email'                => 'Format email tidak valid.',
            'email.unique'               => 'Email sudah terdaftar.',
        ];
    }
}
