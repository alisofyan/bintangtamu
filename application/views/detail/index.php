<div class="row wrap detail">
    <div class="col-md-8" id="col-detail-img">
        <form action="">
            <div class="container inner-gambar">
                <img src="<?= base_url(); ?>assets/img/<?= $gs['foto_gs']; ?>" alt="">
            </div>
        </form>
    </div>
    <div class="col-md-4" id="col-detail-info">
        <form action="">
            <div class="container info">
                <h1><?= $gs['nama_gs']; ?></h1>
                <p class="card-text"><i class="fas fa-microphone"></i> <?= $gs['genre_gs']; ?></p>
                <p class="card-text"><i class="fas fa-map-marker-alt"></i> <?= $gs['lokasi_gs']; ?></p>
                <p class="card-text"><i class="fas fa-coins"></i> Rp. <?= $gs['harga_gs']; ?></p>

                <h3>Deskripsi</h3>
                <p><?= $gs['deskripsi_gs']; ?></p>
                <div class="container sosmed">
                    <a href="https://www.facebook.com/john.alsof?ref=bookmarks" target="_blank" class="fb">
                        <span>
                            <i class="fab fa-facebook-square"></i>
                        </span>
                    </a>
                    <a href="https://www.instagram.com/m.alsof/" target="_blank" class="ig">
                        <span>
                            <i class="fab fa-instagram"></i>
                        </span>
                    </a>
                    <a href="https://www.twitter.com/" target="_blank" class="tw">
                        <span>
                            <i class="fab fa-twitter-square"></i>
                        </span>
                    </a>
                    <a href="https://www.youtube.com/" target="_blank" class="yt">
                        <span>
                            <i class="fab fa-youtube"></i>
                        </span>
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="hrcenter"></div>

<!-- form daftar -->
<div class="container detail-pesan">
    <div class="row">
        <section class="col-12">
            <form class="form-pesan" method="post" action="<?= base_url(); ?>detail/index/<?= $gs['id_gs']; ?>">
                <h1>AJUKAN TAWARAN</h1>
                <?= $this->session->flashdata('message'); ?>
                <div class="form-group" hidden>
                    <input type="text" class="form-control" id="iduser" name="iduser" value="<?php echo $this->session->userdata('oauth_uid'); ?>">
                    <input type="text" class="form-control" id="authuser" name="authuser" value="<?php echo $this->session->userdata('oauth_provider'); ?>">
                    <input type="text" class="form-control" id="namauser" name="namauser" value="<?php echo $this->session->userdata('first_name'); ?>">
                    <input type="text" class="form-control" id="idgs" name="idgs" value="<?= $gs['id_gs']; ?>">
                    <input type="text" class="form-control" id="emailgs" name="emailgs" value="<?= $gs['email_gs']; ?>">
                    <input type="text" class="form-control" id="tgltrx" name="tgltrx" value="<?= date('d-m-Y'); ?>">
                </div>
                <div class="form-group">
                    <label for="namaevent">Nama Acara</label>
                    <input type="text" class="form-control" id="namaevent" name="namaevent" placeholder="Masukan nama acara" value="<?= set_value('namaevent'); ?>">
                    <?= form_error('namaevent', '<small class="pesan-error-form">', "</small>") ?>
                </div>
                <div class="form-group">
                    <label for="tglevent">Tanggal Pelaksanaan</label>
                    <input type="date" class="form-control" id="tglevent" name="tglevent" value="<?= set_value('tglevent'); ?>">
                    <?= form_error('tglevent', '<small class="pesan-error-form">', "</small>") ?>
                </div>
                <div class="form-group">
                    <label for="tempatevent">Tempat Acara</label>
                    <textarea class="form-control" id="tempatevent" rows="3" placeholder="Masukan tempat pelaksanaan acara" name="tempatevent"><?= set_value('tempatevent'); ?></textarea>
                    <?= form_error('tempatevent', '<small class="pesan-error-form">', "</small>") ?>
                </div>
                <div class="form-group">
                    <label for="emailuser">Email</label>
                    <input type="email" class="form-control" id="emailuser" name="emailuser" placeholder="Masukan email untuk dihubungi" value="<?= set_value('emailuser'); ?>">
                    <?= form_error('emailuser', '<small class="pesan-error-form">', "</small>") ?>
                </div>
                <div class="form-group">
                    <label for="telpuser">Nomer HP</label>
                    <input type="text" class="form-control" id="telpuser" name="telpuser" placeholder="Masukan nomer hp yang dapat dihubungi" value="<?= set_value('telpuser'); ?>">
                    <?= form_error('telpuser', '<small class="pesan-error-form">', "</small>") ?>
                </div>
                <div class="form-group">
                    <label for="deskripsievent">Deskripsi Acara</label>
                    <textarea class="form-control" id="deskripsievent" rows="3" placeholder="Deskripsikan acara anda" name="deskripsievent"><?= set_value('deskripsievent'); ?></textarea>
                    <?= form_error('deskripsievent', '<small class="pesan-error-form">', "</small>") ?>
                </div>
                <button type="submit" class="btn btn-primary btn-block" name="pesan" id="pesan">Pesan</button>
            </form>
        </section>
    </div>
</div>