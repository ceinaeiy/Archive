<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($judul) ?></title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; font-family: Arial, sans-serif; color: #1f2937; background: #f4f7fb; }
        .topbar { background: #173b67; color: #fff; padding: 20px 5%; }
        .topbar h1 { margin: 0 0 6px; font-size: 25px; }
        .topbar p { margin: 0; color: #dbeafe; }
        .container { width: min(1180px, 92%); margin: 28px auto; }
        .nav { display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 22px; }
        .nav a { text-decoration: none; padding: 10px 15px; border-radius: 6px; background: #fff;
                 color: #173b67; border: 1px solid #d8e1ed; font-weight: bold; }
        .nav a.active, .nav a:hover { background: #1769aa; color: #fff; }
        .cards { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 16px; }
        .card { background: #fff; padding: 22px; border-radius: 10px; border: 1px solid #e1e8f0;
                box-shadow: 0 3px 12px rgba(20, 45, 80, .04); }
        .card .label { color: #64748b; font-size: 14px; margin-bottom: 12px; }
        .card .value { color: #173b67; font-size: 27px; font-weight: bold; overflow-wrap: anywhere; }
        .section { background: #fff; padding: 22px; margin-top: 22px; border: 1px solid #e1e8f0; border-radius: 10px; }
        .section h2 { margin-top: 0; font-size: 19px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { padding: 12px 10px; text-align: left; border-bottom: 1px solid #e5eaf1; }
        th { background: #f8fafc; color: #475569; }
        .empty { color: #64748b; text-align: center; }
        .footer { color: #64748b; text-align: center; font-size: 13px; padding: 24px 0; }
        @media (max-width: 850px) { .cards { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
        @media (max-width: 520px) {
            .cards { grid-template-columns: 1fr; }
            .topbar h1 { font-size: 22px; }
            .section { padding: 14px; overflow-x: auto; }
            th, td { white-space: nowrap; }
        }
    </style>
</head>
<body>
    <header class="topbar">
        <h1>Dashboard Toko</h1>
        <p>Ringkasan data dan persediaan produk</p>
    </header>

    <main class="container">
        <nav class="nav">
            <a class="active" href="<?= site_url('dashboard') ?>">Dashboard</a>
            <a href="<?= site_url('produk') ?>">Data Produk</a>
            <a href="<?= site_url('produk/tambah') ?>">Tambah Produk</a>
            <a href="<?= site_url('laporan') ?>">Laporan</a>
        </nav>

        <section class="cards">
            <div class="card">
                <div class="label">Total Produk</div>
                <div class="value"><?= number_format($totalProduk, 0, ',', '.') ?></div>
            </div>
            <div class="card">
                <div class="label">Total Stok</div>
                <div class="value"><?= number_format($totalStok, 0, ',', '.') ?></div>
            </div>
            <div class="card">
                <div class="label">Jumlah Kategori</div>
                <div class="value"><?= number_format($totalKategori, 0, ',', '.') ?></div>
            </div>
            <div class="card">
                <div class="label">Nilai Persediaan</div>
                <div class="value">Rp <?= number_format($nilaiPersediaan, 0, ',', '.') ?></div>
            </div>
        </section>

        <section class="section">
            <h2>Produk Terbaru</h2>
            <table>
                <thead>
                    <tr><th>No.</th><th>Kode Produk</th><th>Nama Produk</th><th>Kategori</th><th>Harga</th><th>Stok</th><th>Aksi</th></tr>
                </thead>
                <tbody>
                <?php if (! empty($produkTerbaru)): ?>
                    <?php foreach ($produkTerbaru as $i => $item): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= esc($item['kode_produk']) ?></td>
                            <td><?= esc($item['nama_produk']) ?></td>
                            <td><?= esc($item['kategori'] ?? '-') ?></td>
                            <td>Rp <?= number_format((float) $item['harga'], 0, ',', '.') ?></td>
                            <td><?= number_format((int) $item['stok'], 0, ',', '.') ?></td>
                            <td><a href="<?= site_url('produk/detail/' . $item['id']) ?>">Detail</a></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td class="empty" colspan="7">Belum ada data produk.</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
        </section>

        <div class="footer">Aplikasi Toko · CodeIgniter 4</div>
    </main>
</body>
</html>