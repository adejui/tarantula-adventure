<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        $id = $this->route('user')->id ?? null;

        return [
            'full_name'    => 'required|string|max:100',
            'email'        => 'required|email|unique:users,email,' . $id,
            'phone_number' => 'nullable|regex:/^[0-9]{10,15}$/',
            'nrp'          => 'nullable|string|max:20',
            'password'     => 'nullable|min:8|confirmed',
            'major'        => 'nullable|string|max:50',
            'generation'   => 'nullable|string|max:10',
            'batch'        => 'nullable|string|max:10',
            'photo'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'birth_date'   => 'nullable|date|before:today',
            'status'       => 'required|in:active,inactive,alumni',
            'gender'       => 'required|in:male,female',
            'position'     => 'required|in:leader,secretary,logistics,member',
            'role'         => 'required|in:admin,logistics,member',
        ];
    }

    public function messages(): array
    {
        return [
            'full_name.required'    => 'Nama lengkap wajib diisi.',
            'full_name.max'         => 'Nama lengkap maksimal 100 karakter.',

            'email.required'        => 'Email wajib diisi.',
            'email.email'           => 'Format email tidak valid.',
            'email.unique'          => 'Email ini sudah digunakan oleh pengguna lain.',

            'phone_number.required' => 'Nomor telepon wajib diisi.',
            'phone_number.regex'    => 'Nomor telepon harus terdiri dari 10-15 angka.',

            'password.min'          => 'Kata sandi minimal 8 karakter.',

            'photo.image'           => 'File foto harus berupa gambar.',
            'photo.mimes'           => 'Format gambar harus jpg, jpeg, atau png.',
            'photo.max'             => 'Ukuran foto maksimal 2 MB.',

            'birth_date.date'       => 'Tanggal lahir tidak valid.',
            'birth_date.before'     => 'Tanggal lahir harus sebelum hari ini.',

            'status.required'       => 'Status wajib diisi.',
            'status.in'             => 'Status harus salah satu dari: active, inactive, atau alumni.',

            'gender.required'       => 'Jenis kelamin wajib diisi.',
            'gender.in'             => 'Jenis kelamin harus male atau female.',

            'position.required'     => 'Jabatan wajib diisi.',
            'position.in'           => 'Jabatan harus salah satu dari: leader, secretary, logistics, atau member.',

            'role.required'         => 'Role wajib diisi.',
            'role.in'               => 'Role harus salah satu dari: admin, logistics, atau member.',
        ];
    }
}
