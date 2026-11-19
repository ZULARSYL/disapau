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
              "url": "<?= BASEURL; ?>Setor/serverside_sampah/<?= $data['token']; ?>",
              "dataType": "json",
              "type": "POST"
            }

    });
  });
</script>
<div class="container mt-2">
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
  <!-- DATA TABLES UNTUK JENIS SAMPAH -->
  <div class="card table-responsive mt-4">
    <div class="card-header">
        <b>Daftar Jenis Sampah</b>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-striped table-sm" id="tableserverside">
          <thead class="thead-dark">
              <th>Gambar</th>
              <th>Jenis Sampah</th>
          </thead>
          <tbody></tbody>
        </table>
      </div> 
    </div>
  </div>
</div>