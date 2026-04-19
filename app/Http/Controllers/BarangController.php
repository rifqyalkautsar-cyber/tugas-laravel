<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Http\Requests\StoreBarangRequest;
use App\Services\BarangService;
use Exception;
use Illuminate\Support\Facades\Log;

class BarangController extends Controller
{
    protected $barangService;

    // Menyambungkan Service ke dalam Controller
    public function __construct(BarangService $barangService)
    {
        $this->barangService = $barangService;
    }

    // 1. Fungsi Tampilkan Data (Read)
    public function index()
    {
        $barangs = Barang::all();
        return response()->json(['data' => $barangs]);
    }

    // 2. Fungsi Tambah Data (Create) - Dilengkapi Validasi & Error Handling
    public function store(StoreBarangRequest $request)
    {
        try {
            // Data divalidasi menggunakan file StoreBarangRequest
            $validatedData = $request->validated(); 

            // Simpan data menggunakan BarangService
            $barang = $this->barangService->simpanData($validatedData);

            return response()->json([
                'message' => 'Data berhasil ditambahkan',
                'data' => $barang
            ], 201);

        } catch (Exception $e) {
            // Error Handling: Tangkap error jika gagal menyimpan
            Log::error('Error saat menyimpan barang: ' . $e->getMessage());
            
            return response()->json([
                'message' => 'Terjadi kesalahan pada server saat menyimpan data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // 3. Fungsi Ubah Data (Update)
    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);
        $barang->update($request->all());
        
        return response()->json(['message' => 'Data berhasil diubah', 'data' => $barang]);
    }

    // 4. Fungsi Hapus Data (Delete)
    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();

        return response()->json(['message' => 'Data berhasil dihapus']);
    }
}