<?php
//validasi genre
(isset($_POST["gsi[genre_gs][3]"])) ? $genregs1 = $_POST["gsi[genre_gs][3]"] : $genregs = '';
(isset($_POST["genregs"])) ? $genregs = $_POST["genregs"] : $genregs = '';
(isset($_POST["genregs"])) ? $genregs = $_POST["genregs"] : $genregs = '';
//validasi lokasi
(isset($_POST["lokasigs1"])) ? $lokasigs1 = $_POST["lokasigs1"] : $lokasigs1 = '';
(isset($_POST["lokasigs2"])) ? $lokasigs2 = $_POST["lokasigs2"] : $lokasigs2 = '';
(isset($_POST["lokasigs3"])) ? $lokasigs3 = $_POST["lokasigs3"] : $lokasigs3 = '';
(isset($_POST["lokasigs4"])) ? $lokasigs4 = $_POST["lokasigs4"] : $lokasigs4 = '';
(isset($_POST["lokasigs5"])) ? $lokasigs5 = $_POST["lokasigs5"] : $lokasigs5 = '';
?>

<!-- jumbotron -->
<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1 class="display-4">Lets find your <span>Guest Star</span><br> Now !</h1>
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
                            <select class="form-control" id="genregs1" name="gsi[genre_gs][3]">
                                <option value="">Pilih Prioritas Pertama</option>
                                <?php foreach ($gsJenis as $j) : ?>
                                    <option value="<?= $j['nama']; ?>"><?= $j['nama']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('gsi[genre_gs][3]', '<small class="pesan-error-form">', "</small>") ?>
                        </div>
                        <div class="form-group">
                            <select class="form-control" id="genregs2" name="gsi[genre_gs][2]">
                                <option value="">Pilih Prioritas Kedua</option>
                                <?php foreach ($gsJenis as $j) : ?>
                                    <option value="<?= $j['nama']; ?>"><?= $j['nama']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('gsi[genre_gs][2]', '<small class="pesan-error-form">', "</small>") ?>
                        </div>
                        <div class="form-group">
                            <select class="form-control" id="genregs3" name="gsi[genre_gs][1]">
                                <option value="">Pilih Prioritas Ketiga</option>
                                <?php foreach ($gsJenis as $j) : ?>
                                    <option value="<?= $j['nama']; ?>"><?= $j['nama']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('gsi[genre_gs][1]', '<small class="pesan-error-form">', "</small>") ?>
                        </div>
                    </div>
                    <!-- filter kedua -->
                    <div class="col-lg isi-filter" id="filter-kedua">
                        <h4>Prioritas Keempat</h4>
                        <div class="form-group">
                            <label class="pb-4" for="lokasigs1">Lokasi</label>
                            <select class="form-control" id="lokasigs1" name="gsi[lokasi_gs][5]">
                                <option value="">Pilih Prioritas Pertama</option>
                                <?php foreach ($gsLokasi as $l) : ?>
                                    <option value="<?= $l['nama']; ?>"><?= $l['nama']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('gsi[lokasi_gs][5]', '<small class="pesan-error-form">', "</small>") ?>
                        </div>
                        <div class="form-group">
                            <select class="form-control" id="lokasigs2" name="gsi[lokasi_gs][4]">
                                <option value="">Pilih Prioritas Kedua</option>
                                <?php foreach ($gsLokasi as $l) : ?>
                                    <option value="<?= $l['nama']; ?>"><?= $l['nama']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('gsi[lokasi_gs][4]', '<small class="pesan-error-form">', "</small>") ?>
                        </div>
                        <div class="form-group">
                            <select class="form-control" id="lokasigs3" name="gsi[lokasi_gs][3]">
                                <option value="">Pilih Prioritas Ketiga</option>
                                <?php foreach ($gsLokasi as $l) : ?>
                                    <option value="<?= $l['nama']; ?>"><?= $l['nama']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('gsi[lokasi_gs][3]', '<small class="pesan-error-form">', "</small>") ?>
                        </div>
                        <div class="form-group">
                            <select class="form-control" id="lokasigs4" name="gsi[lokasi_gs][2]">
                                <option value="">Pilih Prioritas Keempat</option>
                                <?php foreach ($gsLokasi as $l) : ?>
                                    <option value="<?= $l['nama']; ?>"><?= $l['nama']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('gsi[lokasi_gs][2]', '<small class="pesan-error-form">', "</small>") ?>
                        </div>
                        <div class="form-group">
                            <select class="form-control" id="lokasigs5" name="gsi[lokasi_gs][1]">
                                <option value="">Pilih Prioritas Kelima</option>
                                <?php foreach ($gsLokasi as $l) : ?>
                                    <option value="<?= $l['nama']; ?>"><?= $l['nama']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('gsi[lokasi_gs][1]', '<small class="pesan-error-form">', "</small>") ?>
                        </div>

                    </div>
                </div>

                <div class="form-group" hidden>
                    <?php foreach ($full_gs as $f) : ?>
                        <input type="text" name="gsi[harga_gs][<?= $f['harga_gs']; ?>]" value="<?= $f['harga_gs']; ?>">
                    <?php endforeach; ?>
                </div>
                <div class="row">
                    <button type="submit" id="cari" class="btn btn-primary btn-lg btn-block">Cari</button>
                </div>
            </form>
        </div>
    </div>
    <!-- akhir info panel -->
    <!-- modal -->
    <!-- Small modal -->
    <div class="modal fade bd-example-modal-sm" id="modalpop" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                ...
            </div>
        </div>
    </div>
    <!-- akhir -->
</div>