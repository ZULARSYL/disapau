<style>
  .row-scrollable {
    scrollbar-width: none;
    /* Firefox */
    -ms-overflow-style: none;
    /* Internet Explorer 10+ */
  }

  .row-scrollable::-webkit-scrollbar {
    display: none;
    /* Safari and Chrome */
  }

  .card-custom {
    border-radius: 15px;
    /* Membuat sisi-sisi card lebih bundar */
    overflow: hidden;
    /* Menghindari elemen di dalam card melampaui sudut */
  }

  .card-body-custom {
    background: linear-gradient(135deg,
        #28a745,
        #218838);
    /* Gradasi hijau dari terang ke gelap */
    color: white;
    /* Warna teks putih untuk kontras */
  }
</style>
<?php
$urlbuku = BASEURL . "Edukasi/";
?>
<div class="container p-3">
  <!-- Latest Plants Section -->
  <div class="row mb-3 flex-nowrap overflow-auto row-scrollable">
    <!-- Buku Panduan Aplikasi -->
    <div class="col-6">
      <a href="<?= $urlbuku; ?>aplikasi" style="text-decoration: none;">
        <div class="card card-custom">
          <img
            src="<?= BASEURL; ?>assets/img/edukasi/buku aplikasi.jpeg"
            class="card-img-top"
            alt="buku aplikasi" />
          <div class="card-body card-body-custom">
            <h6 class="card-title">Buku Panduan Aplikasi</h6>
          </div>
        </div>
      </a>
    </div>

    <!-- Buku Panduan Maggot -->
    <div class="col-6">
      <a href="<?= $urlbuku; ?>maggot" style="text-decoration: none;">
        <div class="card card-custom">
          <img
            src="<?= BASEURL; ?>assets/img/edukasi/buku maggot.jpeg"
            class="card-img-top"
            alt="Buku Maggot" />
          <div class="card-body card-body-custom">
            <h6 class="card-title">Buku Pembuatan Maggot</h6>
          </div>
        </div>
      </a>
    </div>

    <!-- Buku Panduan Pembuatan POC -->
    <div class="col-6">
      <a href="<?= $urlbuku; ?>poc" style="text-decoration: none;">
        <div class="card card-custom">
          <img src="<?= BASEURL; ?>assets/img/edukasi/buku POC.jpeg" class="card-img-top" alt="Buku POC" />
          <div class="card-body card-body-custom">
            <h6 class="card-title">Buku Pembuatan POC</h6>
          </div>
        </div>
      </a>
    </div>
  </div>
</div>

<h3 class="bg-success rounded d-inline-flex p-2 w-55 text-white p-2 ms-2">Video Inspirasi</h3>
<div class="d-flex flex-column gap-3">
  <div class="card card-custom">
    <div class="card-body card-body-custom">
      <h6 class="card-title">Bank Sampah</h6>
    </div>
    <div class="d-flex justify-content-center align-items-center">
      <iframe width="560" height="315" src="https://www.youtube.com/embed/ApuDawJmYdw?si=mGfbm0gm4HVUcgk0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
    </div>
  </div>

  <div class="card card-custom">
    <div class="card-body card-body-custom">
      <h6 class="card-title">Budidaya Maggot</h6>
    </div>
    <div class="d-flex justify-content-center align-items-center">
      <iframe width="560" height="315" src="https://www.youtube.com/embed/g6Jj5svG9fA?si=Eq1lxriTviHwZwu4" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
    </div>
  </div>
  <div class="card card-custom">
    <div class="card-body card-body-custom">
      <h6 class="card-title">Pengelolaan Sampah</h6>
    </div>
    <div class="d-flex justify-content-center align-items-center">
      <iframe width="560" height="315" src="https://www.youtube.com/embed/CGd3lgxReFE?si=rT2sAiTqjIMyfCBx" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
    </div>
  </div>
</div>