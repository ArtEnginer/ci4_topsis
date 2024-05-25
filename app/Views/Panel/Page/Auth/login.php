<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
    <meta name="author" content="Anggaegae">
    <link rel="shortcut icon" href="favicon.ico">

    <!-- FontAwesome JS-->
    <script defer src="assets/plugins/fontawesome/js/all.min.js"></script>

    <!-- App CSS -->
    <link id="theme-style" rel="stylesheet" href="assets/css/portal.css">

</head>

<body class="app app-login p-0">
    <div class="row g-0 app-auth-wrapper">
        <div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
            <div class="d-flex flex-column align-content-end">
                <div class="app-auth-body mx-auto">
                    <div class="app-auth-branding mb-4"><a class="app-logo" href="index.html"><img class="logo-icon me-2" src="assets/images/app-logo.svg" alt="logo"></a></div>
                    <h2 class="auth-heading text-center mb-5"><?= lang('Auth.login') ?></h2>


                    <div class="auth-form-container text-start">

                        <?php if (session('error') !== null) : ?>
                            <div class="alert alert-danger" role="alert"><?= session('error') ?></div>
                        <?php elseif (session('errors') !== null) : ?>
                            <div class="alert alert-danger" role="alert">
                                <?php if (is_array(session('errors'))) : ?>
                                    <?php foreach (session('errors') as $error) : ?>
                                        <?= $error ?>
                                        <br>
                                    <?php endforeach ?>
                                <?php else : ?>
                                    <?= session('errors') ?>
                                <?php endif ?>
                            </div>
                        <?php endif ?>

                        <?php if (session('message') !== null) : ?>
                            <div class="alert alert-success" role="alert"><?= session('message') ?></div>
                        <?php endif ?>

                        <form action="<?= url_to('login') ?>" method="post">
                            <?= csrf_field() ?>

                            <!-- Email -->
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="floatingEmailInput" name="email" inputmode="email" autocomplete="email" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>" required>
                                <label for="floatingEmailInput"><?= lang('Auth.email') ?></label>
                            </div>

                            <!-- Password -->
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="floatingPasswordInput" name="password" inputmode="text" autocomplete="current-password" placeholder="<?= lang('Auth.password') ?>" required>
                                <label for="floatingPasswordInput"><?= lang('Auth.password') ?></label>
                            </div>

                            <!-- Remember me -->
                            <?php if (setting('Auth.sessionConfig')['allowRemembering']) : ?>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" name="remember" class="form-check-input" <?php if (old('remember')) : ?> checked<?php endif ?>>
                                        <?= lang('Auth.rememberMe') ?>
                                    </label>
                                </div>
                            <?php endif; ?>

                            <div class="d-grid col-12 col-md-8 mx-auto m-3">
                                <button type="submit" class="btn btn-primary btn-block"><?= lang('Auth.login') ?></button>
                            </div>

                            <?php if (setting('Auth.allowMagicLinkLogins')) : ?>
                                <p class="text-center"><?= lang('Auth.forgotPassword') ?> <a href="<?= url_to('magic-link') ?>"><?= lang('Auth.useMagicLink') ?></a></p>
                            <?php endif ?>

                            <?php if (setting('Auth.allowRegistration')) : ?>
                                <p class="text-center"><?= lang('Auth.needAccount') ?> <a href="<?= url_to('register') ?>"><?= lang('Auth.register') ?></a></p>
                            <?php endif ?>

                        </form>
                    </div>
                </div>
            </div>
        </div><!--//auth-main-col-->
        <div class="col-12 col-md-5 col-lg-6 h-100 auth-background-col">
            <div class="auth-background-holder">
            </div>
            <div class="auth-background-mask"></div>
            <div class="auth-background-overlay p-3 p-lg-5">
                <div class="d-flex flex-column align-content-end h-100">
                    <div class="h-100"></div>
                    <div class="overlay-content p-3 p-lg-4 rounded">
                        <h5 class="mb-3 overlay-title">Topsis Algoritm</h5>
                        <div>
                            <p class="mb-3">Topsis adalah salah satu metode pengambilan keputusan yang digunakan untuk menyeleksi alternatif terbaik dari sejumlah alternatif berdasarkan nilai relatif dari masing-masing alternatif.</p>
                        </div>
                    </div>
                </div>
            </div><!--//auth-background-overlay-->
        </div><!--//auth-background-col-->

    </div><!--//row-->


</body>

</html>