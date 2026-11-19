<?php
class Sampah extends Controller{
    public function index(){
        $data['judul'] = "Sampah";
        $data['token'] =  hash_hmac('sha256', KUNCITOKEN, $_SESSION['crfs']);
        $data['sampah'] = $this->model('Sampah_model')->getSubkategori();
        $data['nilai_tukar'] = $this->model("Sampah_model")->nilai_tukar();
        $kategori = $this->model('Sampah_model')->getKategori();
        $arr_kategori = array();
        $t_sampah = 0;
        foreach ($kategori as $k) {
            $t_s = $this->model("Sampah_model")->check_sub_kategori($k['id_kategori']);
            $t_sampah += $t_s;
            array_push($arr_kategori,array("id_kategori"=>$k['id_kategori'],"kategori"=>$k['kategori'],"deskripsi"=>$k['deskripsi'],"total_sub"=>$t_s));
        }
        
        $data['jenis'] = $arr_kategori;
        $data['total_sampah'] = $t_sampah;
        
        $this->view('templates/header', $data);
        $this->view('sampah/index', $data);
        $this->view('templates/footer');
    }

    public function serverside_sampah($key){
        $token = hash_hmac('sha256', KUNCITOKEN, $_SESSION['crfs']);
        if(hash_equals($token, $key)){
          $requestData= $_POST;
          $columns = array( 
            0 => 's.nama_klasifikasi', 
            1 => 'k.nama_klasifikasi',
            2 => 's.kategori'
          );
          $sql = "SELECT s.*, k.kategori FROM sampah s, kategori_sampah k WHERE k.id_kategori = s.id_kategori and 1=1 ";
          //$order = "order by STR_TO_DATE(tgl_nota,'%Y-%m-%d') DESC, id_transaksi DESC";
          $t = $this->model("m_serverside")->record_data($sql);
          $totalData = count($t);
          $totalFiltered = $totalData;
          
          if( !empty($requestData['search']['value']) ) {
            //----------------------------------------------------------------------------------
            $sql.=" AND ( s.nama_klasifikasi LIKE '%".$requestData['search']['value']."%' ";    
            $sql.=" OR s.id_sampah LIKE '%".$requestData['search']['value']."%' ";
            $sql.=" OR s.harga_beli LIKE '%".$requestData['search']['value']."%' ";
            $sql.=" OR s.harga_jual LIKE '%".$requestData['search']['value']."%' ";
            $sql.=" OR k.kategori LIKE '%".$requestData['search']['value']."%' )";
          }
  
          $t = $this->model("m_serverside")->record_data($sql);
          $totalFiltered = count($t);
          $order = "";
          if(!empty($requestData['order'][0]['column'])){
            $order.=" order by ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";	
          }else{
            $order.=" order by k.kategori DESC ,". $columns[$requestData['order'][0]['column']]." ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']." ";
          }
  
          $t = $this->model("m_serverside")->record_data($sql.$order);
  
          $data = array();
          $no =1;
          foreach ($t as $v) {
            $no++;
            $t_action = "";
            //action detail
            $t_action .= "<a href='javascript:void(0);' data-toggle='modal' data-target='#modal_detail_sampah' onclick='detail_sampah(@".$v['id_sampah']."@);'><i class='bi bi-eye text-info'></i></a> | ";
            //action edit
            $t_action .= "<a href='javascript:void(0);' data-toggle='modal' data-target='#modal_edit_sampah' onclick='edit_sampah(@".$v['id_sampah']."@);'><i class='bi bi-pencil-square text-warning'></i></a> | ";
            //action delete
            $t_action .= "<a href='javascript:void(0);' onclick='hapus_sampah(@".$v['id_sampah']."@);'><i class='bi bi-trash text-danger'></i></a>";
            
            $t_action = str_replace("'", '"', $t_action);
            $t_action = str_replace("@", "'", $t_action);
  
            $nestedData=array(); 
            $nestedData[] = "<img src='".BASEURL."assets/img/sampah/".$v['nama_file']."' class='img-thumbnail rounded mx-auto d-block' alt=''>";
            $nestedData[] = $v['nama_klasifikasi'];
            $nestedData[] = $t_action;
            $data[] = $nestedData;
          }
          //----------------------------------------------------------------------------------
          $json_data = array(
            "draw"            => intval( $requestData['draw'] ),  
            "recordsTotal"    => intval( $totalData ), 
            "recordsFiltered" => intval( $totalFiltered ), 
            "data"            => $data );
          //----------------------------------------------------------------------------------
          echo json_encode($json_data);
        }
    }

    public function subSampah($id){
        $data['judul'] = "Sampah";
        $data['sub_jenis'] = $this->model('Sampah_model')->getSubkategori($id);
        $this->view('templates/header', $data);
        $this->view('sampah/subSampah', $data);
        $this->view('templates/footer');
    }

    public function get_kategori(){
        $token = hash_hmac('sha256', KUNCITOKEN, $_SESSION['crfs']);
        if(hash_equals($_POST['key'],$token)){
            echo json_encode($this->model("Sampah_model")->detail_kategori($_POST['id']));
        }
    }

    public function detail_kategori(){
        $token = hash_hmac('sha256', KUNCITOKEN, $_SESSION['crfs']);
        if(hash_equals($_POST['key'],$token)){
            $data = $this->model("Sampah_model")->detail_kategori($_POST['id']);
            $t_s = $this->model("Sampah_model")->check_sub_kategori($_POST['id']);
            echo "<table class='table table-sm table-striped'>
                        <tr><td>Nama Kategori</td><td>:</td><td>".ucfirst($data['kategori'])."</td></tr>
                        <tr><td>Deskripsi</td><td>:</td><td>".$data['deskripsi']."</td></tr>
                        <tr><td>Total Sub</td><td>:</td><td>".$t_s."</td></tr>
                    </table>";
        }
    }

    public function simpan_kategori(){
        $token = hash_hmac('sha256', KUNCITOKEN, $_SESSION['crfs']);
        if(hash_equals($_POST['token_add_kategori'],$token)){
            if(!empty($_POST['kategori']) && !empty($_POST['token_add_kategori'])){
                if($this->model("Sampah_model")->simpan_kategori($_POST)>0){
                    echo json_encode(array("status"=>"Y","pesan"=>"Data Tersimpan."));
                }else{
                    echo json_encode(array("status"=>"N","pesan"=>"Gagal Tersimpan!"));
                }
            }else{
                echo json_encode(array("status"=>"W","pesan"=>"Pastikan Semua Data Terisi"));
            }
        }
    }

    public function update_kategori(){
        $token = hash_hmac('sha256', KUNCITOKEN, $_SESSION['crfs']);
        if(hash_equals($_POST['token_edit_kategori'],$token)){
            if(!empty($_POST['kategori_edit']) && !empty($_POST['token_edit_kategori'])){
                if($this->model("Sampah_model")->update_kategori($_POST)>0){
                    echo json_encode(array("status"=>"Y","pesan"=>"Data Terupdate."));
                }else{
                    echo json_encode(array("status"=>"N","pesan"=>"Gagal Terupdate!"));
                }
            }else{
                echo json_encode(array("status"=>"W","pesan"=>"Pastikan Semua Data Terisi"));
            }
        }
    }

    public function hapus_kategori(){
        $token = hash_hmac('sha256', KUNCITOKEN, $_SESSION['crfs']);
        if(hash_equals($_POST['key'],$token)){
            if($this->model("Sampah_model")->check_sub_kategori($_POST['id'])>0){
                echo json_encode(array("status"=>"W","pesan"=>"Data Kategori Memiliki Sub Sampah!"));
            }else{
                if($this->model("Sampah_model")->hapus_kategori($_POST['id'])>0){
                    echo json_encode(array("status"=>"Y","pesan"=>"Data Terhapus."));
                }else{
                    echo json_encode(array("status"=>"N","pesan"=>"Gagal Terhapus!"));
                }
            }
        }
    }

    public function simpan_sampah(){
        $token = hash_hmac('sha256', KUNCITOKEN, $_SESSION['crfs']);
        if(hash_equals($_POST['token_add_sampah'],$token)){
            if(!empty($_POST['token_add_sampah']) && !empty($_POST['nama_sampah']) && $_POST['pilih_kategori']!='pilih' && !empty($_POST['harga_beli']) && !empty($_POST['harga_jual'])){
                $pesan = "";
                $upload_gambar = 1;
                $id_gambar = uniqid();
                $rename_file = "";
                if(isset($_FILES['nama_file']) && !empty($_FILES['nama_file']['name'])){
                    $target_dir = "assets/img/sampah/";
                    $target_file = $target_dir . basename($_FILES["nama_file"]["name"]);
                    $ext_file = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    $kompresi = ($_FILES["nama_file"]["size"]/1024/1024);
                    if ($kompresi > 5) {
                        $stts = "W";
                        $pesan .= "Ukuran file terlalu besar ".$kompresi."\n";
                        $upload_gambar = 0;
                    }
            
                    if($ext_file != "jpg" && $ext_file != "png" && $ext_file != "jpeg") {
                        $stts = "W";
                        $pesan .="File yang di izinkan adalah JPG, JPEG dan PNG\n";
                        $upload_gambar = 0;
                    }
            
                    if ($upload_gambar == 0) {
                        $stts = "N";
                        $pesan .= "Gagal upload gambar";
                    }else{
                        $rename_file = $_POST['nama_sampah']."-".$id_gambar.".".$ext_file;
                        if(move_uploaded_file($_FILES["nama_file"]["tmp_name"], $target_dir.$rename_file)) {
                            $stts = "Y";
                            $pesan .= "Berhasil Upload Gambar";
                        } else {
                            $stts = "N";
                            $pesan .= "Gagal Upload Gambar";
                        }
                    }
                }
                if($upload_gambar==1){
                    if($this->model("Sampah_model")->simpan_sampah($_POST, $rename_file)>0){
                        $poin_terkecil = $this->model("Sampah_model")->min_poin();
                        if(!empty($poin_terkecil['minpoin'])){
                            if($_POST['harga_beli']<=$poin_terkecil['minpoin']){
                                $this->model("Sampah_model")->update_min_poin($_POST['harga_beli']);
                            }
                        }else{
                            $this->model("Sampah_model")->update_min_poin($_POST['harga_beli']);
                        }
                        $stts = "Y";
                        $pesan .= " & Menyimpan Data ";
                    }else{
                        $stts = "N";
                        $pesan .= " & Gagal Menyimpan Data";
                    }
                }
                echo json_encode(array("status"=>$stts,"pesan"=>$pesan));

            }else{
                echo json_encode(array("status"=>"W","pesan"=>"Pastikan Semua Data Terisi"));
            }
        }
    }

    public function update_sampah(){
        $token = hash_hmac('sha256', KUNCITOKEN, $_SESSION['crfs']);
        if(hash_equals($_POST['token_edit_sampah'],$token)){
            $detail_sampah = $this->model("Sampah_model")->detail_sampah_byid($_POST['id_sampah']);
            if(!empty($_POST['token_edit_sampah']) && !empty($_POST['nama_sampah_edit']) && $_POST['pilih_kategori_edit']!='pilih' && !empty($_POST['harga_beli_edit']) && !empty($_POST['harga_jual_edit'])){
                $pesan = "";
                $p_upload = "";
                $upload_gambar = 1;
                $id_gambar = uniqid();
                $rename_file = "";
                if(isset($_FILES['nama_file_edit']) && !empty($_FILES['nama_file_edit']['name']) && $_FILES['nama_file_edit']['error'] == 0){
                    $target_dir = "assets/img/sampah/";
                    $target_file = $target_dir . basename($_FILES["nama_file_edit"]["name"]);
                    $ext_file = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    $kompresi = ($_FILES["nama_file_edit"]["size"]/1024/1024);
                    if ($kompresi > 5) {
                        $p_upload .= "Ukuran file terlalu besar ".$kompresi."\n";
                        $upload_gambar = 0;
                    }
            
                    if($ext_file != "jpg" && $ext_file != "png" && $ext_file != "jpeg") {
                        $p_upload .="File yang di izinkan adalah JPG, JPEG dan PNG\n";
                        $upload_gambar = 0;
                    }
            
                    if ($upload_gambar == 0) {
                        $p_upload .= "Gagal Update gambar";
                    }else{
                        $rename_file = $_POST['nama_sampah_edit']."-".$id_gambar.".".$ext_file;
                        if(move_uploaded_file($_FILES["nama_file_edit"]["tmp_name"], $target_dir.$rename_file)) {
                            if($detail_sampah['nama_file']!=""){
                                if(file_exists("assets/img/sampah/".$detail_sampah['nama_file'])){
                                    unlink("assets/img/sampah/".$detail_sampah['nama_file']);
                                }
                            }
                            $p_upload = "Berhasil Update Gambar ";
                        } else {
                            $p_upload .= "Gagal Update Gambar";
                        }
                    }
                }

                if($this->model("Sampah_model")->update_sampah($_POST, $rename_file)>0){
                    $poin_terkecil = $this->model("Sampah_model")->min_poin();
                    if(!empty($poin_terkecil['minpoin'])){
                        if($_POST['harga_beli_edit']<=$poin_terkecil['minpoin']){
                            $this->model("Sampah_model")->update_min_poin($_POST['harga_beli_edit']);
                        }
                    }else{
                        $this->model("Sampah_model")->update_min_poin($_POST['harga_beli_edit']);
                    }
                    $stts = "Y";
                    $pesan .= "Berhasil Mengupdate Data";
                }else{
                    $stts = "N";
                    $pesan .= "Gagal Menyimpan Data";
                }

                if($p_upload!=""){
                    $pesan .= " & ".$p_upload;
                }
                echo json_encode(array("status"=>$stts,"pesan"=>$pesan));

            }else{
                echo json_encode(array("status"=>"W","pesan"=>"Pastikan Semua Data Terisi"));
            }
        }
    }

    public function hapus_sampah(){
        $token = hash_hmac('sha256', KUNCITOKEN, $_SESSION['crfs']);
        if(hash_equals($_POST['key'],$token)){
            $check = $this->model("Sampah_model")->check_trans_sampah($_POST['id']);
            $detail_sampah = $this->model("Sampah_model")->detail_sampah_byid($_POST['id']);
            if($check>0){
                echo json_encode(array("status"=>"W","pesan"=>"Jenis Sampah Tersebut Sudah Ada Transaksinya!"));
            }else{
                if($this->model("Sampah_model")->hapus_sampah($_POST['id'])>0){
                    $poin_terkecil = $this->model("Sampah_model")->min_poin();
                    $poin_tukar = $this->model("Sampah_model")->nilai_tukar();
                    if($poin_tukar['kurs']>$poin_terkecil['minpoin']){
                        if(empty($poin_terkecil['minpoin'])){
                            $this->model("Sampah_model")->update_min_poin("0");
                        }else{
                            $this->model("Sampah_model")->update_min_poin($poin_terkecil['minpoin']);
                        }
                    }
                    if($detail_sampah['nama_file']!=""){
                        if(file_exists("assets/img/sampah/".$detail_sampah['nama_file'])){
                            unlink("assets/img/sampah/".$detail_sampah['nama_file']);
                        }
                    }
                    echo json_encode(array("status"=>"Y","pesan"=>"Berhasil Hapus Jenis Sampah."));
                }else{
                    echo json_encode(array("status"=>"N","pesan"=>"Gagal Hapus Jenis Sampah!"));
                }
            }
        }
    }

    public function detail_sampah(){
        $token = hash_hmac('sha256', KUNCITOKEN, $_SESSION['crfs']);
        if(hash_equals($_POST['key'],$token)){
            $data = $this->model("Sampah_model")->detail_sampah_byid($_POST['id']);
            echo json_encode($data);
        }
    }
}