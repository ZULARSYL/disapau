<div class="container mt-2">
  <div class="card bg-white shadow">
    <div class="card-header">
      Harga Sampah
    </div>

    <?php foreach($data['sub_jenis'] as $smph) :?>
    <div class="col-sm-6 mb-3 mb-sm-0">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"><?=$smph['nama_klasifikasi'];?></h5>
          <p class="card-text">
            poin : <?=$smph['poin'];?>
          </p>
        </div>
      </div>
    </div>

    <?php endforeach;?>

  </div>
</div>