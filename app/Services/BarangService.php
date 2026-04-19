<?php

namespace App\Services;
use App\Models\Barang;

class BarangService
{
    public function simpanData(array $data)
    {
        // Logika untuk menyimpan data ke database dilakukan di sini
        return Barang::create($data);
    }
}