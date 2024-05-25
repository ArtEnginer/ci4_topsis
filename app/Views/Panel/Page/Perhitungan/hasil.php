<?= $this->extend($config->theme['panel'] . 'index') ?>
<?= $this->section('main') ?>

<?php if ($is_empty == true) : ?>
    <div class="alert alert-warning" role="alert">
        <?= $message ?>
    </div>
<?php else : ?>
    <div class="row">
        <div class="col-md-12">
            <div class="app-card shadow-sm mb-4 border-left-decoration">
                <div class="inner">
                    <div class="app-card-header p-4">
                        <div class="app-card-header-title">
                            <h4 class="app-card-title">Hasil Perengkingan</h4>
                            <p>
                                Hasil perhitungan menggunakan metode TOPSIS
                            </p>
                        </div>

                    </div>
                    <div class="app-card-body p-3 p-lg-4">
                        <table class="table table-striped table-hover table-bordered datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Total</th>
                                    <th>Rangking</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($rangking as $alternatif_id => $rangking) : ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $alternatif[$alternatif_id]->nama ?></td>
                                        <td><?= $kedekatan[$alternatif_id] ?></td>
                                        <td><?= $rangking ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>
<?= $this->endSection() ?>