<?php

namespace App\Http\Requests\Link;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateShortLinkRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Aturan validasi pembaruan Short Link.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $shortLink = $this->route('short_link');
        $shortLinkId = is_object($shortLink) ? $shortLink->id : $shortLink;

        return [
            'name' => ['required', 'string', 'max:255'],
            'destination_url' => [
                'required',
                'url',
                'regex:/^https?:\/\//i',
                'max:2048',
            ],
            'code' => [
                'required',
                'string',
                'min:2',
                'max:50',
                'regex:/^[a-zA-Z0-9-_]+$/',
                Rule::unique('short_links', 'code')->ignore($shortLinkId),
                Rule::notIn(StoreShortLinkRequest::RESERVED_WORDS),
            ],
            'bridge_enabled' => ['nullable', 'boolean'],
            'qr_enabled' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }

    /**
     * Pesan kustom validasi.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nama tautan wajib diisi.',
            'destination_url.required' => 'URL tujuan wajib diisi.',
            'destination_url.url' => 'Format URL tujuan tidak valid.',
            'destination_url.regex' => 'URL tujuan harus diawali dengan http:// atau https://.',
            'code.required' => 'Alias / kode tautan wajib diisi.',
            'code.regex' => 'Alias khusus hanya boleh berisi huruf, angka, tanda strip (-), dan garis bawah (_).',
            'code.unique' => 'Alias khusus ini sudah digunakan oleh tautan lain.',
            'code.not_in' => 'Alias ini merupakan kata sistem yang dilindungi dan tidak dapat digunakan.',
            'code.min' => 'Alias khusus minimal 2 karakter.',
            'code.max' => 'Alias khusus maksimal 50 karakter.',
        ];
    }
}
