<?= $this->extend($config->theme['panel'] . 'index') ?>
<?= $this->section('main') ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        Tambah Penilaian
    </h1>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-body">

                <form action="<?= route_to("penilaian.store") ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="mb-3 row">
                        <label for="alternatif_id" class="col-sm-3 col-form-label">Alternatif</label>
                        <div class="col-sm-9">
                            <select class="form-select" name="alternatif_id" id="alternatif_id">
                                <option value="">Pilih Alternatif</option>
                                <?php foreach ($alternatif as $item) : ?>
                                    <option value="<?= $item->id ?>"><?= $item->nama ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <?php foreach ($kriteria as $k) : ?>
                        <div class="mb-3 row">
                            <label for="kriteria_id" class="col-sm-3 col-form-label"><?= $k->nama ?></label>
                            <div class="col-sm-9">
                                <select class="form-select" name="sub_kriteria_id[<?= $k->id ?>]" id="sub_kriteria_id">
                                    <option value="">Pilih Sub Kriteria</option>
                                    <?php foreach ($sub_kriteria as $item) : ?>
                                        <?php if ($item->kriteria_id == $k->id) : ?>
                                            <option value="<?= $item->id ?>"><?= $item->nama ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    <?php endforeach; ?>


            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>


<?= $this->endSection() ?>