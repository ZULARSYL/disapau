<script>
  $(function(){
    $("#btn-logout").on("click",function(){
      var key = '<?= $data['token']; ?>';
      $.ajax({
        url: '<?= BASEURL; ?>Login/signout',
        data : {key:key},
        method: 'post',
        dataType: 'json',
        success: function(r){
          if(r.status=="Y"){
            swal.fire({
              icon: "info",
              text: r.pesan,
              timer: 2000,
              showCancelButton: false,
              showConfirmButton: false
            })
            setTimeout(function(){ location.reload(); }, 2000);
          }else{
            swal.fire({
              icon: "error",
              text: r.pesan,
              timer: 2000,
              showCancelButton: false,
              showConfirmButton: false
            })
          }
        }
      });
    });
  });
</script>
<div class="container mt-2 mb-2">
  <center>
    <img src="<?= BASEURL."assets/img/tombol/"; ?><?= ($data['detail_user']['jk']=="Laki-laki")?"man.png":"woman.png"; ?>" class="rounded-circle p-3" style="background-color:white;" alt="Cinque Terre">
  </center>
  <div class="card" style="margin-top:-12px;border:none ;">
    <div class="card-body justify-content-center">
      <table class="table table-sm">
        <tr><td>NIK</td><td>:</td><td><?= $data['detail_user']['nik']; ?></td></tr>
        <tr><td>Nama</td><td>:</td><td><?= $data['detail_user']['nama']; ?></td></tr>
        <tr><td>Alamat</td><td>:</td><td><?= "Dusun ".$data['detail_user']['dusun']." RT.".$data['detail_user']['rt']."/RW.".$data['detail_user']['rw']." Desa ".$data['detail_user']['alamat']; ?></td></tr>
      </table>
    </div>
    <a href="#" id="btn-logout" class="btn btn-primary">Log Out</a>
  </div>
  
  <!-- KHUSUS NASABAH  -->
  <?php if($_SESSION['data_disapu']['level']=="1"){ ?>
    <div class="info-box mt-2 mb-2">
      <span class="info-box-icon elevation-1"><img src="<?= BASEURL."assets/img/tombol/garbage.png";?>"></span>
      <div class="info-box-content">
        <span class="info-box-text">Setor</span>
        <h3 class="info-box-number"><?= count($data['setor_sampah']); ?>x</h3>
      </div>
      <div class="bg-dark text-right" style="color:white; margin:-.5rem; padding:0pt 10pt 0pt 10pt;">
        <div class="info-box-number mt-2">
          <small>Poinku</small><br/>
          <h5><?= rupiah($data['poin_user']['poin_now']); ?></h5>
        </div>
      </div>
    </div>
    <?php if(!empty($data['alert'])){ ?>
    <!-- ALERT JIKA ADA ITEM YG BELUM TERKONFIRMASI BANK SAMPAH -->
      <div class="alert alert-info d-flex align-items-center" role="alert">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
          <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
        </svg>
        <div>
          <b><?= count($data['alert']); ?></b> Item Produk Belum Kamu Ambil.
        </div>
      </div>
    <?php } ?>

    <div class="card">
      <div class="card-header">
        <b>Riwayat</b>
      </div>
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="setor-tab" data-bs-toggle="tab" data-bs-target="#setor" type="button" role="tab" aria-controls="setor" aria-selected="true">Setor Sampah</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="tukar-tab" data-bs-toggle="tab" data-bs-target="#tukar" type="button" role="tab" aria-controls="tukar" aria-selected="false">Tukar Poin</button>
        </li>
      </ul>
      <div class="card-body">
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="setor" role="tabpanel" aria-labelledby="setor-tab">
            <div class="accordion accordion-flush" id="accordionFlushExample">
              <?php $no_ss = 1; 
              foreach ($data['setor_sampah'] as $s_s) : ?>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="flus-headingSetor<?= $no_ss; ?>">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSetor<?= $no_ss; ?>" aria-expanded="false" aria-controls="collapseSetor<?= $no_ss; ?>">
                      <?= $s_s['nama_klasifikasi']; ?> | <span class="text-success text-end"><i class="bi bi-plus"></i><?= $s_s['total_poin']; ?> POIN</span>
                    </button>
                  </h2>
                  <div id="collapseSetor<?= $no_ss; ?>" class="accordion-collapse collapse" aria-labelledby="flus-headingSetor<?= $no_ss; ?>" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                      <table>
                        <tr>
                          <td>Tanggal</td>
                          <td>&nbsp;:&nbsp;</td>
                          <td><?= datetime_indo($s_s['tgl_input']); ?></td>
                        </tr>
                        <tr>
                          <td>Kategori</td>
                          <td>&nbsp;:&nbsp;</td>
                          <td><?= $s_s['kategori']; ?></td>
                        </tr>
                        <tr>
                          <td>Sampah</td>
                          <td>&nbsp;:&nbsp;</td>
                          <td><?= $s_s['nama_klasifikasi']; ?></td>
                        </tr>
                        <tr>
                          <td>Nilai Sampah</td>
                          <td>&nbsp;:&nbsp;</td>
                          <td><?= round($s_s['harga_jual']/$s_s['kurs_poin'],2); ?></td>
                        </tr>
                        <tr>
                          <td>Berat</td>
                          <td>&nbsp;:&nbsp;</td>
                          <td><?= $s_s['qty_setor']; ?> KG</td>
                        </tr>
                        <tr>
                          <td>TOTAL POIN</td>
                          <td>&nbsp;:&nbsp;</td>
                          <td class="text-success"><b>+<?= $s_s['total_poin']; ?></b></td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>
              <?php $no_ss++; endforeach; ?>
            </div>
          </div>
          <div class="tab-pane fade" id="tukar" role="tabpanel" aria-labelledby="tukar-tab">
            <div class="accordion accordion-flush" id="accordionFlushExample">
              <?php
                $no = 1; 
                foreach ($data['riwayat_checkout'] as $r_c) : ?>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="flush-heading<?= $no; ?>">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#rc<?= $no; ?>" aria-expanded="false" aria-controls="rc<?= $no; ?>">
                      <?= ucfirst($r_c['nama_hadiah']); ?> |<span class="text-danger text-end">&nbsp;-<?= $r_c['poin_checkout']; ?> POIN</span>
                      <?php
                        if($r_c['status_checkout']=='' and $r_c['tgl_checkout']==''){
                          echo "&nbsp;&nbsp;<span class='badge bg-warning text-dark'><i class='bi bi-clock-history'></i> &nbsp;Waiting</span>";
                        }else{
                          echo "&nbsp;&nbsp;<span class='badge bg-success'><i class='bi bi-check2-circle'></i> &nbsp;Confirmed</span>";
                        }
                      ?>
                    </button>
                  </h2>
                  <div id="rc<?= $no; ?>" class="accordion-collapse collapse" aria-labelledby="flush-heading<?= $no; ?>" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                      <table>
                        <tr>
                          <td>Checkout</td>
                          <td>&nbsp; : &nbsp;</td>
                          <td><?= datetime_indo($r_c['tgl_input']); ?></td>
                        </tr>
                        <tr>
                          <td>Pengambilan</td>
                          <td>&nbsp; : &nbsp;</td>
                          <td>
                            <?php 
                            if($r_c['status_checkout']=='' and $r_c['tgl_checkout']==''){
                              echo "Belum di Ambil";
                            }else{
                              echo datetime_indo($r_c['tgl_checkout']);
                            } 
                            
                            ?>
                          </td>
                        </tr>
                        <tr>
                          <td>Produk</td>
                          <td>&nbsp; : &nbsp;</td>
                          <td><?= $r_c['nama_hadiah']; ?></td>
                        </tr>
                        <tr>
                          <td>QTY</td>
                          <td>&nbsp; : &nbsp;</td>
                          <td>1</td>
                        </tr>
                        <tr>
                          <td>POIN</td>
                          <td>&nbsp; : &nbsp;</td>
                          <td class="text-danger">- <?= $r_c['poin_checkout']; ?></td>
                        </tr>
                        <tr>
                          <td><i class="bi bi-shield-lock"></i> KEY</td>
                          <td>&nbsp; : &nbsp;</td>
                          <td class="bg-warning"><center><sctrong><?= $r_c['key_checkout']; ?></sctrong></center></td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>
              <?php
                $no++; 
                endforeach; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php 
  // KHUSUS ADMIN
    }else{
      if(!empty($data['alert'])){ ?>
      <!-- ALERT JIKA ADA ITEM YG BELUM TERKONFIRMASI BANK SAMPAH -->
        <div class="alert alert-info d-flex align-items-center mt-2" role="alert">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
          </svg>
          <div>
            <b><?= count($data['alert']); ?></b> Tukar Poin Perlu Konfirmasi <a href="<?= BASEURL."Shop"; ?>" class="btn btn-info btn-sm"><i class="bi bi-card-checklist"></i> Disini</a>
          </div>
        </div>
    <?php }
    } ?>
</div>