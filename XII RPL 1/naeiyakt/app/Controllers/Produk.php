<?php

namespace App\Controllers;

use App\Models\ProdukModel;

class Produk extends BaseController
{
    protected $produkModel;

    public function __construct()
    {
        $this->produkModel = new ProdukModel();
    }

    public function index()
    {
        $data = [
            'judul'  => 'Data Produk',
            'produk' => $this->produkModel
                ->orderBy('id', 'DESC')
                ->findAll(),
        ];

        return view('produk/index', $data);
    }

    public function create()
    {
        return view('form_produk', [
            'judul'  => 'Tambah Produk',
            'produk' => null,
            'aksi'   => site_url('produk/simpan'),
        ]);
    }

    public function store()
    {
        if (! $this->validate($this->aturanValidasi())) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $data = $this->dataForm();
        $file = $this->request->getFile('gambar_produk');
        
        if ($file && $file->isValid() && ! $file->hasMoved()) {
            $rules = [
                'gambar_produk' => [
                    'rules' => 'is_image[gambar_produk]|mime_in[gambar_produk,image/jpg,image/jpeg,image/png,image/webp]|max_size[gambar_produk,2048]',
                ],
            ];
        
            if (! $this->validate($rules)) {
                return redirect()->back()
                    ->withInput()
                    ->with('errors', $this->validator->getErrors());
            }
        
            $namaGambar = $file->getRandomName();
            $file->move(FCPATH . 'uploads/produk', $namaGambar);
        
            $data['gambar_produk'] = $namaGambar;
    }

        $this->produkModel->insert($data);

        return redirect()->to(site_url('produk'))
            ->with('pesan', 'Produk berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $produk = $this->produkModel->find($id);

        if (! $produk) {
            return redirect()->to(site_url('produk'))
                ->with('pesan', 'Data produk tidak ditemukan.');
        }

        return view('form_produk', [
            'judul'  => 'Edit Produk',
            'produk' => $produk,
            'aksi'   => site_url('produk/update/' . $id),
        ]);
    }

    public function update($id)
    {
        $produk = $this->produkModel->find($id);

        if (! $produk) {
            return redirect()->to(site_url('produk'))
                ->with('pesan', 'Data produk tidak ditemukan.');
        }

        if (! $this->validate($this->aturanValidasi())) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $data = $this->dataForm();
        $file = $this->request->getFile('gambar_produk');
        
        if ($file && $file->isValid() && ! $file->hasMoved()) {
            if (! $this->validate([
                'gambar_produk' => 'is_image[gambar_produk]|mime_in[gambar_produk,image/jpg,image/jpeg,image/png,image/webp]|max_size[gambar_produk,2048]',
            ])) {
                return redirect()->back()->withInput()
                    ->with('errors', $this->validator->getErrors());
            }
        
            $namaGambar = $file->getRandomName();
            $file->move(FCPATH . 'uploads/produk', $namaGambar);
            $data['gambar_produk'] = $namaGambar;
        }
         else {
            // Pertahankan gambar lama jika tidak ada gambar baru.
            unset($data['gambar_produk']);
        }

        $this->produkModel->update($id, $data);

        return redirect()->to(site_url('produk'))
            ->with('pesan', 'Produk berhasil diperbarui.');
    }

    public function delete($id)
    {
        $produk = $this->produkModel->find($id);

        if (! $produk) {
            return redirect()->to(site_url('produk'))
                ->with('pesan', 'Data produk tidak ditemukan.');
        }

        $this->produkModel->delete($id);

        return redirect()->to(site_url('produk'))
            ->with('pesan', 'Produk berhasil dihapus.');
    }

    
    public function detail($id)
    {
        $produk = $this->produkModel->find($id);
    
        if (! $produk) {
            return redirect()->to(site_url('produk'))
                ->with('pesan', 'Data produk tidak ditemukan.');
        }
    
        $data = [
            'judul'  => 'Detail Produk',
            'produk' => $produk,
        ];
    
        return view('produk/detail', $data);
    }


    private function aturanValidasi()
    {
        return [
            'kode_produk' => 'required|max_length[30]',
            'nama_produk' => 'required|max_length[150]',
            'kategori'    => 'permit_empty|max_length[100]',
            'harga'       => 'required|decimal|greater_than_equal_to[0]',
            'stok'        => 'required|integer|greater_than_equal_to[0]',
        ];
    }

    private function dataForm()
    {
        return [
            'kode_produk' => trim(
                (string) $this->request->getPost('kode_produk')
            ),
            'nama_produk' => trim(
                (string) $this->request->getPost('nama_produk')
            ),
            'kategori' => trim(
                (string) $this->request->getPost('kategori')
            ) ?: null,
            'harga' => $this->request->getPost('harga'),
            'stok'  => $this->request->getPost('stok'),
        ];
    }
}
