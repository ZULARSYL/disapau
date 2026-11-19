<script>
    $(function() {
        $("#form_data_user").on("submit", function(e) {
            var data_form = $("#form_data_user").serialize();
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
                    url: '<?= BASEURL; ?>Nasabah/tambahUser',
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
                            $('#ModalTambahUser').modal('toggle');
                            document.getElementById("form_data_user").reset();
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

        $("#form_edit_user").on("submit", function(e) {
            var data_form = $("#form_edit_user").serialize();
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
                    url: '<?= BASEURL; ?>Nasabah/updateUser',
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
                            $('#ModalEditUser').modal('toggle');
                            document.getElementById("form_edit_user").reset();
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

        $("#username").on("keyup", function() {
            var test = $("#username").val();
            console.log(test);
        });
    });

    //fungsi untuk ketika menampilkan detail user
    function detail_user(id){
        var key = "<?= $data['token']; ?>";
        $.ajax({
            url: '<?= BASEURL; ?>Nasabah/detail_user',
            type: 'post',
            data: {key:key,id:id},
            success: function(r) {
                $(".detail_user_byid").html(r);
            }
        });
    }

    //fungsi untuk mengisi form ketika edit user
    function edit_user(id){
        var key = "<?= $data['token']; ?>";
        $.ajax({
            url: '<?= BASEURL; ?>Nasabah/detail_user_edit',
            type: 'post',
            dataType : 'json',
            data: {key:key,id:id},
            success: function(r) {
                console.log(r);
                $("#id_user_edit").val(r.id_user);
                $("#nama_edit").val(r.nama);
                $("#nik_edit").val(r.nik);
                $("#jk_edit").val(r.jk);
                $("#rt_edit").val(r.rt);
                $("#rw_edit").val(r.rw);
                $("#dusun_edit").val(r.dusun);
                $("#kelurahan_edit").val(r.alamat);
                $("#notelp_edit").val(r.no_telp);
                $("#username_edit").val(r.username);
                $("#password_edit").val(r.password);
            }
        });
    }

    //fungsi untuk menghapus user
    function hapus_user(id){
        swal.fire({
            text: "Apakah Anda Yakin Untuk Menghapus User Tersebut!",
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
                    url: '<?= BASEURL; ?>Nasabah/hapus_user',
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
        <strong>MANAJEMEN NASABAH</strong>
        </div>
    </div>
    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#ModalTambahUser"><i class="bi bi-plus"></i> Nasabah</button>
    
    <div class="info-box mt-2 mb-2">
        <span class="info-box-icon bg-info elevation-1"><i class="bi bi-people"></i></span>
        <div class="info-box-content">
            <span class="info-box-text">Total Nasabah</span>
            <h3 class="info-box-number"><?= $data['jmlh_user']; ?></h3>
        </div>
        <div class="bg-dark text-right" style="color:white; margin:-.5rem; padding:0pt 10pt 0pt 10pt;">
            <div class="info-box-number mt-2">
                <small>Total Poin</small><br/>
                <h5><?= $data['total_poin']['poin']; ?></h5>
            </div>
        </div>
        <!-- /.info-box-content -->
    </div>
    
    <div class="card table-responsive">
        <div class="card-header">
            <b>Data Nasabah</b>
        </div>
        <div class="card-body">
            <table class="table table-sm mb-0">
                <tr>
                    <td>Laki-laki</td>
                    <td>:</td>
                    <td><b><?= $data['statistic']['l']; ?></b></td>
                </tr>
                <tr>
                    <td>Perempuan</td>
                    <td>:</td>
                    <td><b><?= $data['statistic']['p']; ?></b></td>
                </tr>
            </table>
            <table class="table table-striped table-hover" id="defaultdtables">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th class="text-center">Poin</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['nasabah'] as $nsbh) : ?>
                        <tr>
                            <td><?= $nsbh['nama']; ?></i></td>
                            <td class="text-center"><?= $nsbh['poin_now']; ?></td>
                            <td><a href="#" onclick="detail_user('<?= $nsbh['id_user']; ?>')" data-bs-toggle="modal" data-bs-target="#ModalDetailUser"><i class="bi bi-eye text-info"></i></a> | <a href="#" onclick="edit_user('<?= $nsbh['id_user']; ?>')" data-bs-toggle="modal" data-bs-target="#ModalEditUser"><i class="bi bi-pencil-square text-warning"></i></a> | <a href="#" onclick="hapus_user('<?= $nsbh['id_user']; ?>');" ><i class="bi bi-trash text-danger"></i></a></td>
                        </tr>
                    <?php endforeach; ?>
                    <!-- Repeat for other products -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Untuk Menampilkan Detail Dari User -->
<div class="modal fade" id="ModalDetailUser" tabindex="-1" aria-labelledby="labelModalDetailUser" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Detail User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="detail_user_byid"></div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Untuk Tambah Nasabah -->
<div class="modal fade" id="ModalTambahUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form-horizontal" id="form_data_user" onsubmit="return false">
                <div class="modal-body">
                    <input type="hidden" name="token_tambahUser" value="<?= $data['token']; ?>">
                    <input type="hidden" name="id_user" value="<?= uniqid(); ?>">
                    <div class="mb-2">
                        <label for="username" class="form-label">USERNAME <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm" id="username" name="username" placeholder="Contoh : andilmj" required>
                    </div>
                    <div class="mb-2">
                        <label for="username" class="form-label">PASSWORD <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm" id="password" name="password" placeholder="Contoh : andi-123" required>
                    </div>
                    <hr>

                    <div class="mb-2">
                        <label for="nik" class="form-label">NIK <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm" id="nik" name="nik" placeholder="Contoh : 3508994949595" required>
                    </div>
                    <div class="mb-2">
                        <label for="nama" class="form-label">NAMA <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm" id="nama" name="nama" placeholder="Contoh : Sony Setiawan" required>
                    </div>
                    <div class="mb-2">
                        <label for="jk" class="form-label">Jenis Kelamin</label>
                        <select class="form-control form-control-sm" id="jk" name="jk">
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="input-group input-group-sm flex-nowrap mb-2">
                        <span class="input-group-text text-sm" id="addon-wrapping">RT</span>
                        <input type="text" class="form-control form-control-sm" id="rt" name="rt">
                        <span class="input-group-text text-sm" id="addon-wrapping">RW</span>
                        <input type="text" class="form-control form-control-sm" id="rw" name="rw">
                    </div>
                    <div class="mb-2">
                        <label for="dusun" class="form-label">Dusun</label>
                        <input type="text" class="form-control form-control-sm" id="dusun" name="dusun" placeholder="Contoh : Krajan">
                    </div>
                    <div class="mb-2">
                        <label for="kelurahan" class="form-label">Desa</label>
                        <input type="text" class="form-control form-control-sm" id="kelurahan" name="kelurahan" placeholder="Contoh : Purworejo">
                    </div>
                    <div class="mb-2">
                        <label for="kelurahan" class="form-label">No.Telpn</label>
                        <input type="text" class="form-control form-control-sm" id="notelp" name="notelp" placeholder="Contoh : Purworejo">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i> Batal</button>
                    <button type="submit" id="simpan_user" name="simpan_user" class="btn btn-primary"><i class="bi bi-check2-square"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal untuk Edit Nasabah -->
<div class="modal fade" id="ModalEditUser" tabindex="-1" aria-labelledby="labelModalEditUser" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="labelModalEditUser">Edit User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form-horizontal" id="form_edit_user" onsubmit="return false">
                <div class="modal-body">
                    <input type="hidden" name="token_edit_user" value="<?= $data['token']; ?>">
                    <input type="hidden" name="id_user_edit" id="id_user_edit" value="<?= $data['token']; ?>">
                    <div class="mb-2">
                        <label for="username_edit" class="form-label">USERNAME <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm" id="username_edit" name="username_edit" placeholder="Contoh : andilmj" required>
                    </div>
                    <div class="mb-2">
                        <label for="password_edit" class="form-label">PASSWORD <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm" id="password_edit" name="password_edit" placeholder="Contoh : andi-123" required>
                    </div>
                    <hr>

                    <div class="mb-2">
                        <label for="nik_edit" class="form-label">NIK <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm" id="nik_edit" name="nik_edit" placeholder="Contoh : 3508994949595" required>
                    </div>
                    <div class="mb-2">
                        <label for="nama_edit" class="form-label">NAMA <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm" id="nama_edit" name="nama_edit" placeholder="Contoh : Sony Setiawan" required>
                    </div>
                    <div class="mb-2">
                        <label for="jk_edit" class="form-label">Jenis Kelamin</label>
                        <select class="form-control form-control-sm" id="jk_edit" name="jk_edit">
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="input-group input-group-sm flex-nowrap">
                        <span class="input-group-text text-sm" id="addon-wrapping">RT</span>
                        <input type="text" class="form-control form-control-sm" id="rt_edit" name="rt_edit">
                        <span class="input-group-text text-sm" id="addon-wrapping">RW</span>
                        <input type="text" class="form-control form-control-sm" id="rw_edit" name="rw_edit">
                    </div>
                    <div class="mb-2">
                        <label for="dusun_edit" class="form-label">Dusun</label>
                        <input type="text" class="form-control form-control-sm" id="dusun_edit" name="dusun_edit" placeholder="Contoh : Krajan">
                    </div>
                    <div class="mb-2">
                        <label for="kelurahan_edit" class="form-label">Desa</label>
                        <input type="text" class="form-control form-control-sm" id="kelurahan_edit" name="kelurahan_edit" placeholder="Contoh : Purworejo">
                    </div>
                    <div class="mb-2">
                        <label for="notelp_edit" class="form-label">No.Telpn</label>
                        <input type="text" class="form-control form-control-sm" id="notelp_edit" name="notelp_edit" placeholder="Contoh : Purworejo">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i> Batal</button>
                    <button type="submit" id="update_user" name="update_user" class="btn btn-primary"><i class="bi bi-check2-square"></i> Update</button>
                </div>
            </form>
        </div>
    </div>
</div>