<script>
  $(function(){
    <?php if(isset($_SESSION['data_disapu']) && $_SESSION['data_disapu']['level']=='2'){ ?> 
      $('#tableserverside').DataTable({
        "bPaginate": true,
        "bLengthChange": false,
        "bFilter": true,
        "bInfo": false,
        "bAutoWidth": true,
        "processing": true,
        "serverSide": true,
        "ajax":{
                "url": "<?= BASEURL; ?>Shop/serverside_confirm/<?= $data['token_screetkey']; ?>",
                "dataType": "json",
                "type": "POST"
              }

      });

      $("#form_konfirm_poin").on("submit", function(e) {
        var data_form = $("#form_konfirm_poin").serialize();
        e.preventDefault();
        if($('input', this).val().trim() == ''){
          swal.fire({
            icon : "warning",
            text: 'Pastikan Semua Data Terisi',
            timer: 2000,
            showCancelButton: false,
            showConfirmButton: false
          })
        }else{
          $.ajax({
            url: '<?= BASEURL; ?>Shop/confirm_checkout',
            type: 'post',
            data: data_form,
            dataType: "json",
            success: function(r) {
              if(r.status=="Y"){
                swal.fire({
                  icon: "success",
                  text: r.pesan,
                  timer: 2000,
                  showCancelButton: false,
                  showConfirmButton: false
                })
                $('#modal_confirm_chekcout').modal('toggle');
                document.getElementById("form_konfirm_poin").reset();
                $('#tableserverside').DataTable().ajax.reload();
              }else if(r.status=="W"){
                swal.fire({
                  icon: "warning",
                  text: r.pesan,
                  timer: 2000,
                  showCancelButton: false,
                  showConfirmButton: false
                })
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
        }
      });
    <?php } ?>
  });

  window.onload = function() {

  }

  function check_out(id){
    swal.fire({
      text: "Apakah Anda Yakin Untuk Menukarkan Poin Dengan Item Produk Tersebut!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes"
      }).then((result) => {
        if (result.isConfirmed) {
          var key = "<?= $data['token_screetkey']; ?>";
          $.ajax({
            url: '<?= BASEURL; ?>Shop/check_out',
            type: 'post',
            dataType : 'json',
            data: {key:key,id:id},
            success: function(r) {
              if(r.status=="Y"){
                swal.fire({
                  icon: "success",
                  text: r.pesan,
                  timer: 2000,
                  showCancelButton: false,
                  showConfirmButton: false
                })
                setTimeout(function(){ location.reload(); }, 2000);
              }else if(r.status=="W"){
                swal.fire({
                  icon: "warning",
                  text: r.pesan,
                  timer: 2000,
                  showCancelButton: false,
                  showConfirmButton: false
                })
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
        }
    });
  }

  function confirm_checkout(id){
    var key = "<?= $data['token_screetkey']; ?>";
    $.ajax({
      url: '<?= BASEURL; ?>Shop/detail_checkout',
      type: 'post',
      dataType : 'json',
      data: {key:key,id:id},
      success: function(r) {
        console.log(r);
        $("#id_tukar").val(r.id_tukar);
        $("#id_hadiah").val(r.id_hadiah);
        $("#id_user").val(r.id_user);
      } 
    });
    $("#modal_confirm_chekcout").modal('show');
  }
</script>
<div class="container mt-2">
  <?php if(isset($_SESSION['data_disapu']) && $_SESSION['data_disapu']['level']=='1'){ ?>
  <div class="info-box mt-2 mb-2">
    <span class="info-box-icon elevation-1"><img src="<?= BASEURL."assets/img/tombol/"; ?><?= ($data['detail_user']['jk']=="Laki-laki")?"man.png":"woman.png"; ?>" class="rounded-circle" alt="Cinque Terre"></span>
    <div class="info-box-content">
      <span class="info-box-text">Hi.</span>
      <h3 class="info-box-number"><?= $data['detail_user']['nama']; ?></h3>
    </div>
    <div class="bg-dark text-right" style="color:white; margin:-.5rem; padding:0pt 10pt 0pt 10pt;">
      <div class="info-box-number mt-2">
        <small>Poinku</small><br>  
        <h5><?= rupiah($data['poin_user']['poin_now']); ?></h5>
      </div>
    </div>
  </div>
  <?php }
  if(isset($_SESSION['data_disapu']) && $_SESSION['data_disapu']['level']=='2'){ ?>
  <div class="info-box mt-2 mb-2">
    <span class="info-box-icon elevation-1"><img src="<?= BASEURL."assets/img/tombol/products.png"; ?>"></span>
    <div class="info-box-content">
      <h5 class="info-box-number">Item Produk</h5>
    </div>
    <a type="button" href="<?= BASEURL."Hadiah"; ?>" class="btn btn-primary d-flex align-items-center">Manajemen Produk</a>
  </div>
  
  <?php } ?>
  
  <!-- JIKA SEORANG ADMIN  -->
  <?php if(isset($_SESSION['data_disapu']) && $_SESSION['data_disapu']['level']=='2'){ ?>

    <!-- informasi tambahan -->
    <div class="info-box mb-2 mt-2">
      <span class="info-box-icon elevation-1"><img src="<?= BASEURL."assets/img/tombol/voucher.png";?>"></span>
      <div class="info-box-content">
        <span class="info-box-text">Jenis Produk</span>
        <h3 class="info-box-number"><?= count($data['hadiah']); ?></h3>
      </div>
      <div class="d-flex" style="padding:5px 10px 5px 10px;">
        <div class="vr"></div>
      </div>
      <span class="info-box-icon elevation-1"><img src="<?= BASEURL."assets/img/tombol/shelf.png";?>"></span>
      <div class="info-box-content">
          <span class="info-box-text">Stock Produk</span>
          <h3 class="info-box-number"><?= $data['stock']['stock']; ?></h3>
      </div>
        <!-- /.info-box-content -->
    </div>

    <!-- daftar menunggu konfirmasi tukar hadiah -->
    <div class="card table-responsive mt-2 mb-2">
      <div class="card-header">
          <b>Menunggu Konfirmasi</b>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped table-sm" id="tableserverside">
            <thead class="thead-dark">
                <th>Nasabah</th>
                <th>Action</th>
            </thead>
            <tbody></tbody>
          </table>
        </div> 
      </div>
    </div>
    
  <?php } ?>

  <?php if(!empty($data['alert'])){ ?>
  <!-- ALERT JIKA ADA ITEM YG BELUM TERKONFIRMASI BANK SAMPAH -->
    <div class="alert alert-info d-flex align-items-center" role="alert">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
      </svg>
      <div>
        Terdapat <b><?= count($data['alert']); ?></b> item produk yang belum terkonfirmasi, silahkan datang ke Bank Sampah untuk mengambil item produk tersebut.
      </div>
    </div>
  <?php } ?>
  <!--  -->

  <div class="card mb-3" style="background-image: linear-gradient( 105.3deg,  rgba(30,39,107,1) 21.8%, rgba(77,118,221,1) 100.2% );color:white;">
    <div class="card-body text-center">
      <strong>Daftar Produk</strong>
    </div>
  </div>
  <!-- daftar produk -->
  <div class="row mt-2">
    <?php foreach($data['hadiah'] as $hadiah) :?>
      <div class="col-6 col-md-3 mb-2">
        <div class="card">
          <img class="card-img-top" src="<?= $hadiah['image']; ?>" alt="Item 1" style="max-height:120px;"/>
          <div class="card-body">
            <center><b class="card-title"><?= $hadiah['nama']?></b></center>
            <table class="table table-sm">
              <tr>
                <td>Poin</td>
                <td>:</td>
                <td><b><?= round($hadiah['poin']/$data['kurs']['kurs'],2); ?></b></td>
              </tr>
              <tr>
                <td>Stok</td>
                <td>:</td>
                <td><?= $hadiah['stok_barang']; ?></td>
              </tr>
            </table>
            <a href="#" class="btn btn-primary mt-2 btn-sm text-end" onclick="check_out('<?= $hadiah['id_hadiah']; ?>');"><i class="bi bi-cart4"></i> Check Out</a>                        
          </div>
        </div>
      </div>
    <?php endforeach;?>    
  </div>
</div>

<?php if(isset($_SESSION['data_disapu']) && $_SESSION['data_disapu']['level']=='2'){ ?>
<!-- modal konfirmasi khusus admin -->
<div class="modal fade" id="modal_confirm_chekcout" tabindex="-1" aria-labelledby="labelmodal_confirm_chekcout" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="labelmodal_confirm_chekcout">Konfirmasi Tukar Poin</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form class="form-horizontal" id="form_konfirm_poin" onsubmit="return false">
        <div class="modal-body">
          <input type="hidden" name="token_konfirm_poin" value="<?= $data['token_screetkey']; ?>">
          <input type="hidden" name="id_tukar" id="id_tukar">
          <input type="hidden" name="id_hadiah" id="id_hadiah">
          <input type="hidden" name="id_user" id="id_user">
          <div class="mb-2">
            <label for="key_checkout" class="form-label"><i class="bi bi-shield-lock"></i> KEY <span class="text-danger">*</span></label>
            <input type="text" class="form-control form-control-sm" id="key_checkout" name="key_checkout" placeholder="Masukkan Key Tukar Poin" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i> Batal</button>
          <button type="submit" id="simpan_konfirm" name="simpan_konfirm" class="btn btn-primary btn-sm"><i class="bi bi-check2-square"></i> Confirm</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php } ?>