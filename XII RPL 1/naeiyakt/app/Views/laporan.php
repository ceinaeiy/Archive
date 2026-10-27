<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= esc($judul) ?></title>

    <style>
        body {
            margin: 30px;
            font-family: Arial, sans-serif;
            color: #222;
        }

        table {
            width: 100%;
            margin-top: 18px;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            border: 1px solid #bbb;
            text-align: left;
        }

        th {
            background: #eee;
        }

        a,
        button {
            display: inline-block;
            margin-right: 8px;
            padding: 8px 12px;
            cursor: pointer;
        }

        @media print {
            .no-print {
                display: none;
            }

            body {
                margin: 0;
            }
        }
    </style>
</head>

<body>

    <h1><?= esc($judul) ?></h1>

    <div class="no-print">
        <a href="<?= site_url('produk') ?>">
            Kembali ke Data Produk
        </a>

        <button type="button" onclick="window.print()">
            Cetak Laporan
        </button>
    </div>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Kode</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stok</th>
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
                    </tr>
                <?php endforeach; ?>

            <?php else: ?>

                <tr>
                    <td colspan="6">
                        Belum ada data produk.
                    </td>
                </tr>

            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>
