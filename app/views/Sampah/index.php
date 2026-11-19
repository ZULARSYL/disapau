<script>
  $(function(){

    $('#tableserverside').DataTable({
      "bPaginate": true,
      "bLengthChange": false,
      "bFilter": true,
      "bInfo": false,
      "bAutoWidth": true,
      "processing": true,
      "serverSide": true,
      "ajax":{
              "url": "<?= BASEURL; ?>Sampah/serverside_sampah/<?= $data['token']; ?>",
              "dataType": "json",
              "type": "POST"
            }

    });

    $("#form_add_kategori").on("submit", function(e) {
      var data_form = $("#form_add_kategori").serialize();
      // console.log(data_form);
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
          url: '<?= BASEURL; ?>Sampah/simpan_kategori',
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
              $('#ModalKategoriSampah').modal('toggle');
              document.getElementById("form_add_kategori").reset();
              setTimeout(function(){ location.reload(); }, 1500);
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

    $("#form_edit_kategori").on("submit", function(e) {
      var data_form = $("#form_edit_kategori").serialize();
      // console.log(data_form);
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
          url: '<?= BASEURL; ?>Sampah/update_kategori',
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
              $('#ModalEditKategoriSampah').modal('toggle');
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

    $("#form_add_sampah").on("submit", function(e) {
      e.preventDefault();
      var data_form = new FormData(this);
      console.log(data_form);
      $.ajax({
        url: '<?= BASEURL; ?>Sampah/simpan_sampah',
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
            $('#ModalJenisSampah').modal('toggle');
            document.getElementById("form_add_sampah").reset();
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

    $("#form_edit_sampah").on("submit", function(e) {
      e.preventDefault();
      var data_form = new FormData(this);
      $.ajax({
        url: '<?= BASEURL; ?>Sampah/update_sampah',
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
            $('#modal_edit_sampah').modal('toggle');
            document.getElementById("form_edit_sampah").reset();
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

  function detail_kategori(id){
        var key = "<?= $data['token']; ?>";
        $.ajax({
            url: '<?= BASEURL; ?>Sampah/detail_kategori',
            type: 'post',
            data: {key:key,id:id},
            success: function(r) {
                $(".detail_kategori_byid").html(r);
            }
        });
    }

  function edit_kategori(id){
    var key = "<?= $data['token']; ?>";
    $.ajax({
        url: '<?= BASEURL; ?>Sampah/get_kategori',
        type: 'post',
        dataType : 'json',
        data: {key:key,id:id},
        success: function(r) {
            console.log(r);
            $("#id_kategori_edit").val(r.id_kategori);
            $("#kategori_edit").val(r.kategori);
            $("#deskripsi_edit").val(r.deskripsi);
        }
    });
  }

  function hapus_kategori(id){
    swal.fire({
      text: "Apakah Anda Yakin Untuk Menghapus Kategori Tersebut!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes",
      cancelButtonText: "No",
      closeOnConfirm: false,
      closeOnCancel: false
    }).then((result) => {
      if (result.isConfirmed) {
        var key = "<?= $data['token']; ?>";
        $.ajax({
          url: '<?= BASEURL; ?>Sampah/hapus_kategori',
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

  function edit_sampah(id){
    var key="<?= $data['token']; ?>";
    $.ajax({
      url: '<?= BASEURL; ?>Sampah/detail_sampah',
      type: 'post',
      dataType : 'json',
      data: {key:key,id:id},
      success: function(r) {
        console.log(r);
        $("#id_sampah").val(r.id_sampah);
        $("#nama_sampah_edit").val(r.nama_klasifikasi);
        $("#pilih_kategori_edit").val(r.id_kategori);
        $("#harga_beli_edit").val(r.harga_beli);
        $("#harga_jual_edit").val(r.harga_jual);
      } 
    });
    $("#modal_edit_sampah").modal('show');
  }

  function detail_sampah(id){
    var key="<?= $data['token']; ?>";
    $.ajax({
      url: '<?= BASEURL; ?>Sampah/detail_sampah',
      type: 'post',
      dataType : 'json',
      data: {key:key,id:id},
      success: function(r) {
        $("#rd_nama").html(r.nama_klasifikasi);
        $("#rd_kategori").html(r.kategori);
        $("#rd_harga_beli").html(r.harga_beli);
        $("#rd_harga_jual").html(r.harga_jual);
        $("#rd_satuan").html("Per/"+r.satuan_berat);
        $("#gambar_sampah").html("<img src='<?= BASEURL."assets/img/sampah/"; ?>"+r.nama_file+"' class='img-thumbnail rounded mx-auto d-block' alt=''>");
      } 
    });
    $("#modal_detail_sampah").modal('show');
  }

  function hapus_sampah(id){
    swal.fire({
      text: "Apakah Anda Yakin Untuk Menghapus Jenis Sampah Tersebut!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes",
      cancelButtonText: "No",
      closeOnConfirm: false,
      closeOnCancel: false
    }).then((result) => {
      if (result.isConfirmed) {
        var key = "<?= $data['token']; ?>";
        $.ajax({
          url: '<?= BASEURL; ?>Sampah/hapus_sampah',
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
<div class="container mt-2">
  <div class="card mb-3" style="background-image: linear-gradient( 105.3deg,  rgba(30,39,107,1) 21.8%, rgba(77,118,221,1) 100.2% );color:white;">
    <div class="card-body text-center">
      <strong>MANAJEMEN SAMPAH</strong>
    </div>
  </div>
  <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#ModalKategoriSampah"><i class="bi bi-plus"></i> Kategori</button>
  <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#ModalJenisSampah"><i class="bi bi-plus"></i> Sampah</button>
  <div class="info-box mt-2 mb-0">
    <span class="info-box-icon elevation-1"><img src="<?= BASEURL."assets/img/tombol/waste-bin.png";?>"></span>
    <div class="info-box-content">
      <span class="info-box-text">Kategori</span>
      <h3 class="info-box-number"><?= count($data['jenis']); ?></h3>
    </div>
    <div class="d-flex" style="padding:5px 10px 5px 10px;">
      <div class="vr"></div>
    </div>
    <span class="info-box-icon elevation-1"><img src="<?= BASEURL."assets/img/tombol/garbage.png";?>"></span>
    <div class="info-box-content">
        <span class="info-box-text">Jenis Sampah</span>
        <h3 class="info-box-number"><?= $data['total_sampah']; ?></h3>
    </div><!-- /.info-box-content -->
  </div>
  <div class="info-box mb-2">
      <span class="info-box-icon elevation-1"><img src="<?= BASEURL."assets/img/tombol/conversion-rate.png";?>"></span>
      <div class="info-box-content">
        <span class="info-box-text">Nilai Tukar Poin</span>
        <h3 class="info-box-number">1:<?= rupiah($data['nilai_tukar']['kurs']); ?></h3>
      </div>
      <div class="d-flex" style="padding:5px 10px 5px 10px;">
        <div class="vr"></div>
      </div>
      <span class="info-box-icon elevation-1"><img src="<?= BASEURL."assets/img/tombol/asset.png";?>"></span>
      <div class="info-box-content">
          <span class="info-box-text">Nilai Sampah</span>
          <h3 class="info-box-number"></h3>
      </div><!-- /.info-box-content -->
  </div>

  <!-- DATA TABLES UNTUK KATEGORI -->
  <div class="card table-responsive">
    <div class="card-header">
        <b>Data Kategori</b>
    </div>
    <div class="card-body">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Nama Kategori</th>
                    <th class="text-center">Sub Sampah</th>
                    <th class="text-end">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; 
                    foreach ($data['jenis'] as $smph) : ?>
                    <tr>
                        <td><?= ucfirst($smph['kategori']); ?></i></td>
                        <td class="text-center"><?= $smph['total_sub']; ?></td>
                        <td class="text-end">
                          <a href="#" onclick="detail_kategori('<?= $smph['id_kategori']; ?>')" data-bs-toggle="modal" data-bs-target="#ModalDetailKategori"><i class="bi bi-eye text-info"></i></a> | 
                          <a href="#" onclick="edit_kategori('<?= $smph['id_kategori']; ?>')" data-bs-toggle="modal" data-bs-target="#ModalEditKategoriSampah" style="text-decoration:none;"><i class="bi bi-pencil-square text-warning"></i></a> | 
                          <a href="#" onclick="hapus_kategori('<?= $smph['id_kategori']; ?>');" style="text-decoration:none;"><i class="bi bi-trash text-danger"></i></a></td>
                    </tr>
                <?php endforeach; ?>
                <!-- Repeat for other products -->
            </tbody>
        </table>
    </div>
  </div>
  <!-- DATA TABLES UNTUK JENIS SAMPAH -->
  <div class="card table-responsive mt-4">
    <div class="card-header">
        <b>Data Jenis Sampah</b>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-striped table-sm" id="tableserverside">
          <thead class="thead-dark">
              <th>Gambar</th>
              <th>Nama</th>
              <th>Action</th>
          </thead>
          <tbody></tbody>
        </table>
      </div> 
    </div>
  </div>
</div>

<!-- MODAL FOR KATEGORI -->
  <!-- MODAL DETAIL KATEGORI SAMPAH -->
  <div class="modal fade" id="ModalDetailKategori" tabindex="-1" aria-labelledby="labelModalDetailKategori" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="labelModalDetailKategori">Detail Kategori</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="detail_kategori_byid"></div>
        </div>          
      </div>
    </div>
  </div>

  <!-- MODAL TAMBAH KATEGORI SAMPAH -->
  <div class="modal fade" id="ModalKategoriSampah" tabindex="-1" aria-labelledby="labelModalKategoriSampah" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="labelModalKategoriSampah">Tambah Kategori</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form class="form-horizontal" id="form_add_kategori" onsubmit="return false">
          <div class="modal-body">
            <input type="hidden" name="token_add_kategori" value="<?= $data['token']; ?>">
            <div class="mb-2">
              <label for="kategori" class="form-label">Nama Kategori <span class="text-danger">*</span></label>
              <input type="text" class="form-control form-control-sm" id="kategori" name="kategori" placeholder="Contoh : Plastik" required>
            </div>
            <div class="mb-2">
              <label for="deskripsi" class="form-label">Deskripsi</label>
              <textarea class="form-control form-control-sm" id="deskripsi" name="deskripsi" placeholder="Contoh : Sampah yang berbahan dasar plastik" ></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i> Batal</button>
            <button type="submit" id="simpan_kategori" name="simpan_kategori" class="btn btn-primary btn-sm"><i class="bi bi-check2-square"></i> Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- MODAL EDIT KATEGORI SAMPAH -->
  <div class="modal fade" id="ModalEditKategoriSampah" tabindex="-1" aria-labelledby="labelModalEditKategoriSampah" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="labelModalEditKategoriSampah">Edit Kategori</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form class="form-horizontal" id="form_edit_kategori" onsubmit="return false">
          <div class="modal-body">
            <input type="hidden" name="token_edit_kategori" value="<?= $data['token']; ?>">
            <input type="hidden" name="id_kategori_edit" id="id_kategori_edit">
            <div class="mb-2">
              <label for="kategori_edit" class="form-label">Nama Kategori <span class="text-danger">*</span></label>
              <input type="text" class="form-control form-control-sm" id="kategori_edit" name="kategori_edit" placeholder="Contoh : Plastik" required>
            </div>
            <div class="mb-2">
              <label for="deskripsi_edit" class="form-label">Deskripsi</label>
              <textarea class="form-control form-control-sm" id="deskripsi_edit" name="deskripsi_edit" placeholder="Contoh : Sampah yang berbahan dasar plastik" ></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i> Batal</button>
            <button type="submit" id="update_kategori" name="update_kategori" class="btn btn-primary btn-sm"><i class="bi bi-check2-square"></i> Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<!-- END MODAL FOR KATEGORI -->

<!-- MODAL SAMPAH -->
  <!-- MODAL DETAIL SAMPAH -->
  <div class="modal fade" id="modal_detail_sampah" tabindex="-1" aria-labelledby="labelmodal_detail_sampah" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="labelmodal_detail_sampah">Detail Sampah</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <table class="table">
            <tr>
              <td>Nama</td><td>:</td><td><div id="rd_nama" style="text-transform: uppercase;"></div></td>
            </tr>
            <tr>
              <td>Kategori</td><td>:</td><td><div id="rd_kategori" style="text-transform: uppercase;"></div></td>
            </tr>
            <tr>
              <td>Beli</td><td>:</td><td><div id="rd_harga_beli" style="text-transform: uppercase;"></div></td>
            </tr>
            <tr>
              <td>Jual</td><td>:</td><td><div id="rd_harga_jual" style="text-transform: uppercase;"></div></td>
            </tr>
            <tr>
              <td>Satuan</td><td>:</td><td><div id="rd_satuan" style="text-transform: uppercase;"></div></td>
            </tr>
          </table>
          <div id="gambar_sampah"></div>
        </div>
      </div>
    </div>
  </div>
  <!-- MODAL ADD SAMPAH -->
  <div class="modal fade" id="ModalJenisSampah" tabindex="-1" aria-labelledby="labelModalJenisSampah" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="labelModalJenisSampah">Tambah Sampah</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form class="form-horizontal" id="form_add_sampah" enctype="multipart/form-data" onsubmit="return false">
          <div class="modal-body">
            <input type="hidden" name="token_add_sampah" value="<?= $data['token']; ?>">
            <div class="mb-2">
              <label for="kategori" class="form-label">Kategori Sampah <span class="text-danger">*</span></label>
              <select class="form-control form-control-sm" id="pilih_kategori" name="pilih_kategori">
                <option value="pilih">Pilih</option>
                <?php foreach ($data['jenis'] as $k) {
                  echo "<option value='".$k['id_kategori']."'>".ucfirst($k['kategori'])."</option>";
                } ?>
              </select>
            </div>
            <div class="mb-2">
              <label for="nama_sampah" class="form-label">Klasifikasi Sampah <span class="text-danger">*</span></label>
              <input type="text" class="form-control form-control-sm" id="nama_sampah" name="nama_sampah" placeholder="Contoh : Koran, Buku Bekas, Dsb" >
            </div>
            <div class="mb-2">
              <label for="harga_beli" class="form-label">Harga Beli <span class="text-danger">*</span></label>
              <input type="text" class="form-control form-control-sm" id="harga_beli" name="harga_beli" placeholder="Contoh : 10000" >
            </div>
            <div class="mb-2">
              <label for="harga_jual" class="form-label">Harga Jual <span class="text-danger">*</span></label>
              <input type="text" class="form-control form-control-sm" id="harga_jual" name="harga_jual" placeholder="Contoh : 13000" >
            </div>
            <div class="mb-2">
              <label for="satuan_beli" class="form-label">Satuan</label>
              <select class="form-control form-control-sm" id="satuan_beli" name="satuan_beli">
                <option value="kg">Kg (Kilo Gram)</option>
              </select>
            </div>
            <div class="mb-2">
              <label for="nama_file" class="form-label">File</label>
              <input type="file" class="form-control form-control-sm" id="nama_file" name="nama_file">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i> Batal</button>
            <button type="submit" id="simpan_sampah" name="simpan_sampah" class="btn btn-primary btn-sm"><i class="bi bi-check2-square"></i> Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- MODAL EDIT SAMPAH -->
  <div class="modal fade" id="modal_edit_sampah" tabindex="-1" aria-labelledby="labelmodal_edit_sampah" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="labelmodal_edit_sampah">Edit Sampah</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form class="form-horizontal" id="form_edit_sampah" enctype="multipart/form-data" onsubmit="return false">
          <div class="modal-body">
            <input type="hidden" name="token_edit_sampah" value="<?= $data['token']; ?>">
            <input type="hidden" name="id_sampah" id="id_sampah">
            <div class="mb-2">
              <label for="pilih_kategori_edit" class="form-label">Kategori Sampah <span class="text-danger">*</span></label>
              <select class="form-control form-control-sm" id="pilih_kategori_edit" name="pilih_kategori_edit">
                <option value="pilih">Pilih</option>
                <?php foreach ($data['jenis'] as $k) {
                  echo "<option value='".$k['id_kategori']."'>".ucfirst($k['kategori'])."</option>";
                } ?>
              </select>
            </div>
            <div class="mb-2">
              <label for="nama_sampah_edit" class="form-label">Klasifikasi Sampah <span class="text-danger">*</span></label>
              <input type="text" class="form-control form-control-sm" id="nama_sampah_edit" name="nama_sampah_edit" placeholder="Contoh : Koran, Buku Bekas, Dsb" >
            </div>
            <div class="mb-2">
              <label for="harga_beli_edit" class="form-label">Harga Beli <span class="text-danger">*</span></label>
              <input type="text" class="form-control form-control-sm" id="harga_beli_edit" name="harga_beli_edit" placeholder="Contoh : 10000" >
            </div>
            <div class="mb-2">
              <label for="harga_jual_edit" class="form-label">Harga Jual <span class="text-danger">*</span></label>
              <input type="text" class="form-control form-control-sm" id="harga_jual_edit" name="harga_jual_edit" placeholder="Contoh : 13000" >
            </div>
            <div class="mb-2">
              <label for="satuan_beli_edit" class="form-label">Satuan</label>
              <select class="form-control form-control-sm" id="satuan_beli_edit" name="satuan_beli_edit">
                <option value="kg">Kg (Kilo Gram)</option>
              </select>
            </div>
            <div class="mb-2">
              <label for="nama_file_edit" class="form-label">File</label>
              <input type="file" class="form-control form-control-sm" id="nama_file_edit" name="nama_file_edit">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i> Batal</button>
            <button type="submit" id="update_sampah" name="update_sampah" class="btn btn-primary btn-sm"><i class="bi bi-check2-square"></i> Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>

<!-- MODAL END SAMPAH -->