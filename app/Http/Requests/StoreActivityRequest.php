<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreActivityRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'activity_type' => 'required|in:meeting,basic training,exploration,anniversary,others',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            // 'leader_id.exists' => 'Leader yang dipilih tidak valid.',

            'title.required' => 'Nama kegiatan harus diisi.',
            'title.string' => 'Nama kegiatan harus berupa teks.',
            'title.max' => 'Nama kegiatan maksimal 255 karakter.',

            'activity_type.required' => 'Jenis kegiatan harus diisi.',
            'activity_type.in' => 'Jenis kegiatan tidak valid.',

            'start_date.required' => 'Tanggal mulai harus diisi.',
            'start_date.date' => 'Tanggal mulai tidak valid.',

            'end_date.required' => 'Tanggal selesai harus diisi.',
            'end_date.date' => 'Tanggal selesai tidak valid.',
            'end_date.after_or_equal' => 'Tanggal selesai tidak boleh sebelum tanggal mulai.',

            'location.required' => 'Lokasi kegiatan harus diisi.',
            'location.string' => 'Lokasi kegiatan harus berupa teks.',
            'location.max' => 'Lokasi maksimal 255 karakter.',

            'description.string' => 'Deskripsi harus berupa teks.',
        ];
    }
}
