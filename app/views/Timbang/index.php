<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(function(){
        $("#kategori_sampah").select2();
        $("#id_user").select2();
        $("#kategori_sampah").on("change",function(){
            var k = $("#kategori_sampah").val();
            var key = '<?= $data['token_screetkey']; ?>';
            $.ajax({
                url : '<?= BASEURL; ?>Timbang/sub_kategori',
                type : 'post',
                data : {key:key,k:k},
                success : function(r){
                    console.log(r);
                $(".auto_sub_sampah").html(r);
                }
            });
        });
    });
</script>
<div class="container mt-2">
<?php flasher::flash(); ?>
    <!-- <h1 class="text-center">Timbang</h1> -->
    <div class="card bg-white shadow">
  <div class="card-header">
    Timbang Sampah
  </div>
  <div class="card-body">
    <form action="<?= BASEURL; ?>Timbang/tambah" method="post">
                   
            <div class="form-group">
                <!-- <label for="userId">Masukkan ID User</label>
                <input type="text" class="form-control" id="userId" placeholder="Masukkan ID User"> -->
                <select id="id_user" name="id_user" class="form-control">
                        <?php foreach ($data['nasabah'] as $nasabah):?>
                            <option value="<?= $nasabah['id_user']; ?>"><?= "[".$nasabah['nik']."] ".strtoupper($nasabah['nama']); ?></option>
                        <?php endforeach; ?>
                </select>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="weight">Berat</label>
                    <div class="stepper">
                        <input type="number" id="stepperInput" class="form-control" value="0">
                    </div>                    
                </div>
                
                <div class="form-group col-md-4">
                    <label for="material">Material</label>
                    <select id="material" class="form-control">
                        <option selected>Pilih Material</option>
                        <?php foreach ($data['kategori_sampah'] as $kategori): ?>
                                            <option value="<?= $kategori['id_kategori']; ?>">
                                                <?= strtoupper($kategori['kategori']); ?>
                                            </option>
                        <?php endforeach; ?>                                        
                    </select>
                </div>
                
                <div class="form-group col-md-4">
                    <label for="subMaterial">Sub Material</label>
                    <select id="subMaterial" class="form-control">
                        <option selected>Pilih Sub Material</option>
                        <?php foreach ($data['sampah'] as $klasifikasi): ?>
                                            <option value="<?= $klasifikasi['id_sampah']; ?>">
                                                <?= strtoupper($kategori['sampah']); ?>
                                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </form>
    </div>
    </div>

        <div class="mt-4">
            <h4>Detail Transaksi</h4>
            <div class="border p-3">
               
                <button type="submit" class="btn btn-secondary btn-block">Cetak</button>
            </div>
        </div>
    </div>