<!-- Begin Page Content -->
<div class="container-fluid">
    <section class="dashboard-body">
        <?= $this->session->flashdata('message'); ?>
        <?php foreach ($tawaran as $t) : ?>
            <a href="<?= base_url('dashboard/detailrequest/' . $t['id_trx']); ?>" class="hreftawaran">
                <div class="card tawaran">
                    <div class="card-body">
                        <?= $t['nama_event']; ?>
                        <span class="readmore <?= $t['status_trx']; ?>">Status : <?= $t['status_trx']; ?> </span>
                    </div>

                </div>
            </a>
        <?php endforeach; ?>
    </section>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->