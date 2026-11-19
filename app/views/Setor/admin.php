<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
  $(function(){
    $("#id_user").select2();

    $("#id_kategori").on("change",function(){
      var k = $("#id_kategori").val();
      var key = '<?= $data['token']; ?>';
      $.ajax({
          url : '<?= BASEURL; ?>Setor/sub_kategori',
          type : 'post',
          data : {key:key,k:k},
          success : function(r){
            $(".auto_sub_sampah").html(r);
          }
      });
    });

    $("#berat").on("keyup",function(){
      id_sampah = $("#id_sampah").val();
      var berat = $("#berat").val();
      var key = '<?= $data['token']; ?>';
      $.ajax({
          url : '<?= BASEURL; ?>Setor/poin_sampah',
          type : 'post',
          // dataType : 'json',
          data : {key:key,id_sampah:id_sampah,berat:berat},
          success : function(r){
            $(".result_timbang").html(r);
          }
      });
    });

    $("#form_setor_sampah").on("submit", function(e) {
      swal.fire({
        text: "Apakah Anda Yakin Untuk Memproses Setor Sampah!",
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
            var datanya = $("#form_setor_sampah").serialize();
            $.ajax({
              url: '<?= BASEURL; ?>Setor/proses_setor',
              type: 'post',
              dataType : 'json',
              data: datanya,
              success: function(r) {
                if(r.status=="Y"){
                  swal.fire({
                    icon: "success",
                    text: r.pesan,
                    timer: 2000,
                    showCancelButton: false,
                    showConfirmButton: false
                  })
                  document.getElementById("form_setor_sampah").reset();
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
    });
    
  });
  function test(){
    id_sampah = $("#id_sampah").val();
    var berat = $("#berat").val();
    var key = '<?= $data['token']; ?>';
    $.ajax({
        url : '<?= BASEURL; ?>Setor/poin_sampah',
        type : 'post',
        // dataType : 'json',
        data : {key:key,id_sampah:id_sampah,berat:berat},
        success : function(r){
          $(".result_timbang").html(r);
        }
    });
  }
  
</script>
<div class="container mt-2">
  <div class="info-box mt-2 mb-2">
    <span class="info-box-icon elevation-1"><img src="<?= BASEURL."assets/img/tombol/weighing-machine.png"; ?>"></span>
    <div class="info-box-content">
      <h5 class="info-box-number">Timbang Sampah</h5>
    </div>
    <a type="button" href="<?= BASEURL."Sampah"; ?>" class="btn btn-primary d-flex align-items-center">Manajemen Sampah</a>
  </div>
  <div class="card">
    <div class="card-body">
      <form class="form-horizontal" id="form_setor_sampah" onsubmit="return false">
        <div class="modal-body">
          <input type="hidden" name="token_setor_sampah" value="<?= $data['token']; ?>">
          <input type="hidden" name="kurs_poin" id="kurs_poin" value="<?= $data['kurs']['kurs']; ?>">
          <div class="form-group mb-2">
            <label for="id_user" class="form-label">Nasabah <span class="text-danger">*</span></label>
            <select id="id_user" name="id_user" class="form-control form-control-sm">
              <option value="pilih">Pilih</option>
              <?php foreach ($data['nasabah'] as $nasabah):?>
                  <option value="<?= $nasabah['id_user']; ?>"><?= "[".$nasabah['nik']."] ".strtoupper($nasabah['nama']); ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group mb-2">
            <label for="kategori" class="form-label">Kategori Sampah</label>
            <select id="id_kategori" name="id_kategori" class="form-control form-control-sm" required>
              <option value="pilih">Pilih</option>
              <?php foreach ($data['kategori_sampah'] as $kategori): ?>
                  <option value="<?= $kategori['id_kategori']; ?>"><?= strtoupper($kategori['kategori']); ?></option>
              <?php endforeach; ?>                                        
            </select>
          </div>
          <div class="form-group mb-2">
            <div class="auto_sub_sampah"></div>
          </div>
          <div class="form-group mb-2">
            <label for="berat" class="form-label">Berat Timbangan</label>
            <div class="input-group input-group-sm mb-3">
              <input type="number" name="berat" id="berat" class="form-control form-control-sm" placeholder="10" required>
              <span class="input-group-text text-sm">Kg</span>
            </div>
          </div>
          <div class="result_timbang"></div>
        </div>
        <div class="modal-footer">
          <button type="submit" id="proses" name="proses" class="btn btn-primary btn-sm"><i class="bi bi-check2-square"></i> Proses</button>
        </div>
      </form>
    </div>
  </div>
</div>