<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($judul) ?></title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; color: #222; }
        .detail { display: flex; gap: 24px; flex-wrap: wrap; align-items: flex-start; }
        .gambar { width: 320px; max-width: 100%; height: auto; object-fit: contain;
                  border: 1px solid #ddd; border-radius: 8px; padding: 8px; }
        .info { min-width: 260px; }
        .tombol { display: inline-block; padding: 9px 14px; margin-top: 12px;
                  background: #1769aa; color: white; text-decoration: none; border-radius: 4px; }
    </style>
</head>
<body>
    <h1><?= esc($judul) ?></h1>
    <div class="detail">
        <div>
            <?php if (! empty($produk['gambar_produk'])): ?>
                <img class="gambar"
                     src="<?= base_url('uploads/produk/' . $produk['gambar_produk']) ?>"
                     alt="Gambar <?= esc($produk['nama_produk']) ?>">
            <?php else: ?>
                <div class="gambar">Gambar produk belum tersedia.</div>
            <?php endif; ?>
        </div>
        <div class="info">
            <h2><?= esc($produk['nama_produk']) ?></h2>
            <p><strong>Kode:</strong> <?= esc($produk['kode_produk']) ?></p>
            <p><strong>Kategori:</strong> <?= esc($produk['kategori'] ?? '-') ?></p>
            <p><strong>Harga:</strong> Rp <?= number_format((float) $produk['harga'], 0, ',', '.') ?></p>
            <p><strong>Stok:</strong> <?= esc($produk['stok']) ?></p>
            <a class="tombol" href="<?= site_url('produk') ?>">Kembali ke daftar</a>
            <a class="tombol" href="<?= site_url('produk/edit/' . $produk['id']) ?>">Edit Produk</a>
        </div>
    </div>
</body>
</html>