<?php

namespace App\Http\Requests;

// use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
// use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'hp' => ['nullable', 'string', 'max:255'],
            'nik' => ['required', 'string', 'max:20'],
            'tempat_lahir' => ['nullable', 'string', 'max:255'],
            'tanggal_lahir' => ['nullable', 'date'],
            'jenis_kelamin' => ['nullable', 'string'],
            'alamat' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'numeric'],
        ];
    }
}
