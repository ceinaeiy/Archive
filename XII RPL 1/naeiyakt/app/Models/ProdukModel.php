<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $table            = 'produk';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';


    protected $allowedFields = [
        'kode_produk',
        'nama_produk',
        'gambar_produk',
        'kategori',
        'harga',
        'stok',
    ];


    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}
