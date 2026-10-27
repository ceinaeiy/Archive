<?php

namespace App\Controllers;

use App\Models\ProdukModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $model = new ProdukModel();
        $produk = $model->findAll();

        $totalProduk = count($produk);
        $totalStok = 0;
        $nilaiPersediaan = 0;
        $kategori = [];

        foreach ($produk as $item) {
            $totalStok += (int) ($item['stok'] ?? 0);
            $nilaiPersediaan += (float) ($item['harga'] ?? 0) * (int) ($item['stok'] ?? 0);

            $namaKategori = trim((string) ($item['kategori'] ?? ''));
            if ($namaKategori !== '') {
                $kategori[strtolower($namaKategori)] = true;
            }
        }

        return view('dashboard/index', [
            'judul' => 'Dashboard Toko',
            'totalProduk' => $totalProduk,
            'totalStok' => $totalStok,
            'totalKategori' => count($kategori),
            'nilaiPersediaan' => $nilaiPersediaan,
            'produkTerbaru' => $model->orderBy('id', 'DESC')->findAll(5),
        ]);
    }
}