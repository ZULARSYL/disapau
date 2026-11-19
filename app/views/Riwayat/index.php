<!-- Main Content -->
<main class="container mt-4">
  <div class="card shadow">
    <div class="card-body">
      <h2 class="card-title">Riwayat Transaksi</h2>
      <div class="accordion" id="accordionExample">

        <?php if ($_SESSION['data_disapu']['level'] == 1) { ?>
          <!-- Accordion Item 1 -->

          <div class="accordion" id="accordionExample">
            <?php
            $categories = [
              "Koran", "Majalah", "Plastik", "Logam", "Kaca", "Elektronik", "Kain", "Organik", "Besi", "Aluminium"
            ];
            $date = "2024-06-16";
            $point = 10; // Example point, same for all as a demo
            $weight = 2; // Example weight, same for all as a demo

            for ($i = 0; $i < 10; $i++) {
              $headingId = "heading" . $i;
              $collapseId = "collapse" . $i;
              $category = $categories[$i];
            ?>
              <div class="accordion-item">
                <h2 class="accordion-header" id="<?= $headingId; ?>">
                  <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#<?= $collapseId; ?>" aria-expanded="true" aria-controls="<?= $collapseId; ?>">
                    (<?= $category; ?>) +(<span><?= $point; ?> </span>) Poin
                  </button>
                </h2>
                <div id="<?= $collapseId; ?>" class="accordion-collapse collapse" aria-labelledby="<?= $headingId; ?>" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    <strong>Detail Transaksi:</strong>
                    <ul>
                      <li><strong>Tanggal:</strong> <span><?= $date; ?></span></li>
                      <li><strong>Berat Sampah:</strong> <span><?= $weight; ?></span> Kg </li>
                      <li><strong>Kategori Sampah:</strong> <span><?= $category; ?></span> </li>
                      <li><strong>Admin:</strong> <span><?= $weight; ?></span> Kg</li>
                    </ul>
                  </div>
                </div>
              </div>
            <?php } ?>
          </div>




        <?php } else { ?>
          <!-- Accordion Item 1 -->
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                ID : (</span>122455<span> </span>) +(<span>10 </span>) Poin
              </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <strong>Detail Transaksi:</strong>
                <ul>
                  <li><strong>Nama Nasabah:</strong> Muhamammad Farizqi</li>
                  <li><strong>Tanggal:</strong> <span>2024-06-16</span></li>
                  <li><strong>Kategori Sampah:</strong> <span>Kertas</span> </li>
                  <li><strong>Jenis Sampah:</strong> <span>Kertas Koran</span> </li>
                  <li><strong>Berat Sampah:</strong> <span>2</span> Kg</li>
                </ul>
              </div>
            </div>
          </div>

          <!-- Accordion Item 2 -->
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                ID : (</span>122455<span> </span>) +(<span>10 </span>) Poin
              </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <strong>Detail Transaksi:</strong>
                <ul>
                  <li><strong>Nama Nasabah:</strong> Muhamammad Farizqi</li>
                  <li><strong>Tanggal:</strong> <span>2024-06-16</span></li>
                  <li><strong>Kategori Sampah:</strong> <span>Kertas</span> </li>
                  <li><strong>Jenis Sampah:</strong> <span>Kertas Koran</span> </li>
                  <li><strong>Berat Sampah:</strong> <span>2</span> Kg</li>
                </ul>
              </div>
            </div>
          </div>

          <!-- Accordion Item 3 -->
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                ID : (</span>122455<span> </span>) +(<span>10 </span>) Poin
              </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <strong>Detail Transaksi:</strong>
                <ul>
                  <li><strong>Nama Nasabah:</strong> Muhamammad Farizqi</li>
                  <li><strong>Tanggal:</strong> <span>2024-06-16</span></li>
                  <li><strong>Kategori Sampah:</strong> <span>Kertas</span> </li>
                  <li><strong>Jenis Sampah:</strong> <span>Kertas Koran</span> </li>
                  <li><strong>Berat Sampah:</strong> <span>2</span> Kg</li>
                </ul>
              </div>
            </div>
          </div>
        <?php } ?>

      </div>
    </div>
  </div>
</main>