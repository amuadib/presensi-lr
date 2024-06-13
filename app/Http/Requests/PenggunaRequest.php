<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PenggunaRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'pengguna.nama' => ['required', 'string', 'max:255'],
            'pengguna.jabatan' => ['nullable', 'string', 'max:255'],
            'pengguna.foto' => ['required', 'string', 'max:255'],
            'pengguna.email' => ['nullable', 'email', 'max:255'],
            'pengguna.hp' => ['required', 'string', 'max:20'],
            'pengguna.nik' => ['nullable', 'string', 'max:20'],
            'pengguna.tempat_lahir' => ['nullable', 'string', 'max:255'],
            'pengguna.tanggal_lahir' => ['nullable', 'date'],
            'pengguna.jenis_kelamin' => ['nullable'],
            'pengguna.alamat' => ['nullable', 'string'],
            'pengguna.status' => ['nullable', 'string', 'max:2'],
            'pengguna.unit_kerja_id' => ['nullable', 'numeric', 'min:1'],
            'pengguna.lokasi_id' => ['nullable', 'numeric', 'min:1'],
            'pengguna.aktif' => ['required'],
            'pengguna.jenis_akun' => ['required'],
            'jam_kerja_id' => ['nullable', 'array'],
        ];
    }
}
