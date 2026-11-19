<?php

class Riwayat extends Controller{

    public function index(){
        $data['judul'] = "Riwayat";
        $this->view('templates/header', $data);
        $this->view('Riwayat/index');      
        $this->view('templates/footer');
 }
}