<?= $this->extend($config->theme['panel'] . 'index') ?>
<?= $this->section('main') ?>

<div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration">

    <div class="app-card-header p-4">
        <div class="app-card-header-title">
            <h4 class="app-card-title">Data Penilaian</h4>
            <p>Silahkan kelola data Penilaian disini</p>
        </div>
    </div>
    <div class="app-card-body responsive">
        <form id="penilaianForm" action="<?= base_url('panel/penilaian/storeupdate') ?>" method="post">
            <?= csrf_field() ?>
            <table class="table table-striped table-hover table-bordered datatable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Alternatif</th>
                        <?php foreach ($kriteria as $k) : ?>
                            <th><?= $k->nama ?></th>
                        <?php endforeach; ?>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($alternatif as $alt) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $alt->nama ?></td>
                            <?php foreach ($kriteria as $k) : ?>
                                <td>
                                    <?php
                                    $existingPenilaian = null;
                                    foreach ($items as $item) {
                                        $penilaian = json_decode($item->sub_kriteria_id, true);
                                        if ($item->alternatif_id == $alt->id && isset($penilaian[$k->id])) {
                                            $existingPenilaian = $penilaian[$k->id];
                                            break;
                                        }
                                    }
                                    ?>
                                    <select name="penilaian[<?= $alt->id ?>][<?= $k->id ?>]" class="form-control penilaian-dropdown">
                                        <?php if ($existingPenilaian) : ?>
                                            <option value="<?= $existingPenilaian ?>" selected>
                                                <?= $sub_kriteria[$existingPenilaian]->nama . ' (' . $sub_kriteria[$existingPenilaian]->percentage . '%)' ?>
                                            </option>
                                        <?php endif; ?>
                                        <option value="">Nilai <i class="fas fa-arrow-right"></i> </option>
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
                            <td>
                                <?php if ($existingPenilaian) : ?>
                                    <div style="display: flex; gap: 10px;">
                                        <a href="#!" class="btn-edit text-success" data-id="<?= $alt->id ?>"><i class="fas fa-edit"></i></a>
                                        <a href="<?= route_to('penilaian.delete', $alt->id) ?>" class="text-danger"><i class="fas fa-trash"></i></a>
                                    </div>
                                <?php else : ?>
                                    <a href="#!" class="badge bg-success text-center w-100 h-100 btn-add" data-id="<?= $alt->id ?>">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </form>
    </div>
    <div class="app-card-footer p-4">
        <a href="#!" class="btn app-btn-secondary w-100 btn-spk">Hitung SPK</a>
    </div>
</div>



<?php if ($is_empty == true) : ?>
    <div class="alert alert-warning" role="alert">
        <?= $message ?>
    </div>
<?php else : ?>

    <div class="row display-spk" hidden>
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
                        <table class="table table-striped table-hover table-bordered datatable w-100">
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
                        <table class="table table-striped table-hover table-bordered datatable w-100">
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
                        <table class="table table-striped table-hover table-bordered datatable w-100">
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
                        <table class="table table-striped table-hover table-bordered datatable w-100">
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
                        <table class="table table-striped table-hover table-bordered datatable w-100">
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
                        <table class="table table-striped table-hover table-bordered datatable w-100">
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
<?php endif; ?>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.btn-edit').forEach(function(button) {
            button.addEventListener('click', function() {
                const alternatifId = this.getAttribute('data-id');
                document.getElementById('penilaianForm').action = '<?= base_url('panel/penilaian/storeupdate/') ?>' + alternatifId;
                document.getElementById('penilaianForm').submit();
            });
        });

        document.querySelectorAll('.btn-add').forEach(function(button) {
            button.addEventListener('click', function() {
                const alternatifId = this.getAttribute('data-id');
                document.getElementById('penilaianForm').action = '<?= base_url('panel/penilaian/storeupdate/') ?>' + alternatifId;
                document.getElementById('penilaianForm').submit();
            });
        });
        document.querySelector('.btn-spk').addEventListener('click', function() {
            document.querySelector('.display-spk').removeAttribute('hidden');
        });
    });
</script>

<?= $this->endSection() ?>