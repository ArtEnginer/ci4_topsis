<?= $this->extend($config->theme['panel'] . 'index') ?>
<?= $this->section('main') ?>

<div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration">
    <div class="inner">
        <div class="app-card-header p-4">
            <div class="app-card-header-title">
                <h4 class="app-card-title">Data user</h4>
                <p>Silahkan kelola data user disini</p>
            </div>
            <div class="app-card-header-actions ml-auto">
                <a href="<?= base_url('panel/user/add') ?>" class="btn btn-primary">Tambah user</a>
            </div>
        </div>
        <div class="app-card-body p-3 p-lg-4">
            <table class="table table-striped table-hover table-bordered datatable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($items as $item) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $item->username ?></td>
                            <td><?= $item->getEmail($item->id) ?></td>
                            <td><?= $item->getGroups() ?></td>
                            <td>
                                <a href="<?= route_to('user.edit', $item->id) ?>" class="btn btn-sm btn-warning"><i class="fas fa-key"></i>
                                </a>
                                <a href="<?= route_to('user.delete', $item->id) ?>" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>