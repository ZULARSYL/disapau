<?php
    class Timbang_model{
        private $db;
        public function __construct() {
            $this->db = new Database;
        }

        public function getKategoriSampah(){
            $query = "select * from kategori_sampah";
            $this->db->query($query);
            return $this->db->resultSet();
        }
        
        public function getKlasifikasi(){
            $query = "SELECT * FROM sampah";
            $this->db->query($query);
            return $this->db->resultSet();
        }


        public function tambahTimbang($data){
            $query = "INSERT INTO transaksi VALUES 
                    ('', :poin, :berat, :id_user, :id_sampah)";
            $this->db->query($query);
            $this->db->bind('id_user', $data['id_user']);
            $this->db->bind('berat', $data['berat']);
            $this->db->bind('id_sampah', $data['material2']);
        }
        
        public function getSampah($id){
            $query = "SELECT * FROM sampah WHERE id_sampah = :id ";
            $this->db->query($query);
            $this->db->bind('id', $id);
            return $this->db->single();
        }

}