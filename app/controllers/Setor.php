<?php
  class Setor extends Controller{
    public function index(){
      $data['token'] =  hash_hmac('sha256', KUNCITOKEN, $_SESSION['crfs']);
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
      $this->view('templates/header');
      if(isset($_SESSION['data_disapu']) && $_SESSION['data_disapu']['level']=='2'){
        $data['nasabah'] = $this->model("User_model")->getDataUser();
        $data['kategori_sampah'] = $this->model("Timbang_model")->getKategoriSampah();
        $data['kurs'] = $this->model("Sampah_model")->nilai_tukar();
        $this->view('Setor/admin',$data);
      }else{
        $this->view('Setor/index',$data);
      }
      $this->view('templates/footer');
    }

    public function sub_kategori(){
      $token = hash_hmac('sha256', KUNCITOKEN, $_SESSION['crfs']); //set Token ;
      if(hash_equals($token, $_POST['key'])){
          $sub_kategori = $this->model("Sampah_model")->getSubKategoriSampah($_POST['k']);?>
          <script>
              $(function(){
                  $("#id_sampah").select2();
              });
          </script>
          <?php
          echo "<label for='id_sampah' class='form-label'>Klasifikasi Sampah</label>";
          echo "<select id='id_sampah' name='id_sampah' class='form-control form-control-sm' onchange='test();' required>";
          echo "<option value='pilih'>Pilih</option>";
          foreach ($sub_kategori as $s_k) {
              echo "<option value='".$s_k['id_sampah']."'>".strtoupper($s_k['nama_klasifikasi'])."</option>";    
          }
          echo "</select>";
      }
    }

    public function poin_sampah(){
      $token = hash_hmac('sha256', KUNCITOKEN, $_SESSION['crfs']); //set Token ;
      if(hash_equals($token, $_POST['key'])){
        $sampah = $this->model("Sampah_model")->detail_sampah_byid($_POST['id_sampah']);
        $kurs = $this->model("Sampah_model")->nilai_tukar();
        if(empty($_POST['berat'])){
          $berat = 0;
        }else{
          $berat = $_POST['berat'];
        }
        $poin = round($sampah['harga_beli']/$kurs['kurs'],2);
        echo "<div class='alert alert-warning' role='alert'>
          <b class='alert-heading'><u>DETAIL</u></b>
          <p>Kategori : <b>".$sampah['kategori']."</b><br>
          Jenis Sampah : <b>".$sampah['nama_klasifikasi']."</b><br>
          Nilai Tukar : <b>".$poin." Poin/Kg</b><br>
          Berat Timbangan : <b>".$berat."</b><br>
          <strong>Total Poin Didapat : ".$poin*$berat." Poin</strong> 
          </p>
        </div>";
      }
    }

    public function serverside_sampah($key){
      $token = hash_hmac('sha256', KUNCITOKEN, $_SESSION['crfs']);
      if(hash_equals($token, $key)){
        $kurs = $this->model("Sampah_model")->nilai_tukar();
        $requestData= $_POST;
        $columns = array( 
          0 => 's.nama_klasifikasi', 
          1 => 'k.nama_klasifikasi'
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

          $deskripsi = "<table>
          <tr>
            <td>Nama </td>
            <td>&nbsp;:&nbsp;</td>
            <td> ".$v['nama_klasifikasi']."</td>
          </tr>
          <tr>
            <td>Kategori </td>
            <td>&nbsp;:&nbsp;</td>
            <td> ".$v['kategori']."</td>
          </tr>
          <tr>
            <td>Poin </td>
            <td>&nbsp;:&nbsp;</td>
            <td> ".round($v['harga_beli']/$kurs['kurs'],2)."/Kg</td>
          </tr>
          </table>";
          
          $no++;
          $nestedData=array(); 
          $nestedData[] = "<img src='".BASEURL."assets/img/sampah/".$v['nama_file']."' class='img-thumbnail rounded mx-auto d-block' alt=''>";
          $nestedData[] = $deskripsi;
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

    public function proses_setor(){
      $token = hash_hmac('sha256', KUNCITOKEN, $_SESSION['crfs']);
      if(hash_equals($token, $_POST['token_setor_sampah'])){
        if($_POST['id_kategori']!='pilih' && $_POST['id_sampah']!='pilih' && $_POST['id_user']!='pilih' && $_POST['berat']!='0'){
          $sampah = $this->model("Sampah_model")->detail_sampah_byid($_POST['id_sampah']);
          $kurs = $this->model("Sampah_model")->nilai_tukar();
          $user = $this->model("Profile_model")->detail_profil($_POST['id_user']);
          
          if(empty($_POST['berat'])){
            $berat = 0;
          }else{
            $berat = $_POST['berat'];
          }
          $poin = round(($sampah['harga_beli']/$kurs['kurs'])*$_POST['berat'],2);
          //id_user, nama_user, id_kategori, kategori, id_sampah, nama_klasifikasi, harga_jual, qty_setor, kurs_poin, total_poin
          if($poin>0){
            $arr_send = array("id_user"=>$_POST['id_user'], 
            "nama_user"=>$user['nama'], 
            "id_kategori"=>$_POST['id_kategori'], 
            "kategori"=>$sampah['kategori'], 
            "id_sampah"=>$_POST['id_sampah'], 
            "nama_klasifikasi"=>$sampah['nama_klasifikasi'], 
            "harga_jual"=>$sampah['harga_beli'], 
            "qty_setor"=>$_POST['berat'], 
            "kurs_poin"=>$_POST['kurs_poin'], 
            "total_poin"=>$poin);
            if($this->model("Setor_model")->proses_setor($arr_send)>0){
              $tambah_poin = $this->model("Profile_model")->tambah_poin_user($arr_send);
              echo json_encode(array("status"=>"Y","pesan"=>"Setor Sampah Berhasil, Nasabah Mendapatkan Poin : ".$poin));
            }else{
              echo json_encode(array("status"=>"N","pesan"=>"Gagal Memproses Setor Sampah."));
            }
          }else{
            echo json_encode(array("status"=>"W","pesan"=>"Pastikan Poin Yang Diterima User Tidak = 0"));
          }
        }else{
          echo json_encode(array("status"=>"W","pesan"=>"Pastikan Semua Data Sudah Terisi!"));
        }
      }
    }
  }

?>