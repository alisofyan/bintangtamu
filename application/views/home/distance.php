<?php
//validasi genre
(isset($_POST["genregs1"])) ? $genregs1 = $_POST["genregs1"] : $genregs1 = '';
(isset($_POST["genregs2"])) ? $genregs2 = $_POST["genregs2"] : $genregs2 = '';
(isset($_POST["genregs3"])) ? $genregs3 = $_POST["genregs3"] : $genregs3 = '';

//validasi lokasi
(isset($_POST["lokasigs1"])) ? $lokasigs1 = $_POST["lokasigs1"] : $lokasigs1 = '';
(isset($_POST["lokasigs2"])) ? $lokasigs2 = $_POST["lokasigs2"] : $lokasigs2 = '';
(isset($_POST["lokasigs3"])) ? $lokasigs3 = $_POST["lokasigs3"] : $lokasigs3 = '';
(isset($_POST["lokasigs4"])) ? $lokasigs4 = $_POST["lokasigs4"] : $lokasigs4 = '';
(isset($_POST["lokasigs5"])) ? $lokasigs5 = $_POST["lokasigs5"] : $lokasigs5 = '';

//validasi harga
(isset($_POST["hargags1"])) ? $hargags1 = $_POST["hargags1"] : $hargags1 = '';
(isset($_POST["hargags2"])) ? $hargags2 = $_POST["hargags2"] : $hargags2 = '';
(isset($_POST["hargags3"])) ? $hargags3 = $_POST["hargags3"] : $hargags3 = '';
(isset($_POST["hargags4"])) ? $hargags4 = $_POST["hargags4"] : $hargags4 = '';
(isset($_POST["hargags5"])) ? $hargags5 = $_POST["hargags5"] : $hargags5 = '';
?>

<!-- jumbotron -->
<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1 class="display-4">Lets find your <span>Guest Star</span><br> Now !<?php echo $this->session->userdata('oauth_provider'); ?><?php echo $this->session->userdata('oauth_uid'); ?></h1>
    </div>
</div>
<!-- akhir jumbotron -->

<!-- filter -->
<div class="container">
    <!-- info panel -->
    <div class="row justify-content-center" id="row-kriteria">
        <div class="col-12 filter">
            <form class="form-index" method="post" action="<?= base_url(); ?>">
                <div class="row">
                    <!-- Filter pertama -->
                    <div class="col-lg isi-filter" id="filter-pertama">
                        <h4>Prioritas pertama</h4>
                        <div class="form-group">
                            <label class="pb-4" for="genregs1">Jenis Pertunjukan</label>
                            <select class="form-control" id="genregs1" name="genregs1">
                                <option value="">Pilih Prioritas Pertama</option>
                                <?php foreach ($gsJenis as $j) : ?>
                                    <option <?php if ($genregs1 == $j['id']) echo 'selected'; ?> value="<?= $j['id']; ?>"><?= $j['nama']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('genregs1', '<small class="pesan-error-form">', "</small>") ?>
                        </div>
                        <div class="form-group">
                            <select class="form-control" id="genregs2" name="genregs2">
                                <option value="">Pilih Prioritas Kedua</option>
                                <?php foreach ($gsJenis as $j) : ?>
                                    <option <?php if ($genregs2 == $j['id']) echo 'selected'; ?> value="<?= $j['id']; ?>"><?= $j['nama']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('genregs2', '<small class="pesan-error-form">', "</small>") ?>
                        </div>
                        <div class="form-group">
                            <select class="form-control" id="genregs3" name="genregs3">
                                <option value="">Pilih Prioritas Ketiga</option>
                                <?php foreach ($gsJenis as $j) : ?>
                                    <option <?php if ($genregs3 == $j['id']) echo 'selected'; ?> value="<?= $j['id']; ?>"><?= $j['nama']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('genregs3', '<small class="pesan-error-form">', "</small>") ?>
                        </div>
                    </div>
                    <!-- filter kedua -->
                    <div class="col-lg isi-filter">
                        <h4>Prioritas Kedua</h4>
                        <div class="form-group">
                            <label class="pb-4" for="hargags1">Harga</label>
                            <select class="form-control" id="hargags1" name="hargags1">
                                <option value="">Pilih Prioritas Pertama</option>
                                <?php foreach ($gsHarga as $h) : ?>
                                    <option <?php if ($hargags1 == $h['harga']) echo 'selected'; ?> value="<?= $h['harga']; ?>">Rp. <?= $h['harga']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('hargags1', '<small class="pesan-error-form">', "</small>") ?>
                        </div>
                        <div class="form-group">
                            <select class="form-control" id="hargags2" name="hargags2">
                                <option value="">Pilih Prioritas Kedua</option>
                                <?php foreach ($gsHarga as $h) : ?>
                                    <option <?php if ($hargags2 == $h['harga']) echo 'selected'; ?> value="<?= $h['harga']; ?>">Rp. <?= $h['harga']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('hargags2', '<small class="pesan-error-form">', "</small>") ?>
                        </div>
                        <div class="form-group">
                            <select class="form-control" id="hargags3" name="hargags3">
                                <option value="">Pilih Prioritas Ketiga</option>
                                <?php foreach ($gsHarga as $h) : ?>
                                    <option <?php if ($hargags3 == $h['harga']) echo 'selected'; ?> value="<?= $h['harga']; ?>">Rp. <?= $h['harga']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('hargags3', '<small class="pesan-error-form">', "</small>") ?>
                        </div>
                        <div class="form-group">
                            <select class="form-control" id="hargags4" name="hargags4">
                                <option value="">Pilih Prioritas keempat</option>
                                <?php foreach ($gsHarga as $h) : ?>
                                    <option <?php if ($hargags4 == $h['harga']) echo 'selected'; ?> value="<?= $h['harga']; ?>">Rp. <?= $h['harga']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('hargags4', '<small class="pesan-error-form">', "</small>") ?>
                        </div>
                        <div class="form-group">
                            <select class="form-control" id="hargags5" name="hargags5">
                                <option value="">Pilih Prioritas Kelima</option>
                                <?php foreach ($gsHarga as $h) : ?>
                                    <option <?php if ($hargags5 == $h['harga']) echo 'selected'; ?> value="<?= $h['harga']; ?>">Rp. <?= $h['harga']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('hargags5', '<small class="pesan-error-form">', "</small>") ?>
                        </div>
                    </div>
                    <!-- filter keempat -->
                    <div class="col-lg isi-filter">
                        <h4>Prioritas Keempat</h4>
                        <div class="form-group">
                            <label class="pb-4" for="lokasigs1">Lokasi</label>
                            <select class="form-control" id="lokasigs1" name="lokasigs1">
                                <option value="">Pilih Prioritas Pertama</option>
                                <?php foreach ($gsLokasi as $l) : ?>
                                    <option <?php if ($lokasigs1 == $l['nama']) echo 'selected'; ?> value="<?= $l['nama']; ?>"><?= $l['nama']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('lokasigs1', '<small class="pesan-error-form">', "</small>") ?>
                        </div>
                        <div class="form-group">
                            <select class="form-control" id="lokasigs2" name="lokasigs2">
                                <option value="">Pilih Prioritas Kedua</option>
                                <?php foreach ($gsLokasi as $l) : ?>
                                    <option <?php if ($lokasigs2 == $l['nama']) echo 'selected'; ?> value="<?= $l['nama']; ?>"><?= $l['nama']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('lokasigs2', '<small class="pesan-error-form">', "</small>") ?>
                        </div>
                        <div class="form-group">
                            <select class="form-control" id="lokasigs3" name="lokasigs3">
                                <option value="">Pilih Prioritas Ketiga</option>
                                <?php foreach ($gsLokasi as $l) : ?>
                                    <option <?php if ($lokasigs3 == $l['nama']) echo 'selected'; ?> value="<?= $l['nama']; ?>"><?= $l['nama']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('lokasigs3', '<small class="pesan-error-form">', "</small>") ?>
                        </div>
                        <div class="form-group">
                            <select class="form-control" id="lokasigs4" name="lokasigs4">
                                <option value="">Pilih Prioritas Keempat</option>
                                <?php foreach ($gsLokasi as $l) : ?>
                                    <option <?php if ($lokasigs4 == $l['nama']) echo 'selected'; ?> value="<?= $l['nama']; ?>"><?= $l['nama']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('lokasigs4', '<small class="pesan-error-form">', "</small>") ?>
                        </div>
                        <div class="form-group">
                            <select class="form-control" id="lokasigs5" name="lokasigs5">
                                <option value="">Pilih Prioritas Kelima</option>
                                <?php foreach ($gsLokasi as $l) : ?>
                                    <option <?php if ($lokasigs5 == $l['nama']) echo 'selected'; ?> value="<?= $l['nama']; ?>"><?= $l['nama']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('lokasigs5', '<small class="pesan-error-form">', "</small>") ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Cari</button>
                </div>
            </form>
        </div>
    </div>
    <!-- akhir info panel -->
</div>