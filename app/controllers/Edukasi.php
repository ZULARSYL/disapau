<?php
    class Edukasi extends Controller{
    
        public function __construct(){
            
        }
    
        public function index(){
            $this->view('templates/header');    
            $this->view('edukasi/index');
            $this->view('templates/footer');
        }
        public function aplikasi(){
            $this->view('templates/header');    
            $this->view('edukasi/aplikasi');
            $this->view('templates/footer');
        }
        public function maggot(){
            $this->view('templates/header');    
            $this->view('edukasi/maggot');
            $this->view('templates/footer');
        }
        public function poc(){
            $this->view('templates/header');    
            $this->view('edukasi/poc');
            $this->view('templates/footer');
        }
    }
?>