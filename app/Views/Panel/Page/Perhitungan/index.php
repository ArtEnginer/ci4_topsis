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
                            <h4 class="app-card-title">Matrix Keputusan</h4>
                            <p>
                                Matrix keputusan adalah matrix yang berisi nilai dari setiap alternatif terhadap setiap kriteria
                            </p>
                        </div>

                    </div>
                    <div class="app-card-body p-3 p-lg-4">
                        <table class="table table-striped table-hover table-bordered datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <!--loop kriteria code -->
                                    <?php foreach ($kriteria as $item) : ?>
                                        <th><?= $item->kode ?></th>
                                    <?php endforeach; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($matriks_keputusan as $key => $value) :
                                    $alternatif = $alternatif->find($key); ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $alternatif->nama ?></td>
                                        <?php foreach ($value as $item) : ?>
                                            <td><?= $item ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="app-card shadow-sm mb-4 border-left-decoration">
                <div class="inner">
                    <div class="app-card-header p-4">
                        <div class="app-card-header-title">
                            <h4 class="app-card-title">Matrix Normalisasi</h4>
                            <p>
                                Matrix normalisasi adalah matrix yang sudah dinormalisasi dengan rumus
                                <code>nilai / sqrt(jumlah nilai^2)</code>
                            </p>
                        </div>

                    </div>
                    <div class="app-card-body p-3 p-lg-4">
                        <table class="table table-striped table-hover table-bordered datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <!--loop kriteria code -->
                                    <?php foreach ($kriteria as $item) : ?>
                                        <th><?= $item->kode ?></th>
                                    <?php endforeach; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($matriks_normalisasi as $key => $value) :
                                    $alternatif = $alternatif->find($key); ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $alternatif->nama ?></td>
                                        <?php foreach ($value as $item) : ?>
                                            <td><?= $item ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="app-card shadow-sm mb-4 border-left-decoration">
                <div class="inner">
                    <div class="app-card-header p-4">
                        <div class="app-card-header-title">
                            <h4 class="app-card-title">Matrix Y</h4>
                            <p>
                                Matrix Y adalah matrix yang berisi nilai dari setiap alternatif terhadap setiap kriteria
                                yang sudah dikalikan dengan bobot kriteria
                            </p>
                        </div>

                    </div>
                    <div class="app-card-body p-3 p-lg-4">
                        <table class="table table-striped table-hover table-bordered datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <!--loop kriteria code -->
                                    <?php foreach ($kriteria as $item) : ?>
                                        <th><?= $item->kode ?></th>
                                    <?php endforeach; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($matriks_y as $key => $value) :
                                    $alternatif = $alternatif->find($key); ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $alternatif->nama ?></td>
                                        <?php foreach ($value as $item) : ?>
                                            <td><?= $item ?></td>
                                        <?php endforeach; ?>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="app-card shadow-sm mb-4 border-left-decoration">
                <div class="inner">
                    <div class="app-card-header p-4">
                        <div class="app-card-header-title">
                            <h4 class="app-card-title">Solusi Ideal Positif dan Negatif</h4>
                            <p>
                                Solusi ideal positif dan negatif adalah nilai maksimum dan minimum dari setiap kriteria
                            </p>
                        </div>

                    </div>
                    <div class="app-card-body p-3 p-lg-4">
                        <table class="table table-striped table-hover table-bordered datatable">
                            <thead>
                                <tr>
                                    <th>Kriteria</th>
                                    <th>Solusi Ideal Positif</th>
                                    <th>Solusi Ideal Negatif</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($kriteria as $item) : ?>
                                    <tr>
                                        <td><?= $item->kode ?></td>
                                        <td><?= $solusi_ideal_positif[$item->id] ?></td>
                                        <td><?= $solusi_ideal_negatif[$item->id] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="app-card shadow-sm mb-4 border-left-decoration">
                <div class="inner">
                    <div class="app-card-header p-4">
                        <div class="app-card-header-title">
                            <h4 class="app-card-title">Jarak Alternatif terhadap Solusi Ideal Positif dan Negatif</h4>
                            <p>
                                Jarak alternatif terhadap solusi ideal positif dan negatif adalah jarak euclidean dari setiap
                                alternatif terhadap solusi ideal positif dan negatif
                            </p>
                        </div>

                    </div>
                    <div class="app-card-body p-3 p-lg-4">
                        <table class="table table-striped table-hover table-bordered datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Jarak Positif</th>
                                    <th>Jarak Negatif</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($jarak_positif as $key => $value) :
                                    $alternatif = $alternatif->find($key); ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $alternatif->nama ?></td>
                                        <td><?= $value ?></td>
                                        <td><?= $jarak_negatif[$key] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="app-card shadow-sm mb-4 border-left-decoration">
                <div class="inner">
                    <div class="app-card-header p-4">
                        <div class="app-card-header-title">
                            <h4 class="app-card-title">Kedekatan Alternatif terhadap Solusi Ideal Positif dan Negatif</h4>
                            <p>
                                Kedekatan alternatif terhadap solusi ideal positif dan negatif adalah nilai dari setiap
                                alternatif terhadap solusi ideal positif dan negatif
                            </p>
                        </div>

                    </div>
                    <div class="app-card-body p-3 p-lg-4">
                        <table class="table table-striped table-hover table-bordered datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Kedekatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($kedekatan as $key => $value) :
                                    $alternatif = $alternatif->find($key); ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $alternatif->nama ?></td>
                                        <td><?= $value ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- button reset -->
    <div class="row">
        <div class="col-md-12">
            <a href="<?= route_to('perhitungan.reset') ?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?')">Reset Perhitungan</a>
        </div>
    </div>
<?php endif; ?>
<?= $this->endSection() ?>