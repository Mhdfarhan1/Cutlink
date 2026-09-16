<?php

namespace App\Http\Requests\Link;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreShortLinkRequest extends FormRequest
{
    /**
     * Daftar route cadangan yang tidak boleh dijadikan alias short link.
     *
     * @var array<int, string>
     */
    public const RESERVED_WORDS = [
        'login',
        'logout',
        'dashboard',
        'links',
        'create',
        'edit',
        'statistics',
        'analytics',
        'qr',
        'qr-code',
        'profile',
        'settings',
        'r',
        'api',
        'up',
        'admin',
        'home',
        'bridge',
        'images',
        'build',
        'assets',
        'storage',
        'app',
    ];

    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Aturan validasi penyimpanan Short Link baru.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'destination_url' => [
                'required',
                'url',
                'regex:/^https?:\/\//i',
                'max:2048',
            ],
            'code' => [
                'nullable',
                'string',
                'min:2',
                'max:50',
                'regex:/^[a-zA-Z0-9-_]+$/',
                Rule::unique('short_links', 'code'),
                Rule::notIn(self::RESERVED_WORDS),
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
            'code.regex' => 'Alias khusus hanya boleh berisi huruf, angka, tanda strip (-), dan garis bawah (_).',
            'code.unique' => 'Alias khusus ini sudah digunakan oleh tautan lain. Silakan pilih alias lain.',
            'code.not_in' => 'Alias ini merupakan kata sistem yang dilindungi dan tidak dapat digunakan.',
            'code.min' => 'Alias khusus minimal 2 karakter.',
            'code.max' => 'Alias khusus maksimal 50 karakter.',
        ];
    }
}
