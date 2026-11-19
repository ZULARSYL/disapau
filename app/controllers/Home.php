<?php
    class Home extends Controller{
    
        public function __construct(){
            
        }
    
        public function index(){
            $this->view('templates/header');    
            $this->view('home/baru');
            $this->view('templates/footer');
        }
    }
?>