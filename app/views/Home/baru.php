<style>
  .card-custom {
    border: none;
    border-radius: 15px;
    background-color: #f8f9fa;
    text-align: center;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
  }

  .card-custom:hover {
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
  }

  .icon {
    width: 64px;
    height: 64px;
    margin: 0 auto;
    margin-bottom: 5px;
  }
</style>
<!-- Profile content -->
<?php if (isset($_SESSION['data_disapu']) && $_SESSION['data_disapu']['level'] == 1) { ?>
  <div class="container mt-3">
    <div class="card shadow" style="background-color: #355245">
      <div class="card-body d-flex align-items-center">
        <img src="<?= BASEURL . "assets/img/tombol/"; ?><?= ($_SESSION['data_disapu']['jk'] == "Laki-laki") ? "man.png" : "woman.png"; ?>">
        <div class="ms-3">
          <p class="mb-0 fw-bold text-white">
            Hi, <span><?= $_SESSION['data_disapu']['nama']; ?></span>
          </p>
          <small class="text-white">
            <?php $poin = poin_user($_SESSION['data_disapu']['id_user']);
            if ($poin['poin_now'] > 0) {
              echo "Poin kamu saat ini, <b>" . $poin['poin_now'] . " POIN</b>";
            } else {
              echo "Ayo menabung sampah, dan kumpulkan Poinnya.";
            }
            ?></small>
        </div>
      </div>
    </div>
  </div>
<?php }; ?>

<!-- menu aplikasi -->
<div class="container">
  <div class="row mt-5">
    <?php if (isset($_SESSION['data_disapu']) && $_SESSION['data_disapu']['level'] == 1) { ?>

      <!-- tukar poin -->
      <a class="col-6" href="<?= BASEURL; ?>TukarPoin">
        <div class="card card-custom">
          <img src="<?= BASEURL; ?>assets/img/tombol/giftbox.png" alt="Hadiah" class="icon">
          <p>Tukar Poin Sampah</p>
          <!-- <a href="< ?=BASEURL;?>TukarPoin" class="btn btn-outline-success btn-block w-100">Tukar</a> -->
        </div>
      </a>
      <!-- bank sampah -->
      <a class="col-6" href="https://maps.app.goo.gl/YogaYbANMNJLxgM58" style="text-decoration: none;">
        <div class="card card-custom">
          <img src="<?= BASEURL; ?>assets/img/tombol/rumah sampah.png" alt="Hadiah" class="icon">
          <p>Bank Sampah</p>
          <!-- <a href="https://maps.app.goo.gl/YogaYbANMNJLxgM58" target="_blank" class="btn btn-outline-success btn-block w-100">Temukan</a> -->
        </div>
      </a>
    <?php } else if (isset($_SESSION['data_disapu']) && $_SESSION['data_disapu']['level'] == 2) { ?>

      <!-- timbang sampah-->
      <a class="col-6" href="<?= BASEURL; ?>Timbang" style="text-decoration: none;">
        <div class="card card-custom">
          <img src="<?= BASEURL; ?>assets/img/tombol/timbang.png" alt="Timbang" class="icon">
          <p>Timbang Sampah</p>
          <!-- <a href="< ?=BASEURL;?>Timbang" class="btn btn-outline-success btn-block w-100">Timbang</a> -->

        </div>
      </a>

      <!-- manajemen user -->
      <a class="col-6" href="<?= BASEURL; ?>Nasabah" style="text-decoration: none;">
        <div class="card card-custom">
          <img src="<?= BASEURL; ?>assets/img/tombol/people.png" alt="Pantau" class="icon">
          <p>Manajemen Nasabah</p>
          <!-- <a href="< ?=BASEURL;?>Nasabah" class="btn btn-outline-success btn-block w-100">Kunjungi</a> -->
        </div>
      </a>

      <!-- manajemen hadiah -->
      <a class="col-6" href="<?= BASEURL; ?>Hadiah" style="text-decoration: none;">
        <div class="card card-custom">
          <img src="<?= BASEURL; ?>assets/img/tombol/giftbox.png" alt="Pantau" class="icon">
          <p>Manajemen Hadiah</p>
          <!-- <a href="< ?=BASEURL;?>Hadiah" class="btn btn-outline-success btn-block w-100">Kunjungi</a> -->
        </div>
      </a>
      <!-- harga sampah -->
      <a class="col-6" href="<?= BASEURL; ?>Sampah" style="text-decoration: none;">
        <div class="card card-custom active-card">
          <img src="<?= BASEURL; ?>assets/img/tombol/garbage.png" alt="Harga" class="icon">
          <p>Manajemen Sampah</p>
          <!-- <a href="< ?=BASEURL;?>Sampah" class="btn btn-outline-success btn-block w-100">Kunjungi</a> -->
        </div>
      </a>

    <?php } ?>


    <!-- Edukasi -->
    <a class="col-6" href="<?= BASEURL; ?>Edukasi" style="text-decoration: none;">
      <div class="card card-custom">
        <img src="<?= BASEURL; ?>assets/img/tombol/webinar.png" alt="Edukasi" class="icon">
        <p>Edukasi Sampah</p>
        <!-- <a href="#" class="btn btn-outline-success btn-block w-100"> Kunjungi</a> -->
      </div>
    </a>


  </div>
</div>

<!-- Carousel Content -->
<div class="container">
  <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      <!-- carousel 1 -->
      <div class="carousel-item active">
        <div class="row justify-content-center">
          <div class="col-md-11">
            <div class="card mt-5 shadow">
              <div class="card-body">
                <h5 class="card-title">Ayo Gabung Disapu!</h5>
                <p class="card-text">
                  This is a wider card with supporting text below as a
                  natural lead-in to additional content. This content is a
                  little bit longer.
                </p>
              </div>
              <img src="<?= BASEURL; ?>assets/img/Mockup.jpeg" class="card-img-bottom" alt="..." />
            </div>
          </div>
        </div>
      </div>
      <!-- carousel 2 -->
      <div class="carousel-item active">
        <div class="row justify-content-center">
          <div class="col-md-11">
            <div class="card mt-5 shadow">
              <div class="card-body">
                <h5 class="card-title">Ayo Gabung Disapu!</h5>
                <p class="card-text">
                  This is a wider card with supporting text below as a
                  natural lead-in to additional content. This content is a
                  little bit longer.
                </p>
              </div>
              <img src="<?= BASEURL; ?>assets/img/kegiatan.jpg" class="card-img-bottom" alt="..." />
            </div>
          </div>
        </div>
      </div>
    </div>
    <button
      class="carousel-control-prev"
      type="button"
      data-bs-target="#myCarousel"
      data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button
      class="carousel-control-next"
      type="button"
      data-bs-target="#myCarousel"
      data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
</div>