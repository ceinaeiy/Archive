<?php

namespace App\Controllers;

use App\Models\ProdukModel;

class Laporan extends BaseController
{
    public function index()
    {
        $model = new ProdukModel();

        $data = [
            'judul'  => 'Laporan Data Produk',
            'produk' => $model
                ->orderBy('nama_produk', 'ASC')
                ->findAll(),
        ];

        return view('laporan', $data);
    }
}
