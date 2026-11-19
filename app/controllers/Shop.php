<?php
  class Shop extends Controller {
    public function index(){
      $data['token_screetkey'] = hash_hmac('sha256', KUNCITOKEN, $_SESSION['crfs']);
      $data['hadiah'] = $this->model('Hadiah_model')->getHadiah();
      $data['kurs'] = $this->model("Sampah_model")->nilai_tukar();

      // jika yang mengakses sudah melakukan login
      if(isset($_SESSION['data_disapu'])){
        $data['alert'] = $this->model("Profile_model")->alert_checkout($_SESSION['data_disapu']['id_user']);
        $data['poin_user'] = $this->model("Profile_model")->poin_user($_SESSION['data_disapu']['id_user']);
        $data['detail_user'] = $this->model("Profile_model")->detail_profil($_SESSION['data_disapu']['id_user']);
        if($_SESSION['data_disapu']['level']=='2'){
          $data['stock'] = $this->model("Hadiah_model")->getStock();
          $data['need_confirm'] = $this->model("Shop_model")->need_confirm();
        }
      }
      
      $this->view('Templates/header');
      $this->view('Shop/index', $data);
      $this->view('Templates/footer');
    }

    public function check_out(){
      $token = hash_hmac('sha256', KUNCITOKEN, $_SESSION['crfs']);
      if(!empty($_SESSION['data_disapu']['id_user'])){
        if(hash_equals($token,$_POST['key'])){
          $produk = $this->model("Hadiah_model")->getHadiahbyId($_POST['id']);
          $poin_user = $this->model("Profile_model")->poin_user($_SESSION['data_disapu']['id_user']);
          $kurs = $this->model("Sampah_model")->nilai_tukar();
          $detail_user = $this->model("Profile_model")->detail_profil($_SESSION['data_disapu']['id_user']);

          if($poin_user>=($produk['poin']/$kurs['kurs'])){
            if($produk['stok_barang']<=0){
              echo json_encode(array("status"=>"W","pesan"=>"Stok Item Produk Kosong"));
            }else{
              $poincheckout = $produk['poin']/$kurs['kurs'];
              $data = array("id_hadiah"=>$_POST['id'],"nama_hadiah"=>$produk['nama'],"poin_checkout"=>$poincheckout,"id_user"=>$detail_user['id_user'],"nama_user"=>$detail_user['nama']);
              if($this->model("Shop_model")->check_out($data)>0){
                echo json_encode(array("status"=>"Y","pesan"=>"Berhasil Check out 1 Item Produk."));                
              }else{
                echo json_encode(array("status"=>"N","pesan"=>"Proses Checkout Gagal!"));
              }
            }
          }else{
            echo json_encode(array("status"=>"W","pesan"=>"Poin anda tidak cukup untuk menukarkan dengan produk tersebut."));
          }
        }
      }else{
        echo json_encode(array("status"=>"W","pesan"=>"Silahkan Login Terlebih Dahulu Untuk Check Out Produk Tersebut"));
      }
    }

    public function detail_checkout(){
      $token = hash_hmac('sha256', KUNCITOKEN, $_SESSION['crfs']);
      if(hash_equals($token, $_POST['key'])){
        $data = $this->model("Shop_model")->detail_confim($_POST['id']);
        echo json_encode(array("id_tukar"=>$data['id_tukar'],"id_hadiah"=>$data['id_hadiah'],"id_user"=>$data['id_user']));
      }
    }

    public function confirm_checkout(){
      $token = hash_hmac('sha256', KUNCITOKEN, $_SESSION['crfs']);
      if(hash_equals($token, $_POST['token_konfirm_poin'])){
        $detail_tukar = $this->model("Shop_model")->detail_confim($_POST['id_tukar']);
        if($detail_tukar['key_checkout']==$_POST['key_checkout']){
          if($this->model("Shop_model")->konfirm($_POST)>0){
            $update_poin = $this->model("Profile_model")->kurangi_poin_user($detail_tukar);
            $update_stok = $this->model("Hadiah_model")->kurangi_stok_produk($detail_tukar);
            echo json_encode(array("status"=>"Y","pesan"=>"Tukar Poin Terkonfirmasi"));
          }else{
            echo json_encode(array("status"=>"N","pesan"=>"Konfirmasi Tukar Poin Gagal!"));  
          }
        }else{
          echo json_encode(array("status"=>"W","pesan"=>"Pastikan Key Tukar Poin Sesuai!"));  
        }
      }
    }

    public function serverside_confirm($key){
      $token = hash_hmac('sha256', KUNCITOKEN, $_SESSION['crfs']);
      if(hash_equals($token, $key)){
        $requestData= $_POST;
        $columns = array( 
          0 => 'nama_user',
          3 => 'tgl_input'
        );
        $sql = "select * from tukar_poin where status_checkout is NULL and tgl_checkout is NULL";
        //$order = "order by STR_TO_DATE(tgl_nota,'%Y-%m-%d') DESC, id_transaksi DESC";
        $t = $this->model("m_serverside")->record_data($sql);
        $totalData = count($t);
        $totalFiltered = $totalData;
        
        if( !empty($requestData['search']['value']) ) {
          //----------------------------------------------------------------------------------
          $sql.=" AND ( nama_user LIKE '%".$requestData['search']['value']."%' ";    
          $sql.=" OR nama_hadiah LIKE '%".$requestData['search']['value']."%' ";
          $sql.=" OR tgl_input LIKE '%".$requestData['search']['value']."%' ";
          $sql.=" OR poin_checkout LIKE '%".$requestData['search']['value']."%' )";
        }

        $t = $this->model("m_serverside")->record_data($sql);
        $totalFiltered = count($t);
        $order = "";
        if(!empty($requestData['order'][0]['column'])){
          $order.=" order by ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";	
        }else{
          $order.=" order by id_tukar DESC ,". $columns[$requestData['order'][0]['column']]." ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']." ";
        }

        $t = $this->model("m_serverside")->record_data($sql.$order);

        $data = array();
        $no =1;
        foreach ($t as $v) {
          $stok = $this->model("Hadiah_model")->getStokById($v['id_hadiah']);
          $poin_user = $this->model("Profile_model")->poin_user($v['id_user']);
          $no++;
          $t_action = "";
          //action detail
          if($stok['stok_barang']<=0 || $poin_user['poin_now']<$v['poin_checkout']){
            if($poin_user['poin_now']<$v['poin_checkout']){
              $t_action .= "Poin User Tidak Cukup!<br><button href='javascript:void(0);' class='btn btn-info btn-sm' data-toggle='modal' data-target='#modal_confirm_chekcout' onclick='confirm_checkout(@".$v['id_tukar']."@);' disabled><i class='bi bi-check2-all'></i> Confirm</button>";
            }else{
              $t_action .= "Stok Produk Habis!<br><button href='javascript:void(0);' class='btn btn-info btn-sm' data-toggle='modal' data-target='#modal_confirm_chekcout' onclick='confirm_checkout(@".$v['id_tukar']."@);' disabled><i class='bi bi-check2-all'></i> Confirm</button>";
            }
          }else{
            $t_action .= "<a href='javascript:void(0);' class='btn btn-info btn-sm' data-toggle='modal' data-target='#modal_confirm_chekcout' onclick='confirm_checkout(@".$v['id_tukar']."@);'><i class='bi bi-check2-all'></i> Confirm</a>";
          }
          $t_action = str_replace("'", '"', $t_action);
          $t_action = str_replace("@", "'", $t_action);

          $nestedData=array(); 
          $nestedData[] = ucfirst($v['nama_user'])."<br><b>".ucfirst($v['nama_hadiah'])."</b><br>Stok : ".$stok['stok_barang']."<br>Poin : ".$v['poin_checkout'];
          
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
  }
?>