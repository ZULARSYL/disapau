
    <!-- Profile content -->
    <?php if ($_SESSION['data_disapu']['level']==1) { ?>
    <div class="container mt-3">
      <div class="card shadow" style="background-color: #355245">
        <div class="card-body d-flex align-items-center">
          <img src="<?= BASEURL."assets/img/tombol/"; ?><?= ($_SESSION['data_disapu']['jk']=="Laki-laki")?"man.png":"woman.png"; ?>">
          <div class="ms-3">
            <p class="mb-0 fw-bold text-white">
              Hi, <span><?= $_SESSION['data_disapu']['nama'];?></span>
            </p>
            <small class="text-white">
            <?php $poin = poin_user($_SESSION['data_disapu']['id_user']);
              if($poin['poin_now']>0){
                echo "Poin kamu saat ini, <b>".$poin['poin_now']." POIN</b>";
              }else{
                echo "Ayo menabung sampah, dan kumpulkan Poinnya.";
              }
            ?></small>
          </div>
        </div>
      </div>
    </div>
<?php };?>


    <!-- Menu Content -->
    <div class="container-fluid mt-5">
      <div class="card mx-auto shadow" style="max-width: 1000px; background-color: #d3d3d3">
        <h5 class="card-header fw-semibold">Menu</h5>
          <div class="row mt-3 mx-1">

            <?php if ($_SESSION['data_disapu']['level']==1) { ?>
              <!-- Tukar Poin Card -->
              <div class="col-sm-6 mb-3 mb-sm-0">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Tukar Poin</h5>
                    <p class="card-text">
                      Ayo mulai tukar poinmu sekarang dan nikmati hadiahnya!
                    </p>
                    <a href="<?=BASEURL;?>TukarPoin" class="btn btn-outline-success btn-block w-100">Tukar Sekarang</a>
                  </div>
                </div>
              </div>
              <!-- Bank Sampah Card -->
              <div class="col-sm-6">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Bank Sampah</h5>
                    <p class="card-text">
                      Ayo temukan lokasi bank sampah kami dengan mudah!
                    </p>
                    <a href="https://maps.app.goo.gl/YogaYbANMNJLxgM58" target="_blank" class="btn btn-outline-success btn-block w-100">Temukan Sekarang</a>
                  </div>
                </div>
              </div>
            <?php }else { ?>
              
              <!-- Timbang Sampah Card -->
              <div class="col-sm-6 mb-3 mb-sm-0">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Timbang Sampah</h5>
                    <p class="card-text">
                      Ayo mulai tukar poinmu sekarang dan nikmati hadiahnya!
                    </p>
                    <a href="<?=BASEURL;?>Timbang" class="btn btn-outline-success btn-block w-100">Tukar Sekarang</a>
                  </div>
                </div>
              </div>
              <!-- Manajemen User -->
              <div class="col-sm-6 mb-3 mb-sm-0">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Manajemen Nasabah</h5>
                    <p class="card-text">
                      Ayo mulai tukar poinmu sekarang dan nikmati hadiahnya!
                    </p>
                    <a href="<?=BASEURL;?>Nasabah" class="btn btn-outline-success btn-block w-100">Tukar Sekarang</a>
                  </div>
                </div>
              </div>
              <!-- manajemen hadiah -->
              <div class="col-sm-6 mb-3 mb-sm-0">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Manajemen Hadiah</h5>
                    <p class="card-text">
                      Ayo mulai tukar poinmu sekarang dan nikmati hadiahnya!
                    </p>
                    <a href="<?=BASEURL;?>Hadiah" class="btn btn-outline-success btn-block w-100">Tukar Sekarang</a>
                  </div>
                </div>
              </div>
            <?php } ?>
            
          </div>

        <!-- --------------- -->
          <div class="row mt-3 mx-1">            
            <!-- Harga Sampah Card -->
            <div class="col-sm-6 mb-2">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Manajemen Sampah</h5>
                  <p class="card-text">Temukan harga jual sampah terkini di tempat kami. Kami
                    memberikan informasi yang akurat</p>
                  <a href="<?=BASEURL;?>Sampah" class="btn btn-outline-success btn-block w-100">Cek Harga Sekarang</a>
                </div>
              </div>
            </div>
            
              <!-- Edukasi Sampah Card -->
            <div class="col-sm-6 mb-3 mb-sm-0">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Edukasi Sampah</h5>
                  <p class="card-text">Temukan berbagai informasi edukatif tentang pengelolaan
                    sampah.</p>
                  <a href="#" class="btn btn-outline-success btn-block w-100">Temukan Lebih Lanjut</a>
                </div>
              </div>
            </div>          
          </div>
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
                  <img src="<?=BASEURL;?>assets/img/Mockup.png" class="card-img-bottom" alt="..." />
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
                  <img src="<?=BASEURL;?>assets/img/kegiatan.jpg" class="card-img-bottom" alt="..." />
                </div>
              </div>
            </div>
          </div>
        </div>
        <button
          class="carousel-control-prev"
          type="button"
          data-bs-target="#myCarousel"
          data-bs-slide="prev"
        >
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button
          class="carousel-control-next"
          type="button"
          data-bs-target="#myCarousel"
          data-bs-slide="next"
        >
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>

