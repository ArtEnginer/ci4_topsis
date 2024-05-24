<?= $this->extend($config->theme['panel'] . 'index') ?>
<?= $this->section('main') ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        Edit alternatif
    </h1>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-body">

                <form action="<?= route_to("alternatif.update", $item->id) ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="nama" id="nama" value="<?= $item->nama ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nip" class="col-sm-3 col-form-label">NIP</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="nip" id="nip" value="<?= $item->nip ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="tempat_lahir" class="col-sm-3 col-form-label">Tempat Lahir</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" value="<?= $item->tempat_lahir ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="tanggal_lahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" value="<?= $item->tanggal_lahir ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="bidang_tugas" class="col-sm-3 col-form-label">Bidang Tugas</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="bidang_tugas" id="bidang_tugas" value="<?= $item->bidang_tugas ?>">
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