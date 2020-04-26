<!-- Begin Page Content -->
<div class="container-fluid">
    <section class="dashboard-body">
        <section class="row justify-content-center">
            <section class="col-12 col-sm-10 col-md-10">
                <form class="form-akun" method="post" action="<?= base_url('Dashboard/akun'); ?>">
                    <h1>update password</h1>
                    <?= $this->session->flashdata('message'); ?>
                    <div class="form-group" hidden>
                        <input type="text" class="form-control" id="idgs" name="idgs" value="<?= $user['id_gs']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="usernamegs">Username</label>
                        <input type="text" class="form-control" id="usernamegs" name="usernamegs" value="<?= $user['username_gs']; ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="passwordlama">Password Lama</label>
                        <input type="password" class="form-control" id="passwordlama" name="passwordlama" placeholder="Masukan password lama">
                        <?= form_error('passwordlama', '<small class="pesan-error-form">', "</small>") ?>
                    </div>
                    <div class="form-group">
                        <label for="passwordgs">Password Baru</label>
                        <input type="password" class="form-control" id="passwordgs" name="passwordgs" placeholder="Masukan password baru">
                        <?= form_error('passwordgs', '<small class="pesan-error-form">', "</small>") ?>
                    </div>
                    <div class="form-group">
                        <label for="passwordgs2">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="passwordgs2" name="passwordgs2" placeholder="Masukan kembali password baru">
                        <?= form_error('passwordgs2', '<small class="pesan-error-form">', "</small>") ?>
                    </div>
                    <button type="submit" class="btn btn-success btn-block" name="update" id="update">Update</button>
                </form>
            </section>
        </section>
    </section>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->