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
                    <?php
                    // foreach all alternatif $alternatif
                    // jika ada data penilaian maka isikan dropdown dengan data penilaian
                    // jika tidak ada data penilaian maka isikan dropdown dengan data sub kriteria


                    foreach ($items as $item) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $item->alternatif->nama ?></td>
                            <?php
                            $sub_kriteria_id = json_decode($item->sub_kriteria_id, true);
                            foreach ($kriteria as $k) : ?>
                                <td><?= $sub_kriteria[$sub_kriteria_id[$k->id]]->nama . ' (' . $sub_kriteria[$sub_kriteria_id[$k->id]]->percentage . '%)' ?></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>