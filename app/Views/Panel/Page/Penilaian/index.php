<?= $this->extend($config->theme['panel'] . 'index') ?>
<?= $this->section('main') ?>

<div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration">
    <div class="inner">
        <div class="app-card-header p-4">
            <div class="app-card-header-title">
                <h4 class="app-card-title">Data Penilaian</h4>
                <p>Silahkan kelola data Penilaian disini</p>
            </div>
        </div>
        <div class="app-card-body p-3 p-lg-4">
            <table class="table table-striped table-hover table-bordered datatable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Alternatif</th>
                        <?php foreach ($kriteria as $k) : ?>
                            <th><?= $k->nama ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <!-- form using dropdown -->
                    <?php $no = 1; ?>
                    <?php foreach ($alternatif as $alt) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $alt->nama ?></td>
                            <?php foreach ($kriteria as $k) : ?>
                                <td>
                                    <?php
                                    // find existing assessment data for the current alternatif and kriteria
                                    $existingPenilaian = null;
                                    foreach ($items as $item) {
                                        $penilaian = json_decode($item->sub_kriteria_id, true);
                                        if ($item->alternatif_id == $alt->id && isset($penilaian[$k->id])) {
                                            $existingPenilaian = $penilaian[$k->id];
                                            break;
                                        }
                                    }
                                    ?>
                                    <select name="penilaian[<?= $alt->id ?>][<?= $k->id ?>]" class="form-control">
                                        <?php if ($existingPenilaian) : ?>
                                            <option value="<?= $existingPenilaian ?>" selected>
                                                <?= $sub_kriteria[$existingPenilaian]->nama . ' (' . $sub_kriteria[$existingPenilaian]->percentage . '%)' ?>
                                            </option>
                                        <?php endif; ?>
                                        <?php foreach ($sub_kriteria as $sk) : ?>
                                            <?php if ($sk->kriteria_id == $k->id) : ?>
                                                <option value="<?= $sk->id ?>">
                                                    <?= $sk->nama . ' (' . $sk->percentage . '%)' ?>
                                                </option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>