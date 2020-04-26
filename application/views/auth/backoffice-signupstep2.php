<body class="backoffice signup-body">
    <section class="container-fluid">
        <section class="row justify-content-center">
            <section class="col-12 col-sm-10 col-md-10">
                <form class="form-daftar" method="post" action="<?= base_url('Auth/backofficesignupstep2'); ?>">
                    <h1>DAFTAR GUEST STAR</h1>
                    <div class="progress">
                        <div class="progress-bar bg-dark" role="progressbar" style="width: 66%;" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100">STEP 2</div>
                    </div>
                    <div class="form-group" hidden>
                        <input type="text" class="form-control" id="idgs" name="idgs" value="<?= $idgs; ?>">
                    </div>
                    <div class="form-group" hidden>
                        <input type="text" class="form-control" id="emailgs" name="emailgs" value="<?= $emailgs; ?>">
                    </div>
                    <div class="form-group">
                        <label for="usernamegs">Username</label>
                        <input type="text" class="form-control" id="usernamegs" name="usernamegs" placeholder="Masukan username" value="<?= set_value('usernamegs'); ?>">
                        <?= form_error('usernamegs', '<small class="pesan-error-form">', "</small>") ?>
                    </div>
                    <div class="form-group">
                        <label for="passwordgs">Password</label>
                        <input type="password" class="form-control" id="passwordgs" name="passwordgs" placeholder="Masukan password">
                        <?= form_error('passwordgs', '<small class="pesan-error-form">', "</small>") ?>
                    </div>
                    <div class="form-group">
                        <label for="passwordgs2">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="passwordgs2" name="passwordgs2" placeholder="Masukan kembali password">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block" name="daftar" id="daftar">Simpan dan Lanjut</button>
                </form>
            </section>
        </section>
    </section>