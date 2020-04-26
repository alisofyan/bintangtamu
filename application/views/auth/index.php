<!-- Display login button / Facebook profile information -->
<?php if (!empty($authURL)) { ?>
    <!-- Body -->
    <div class="row wrap">
        <div class="col-md-4 offset-md-7" id="col-login">
            <form action="" id="form-login" method="post" action="<?= base_url('Auth/backoffice'); ?>">
                <div class="container bg-light">
                    <h1>Login</h1>
                    <?= $this->session->flashdata('message'); ?>
                    <div class="form-group">
                        <label for="emailuser">Email</label>
                        <input type="email" class="form-control" id="emailuser" name="emailuser" placeholder="Masukan email">
                        <?= form_error('emailuser', '<small class="pesan-error-form">', "</small>") ?>
                    </div>
                    <div class="form-group">
                        <label for="passworduser">Password</label>
                        <input type="password" class="form-control" id="passworduser" name="passworduser" placeholder="Masukan Password">
                        <?= form_error('passworduser', '<small class="pesan-error-form">', "</small>") ?>
                    </div>
                    <button type="submit" class="btn">Login</button>
                    <p>Belum punya akun? <a href="<?= base_url(); ?>Auth/userregister">Daftar sekarang!</a></p>
                    <div class="pembungkus">
                        <p>ATAU</p>
                    </div>
                    <a href="<?php echo $authURL; ?>"><img id="logofb" src="<?php echo base_url('assets/img/fb-login-btn.png'); ?>"></a>
                </div>
            </form>
        </div>
    </div>

<?php } else { ?>
    <?php redirect('Home'); ?>
<?php } ?>