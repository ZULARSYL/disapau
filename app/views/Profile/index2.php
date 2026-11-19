<?php if($_SESSION['data_disapu']['id_user'] == 1){ ?>
  <div class="container mt-4 mb-4 p-3 d-flex justify-content-center">
    <div class="card p-4 shadow">
      <div class="image d-flex flex-column justify-content-center align-items-center">
        <button class="btn btn-secondary">
          <img src="img/jurnalis.png" height="100" width="100" />
        </button>
        <span class="name mt-3 fw-bold"><?=$_SESSION['data_disapu']['nama'];?></span>
        <div class="d-flex flex-row justify-content-center align-items-center gap-2">
          <span><?=$_SESSION['data_disapu']['alamat'];?></span>
        </div>
        <div class="d-flex flex-row justify-content-center align-items-center gap-2">
          <span>No Hp : <span><?=$_SESSION['data_disapu']['no_telp'];?></span></span>
        </div>
        <div class="d-flex flex-row justify-content-center align-items-center gap-2">
          <p>Sebagai : <span><?= $_SESSION['data_disapu']['level'] == 1 ? 'user' : 'admin'; ?></span></p>
        </div>
        <div class="d-flex mt-2">
          <a href="<?= BASEURL."Login/signout"; ?>">
            <button class="btn btn-outline-danger btn-block w-100">
              Logout
            </button>
          </a>
        </div>
      </div>
    </div>
  </div>
<?php } else{?>
  <div class="container mt-4 mb-4 p-3 d-flex justify-content-center">
    <div class="card p-4 shadow">
      <div class="image d-flex flex-column justify-content-center align-items-center">
        <button class="btn btn-secondary">
          <img src="img/jurnalis.png" height="100" width="100" />
        </button>
        <span class="name mt-3 fw-bold"><?=$_SESSION['data_disapu']['nama'];?></span>
        <div class="d-flex flex-row justify-content-center align-items-center gap-2">
          <span><?=$_SESSION['data_disapu']['alamat'];?></span>
        </div>
        <div class="d-flex flex-row justify-content-center align-items-center gap-2">
          <span>No Hp : <span><?=$_SESSION['data_disapu']['no_telp'];?></span></span>
        </div>
        <div class="d-flex flex-row justify-content-center align-items-center gap-2">
          <p>Sebagai : <span><?= $_SESSION['data_disapu']['level'] == 1 ? 'user' : 'admin'; ?></span></p>
        </div>
        <div class="d-flex mt-2">
          <a href="#">
            <button class="btn btn-outline-primary btn-block w-100">
              Riwayat penerimaan
            </button>
          </a>
        </div>
        <div class="d-flex mt-2">
          <a href="<?= BASEURL."Login/signout"; ?>">
            <button class="btn btn-outline-danger btn-block w-100">
              Logout
            </button>
          </a>
        </div>
      </div>
    </div>
  </div>
<?php } ?>


  <!-- Nav Pills -->
   <?php if($_SESSION['data_disapu']['id_user'] == 1){ ?>
    <ul class="nav nav-pills">
      <li class="nav-item">
        <a class="nav-link" id="nav-timbang-tab" href="#">Riwayat Timbang</a>
      </li>
      <li class="nav-item">
         <a class="nav-link" id="nav-penukaran-tab" href="#">Riwayat Penukaran</a>
      </li>
    </ul>

  <!-- Main Content -->
        <main class="container mt-4">
          <div id="content-timbang" class="card shadow">
            <div class="card-body">
              <h2 class="card-title">Riwayat Timbang</h2>
              <div class="accordion" id="accordionTimbang">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingOneTimbang">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOneTimbang" aria-expanded="true" aria-controls="collapseOneTimbang">
                      ID : (122455) + (10) Poin
                    </button>
                  </h2>
                  <div id="collapseOneTimbang" class="accordion-collapse collapse" aria-labelledby="headingOneTimbang" data-bs-parent="#accordionTimbang">
                    <div class="accordion-body">
                      <strong>Detail Transaksi:</strong>
                      <ul>
                        <li><strong>Nama Nasabah:</strong> Muhamammad Farizqi</li>
                        <li><strong>Tanggal:</strong> 2024-06-16</li>
                        <li><strong>Kategori Sampah:</strong> Kertas</li>
                        <li><strong>Jenis Sampah:</strong> Kertas Koran</li>
                        <li><strong>Berat Sampah:</strong> 2 Kg</li>
                      </ul>
                    </div>
                  </div>
                </div>
                <!-- Tambahkan item lainnya sesuai kebutuhan -->
              </div>
            </div>
          </div>

          <div id="content-penukaran" class="card shadow" style="display: none;">
    <div class="card-body">
        <h2 class="card-title">Riwayat Penukaran</h2>
        <div class="accordion" id="accordionPenukaran">
            <!-- Menampilkan riwayat dengan sifat 1 terlebih dahulu -->
            <?php foreach ($data['riwayat_sifat_1'] as $index => $riwayat): ?> 
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingPenukaran<?= $index ?>">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePenukaran<?= $index ?>" aria-expanded="false" aria-controls="collapsePenukaran<?= $index ?>">
                            ID : (<span><?= $riwayat['id_transaksi']?></span>) | Barang: (<span><?= $riwayat['nama_hadiah']?></span>) 
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-hourglass-split text-warning" viewBox="0 0 16 16">
                                    <path d="M2.5 15a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1zm2-13v1c0 .537.12 1.045.337 1.5h6.326c.216-.455.337-.963.337-1.5V2zm3 6.35c0 .701-.478 1.236-1.011 1.492A3.5 3.5 0 0 0 4.5 13s.866-1.299 3-1.48zm1 0v3.17c2.134.181 3 1.48 3 1.48a3.5 3.5 0 0 0-1.989-3.158C8.978 9.586 8.5 9.052 8.5 8.351z"/>
                                </svg>
                            </span>
                        </button>
                    </h2>
                    <div id="collapsePenukaran<?= $index ?>" class="accordion-collapse collapse" aria-labelledby="headingPenukaran<?= $index ?>" data-bs-parent="#accordionPenukaran">
                        <div class="accordion-body">
                            <strong>Detail Penukaran:</strong>
                            <ul>
                                <li><strong>ID nasabah:</strong> <span><?= $_SESSION['data_disapu']['id_user']?></span></li>
                                <li><strong>Nama nasabah:</strong> <span><?= $_SESSION['data_disapu']['nama']?></span></li>
                                <li><strong>Hadiah tukar:</strong> <span><?= $riwayat['nama_hadiah']?></span></li>
                                <li><strong>Harga hadiah:</strong> <span><?= $riwayat['jumlah_poin']?></span></li>
                                <li><strong>ID admin penerima :</strong> <span><?= $riwayat['id_admin'] ?? '-' ?></span></li>
                                <li><strong>Nama admin penerima :</strong> <span><?= $riwayat['nama_admin'] ?? '-' ?></span></li>
                                <li><strong>Waktu Checkout:</strong> <span><?= $riwayat['tgl_input'] ?></span></li>
                                <li><strong>Waktu diterima admin :</strong> <span><?= $riwayat['tgl_checkout'] ?? '-' ?></span></li>
                                <li><strong>Status :</strong> <span><?= $riwayat['sifat'] == 1 ? 'Belum di terima admin':'sukses' ?></span></li>
                            </ul>
                            <button type="button" class="btn btn-danger" onclick="cancelTransaction(<?= $riwayat['id_transaksi'] ?>, <?= $riwayat['jumlah_poin'] ?>)">Batalkan penukaran</button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

            <!-- Menampilkan riwayat dengan sifat lainnya -->
            <?php foreach ($data['riwayat_sifat_others'] as $index => $riwayat): ?> 
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingPenukaranOthers<?= $index ?>">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePenukaranOthers<?= $index ?>" aria-expanded="false" aria-controls="collapsePenukaranOthers<?= $index ?>">
                            ID : (<span><?= $riwayat['id_transaksi']?></span>) | Barang: (<span><?= $riwayat['nama_hadiah']?></span>)
                        </button>
                    </h2>
                    <div id="collapsePenukaranOthers<?= $index ?>" class="accordion-collapse collapse" aria-labelledby="headingPenukaranOthers<?= $index ?>" data-bs-parent="#accordionPenukaran">
                        <div class="accordion-body">
                            <strong>Detail Penukaran:</strong>
                            <ul>
                                <li><strong>ID nasabah:</strong> <span><?= $_SESSION['data_disapu']['id_user']?></span></li>
                                <li><strong>Nama nasabah:</strong> <span><?= $_SESSION['data_disapu']['nama']?></span></li>
                                <li><strong>Hadiah tukar:</strong> <span><?= $riwayat['nama_hadiah']?></span></li>
                                <li><strong>Harga hadiah:</strong> <span><?= $riwayat['jumlah_poin']?></span></li>
                                <li><strong>ID admin penerima :</strong> <span><?= $riwayat['id_admin'] ?? '-' ?></span></li>
                                <li><strong>Nama admin penerima :</strong> <span><?= $riwayat['nama_admin'] ?? '-' ?></span></li>
                                <li><strong>Waktu Checkout:</strong> <span><?= $riwayat['tgl_input'] ?></span></li>
                                <li><strong>Waktu diterima admin :</strong> <span><?= $riwayat['tgl_checkout'] ?? '-' ?></span></li>
                                <li><strong>Status :</strong> <span><?= $riwayat['sifat'] == 1 ? 'Belum di terima admin':'sukses' ?></span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>


        </main>
   <?php } else{?>
    <ul class="nav nav-pills">
      <li class="nav-item">
        <a class="nav-link" id="nav-timbang-tab" href="#">Transaksi tertunda</a>
      </li>
      <li class="nav-item">
         <a class="nav-link" id="nav-penukaran-tab" href="#">Transaksi selesai</a>
      </li>
    </ul>

  <!-- Main Content -->
  <main class="container mt-4">
    <div id="content-timbang" class="card shadow">
      <div class="card-body">
        <h2 class="card-title">Transaksi tertunda</h2>
        <div class="accordion" id="accordionTimbang">
          <?php foreach($data['riwayat_user'] as $index => $riwayatUser):?>
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingOneTimbang<?= $index ?>">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOneTimbang<?= $index ?>" aria-expanded="true" aria-controls="collapseOneTimbang">
                ID : (<span><?= $riwayatUser['id_transaksi']?></span>) Nama: (<?= $riwayatUser['nama_user']?>)
              </button>
            </h2>
            <div id="collapseOneTimbang<?= $index ?>" class="accordion-collapse collapse" aria-labelledby="headingOneTimbang<?= $index ?>" data-bs-parent="#accordionTimbang">
              <div class="accordion-body">
                <strong>Detail Transaksi:</strong>
                <ul>
                <li><strong>ID nasabah:</strong> <span><?= $riwayatUser['id_user']?></span></li>
                   <li><strong>Nama nasabah:</strong> <span><?= $riwayatUser['nama_user']?></span></li>
                   <li><strong>Hadiah tukar:</strong> <span><?= $riwayatUser['nama_hadiah']?></span></li>
                   <li><strong>Harga hadiah:</strong> <span><?= $riwayatUser['jumlah_poin']?></span></li>
                   <li><strong>Waktu Checkout:</strong> <span><?= $riwayatUser['tgl_input'] ?></span></li>
                </ul>
                <form method="post" action="<?= BASEURL; ?>/Profile/terimaTransaksi">
                  <input type="hidden" name="id_transaksi" value="<?= $riwayatUser['id_transaksi']; ?>" />
                  <input type="hidden" name="id_admin" value="<?= $_SESSION['data_disapu']['id_user']; ?>" />
                  <input type="hidden" name="nama_admin" value="<?= $_SESSION['data_disapu']['nama']; ?>" />
                  <input type="hidden" name="id_hadiah" value="<?= $riwayatUser['id_hadiah']; ?>" /> <!-- Tambahkan id_hadiah -->
                  <button type="submit" class="btn btn-success">Terima Transaksi</button>
                </form>
              </div>
            </div>
          </div>
          <?php endforeach;?>
          <!-- Tambahkan item lainnya sesuai kebutuhan -->
        </div>
      </div>
    </div>

    <div id="content-penukaran" class="card shadow" style="display: none;">
      <div class="card-body">
        <h2 class="card-title">Transaksi selesai</h2>
        <div class="accordion" id="accordionPenukaran">
        <?php foreach($data['riwayat_user_done'] as $index => $riwayatUserDone):?>
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingOnePenukaran<?= $index ?>">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOnePenukaran<?= $index ?>" aria-expanded="true" aria-controls="collapseOnePenukaran">
              ID : (<span><?= $riwayatUserDone['id_transaksi']?></span>) Nama: (<?= $riwayatUserDone['nama_user']?>)
              </button>
            </h2>
            <div id="collapseOnePenukaran<?= $index ?>" class="accordion-collapse collapse" aria-labelledby="headingOnePenukaran<?= $index ?>" data-bs-parent="#accordionPenukaran">
              <div class="accordion-body">
                <strong>Detail Penukaran:</strong>
                <ul>
                    <li><strong>ID nasabah:</strong> <span><?= $riwayatUserDone['id_user']?></span></li>
                    <li><strong>Nama nasabah:</strong> <span><?= $riwayatUserDone['nama_user']?></span></li>
                    <li><strong>Hadiah tukar:</strong> <span><?= $riwayatUserDone['nama_hadiah']?></span></li>
                    <li><strong>Harga hadiah:</strong> <span><?= $riwayatUserDone['jumlah_poin']?></span></li>
                    <li><strong>ID admin penerima :</strong> <span><?= $riwayatUserDone['id_admin'] ?? '-' ?></span></li>
                    <li><strong>Nama admin penerima :</strong> <span><?= $riwayatUserDone['nama_admin'] ?? '-' ?></span></li>
                    <li><strong>Waktu Checkout:</strong> <span><?= $riwayatUserDone['tgl_input'] ?></span></li>
                    <li><strong>Waktu diterima admin :</strong> <span><?= $riwayatUserDone['tgl_checkout'] ?? '-' ?></span></li>
                    <li><strong>Status :</strong> <span><?= $riwayatUserDone['sifat'] == 1 ? 'Belum di terima admin':'sukses' ?></span></li>
                </ul>
              </div>
            </div>
          </div>
          <?php endforeach;?>

          <!-- Tambahkan item lainnya sesuai kebutuhan -->
        </div>
      </div>
    </div>
  </main>

   <?php } ?>
  

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const navTimbang = document.getElementById('nav-timbang-tab');
      const navPenukaran = document.getElementById('nav-penukaran-tab');
      const contentTimbang = document.getElementById('content-timbang');
      const contentPenukaran = document.getElementById('content-penukaran');

      // Default aktifkan Riwayat Timbang
      navTimbang.classList.add('active', 'bg-success');
      navPenukaran.classList.add('text-black','bg-secondary');
      contentTimbang.style.display = 'block';
      contentPenukaran.style.display = 'none';

      navTimbang.addEventListener('click', function () {
        navTimbang.classList.add('active', 'bg-success', 'text-white');
        navPenukaran.classList.remove('active', 'bg-success','text-white');
        contentTimbang.style.display = 'block';
        contentPenukaran.style.display = 'none';
      });

      navPenukaran.addEventListener('click', function () {
        navPenukaran.classList.add('active', 'bg-success', 'text-white');
        navTimbang.classList.add('text-black','bg-secondary');
        navTimbang.classList.remove('active', 'bg-success', 'text-white');
        contentTimbang.style.display = 'none';
        contentPenukaran.style.display = 'block';
      });
    });
    function cancelTransaction(id_transaksi, jumlah_poin) {
    if (confirm('Apakah Anda yakin ingin membatalkan penukaran ini?')) {
        var formData = new FormData();
        formData.append('id_transaksi', id_transaksi);
        formData.append('jumlah_poin', jumlah_poin);

        fetch('<?= BASEURL; ?>Profile/cancelTransaction', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            if (data === 'success') {
                alert('Penukaran berhasil dibatalkan.');
                location.reload();
            } else {
                alert('Terjadi kesalahan, silakan coba lagi.');
                location.reload();
            }
        });
    }
}
  </script>