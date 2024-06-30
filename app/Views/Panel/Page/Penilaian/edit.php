<?= $this->extend($config->theme['panel'] . 'index') ?>
<?= $this->section('main') ?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        Edit Penilaian
    </h1>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-body">

                <form action="<?= route_to("penilaian.update", $item->id) ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="mb-3 row">
                        <label for="alternatif_id" class="col-sm-3 col-form-label">Alternatif</label>

                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="alternatif_id" value="<?= $item->alternatif->nama ?>" readonly>
                        </div>

                    </div>

                    <?php
                    $sub_kriteria_id = json_decode($item->sub_kriteria_id, true);
                    foreach ($kriteria as $k) : ?>
                        <div class="mb-3 row">
                            <label for="kriteria_id_<?= $k->id ?>" class="col-sm-3 col-form-label"><?= $k->nama ?></label>
                            <div class="col-sm-9">
                                <select class="form-select" name="sub_kriteria_id[<?= $k->id ?>]" id="sub_kriteria_id_<?= $k->id ?>">
                                    <option value="">Pilih Sub Kriteria</option>
                                    <?php foreach ($sub_kriteria as $item) : ?>
                                        <?php if ($item->kriteria_id == $k->id) : ?>
                                            <option value="<?= $item->id ?>" <?= isset($sub_kriteria_id[$k->id]) && $item->id == $sub_kriteria_id[$k->id] ? 'selected' : '' ?>>
                                                <?= $item->nama . '(' . $item->percentage . '%)' ?>
                                            </option>
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