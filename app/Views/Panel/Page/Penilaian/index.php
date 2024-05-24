<?= $this->extend($config->theme['panel'] . 'index') ?>
<?= $this->section('main') ?>

<div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration">
    <div class="inner">
        <div class="app-card-header p-4">
            <div class="app-card-header-title">
                <h4 class="app-card-title">Data Penilaian</h4>
                <p>Silahkan kelola data Penilaian disini</p>
            </div>
            <div class="app-card-header-actions ml-auto">
                <a href="<?= route_to('penilaian.add') ?>" class="btn btn-primary">Tambah Penilaian</a>
            </div>
        </div>
        <div class="app-card-body p-3 p-lg-4">
            <table class="table table-striped table-hover table-bordered datatable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($items as $item) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $item->alternatif->nama ?></td>
                            <td>

                                <a href="<?= route_to('penilaian.edit', $item->id) ?>" class="btn btn-sm btn-warning">Nilai</a>
                                <a href="<?= route_to('penilaian.delete', $item->id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>