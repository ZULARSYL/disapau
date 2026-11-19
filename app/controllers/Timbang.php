<?php

class Timbang extends Controller{
    
    public function index(){     
        $data['kategori_sampah'] = $this->model("Timbang_model")->getKategoriSampah();
        $data['nasabah'] = $this->model("User_model")->getDataUser();
        $data['token_screetkey'] = hash_hmac('sha256', KUNCITOKEN, $_SESSION['crfs']);
        $this->view('Templates/header');
        $this->view('Timbang/index',$data);
        $this->view('Templates/footer');
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
            echo "<select id='id_sampah' name='id_sampah' class='p-2 rounded-xl shadow-md focus:outline-none focus:ring-4 focus:ring-teal-600 text-sm w-full'>";
            foreach ($sub_kategori as $s_k) {
                echo "<option value='".$s_k['id_sampah']."'>".strtoupper($s_k['nama_klasifikasi'])."</option>";    
            }
            echo "</select>";
        }
    }


    public function tambah(){
        $id_sampah = $_POST['material2'];
        
        $sampah = $this->model('Timbang_model')->getSampah($id_sampah);
        var_dump($sampah);
        // if ($this->model('Timbang_model')->tambahTimbang($_POST)>0) {
        //     header('Location :'. BASEURL . 'timbang');
        //     exit;
        // }

    }
}