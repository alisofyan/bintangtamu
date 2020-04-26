<!-- jumbotron -->
<div class="jumbotron jumbotron-fluid result">
    <div class="container">
        <h1 class="display-4">Lets find your <span>Guest Star</span><br> Now !</h1>
    </div>
</div>
<!-- akhir jumbotron -->

<!-- akhir filter -->
<div class="row result">
    <!-- sidebar -->
    <div class="col-md-3 kiri">
        <div class="accordion" id="accordionExample">
            <div class="card sidebar">
                <div class="card-header" id="headingOne">
                    <h2 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Jenis Pertunjukan
                        </button>
                    </h2>
                </div>

                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body filter">
                        <?php $i = 1; ?>
                        <?php foreach ($filter_jenis as $x) : ?>
                            <p><?= $i . '. ' . $x['nama']; ?></p>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="card-header" id="headingTwo">
                    <h2 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Harga
                        </button>
                    </h2>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                    <div class="card-body filter">
                        <?php $i = 1; ?>
                        <?php foreach ($filter_harga as $x) : ?>
                            <p><?= $i . '. Rp. ' . $x['harga_gs']; ?></p>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="card-header" id="headingThree">
                    <h2 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Lokasi
                        </button>
                    </h2>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                    <div class="card-body filter">
                        <?php $i = 1; ?>
                        <?php foreach ($filter_lokasi as $x) : ?>
                            <p><?= $i . '. ' . $x['nama']; ?></p>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- akiht -->
    </div>

    <!-- content -->
    <div class="col-md-9 kanan">
        <h4 class="text-center">HASIL PENCARIAN</h4>
        <!-- product -->
        <div class="row content">
            <?php foreach ($hasilgs as $x) : ?>
                <!-- pro -->
                <div class="card text-center hasil" style="width: 20rem;">
                    <img src="<?= base_url(); ?>assets/img/<?= $x['foto_gs']; ?>" class="card-img-top" id="fotodalamcard" alt="...">
                    <div class="card-body bg-light">
                        <h5 class="card-title"><?= $x['nama_gs']; ?></h5>
                        <p class="card-text genre"><?= $x['genre_gs']; ?></p>
                        <p class="card-text nilai"><?= $x['hasilV']; ?></p>
                        <a href="<?= base_url('detail/index/' . $x['id_gs']); ?>" class="btn btn-danger btn-block" id="detailbtn">Detail</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>