<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // Personal Information
            'name' => ['required', 'string', 'max:255'],
            'username' => [
                'nullable',
                'string',
                'max:191',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            
            // Contact Information
            'phone' => ['nullable', 'string', 'max:191'],
            'age' => ['nullable', 'integer', 'min:1', 'max:120'],
            'work' => ['nullable', 'string', 'max:191'],
            'address' => ['nullable', 'string', 'max:191'],
            
            // Identity Information
            'nik' => ['nullable', 'string', 'max:16', 'min:16'],
            'ktp' => ['nullable', 'string', 'max:16', 'min:16'],
            'npwp' => ['nullable', 'string', 'max:255'],
            'nip' => ['nullable', 'string', 'max:255'],
            'status_ktp' => ['nullable', 'string', 'in:Valid,Tidak Valid,Belum Verifikasi'],
            'ket_ktp' => ['nullable', 'string', 'max:191'],
        ];
    }
}
