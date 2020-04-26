<?php

(isset($_POST["genregs"])) ? $genregs = $_POST["genregs"] : $genregs = '';
(isset($_POST["lokasigs"])) ? $lokasigs = $_POST["lokasigs"] : $lokasigs = '';

?>

<body class="backoffice signup-body">
    <section class="container-fluid">
        <section class="row justify-content-center">
            <section class="col-12 col-sm-10 col-md-10">
                <form class="form-daftar" method="post" action="<?= base_url('Auth/backofficesignup'); ?>">
                    <h1>DAFTAR GUEST STAR</h1>
                    <div class="progress">
                        <div class="progress-bar bg-dark" role="progressbar" style="width: 33%;" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100">STEP 1</div>
                    </div>
                    <div class="form-group">
                        <label for="namags">Nama Guest Star</label>
                        <input type="text" class="form-control" id="namags" name="namags" placeholder="Nama Band/Penari/Stand Up" value="<?= set_value('namags'); ?>">
                        <?= form_error('namags', '<small class="pesan-error-form">', "</small>") ?>
                    </div>
                    <div class="form-group">
                        <label for="emailgs">Email</label>
                        <input type="email" class="form-control" id="emailgs" name="emailgs" placeholder="Masukan email" value="<?= set_value('emailgs'); ?>">
                        <?= form_error('emailgs', '<small class="pesan-error-form">', "</small>") ?>
                    </div>
                    <div class="form-group">
                        <label for="telpgs">Nomer HP</label>
                        <input type="text" class="form-control" id="telpgs" name="telpgs" placeholder="Masukan nomer hp" value="<?= set_value('telpgs'); ?>">
                        <?= form_error('telpgs', '<small class="pesan-error-form">', "</small>") ?>
                    </div>
                    <div class="form-group">
                        <label for="genregs">Jenis Pertunjukan</label>
                        <select class="form-control" id="genregs" name="genregs">
                            <option value="">Pilih Jenis Pertunjukan ...</option>
                            <option <?php if ($genregs == "Band") echo 'selected'; ?> value="Band">Band</option>
                            <option <?php if ($genregs == "Penari") echo 'selected'; ?> value="Penari">Penari</option>
                            <option <?php if ($genregs == "Stand Up Comedy") echo 'selected'; ?> value="Stand Up Comedy">Stand Up Comedy</option>
                        </select>
                        <?= form_error('genregs', '<small class="pesan-error-form">', "</small>") ?>
                    </div>
                    <div class="form-group">
                        <label for="lokasigs">Lokasi</label>
                        <select class="form-control" id="lokasigs" name="lokasigs" value="<?= set_value('lokasigs'); ?>">
                            <option value="">Pilih Base Lokasi ...</option>
                            <option <?php if ($lokasigs == "Jogja") echo 'selected'; ?> value="Jogja">Jogja</option>
                            <option <?php if ($lokasigs == "Sleman") echo 'selected'; ?> value="Sleman">Sleman</option>
                            <option <?php if ($lokasigs == "Bantul") echo 'selected'; ?> value="Bantul">Bantul</option>
                            <option <?php if ($lokasigs == "Gunung Kidul") echo 'selected'; ?> value="Gunung Kidul">Gunung Kidul</option>
                            <option <?php if ($lokasigs == "Kulon Progo") echo 'selected'; ?> value="Kulon Progo">Kulon Progo</option>
                        </select>
                        <?= form_error('lokasigs', '<small class="pesan-error-form">', "</small>") ?>
                    </div>
                    <div class="form-group">
                        <label for="hargags">Harga</label>
                        <input type="number" class="form-control" id="hargags" name="hargags" placeholder="Masukan Harga yang anda patok" value="<?= set_value('hargags'); ?>">
                        <?= form_error('hargags', '<small class="pesan-error-form">', "</small>") ?>
                    </div>
                    <label for="customFile" hidden>Foto</label>
                    <div class="custom-file" style="margin-bottom: 1rem" hidden>
                        <input type="file" class="custom-file-input" id="customFile" name="fotogs" value="<?= set_value('fotogs'); ?>">
                        <label class="custom-file-label" for="customFile">Pilih file</label>
                        <?= form_error('fotogs', '<small class="pesan-error-form">', "</small>") ?>
                    </div>
                    <div class="form-group">
                        <label for="deskripsigs">Deskripsi</label>
                        <textarea class="form-control" id="deskripsigs" rows="3" placeholder="Ex: Band beraliran .., dengan personil .." name="deskripsigs"><?= set_value('deskripsigs'); ?></textarea>
                        <?= form_error('deskripsigs', '<small class="pesan-error-form">', "</small>") ?>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block" name="daftar" id="daftar">Daftar</button>
                </form>
            </section>
        </section>
    </section>