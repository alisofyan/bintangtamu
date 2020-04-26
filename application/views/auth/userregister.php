<!-- Body -->
<div class="row wrap">
    <div class="col-md-4 offset-md-7" id="col-login">
        <form class="form-login" method="post" id="form-login" action="<?= base_url('Auth/userregister'); ?>">
            <div class="container bg-light">
                <h1>Daftar</h1>
                <div class="form-group">
                    <label for="namauser">Nama</label>
                    <input type="text" class="form-control" id="namauser" name="namauser" placeholder="Masukan username" value="<?= set_value('namauser'); ?>">
                    <?= form_error('namauser', '<small class="pesan-error-form">', "</small>") ?>
                </div>
                <div class="form-group">
                    <label for="emailuser">Email</label>
                    <input type="text" class="form-control" id="emailuser" name="emailuser" placeholder="Masukan email" value="<?= set_value('emailuser'); ?>">
                    <?= form_error('emailuser', '<small class="pesan-error-form">', "</small>") ?>
                </div>
                <div class="form-group">
                    <label for="passworduser">Password</label>
                    <input type="password" class="form-control" id="passworduser" name="passworduser" placeholder="Masukan password">
                    <?= form_error('passworduser', '<small class="pesan-error-form">', "</small>") ?>
                </div>
                <div class="form-group">
                    <label for="passworduser2">Konfirmasi Password</label>
                    <input type="password" class="form-control" id="passworduser2" name="passworduser2" placeholder="Masukan kembali password">
                </div>
                <button type="submit" class="btn">Daftar</button>
            </div>
        </form>
    </div>
</div>