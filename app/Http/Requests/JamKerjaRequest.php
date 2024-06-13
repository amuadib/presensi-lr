<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JamKerjaRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'form.nama' => ['required', 'string', 'max:255'],
            'form.singkatan' => ['nullable', 'string', 'max:20'],
            'form.batas_mulai_presensi' => ['required', 'numeric'],
            'form.batas_akhir_presensi' => ['required', 'numeric'],
            'form.jam.*.hari' => ['nullable'],
            'form.jam.*.datang' => ['nullable'],
            'form.jam.*.pulang' => ['nullable'],
        ];
    }
}
