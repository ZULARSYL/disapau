<?php
    class Nasabah extends Controller{
        public function index(){
            $data['token'] =  hash_hmac('sha256', KUNCITOKEN, $_SESSION['crfs']);
            $data['judul'] = "Nasabah";
            $data['nasabah'] = $this->model('Nasabah_model')->getNasabah();
            $data['jmlh_admin'] = $this->model('Nasabah_model')->getJmlhadmin();
            $data['jmlh_user'] = $this->model('Nasabah_model')->getJmlhuser();
            $data['total_poin'] = $this->model('Nasabah_model')->getTotalPoin();
            $data['statistic'] = $this->model("Nasabah_model")->getStatistic();
            $this->view('templates/header', $data);    
            $this->view('nasabah/index',$data);
            $this->view('templates/footer');
        }

        public function detail_user(){
            $token =  hash_hmac('sha256', KUNCITOKEN, $_SESSION['crfs']);
            if(hash_equals($_POST['key'],$token)){
                $data = $this->model("Nasabah_model")->detail_user($_POST['id']);
                echo "<table class='table table-sm table-striped'>
                        <tr><td>NIK</td><td>:</td><td>".$data['nik']."</td></tr>
                        <tr><td>Nama</td><td>:</td><td>".$data['nama']."</td></tr>
                        <tr><td>Jenis Kelamin</td><td>:</td><td>".$data['jk']."</td></tr>
                        <tr><td>Alamat</td><td>:</td><td>".$data['dusun']." RT.".$data['rt']."/RW.".$data['rw']." Desa ".$data['alamat']."</td></tr>
                        <tr><td>No.Telpn</td><td>:</td><td>".$data['no_telp']."</td></tr>
                        <tr><td>Peringkat</td><td>:</td><td><i class='bi bi-award-fill' style='color:".medal_color($data['peringkat'])."'></i> ".$data['peringkat']."</td></tr>
                        <tr><td colspan='3'><strong>Credential</strong></td></tr>
                        <tr><td>Username</td><td>:</td><td>".$data['username']."</td></tr>
                        <tr><td>Password</td><td>:</td><td>".masking_text($data['password'])."</td></tr>
                      </table>";
            }
        }

        public function detail_user_edit(){
            $token =  hash_hmac('sha256', KUNCITOKEN, $_SESSION['crfs']);
            if(hash_equals($_POST['key'],$token)){
                $data = $this->model("Nasabah_model")->detail_user($_POST['id']);
                echo json_encode($data);
            }
        }

        public function tambahUser(){
            $token =  hash_hmac('sha256', KUNCITOKEN, $_SESSION['crfs']);
            // echo json_encode(array("status"=>"Y","pesan"=>"Token sama","POST"=>$_POST));
            if(hash_equals($_POST['token_tambahUser'],$token)){
                //require
                if(!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['token_tambahUser']) && !empty($_POST['nik']) && !empty($_POST['nama'])){
                    if($this->model("Nasabah_model")->simpan_user($_POST)>0){
                        $create_poin = $this->model("Nasabah_model")->create_poin($_POST['id_user']);
                        echo json_encode(array("status"=>"Y","pesan"=>"Data Tersimpan."));
                    }else{
                        echo json_encode(array("status"=>"N","pesan"=>"Gagal Tersimpan!"));
                    }
                }else{
                    echo json_encode(array("status"=>"W","pesan"=>"Pastikan Semua Data Terisi"));
                }
            }
        }

        public function updateUser(){
            $token =  hash_hmac('sha256', KUNCITOKEN, $_SESSION['crfs']);
            // echo json_encode(array("status"=>"Y","pesan"=>"Token sama","POST"=>$_POST));
            if(hash_equals($_POST['token_edit_user'],$token)){
                //require
                if(!empty($_POST['username_edit']) && !empty($_POST['password_edit']) && !empty($_POST['token_edit_user']) && !empty($_POST['nik_edit']) && !empty($_POST['nama_edit'])){
                    if($this->model("Nasabah_model")->update_user($_POST)>0){
                        echo json_encode(array("status"=>"Y","pesan"=>"Data Terupdate."));
                    }else{
                        echo json_encode(array("status"=>"N","pesan"=>"Gagal Terupdate!"));
                    }
                }else{
                    echo json_encode(array("status"=>"W","pesan"=>"Pastikan Semua Data Terisi"));
                }
            }
        }

        public function hapus_user(){
            $token =  hash_hmac('sha256', KUNCITOKEN, $_SESSION['crfs']);
            // echo json_encode(array("status"=>"Y","pesan"=>"Token sama","POST"=>$_POST));
            if(hash_equals($_POST['key'],$token)){
                if($this->model("Nasabah_model")->hapus_user($_POST['id'])>0){
                    echo json_encode(array("status"=>"Y","pesan"=>"Data Terhapus."));
                }else{
                    echo json_encode(array("status"=>"N","pesan"=>"Gagal Terhapus!"));
                }
            }
        }
    }
?>