<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= esc($judul) ?></title>

    <style>
        body {
            max-width: 720px;
            margin: 30px;
            font-family: Arial, sans-serif;
            color: #222;
        }

        label {
            display: block;
            margin-top: 14px;
            font-weight: bold;
        }

        input {
            box-sizing: border-box;
            width: 100%;
            margin-top: 5px;
            padding: 9px;
        }

        button,
        a {
            display: inline-block;
            margin-top: 18px;
            padding: 9px 14px;
            border: 0;
            border-radius: 4px;
            text-decoration: none;
            cursor: pointer;
        }

        button {
            background: #1769aa;
            color: white;
        }

        a {
            background: #ddd;
            color: #222;
        }

        .error {
            margin: 12px 0;
            padding: 12px;
            background: #fde8e7;
        }
    </style>
</head>

<body>

    <h1><?= esc($judul) ?></h1>

    <?php $errors = session()->getFlashdata('errors') ?? []; ?>

    <?php if (! empty($errors)): ?>
        <div class="error">
            <strong>Periksa kembali data:</strong>

            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

        <form action="<?= esc($aksi) ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <label for="kode_produk">Kode Produk</label>
        <input
            id="kode_produk"
            name="kode_produk"
            type="text"
            maxlength="30"
            required
            value="<?= esc(old('kode_produk', $produk['kode_produk'] ?? '')) ?>"
        >

        <label for="nama_produk">Nama Produk</label>
        <input
            id="nama_produk"
            name="nama_produk"
            type="text"
            maxlength="150"
            required
            value="<?= esc(old('nama_produk', $produk['nama_produk'] ?? '')) ?>"
        >

        <label for="kategori">Kategori</label>
        <input
            id="kategori"
            name="kategori"
            type="text"
            maxlength="100"
            value="<?= esc(old('kategori', $produk['kategori'] ?? '')) ?>"
        >

        <label for="harga">Harga</label>
        <input
            id="harga"
            name="harga"
            type="number"
            min="0"
            step="0.01"
            required
            value="<?= esc(old('harga', $produk['harga'] ?? '')) ?>"
        >

        <label for="stok">Stok</label>
        <input
            id="stok"
            name="stok"
            type="number"
            min="0"
            step="1"
            required
            value="<?= esc(old('stok', $produk['stok'] ?? '')) ?>"
        >

        <label for="gambar_produk">Gambar Produk (JPG, PNG, WEBP; maks. 2 MB)</label>
        <input id="gambar_produk" name="gambar_produk" type="file"
               accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">
        
        <?php if (! empty($produk['gambar_produk'])): ?>
            <p>Gambar saat ini:</p>
            <img src="<?= base_url('uploads/produk/' . $produk['gambar_produk']) ?>"
                 alt="Gambar <?= esc($produk['nama_produk']) ?>"
                 style="max-width:220px; height:auto;">
        <?php endif; ?>

        <button type="submit">Simpan</button>

        <a href="<?= site_url('produk') ?>">
            Kembali
        </a>
    </form>

</body>
</html>
