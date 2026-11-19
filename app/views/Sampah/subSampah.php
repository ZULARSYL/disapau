<div class="container mt-3">
      <div class="card shadow">
        <div class="card-header text-center">
          <h1 class="mb-0 fw-semibold">Tukar Poin</h1>
        </div>

        <div class="card-body">
          <div class="row">
        <?php foreach($data['sub_jenis'] as $smph) :?>
            <div class="col-6 col-md-3">
              <div class="card">
                <img
                  class="card-img-top"
                  src="https://via.placeholder.com/150"
                  alt="Sampah"
                />
                <div class="card-body">
                  <h5 class="card-title"><?=$smph['nama_klasifikasi'];?></h5>
                  <p class="card-text">Poin: <?=$smph['poin'];?></p>
                </div>
              </div>
            </div>
        <?php endforeach;?>
            <!-- Tambahkan item lain sesuai kebutuhan -->
          </div>
        </div>
      </div>
    </div>