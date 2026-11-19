<div class="container mt-5">
     <?php if (!empty($_SESSION['message'])): ?>
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            <?= $_SESSION['message']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['message']); // Menghapus pesan setelah ditampilkan ?>
    <?php endif; ?>
    <div class="row">
        <div class="col-12">
            <div class="card card-custom text-light" style="max-width: 1000px; background-color: #2d3748">
                <div class="card-body card-body-custom">
                    <p class="mb-1">Hi. <?= $_SESSION['data_disapu']['nama']; ?></p>
                    <div class="d-flex justify-content-between">
                        <?php if($_SESSION['data_disapu']['level'] == 1){ ?>
                            <p class="card-title mb-0">Poin Anda : <strong><?= $data['poin_now']; ?></strong></>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-3">
    <div class="card shadow">
        <div class="card-header text-center">
            <b class="mb-0 fw-semibold">Daftar Produk</b>
        </div>
        <div class="card-body">
            <div class="row">
                <?php foreach ($data['hadiah'] as $hadiah): ?>
                    <div class="col-6 col-md-3 mb-3">
                        <div class="card">
                            <img class="card-img-top" src="https://via.placeholder.com/150" alt="">
                            <div class="card-body">
                                <h5 class="card-title"><?= $hadiah['nama']; ?></h5>
                                <p class="card-text">Poin: <?= $hadiah['poin']; ?></p>
                                <p >Stok : <span><?= $hadiah['stok_barang']; ?></span></p>
                                <form action="<?= BASEURL; ?>Shope/tukarPoin" method="post">
                                    <input type="hidden" name="id_user" value="<?= $_SESSION['data_disapu']['id_user']; ?>" />
                                    <input type="hidden" name="id_hadiah" value="<?= $hadiah['id_hadiah']; ?>" />
                                    <input type="hidden" name="poin" value="<?= $hadiah['poin']; ?>" />
                                    <input type="hidden" name="nama_hadiah" value="<?= $hadiah['nama']; ?>" />
                                    <input type="hidden" name="stok_barang" value="<?= $hadiah['stok_barang']; ?>" />
                                        <div class="align-items-center">
                                            <button type="submit" class="btn btn-primary">Tukar</button>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
