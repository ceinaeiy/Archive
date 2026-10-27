
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= esc($judul) ?></title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            color: #222;
        }

        h1 {
            margin-bottom: 16px;
        }

        a,
        button {
            display: inline-block;
            padding: 8px 12px;
            text-decoration: none;
            border: 0;
            border-radius: 4px;
            cursor: pointer;
        }

        .utama {
            background: #1769aa;
            color: white;
        }

        .edit {
            background: #f0ad4e;
            color: #111;
        }

        .hapus {
            background: #c9302c;
            color: white;
        }

        .pesan {
            padding: 10px;
            margin: 12px 0;
            background: #e7f5e8;
        }

        table {
            width: 100%;
            margin-top: 18px;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 9px;
            border: 1px solid #ccc;
            text-align: left;
        }

        th {
            background: #f2f2f2;
        }

        form.inline {
            display: inline;
        }
    </style>
</head>

<body>

    <h1><?= esc($judul) ?></h1>

    <?php if (session()->getFlashdata('pesan')): ?>
        <div class="pesan">
            <?= esc(session()->getFlashdata('pesan')) ?>
        </div>
    <?php endif; ?>

    <a class="utama" href="<?= site_url('produk/tambah') ?>">
        + Tambah Produk
    </a>

    <a href="<?= site_url('laporan') ?>">
        Lihat Laporan
    </a>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Kode Produk</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            <?php if (! empty($produk)): ?>

                <?php foreach ($produk as $i => $item): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= esc($item['kode_produk']) ?></td>
                        <td><?= esc($item['nama_produk']) ?></td>
                        <td><?= esc($item['kategori'] ?? '-') ?></td>
                        <td>
                            Rp <?= number_format(
                                (float) $item['harga'],
                                0,
                                ',',
                                '.'
                            ) ?>
                        </td>
                        <td><?= esc($item['stok']) ?></td>

                        <td>
                            <a href="<?= site_url('produk/detail/' . $item['id']) ?>">Detail</a>
                            <a
                                class="edit"
                                href="<?= site_url('produk/edit/' . $item['id']) ?>"
                            >
                                Edit
                            </a>

                            <form
                                class="inline"
                                action="<?= site_url('produk/hapus/' . $item['id']) ?>"
                                method="post"
                                onsubmit="return confirm('Yakin ingin menghapus produk ini?')"
                            >
                                <?= csrf_field() ?>

                                <button class="hapus" type="submit">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>

            <?php else: ?>

                <tr>
                    <td colspan="7">Belum ada data produk.</td>
                </tr>

            <?php endif; ?>
        </tbody>
    </table>

</body>

</html>
