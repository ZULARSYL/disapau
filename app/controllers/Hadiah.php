<?php
class Hadiah extends Controller{

    public function index(){
        $token = hash_hmac('sha256', KUNCITOKEN, $_SESSION['crfs']);
        $data['token_screetkey'] = $token;
        $data['judul'] = "Hadiah";
        $data['hadiah'] = $this->model('Hadiah_model')->getHadiah();
        $data['stock'] = $this->model("Hadiah_model")->getStock();
        $data['kurs'] = $this->model("Sampah_model")->nilai_tukar();
        $this->view('templates/header', $data);
        $this->view('hadiah/index',$data);
        $this->view('templates/footer');
    }
    
    // public function tambah(){
    //     if ($this->model('Hadiah_model')->tambahHadiah($_POST) > 0) {
    //         header('Location: ' . BASEURL . 'hadiah');
    //         exit;
    //     }
    // }
    public function tambah() {
        $token = hash_hmac('sha256', KUNCITOKEN, $_SESSION['crfs']);
        if(hash_equals($token,$_POST['inputtoken'])){
            $stts = "";
            $pesan = "";
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                    $target_dir = "assets/img/hadiah/";
                    $target_file = $target_dir . basename($_FILES["image"]["name"]);
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                    $target_name = $_POST['nama_produk'].".".$imageFileType;
                    // Check if image file is an actual image or fake image
                    $check = getimagesize($_FILES["image"]["tmp_name"]);
                    if ($check !== false) {
                       
                        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                            $pesan = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                            $stts = "W";
                        }
    
                        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir.$target_name)) {
                            $_POST['image'] = $target_file;
                            if ($this->model('Hadiah_model')->tambahHadiah($_POST,$target_dir.$target_name) > 0) {
                                $stts = "Y";
                                $pesan = "Berhasil Menambah Produk";
                            } else {
                                $stts = "W";
                                $pesan = "Sorry, there was an error uploading your file.";
                            }
                        } else {
                            $stts = "W";
                            $pesan = "Sorry, there was an error uploading your file.";
                        }
                    } else {
                        $stts = "W";
                        $pesan = "File is not an image.";
                    }
                } else {
                    $stts = "W";
                    $pesan = "No file uploaded or there was an upload error.";
                }
            } else {
                $stts = "N";
                $pesan = "Gagal!";
            }
            echo json_encode(array("status"=>$stts,"pesan"=>$pesan));
        }
    }

    public function hapus(){
        $token = hash_hmac('sha256', KUNCITOKEN, $_SESSION['crfs']);
        if(hash_equals($token,$_POST['key'])){
            $detail_data = $this->model("Hadiah_model")->getHadiahbyId($_POST['id']);
            if ($this->model('Hadiah_model')->hapusHadiah($_POST['id']) > 0) {
                if(file_exists($detail_data['image'])){
                    unlink($detail_data['image']);
                }
                echo json_encode(array("status"=>"Y","pesan"=>"Berhasil Menghapus Produk"));
            }else{
                echo json_encode(array("status"=>"N","pesan"=>"Gagal Menghapus Produk!"));
            }
        }
    }

    public function getubah(){
        $token = hash_hmac('sha256', KUNCITOKEN, $_SESSION['crfs']);
        if(hash_equals($token,$_POST['key'])){
            echo json_encode($this->model('Hadiah_model')->getHadiahbyId($_POST['id']));
        }
    }

    // public function ubah(){
    //     if ($this->model('Hadiah_model')->ubahHadiah($_POST) > 0) {
    //         header('Location: ' . BASEURL . 'hadiah');
    //         exit;
    //     }   
    // }
    public function ubah() {
        $token = hash_hmac('sha256', KUNCITOKEN, $_SESSION['crfs']);
        if(hash_equals($token,$_POST['token_edit'])){
            $detail_hadiah = $this->model('Hadiah_model')->getHadiahbyId($_POST['id_hadiah_edit']);
            $filehadiah = $detail_hadiah['image'];
            $stts = "";
            $pesan = "";
            if (isset($_FILES['image_edit']) && $_FILES['image_edit']['error'] == 0) {
                $target_dir = "assets/img/hadiah/";
                $target_file = $target_dir . basename($_FILES["image_edit"]["name"]);
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                $target_name = $_POST['nama_produk_edit'].".".$imageFileType;

                // Check if image file is an actual image or fake image
                $check = getimagesize($_FILES["image_edit"]["tmp_name"]);
                if ($check !== false) {
                    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                        $stts = "W";
                        $pesan = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    }                        
                    if (move_uploaded_file($_FILES["image_edit"]["tmp_name"], $target_dir.$target_name)) {
                        $_POST['image_edit'] = $target_file;
                        $filehadiah = $target_dir.$target_name;
                        if(file_exists($detail_hadiah['image'])){
                            unlink($detail_hadiah['image']);
                        }                        
                    } else {
                        $stts = "W";
                        $pesan = "Sorry, there was an error uploading your file.";
                    }
                } else {
                    $stts = "W";
                    $pesan = "File is not an image.";
                }
            } else {
                $_POST['image_edit'] = $_POST['current_image'];
            }

            if ($this->model('Hadiah_model')->ubahHadiah($_POST,$filehadiah) > 0) {
                $stts = "Y";
                $pesan = "Berhasil Update Data Produk";
            } else {
                $stts = "N";
                $pesan = "Gagal Update Data Produk";
            }
            echo json_encode(array("status"=>$stts,"pesan"=>$pesan));
        }
    }
}
?>