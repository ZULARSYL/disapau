<?php

class Login extends Controller{
    public function index(){
        if(empty($_SESSION['data_disapu'])){
            $token = hash_hmac('sha256', KUNCITOKEN, $_SESSION['crfs']);
            $data['judul'] = "Login";      
            $data['token_screetkey'] = $token;
            $this->view('Login/index',$data);
        }else{
            header('Location:'.BASEURL.'Home');
            exit();
        }
    }

    public function checkLogin(){
        $token = hash_hmac('sha256', KUNCITOKEN, $_SESSION['crfs']);
        $pass = MD5($_POST['password']);
        if (hash_equals($token, $_POST['inputtoken'])) {
            $data_user=$this->model('Login_model')->getUser($_POST['username'], $_POST['password']);
            if(!empty($data_user)){
                if(hash_equals($pass, $data_user['hash_password'])){ 
                    $_SESSION['data_disapu'] = array("id_user"=>$data_user['id_user'],
                                                    "nama"=>$data_user['nama'],
                                                    "level"=>$data_user['id_level'],
                                                    "jk"=>$data_user['jk'],
                                                    "peringkat"=>$data_user['peringkat']
                    );
                    echo json_encode(array("respons"=>"200","notif"=>"Hi, ".$data_user['nama']." Selamat Datang Kembali"));
                }else{
                    echo json_encode(array("respons"=>"201","notif"=>"Pastikan Username & Password Benar!","md5"=>$pass));
                }
            }else{
                echo json_encode(array("respons"=>"201","notif"=>"Pastikan Username & Password Benar!","md5"=>$pass));
            }
        }else{
            echo json_encode(array("respons"=>"201","notif"=>"Pastikan Username & Password Benar!"));
        }        
    }

    public function signout(){
        echo json_encode(array("status"=>"Y","pesan"=>"Anda Berhasil Logout, Sampai Jumpa Kembali."));
        // remove all session variables
        session_unset();
        // destroy the session
        session_destroy();
    }
}
