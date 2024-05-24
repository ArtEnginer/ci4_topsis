<?= $this->extend($config->theme['panel'] . 'index') ?>
<?= $this->section('main') ?>

<div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration">
    <div class="inner">
        <div class="app-card-header p-4">
            <div class="app-card-header-title">
                <h4 class="app-card-title">Data Kriteria</h4>
                <p>Silahkan kelola data kriteria disini</p>
            </div>
            <div class="app-card-header-actions ml-auto">
                <a href="<?= base_url('panel/kriteria/add') ?>" class="btn btn-primary">Tambah Kriteria</a>
            </div>
        </div>
        <div class="app-card-body p-3 p-lg-4">
            <table class="table table-striped table-hover table-bordered datatable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Bobot</th>
                        <th>Sub Kriteria</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($items as $item) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $item->kode ?></td>
                            <td><?= $item->nama ?></td>
                            <td><?= $item->bobot ?></td>
                            <td>
                                <a href="<?= base_url('panel/kriteria/' . $item->id . '/subkriteria') ?>" class="btn btn-sm btn-primary"><?= $item->subkriteria_count ?> Sub Kriteria</a>
                            </td>
                            <td>
                                <a href="<?= route_to('kriteria.edit', $item->id) ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="<?= route_to('kriteria.delete', $item->id) ?>" class="btn btn-sm btn-danger">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>