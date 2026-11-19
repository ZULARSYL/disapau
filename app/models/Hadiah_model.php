<?php
 class Hadiah_model{
    
        private $db;

        public function __construct() {
            $this->db = new Database;
        }

        public function getHadiah(){
            $this->db->query('SELECT * FROM `hadiah`');
            return $this->db->resultSet();
        }

        public function getStock(){
            $this->db->query("SELECT sum(stok_barang) as stock FROM hadiah");
            return $this->db->single();
        }

        public function getStokById($id){
            $this->db->query("SELECT stok_barang FROM hadiah where id_hadiah=:id");
            $this->db->bind("id",$id);
            $this->db->execute();
            return $this->db->single();
        }

        public function kurangi_stok_produk($data){
            $detail_produk = $this->getHadiahbyId($data['id_hadiah']);
            $stok_now = $detail_produk['stok_barang']-1;
            $this->db->query("update hadiah set stok_barang=:stok where id_hadiah=:id");
            $this->db->bind("stok",$stok_now);
            $this->db->bind("id",$data['id_hadiah']);
            $this->db->execute();
            return $this->db->rowCount();
        }

        public function tambahHadiah($data,$filename){
            $query = "INSERT INTO hadiah VALUES (`id_hadiah`, :nama, :poin, :stok_barang, :image)";
            $this->db->query($query);  
            $this->db->bind('nama', $data['nama_produk']);
            $this->db->bind('poin', $data['poin']);
            $this->db->bind('stok_barang', $data['stok_produk']);
            $this->db->bind('image', $filename);

            $this->db->execute();
            return $this->db->rowCount();
        }

        public function getHadiahbyId($id){
            $query = "SELECT * FROM hadiah WHERE id_hadiah = :id";
            $this->db->query($query);
            $this->db->bind('id',$id);
            return $this->db->single();
        }

        public function hapusHadiah($id){
            $query = "DELETE FROM hadiah WHERE id_hadiah = :id";
            $this->db->query($query);
            $this->db->bind('id', $id);
            $this->db->execute();
            return $this->db->rowCount();
        }

        public function ubahHadiah($data,$filehadiah){
            $query = "UPDATE hadiah SET 
            nama = :nama, 
            poin = :poin, 
            stok_barang = :stok_barang,
            image = :uimage
            WHERE id_hadiah = :id_hadiah";
            $this->db->query($query);  
            $this->db->bind('nama', $data['nama_produk_edit']);
            $this->db->bind('poin', $data['poin_edit']);
            $this->db->bind('stok_barang', $data['stok_produk_edit']);
            $this->db->bind('id_hadiah', $data['id_hadiah_edit']);
            $this->db->bind('uimage', $filehadiah);
            $this->db->execute();
            return $this->db->rowCount();
        }
 }
?>