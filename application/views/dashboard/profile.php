<?php

(isset($_POST["genregs"])) ? $genregs = $_POST["genregs"] : $genregs = $user['genre_gs'];
(isset($_POST["lokasigs"])) ? $lokasigs = $_POST["lokasigs"] : $lokasigs = $user['lokasi_gs'];

?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <section class="dashboard-body">
        <section class="row justify-content-center">
            <section class="col-12 col-sm-10 col-md-10">
                <?= form_open_multipart('Dashboard/profile'); ?>
                <h1>update profile</h1>
                <div class="form-group" hidden>
                    <input type="text" class="form-control" id="idgs" name="idgs" value="<?= $user['id_gs']; ?>">
                </div>
                <div class="form-group">
                    <label for="namags">Nama Guest Star</label>
                    <input type="text" class="form-control" id="namags" name="namags" value="<?= $user['nama_gs']; ?>">
                    <?= form_error('namags', '<small class="pesan-error-form">', "</small>") ?>
                </div>
                <div class="form-group">
                    <label for="emailgs">Email</label>
                    <input type="emailgs" class="form-control" id="emailgs" name="emailgs" value="<?= $user['email_gs']; ?>" disabled>
                    <?= form_error('emailgs', '<small class="pesan-error-form">', "</small>") ?>
                </div>
                <div class="form-group">
                    <label for="telpgs">Nomer HP</label>
                    <input type="telpgs" class="form-control" id="telpgs" name="telpgs" value="<?= $user['telp_gs']; ?>">
                    <?= form_error('telpgs', '<small class="pesan-error-form">', "</small>") ?>
                </div>
                <div class="form-group">
                    <label for="genregs">Genre</label>
                    <select class="form-control" id="genregs" name="genregs" value="<?= set_value('genregs'); ?>">
                        <option value="">Pilih Genre ...</option>
                        <option <?php if ($genregs == 'Band') echo 'selected'; ?> value="1">Band</option>
                        <option <?php if ($genregs == 'Penari') echo 'selected'; ?> value="2">Penari</option>
                        <option <?php if ($genregs == 'Stand Up Comedy') echo 'selected'; ?> value="3">Stand Up Comedy</option>
                    </select>
                    <?= form_error('genregs', '<small class="pesan-error-form">', "</small>") ?>
                </div>
                <div class="form-group">
                    <label for="lokasigs">Lokasi</label>
                    <select class="form-control" id="lokasigs" name="lokasigs" value="<?= set_value('lokasigs'); ?>">
                        <option value="">Pilih Base Lokasi ...</option>
                        <option <?php if ($lokasigs == 'Jogja') echo 'selected'; ?> value="Jogja">Jogja</option>
                        <option <?php if ($lokasigs == 'Sleman') echo 'selected'; ?> value="Sleman">Sleman</option>
                        <option <?php if ($lokasigs == 'Bantul') echo 'selected'; ?> value="Bantul">Bantul</option>
                        <option <?php if ($lokasigs == 'Gunung kidul') echo 'selected'; ?> value="Gunung Kidul">Gunung Kidul</option>
                        <option <?php if ($lokasigs == 'Kulon Progo') echo 'selected'; ?> value="Kulon Progo">Kulon Progo</option>
                    </select>
                    <?= form_error('lokasigs', '<small class="pesan-error-form">', "</small>") ?>
                </div>
                <div class="form-group">
                    <label for="hargags">Harga</label>
                    <input type="number" class="form-control" id="hargags" name="hargags" value="<?= $user['harga_gs']; ?>">
                    <?= form_error('hargags', '<small class="pesan-error-form">', "</small>") ?>
                </div>
                <div class="form-group">
                    <div class="col-sm-2">Foto</div>
                    <div class="col-sm-10">
                        <div class="row">
                            <div class="col-sm-3">
                                <img src="<?= base_url('assets/img/') . $user['foto_gs']; ?>" class="img-thumbnail">
                            </div>
                            <div class="col-sm-9">
                                <div class="custom-file" style="margin-bottom: 1rem">
                                    <input type="file" class="custom-file-input" id="fotogs" name="fotogs">
                                    <label class="custom-file-label" for="fotogs">choose</label>
                                </div>
                                <span style="font-style: italic;">*Usahakan berbentuk landscape</span>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="form-group">
                    <label for="deskripsigs">Deskripsi</label>
                    <textarea class="form-control" id="deskripsigs" rows="3" placeholder="Ex: Band beraliran .., dengan personil .." name="deskripsigs"><?= $user['deskripsi_gs']; ?></textarea>
                    <?= form_error('deskripsigs', '<small class="pesan-error-form">', "</small>") ?>
                </div>
                <div class="form-group" data-toggle="tooltip" data-placement="top" title="Jika tidak ada boleh dikosongkan">
                    <label for="facebookgs">Facebook</label>
                    <input type="facebookgs" class="form-control" id="facebookgs" name="facebookgs" value="<?= $user['link_fb']; ?>">
                </div>
                <div class="form-group" data-toggle="tooltip" data-placement="top" title="Jika tidak ada boleh dikosongkan">
                    <label for="instagramgs">Instagram</label>
                    <input type="instagramgs" class="form-control" id="instagramgs" name="instagramgs" value="<?= $user['link_ig']; ?>">
                </div>
                <div class="form-group" data-toggle="tooltip" data-placement="top" title="Jika tidak ada boleh dikosongkan">
                    <label for="youtubegs">Youtube</label>
                    <input type="youtubegs" class="form-control" id="youtubegs" name="youtubegs" value="<?= $user['link_yt']; ?>">
                </div>
                <div class="form-group" data-toggle="tooltip" data-placement="top" title="Jika tidak ada boleh dikosongkan">
                    <label for="twittergs">Twitter</label>
                    <input type="twittergs" class="form-control" id="twittergs" name="twittergs" value="<?= $user['link_tw']; ?>">
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