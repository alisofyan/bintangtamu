<!-- Begin Page Content -->
<div class="container-fluid">
    <section class="dashboard-body">
        <!-- card -->
        <div class="card text-center <?= $req['status_trx']; ?>" id="detail-tawaran">
            <div class="card-header">
                Status : <?= $req['status_trx']; ?>
            </div>
            <div class="card-body isi-tabel">
                <h1 class="card-title"><?= $req['nama_event']; ?></h1>
                <p><?= $req['deskripsi_event']; ?></p>
                <table class="" id="tawaran-info">
                    <tr>
                        <td>
                            <h5>Pengirim</h5>
                        </td>
                        <th>
                            <h5><?= $req['namauser']; ?></h5>
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <h5>Tanggal Pelaksanaan</h5>
                        </td>
                        <th>
                            <h5><?= $req['tgl_event']; ?></h5>
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <h5>Tempat Pelaksanaan</h5>
                        </td>
                        <th>
                            <h5><?= $req['tempat_event']; ?></h5>
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <h5>Email</h5>
                        </td>
                        <th>
                            <h5><?= $req['email_user']; ?></h5>
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <h5>Nomer Handphone</h5>
                        </td>
                        <th>
                            <h5><?= $req['hp_user']; ?></h5>
                        </th>
                    </tr>

                </table>
                <a href="<?= base_url() ?>Dashboard/terimaTawaran/<?= $req['id_trx']; ?>" class="btn btn-success" id="btn-terima">Terima tawaran</a>
                <a href="<?= base_url() ?>Dashboard/tolakTawaran/<?= $req['id_trx']; ?>" class="btn btn-danger" id="btn-tolak">Tolak Tawaran</a>
            </div>
            <div class="card-footer text-muted">
                Dikirim pada : <?= $req['tgl_trx']; ?>
            </div>
        </div>
        <!-- card -->
    </section>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->