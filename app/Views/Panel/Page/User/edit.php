<?= $this->extend($config->theme['panel'] . 'index') ?>
<?= $this->section('main') ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        Edit user
    </h1>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-body">

                <form action="<?= route_to("penilaian.add.store") ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-3 row">
                        <label for="username" class="col-sm-3 col-form-label">Username</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="username" id="username" value="<?= $item->username ?>" readonly>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="email" class="col-sm-3 col-form-label">Email user</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" name="email" id="email" value="<?= $item->getIdentities()[0]->secret ?>" readonly>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="password" class="col-sm-3 col-form-label">password</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="password" id="password">
                        </div>
                    </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>


<?= $this->endSection() ?>