<?= $this->extend($config->theme['panel'] . 'index') ?>
<?= $this->section('main') ?>

<h1 class="app-page-title">Dashboard</h1>

<div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert">
    <div class="inner">
        <div class="app-card-body p-3 p-lg-4">
            <h3 class="mb-3">Welcome, Topsis Algoritm!</h3>
            <div class="row gx-5 gy-3">
                <div class="col-12 col-lg-9">

                    <div>
                        <p class="m-0">Topsis Algoritm is a web application that can help you to make a decision based on
                            the best alternative. This application is based on the Topsis method which is a method that
                            can help you to make a decision based on the best alternative. This application is based on
                            the Topsis method which is a method that can help you to make a decision based on the best
                            alternative.</p>
                    </div>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-6 col-lg-3">
        <div class="app-card app-card-stat shadow-sm h-100">
            <div class="app-card-body p-3 p-lg-4">
                <h4 class="stats-type mb-1">Total Kriteria</h4>
                <div class="stats-figure"><?= $total_kriteria ?></div>
            </div>
        </div>
    </div>

    <div class="col-6 col-lg-3">
        <div class="app-card app-card-stat shadow-sm h-100">
            <div class="app-card-body p-3 p-lg-4">
                <h4 class="stats-type mb-1">Total SubKriteria</h4>
                <div class="stats-figure"><?= $total_subkriteria ?></div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="app-card app-card-stat shadow-sm h-100">
            <div class="app-card-body p-3 p-lg-4">
                <h4 class="stats-type mb-1">Alternatif</h4>
                <div class="stats-figure"><?= $total_alternatif ?></div>
                <div class="stats-meta">
                </div>
            </div>
        </div>
    </div>

</div>


<?= $this->endSection() ?>