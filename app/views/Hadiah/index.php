<script>
  $(function(){
    // ajax tambah hadiah
    $("#form_add_hadiah").on("submit", function(e) {
      e.preventDefault();
      var data_form = new FormData(this);
      $.ajax({
        url: '<?= BASEURL; ?>Hadiah/tambah',
        type: 'post',
        data: data_form,
        dataType : "json",
        success: function (r) {
          if(r.status=="Y"){
            swal.fire({
              icon: "success",
              text: r.pesan,
              timer: 2000,
              showCancelButton: false,
              showConfirmButton: false
            })
            $('#formModal').modal('toggle');
            document.getElementById("form_add_hadiah").reset();
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
        },
        cache: false,
        contentType: false,
        processData: false
      });
    });

    //ajax ubah hadiah
    $("#form_edit_hadiah").on("submit", function(e) {
      e.preventDefault();
      var data_form = new FormData(this);
      $.ajax({
        url: '<?= BASEURL; ?>Hadiah/ubah',
        type: 'post',
        data: data_form,
        dataType : "json",
        success: function (r) {
          if(r.status=="Y"){
            swal.fire({
              icon: "success",
              text: r.pesan,
              timer: 2000,
              showCancelButton: false,
              showConfirmButton: false
            })
            $('#formModalEdit').modal('toggle');
            document.getElementById("form_edit_hadiah").reset();
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
        },
        cache: false,
        contentType: false,
        processData: false
      });
    });
  }); 

  //fungsi edit
  function detail_edit(id){
    var key = '<?= $data['token_screetkey'] ?>';
    $.ajax({
        url: '<?= BASEURL; ?>Hadiah/getubah',
        data : {id : id, key:key},
        method: 'post',
        dataType: 'json',
        success: function(r){
            console.log(r);
            $('#nama_produk_edit').val(r.nama);
            $('#stok_produk_edit').val(r.stok_barang);
            $('#poin_edit').val(r.poin);
            $('#id_hadiah_edit').val(r.id_hadiah);
            // $('#image').val(r.image);
        }
    });
  }

  // function hapus hadiah
  function hapus_hadiah(id){
    swal.fire({
      text: "Apakah Anda Yakin Untuk Menghapus Produk Tersebut!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes"
      }).then((result) => {
        if (result.isConfirmed) {
          var key = "<?= $data['token_screetkey']; ?>";
          $.ajax({
            url: '<?= BASEURL; ?>Hadiah/hapus',
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
</script>
<!-- <div class="container mt-5">
  < ?php if ($_SESSION['data_disapu']['level']==1) { ?>
      <div class="row">
          <div class="col-12">
              <div class="card card-custom text-light" style="max-width: 1000px; background-color: #2d3748">
                  <div class="card-body card-body-custom ">
                      <p class="mb-1">< ?= $_SESSION['data_disapu']['nama'];?></p>
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title mb-0">Poin Anda : </h5>
                            <h1 class="card-text px-3 top-50 end-0 translate-middle-y">10</h1>                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  < ?php }else{?>
     Button trigger modal 
  <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#formModal">
    Tambah Produk
  </button>
  < ?php };?>

    </div> -->
    <div class="container mt-3">
      <div class="card mb-3" style="background-image: linear-gradient( 105.3deg,  rgba(30,39,107,1) 21.8%, rgba(77,118,221,1) 100.2% );color:white;">
        <div class="card-body text-center">
          <strong>MANAJEMEN HADIAH</strong>
        </div>
      </div>
      <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#formModal">
        <i class="bi bi-plus"></i> Produk
      </button>
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
      <div class="card shadow mt-2">
        <div class="card-header text-center">
          <B class="mb-0 fw-semibold">Daftar Produk</b>
        </div>
        <div class="card-body">
          <div class="row">
            <?php foreach($data['hadiah'] as $hadiah) :?>
              <div class="col-6 col-md-3 mb-2">
                <div class="card">
                  <img class="card-img-top" src="<?= $hadiah['image']; ?>" alt="Item 1" style="max-height:120px;"/>
                  <div class="card-body">
                    <center><b class="card-title"><?= $hadiah['nama']?></b></center>
                    <table class="table table-sm">
                      <tr>
                        <td>Harga</td>
                        <td>:</td>
                        <td><?= "Rp.".rupiah($hadiah['poin']); ?></td>
                      </tr>
                      <tr>
                        <td>Poin</td>
                        <td>:</td>
                        <td><?= round($hadiah['poin']/$data['kurs']['kurs'],2); ?></td>
                      </tr>
                      <tr>
                        <td>Stock</td>
                        <td>:</td>
                        <td><?= $hadiah['stok_barang']; ?></td>
                      </tr>
                    </table>
                    <a href="#" class="btn btn-warning mt-2 btn-sm" onclick="detail_edit('<?= $hadiah['id_hadiah']; ?>')" data-bs-toggle="modal" data-bs-target="#formModalEdit" data-id="<?= $hadiah['id_hadiah'];?>"><i class="bi bi-pencil-fill"></i> Edit</a>
                    <a href="#" class="btn btn-danger mt-2 btn-sm" onclick="hapus_hadiah('<?= $hadiah['id_hadiah']; ?>');"><i class="bi bi-trash-fill" ></i> Hapus</a>                        
                  </div>
                </div>
              </div>
            <?php endforeach;?>
            
          </div>
        </div>
      </div>
    </div>


<!-- Modal Edit -->
<div class="modal fade" id="formModalEdit" tabindex="-1" aria-labelledby="judulModalEdit" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="judulModalEdit">Edit Produk</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post" enctype="multipart/form-data" id="form_edit_hadiah">
        <div class="modal-body">
          <input type="hidden" name="token_edit" id="token_edit" value="<?= $data['token_screetkey']; ?>">
          <input type="hidden" name="id_hadiah_edit" id="id_hadiah_edit" >
          <div class="mb-3">
            <label for="nama_produk_edit" class="form-label">Nama Produk</label>
            <input type="text" class="form-control" id="nama_produk_edit" name="nama_produk_edit" placeholder="Contoh : Beras Premium">
          </div>

          <div class="mb-3">
            <label for="stok_produk_edit" class="form-label">Stok Produk</label>
            <input type="number" class="form-control" id="stok_produk_edit" name="stok_produk_edit" placeholder="Contoh : 5">
          </div>
          
          <div class="mb-3">
            <label for="poin_edit" class="form-label">Harga Satuan</label>
            <input type="number" class="form-control" id="poin_edit" name="poin_edit" placeholder="Contoh : 12000">
          </div>

          <div class="mb-3">
            <label for="foto_produk" class="form-label">image</label>
            <input type="file" class="form-control" id="image_edit" name="image_edit">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i> Batal</button>
          <button type="submit" name="update_produk" id="update_produk" class="btn btn-primary btn-sm"><i class="bi bi-plus"></i> Update Produk</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="judulModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="judulModalEdit">Tambah Produk</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" enctype="multipart/form-data" id="form_add_hadiah">
          <input type="hidden" name="inputtoken" id="inputtoken" value="<?= $data['token_screetkey']; ?>">
          <input type="hidden" name="id_hadiah" id="id_hadiah" >
          <div class="mb-3">
            <label for="nama_produk" class="form-label">Nama Produk</label>
            <input type="text" class="form-control" id="nama_produk" name="nama_produk" placeholder="Contoh : Beras Premium">
          </div>

          <div class="mb-3">
            <label for="stok_produk" class="form-label">Stok Produk</label>
            <input type="number" class="form-control" id="stok_produk" name="stok_produk" placeholder="Contoh : 5">
          </div>
          
          <div class="mb-3">
            <label for="poin" class="form-label">Harga Satuan</label>
            <input type="number" class="form-control" id="poin" name="poin" placeholder="Contoh : 12000">
          </div>

          <div class="mb-3">
            <label for="poin" class="form-label">image</label>
            <input type="file" class="form-control" id="image" name="image">
          </div>

      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i> Batal</button>
          <button type="submit" name="add_produk" id="add_produk" class="btn btn-primary btn-sm"><i class="bi bi-plus"></i> Tambah Produk</button>
        </form>
      </div>
    </div>
  </div>
</div>