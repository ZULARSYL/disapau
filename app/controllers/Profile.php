<?php
class Profile extends Controller {
    public function __construct() {
        if (empty($_SESSION['data_disapu'])) {
            header("Location: ".BASEURL.'Login');
            exit();
        }
    }

    public function index() {
        $data['token'] = hash_hmac('sha256', KUNCITOKEN, $_SESSION['crfs']);
        $data['judul'] = "Profile";
        $data['detail_user'] = $this->model("Profile_model")->detail_profil($_SESSION['data_disapu']['id_user']);
        $data['poin_user'] = $this->model("Profile_model")->poin_user($_SESSION['data_disapu']['id_user']);
        $data['riwayat_checkout'] = $this->model("Profile_model")->riwayat_checkout($_SESSION['data_disapu']['id_user']);
        $data['setor_sampah'] = $this->model("Profile_model")->setor_sampah_user($_SESSION['data_disapu']['id_user']);
        if($_SESSION['data_disapu']['level']=='1'){
            $data['alert'] = $this->model("Profile_model")->alert_checkout($_SESSION['data_disapu']['id_user']);
        }else{
            $data['alert'] = $this->model("Shop_model")->need_confirm();
        }

        // $data['riwayat_sifat_1'] = $this->model("Riwayat_model")->getRiwayatBySifat(1, $id_user);
        // $data['riwayat_user'] = $this ->model("Riwayat_model") -> getRiwayatuser();
        // $data['riwayat_user_done'] = $this-> model("Riwayat_model") -> getRiwayatuserDone();
        // $data['riwayat_sifat_others'] = $this->model("Riwayat_model")->getRiwayatBySifat(2, $id_user);
        
        $this->view('templates/header', $data);
        $this->view('Profile/index', $data);
        $this->view('templates/footer');
    }


    public function terimaTransaksi() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_transaksi = $_POST['id_transaksi'];
            $id_admin = $_POST['id_admin'];
            $nama_admin = $_POST['nama_admin'];
            $id_hadiah = $_POST['id_hadiah'];
    
            if ($this->model('Riwayat_model')->terimaTransaksi($id_transaksi, $id_admin, $nama_admin, $id_hadiah)) {
                header("Location: " . BASEURL . "/Profile");
                exit();
            } else {
                header("Location: " . BASEURL . "/Profile");
                exit();
            }
        } else {
            header("Location: " . BASEURL . "/Profile");
            exit();
        }
    }
    
    public function cancelTransaction() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_transaksi = $_POST['id_transaksi'];
            $jumlah_poin = $_POST['jumlah_poin'];
            $id_user = $_SESSION['data_disapu']['id_user'];
            
            if ($this->model('Riwayat_model')->cancelTransaction($id_transaksi, $jumlah_poin, $id_user)) {
                echo 'success';
            } else {
                echo 'error';
            }
        } else {
            header("Location: ".BASEURL);
            exit();
        }
    }

    
    
}
?>
