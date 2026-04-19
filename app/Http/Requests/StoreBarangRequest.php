<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class StoreBarangRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // <-- Penting: Ubah dari false menjadi true agar diizinkan
    }

    public function rules(): array
    {
        return [
            'nama_barang' => 'required|string|max:255',
            'harga' => 'required|numeric'
        ];
    }
}