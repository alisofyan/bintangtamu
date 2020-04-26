<?php

(isset($_POST["genregs"])) ? $genregs = $_POST["genregs"] : $genregs = 0;
(isset($_POST["lokasigs"])) ? $lokasigs = $_POST["lokasigs"] : $lokasigs = 0;
(isset($_POST["hargags"])) ? $hargags = $_POST["hargags"] : $hargags = 0;

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
                            <option>Pilih Jenis Pertunjukan ...</option>
                            <option <?php if ($genregs == 1) echo 'selected'; ?> value="1">Band</option>
                            <option <?php if ($genregs == 2) echo 'selected'; ?> value="2">Penari</option>
                            <option <?php if ($genregs == 3) echo 'selected'; ?> value="3">Stand Up Comedy</option>
                        </select>
                        <?= form_error('genregs', '<small class="pesan-error-form">', "</small>") ?>
                    </div>
                    <div class="form-group">
                        <label for="lokasigs">Lokasi</label>
                        <select class="form-control" id="lokasigs" name="lokasigs" value="<?= set_value('lokasigs'); ?>">
                            <option>Pilih Base Lokasi ...</option>
                            <option <?php if ($lokasigs == 1) echo 'selected'; ?> value="1">Jogja</option>
                            <option <?php if ($lokasigs == 2) echo 'selected'; ?> value="2">Sleman</option>
                            <option <?php if ($lokasigs == 3) echo 'selected'; ?> value="3">Bantul</option>
                            <option <?php if ($lokasigs == 4) echo 'selected'; ?> value="4">Gunung Kidul</option>
                            <option <?php if ($lokasigs == 5) echo 'selected'; ?>value="5">Kulon Progo</option>
                        </select>
                        <?= form_error('lokasigs', '<small class="pesan-error-form">', "</small>") ?>
                    </div>
                    <div class="form-group">
                        <label for="hargags">Harga</label>
                        <select class="form-control" id="hargags" name="hargags" value="<?= set_value('hargags'); ?>">
                            <option>Pilih Rate Harga ...</option>
                            <option <?php if ($hargags == 1) echo 'selected'; ?> value="1">Rp. 0 - Rp. 500.000</option>
                            <option <?php if ($hargags == 2) echo 'selected'; ?> value="2">Rp. 500.001 - Rp. 1.000.000</option>
                            <option <?php if ($hargags == 3) echo 'selected'; ?> value="3">Rp. 1.000.001 - Rp. 5.000.000</option>
                            <option <?php if ($hargags == 4) echo 'selected'; ?> value="4">Rp. 5.000.001 - Rp. 10.000.000</option>
                            <option <?php if ($hargags == 5) echo 'selected'; ?> value="5">>Rp. 10.000.000</option>
                        </select>
                        <?= form_error('hargags', '<small class="pesan-error-form">', "</small>") ?>
                    </div>
                    <label for="customFile">Foto</label>
                    <div class="custom-file" style="margin-bottom: 1rem">
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