<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PendaftaranTryoutRequest extends FormRequest
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
            
			'id_pendaftar' => 'required|string',
			'no_peserta' => 'string',
			'nama_lengkap' => 'string',
			'nisn' => 'string',
			'nama_asal_sekolah' => 'string',
			'nama_ortu' => 'string',
			'no_wa_ortu' => 'string',
			'no_wa_peserta' => 'string',
			'alamat_domisili' => 'string',
			'tanggal_pembayaran' => 'string',
        ];
    }
}
