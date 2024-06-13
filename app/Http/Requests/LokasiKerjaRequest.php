<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LokasiKerjaRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'form.nama' => ['required', 'string', 'max:255'],
            'form.lat' => ['required', 'numeric'],
            'form.lon' => ['required', 'numeric'],
            'form.radius' => ['required', 'numeric'],
        ];
    }
}
