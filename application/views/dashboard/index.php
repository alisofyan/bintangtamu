<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-md">
            <?= $this->session->flashdata('message'); ?>
        </div>

    </div>
    <div class="card mb-3">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img src="<?= base_url(); ?>assets/img/<?= $user['foto_gs']; ?>" class="card-img" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h3 class="card-title">Halo, <?= $user['nama_gs']; ?></h3>
                    <p class="card-text"><i class="fas fa-microphone"></i> <?= $user['genre_gs']; ?></p>
                    <p class="card-text"><i class="fas fa-map-marker-alt"></i> <?= $user['lokasi_gs']; ?></p>
                    <p class="card-text"><i class="fas fa-info-circle"></i> <?= $user['deskripsi_gs']; ?></p>

                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->