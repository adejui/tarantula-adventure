<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'full_name'    => 'required|string|max:100',
            'email'        => 'required|email|unique:users,email,' . $this->id,
            'phone_number' => 'nullable|regex:/^[0-9]{10,15}$/',
            'nrp'   => 'required|string|max:20',
            // 'password'     => $this->isMethod('post') ? 'required|min:8|confirmed' : 'nullable|min:8|confirmed',
            'password'     => 'required|min:8',
            'generation'   => 'required|string|max:10',
            'batch'   => 'required|string|max:10',
            'major'        => 'nullable|string|max:50',
            'photo'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'birth_date'   => 'nullable|date|before:today',
            'status'       => 'required|in:active,inactive,alumni',
            'gender'       => 'nullable|in:male,female',
            'position'     => 'required|in:leader,secretary,logistics,member',
            'role'         => 'required|in:admin,logistics,member',
        ];
    }

    public function messages(): array
    {
        return [
            'full_name.required'    => 'Nama lengkap wajib diisi.',
            'full_name.max'         => 'Nama lengkap maksimal 100 karakter.',

            'nrp.required'    => 'NRP wajib diisi.',

            'email.required'        => 'Email wajib diisi.',
            'email.email'           => 'Format email tidak valid.',
            'email.unique'          => 'Email ini sudah terdaftar.',

            'phone_number.required' => 'Nomor telepon wajib diisi.',
            'phone_number.regex'    => 'Nomor telepon harus terdiri dari 10-15 angka.',

            'password.required'     => 'Kata sandi wajib diisi.',
            'password.min'          => 'Kata sandi minimal 8 karakter.',
            // 'password.confirmed'    => 'Konfirmasi kata sandi tidak cocok.',

            'photo.image'           => 'File foto harus berupa gambar.',
            'photo.mimes'           => 'Format gambar harus jpg, jpeg, atau png.',
            'photo.max'             => 'Ukuran foto maksimal 2 MB.',

            'generation.required'     => 'Angkatan wajib diisi.',
            'generation.string' => 'Angkatan harus berupa teks.',
            'generation.max'    => 'Angkatan tidak boleh lebih dari 10 karakter.',

            'batch.required'     => 'Angkatan wajib diisi.',
            'batch.string' => 'Angkatan harus berupa teks.',
            'batch.max'    => 'Angkatan tidak boleh lebih dari 10 karakter.',

            'birth_date.date'       => 'Tanggal lahir tidak valid.',
            'birth_date.before'     => 'Tanggal lahir harus sebelum hari ini.',

            'status.required'       => 'Status wajib diisi.',
            'status.in'             => 'Status harus salah satu dari: active, inactive, atau alumni.',

            'major.required'       => 'Program Studi wajib diisi.',

            'gender.required'       => 'Jenis kelamin wajib diisi.',
            'gender.in'             => 'Jenis kelamin harus male atau female.',

            'position.required'     => 'Jabatan wajib diisi.',
            'position.in'           => 'Jabatan harus salah satu dari: leader, secretary, logistics, atau member.',

            'role.required'         => 'Role wajib diisi.',
            'role.in'               => 'Role harus salah satu dari: admin, logistics, atau member.',
        ];
    }
}
