<?= $this->extend($config->theme['panel'] . 'index') ?>
<?= $this->section('main') ?>

<div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration">
    <div class="inner">
        <div class="app-card-header p-4">
            <div class="app-card-header-title">
                <h4 class="app-card-title">Data Alternatif</h4>
                <p>Silahkan kelola data Alternatif disini</p>
            </div>
            <div class="app-card-header-actions ml-auto">
                <a href="<?= route_to('alternatif.add') ?>" class="btn btn-primary">Tambah Alternatif</a>
            </div>
        </div>
        <div class="app-card-body p-3 p-lg-4">
            <table class="table table-striped table-hover table-bordered datatable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIP</th>
                        <th>Tempat/Tgl Lahir</th>
                        <th>Bagian Tugas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($items as $item) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $item->nama ?></td>
                            <td><?= $item->nip ?></td>
                            <td><?= $item->tempat_lahir . "/" . $item->tanggal_lahir ?></td>
                            <td><?= $item->bidang_tugas ?></td>
                            <td>
                                <a href="<?= route_to('alternatif.edit', $item->id) ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="<?= route_to('alternatif.delete', $item->id) ?>" class="btn btn-sm btn-danger">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>