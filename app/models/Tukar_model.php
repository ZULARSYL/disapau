<?php
class Tukar_model {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }
    
    public function getPoin($id_user) {
        $query = "SELECT poin_now FROM poin_user WHERE id_user = :id_user";
        $this->db->query($query);
        $this->db->bind('id_user', $id_user);
        return $this->db->single();
    }
    public function getStok() {
        $query = "SELECT * FROM hadiah";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function penukaran($data) {
        $query = "INSERT INTO transaksi (id_hadiah, nama_hadiah, jumlah_poin, id_user, nama_user, tgl_input, tgl_checkout, sifat) 
                  VALUES (:id_hadiah, :nama_hadiah, :jumlah_poin, :id_user, :nama_user, :tgl_input, :tgl_checkout, :sifat)";
        $this->db->query($query);
        $this->db->bind('id_hadiah', $data['id_hadiah']);
        $this->db->bind('nama_hadiah', $data['nama_hadiah']);
        $this->db->bind('jumlah_poin', $data['jumlah_poin']);
        $this->db->bind('id_user', $data['id_user']);
        $this->db->bind('nama_user', $data['nama_user']);
        $this->db->bind('tgl_input', $data['tgl_input']);
        $this->db->bind('tgl_checkout', $data['tgl_checkout']);  // Awalnya null
        $this->db->bind('sifat', $data['sifat']);  // Set transaksi sebagai aktif
        $this->db->execute();
        return $this->db->rowCount();
    }
    
    public function kurangiPoin($id_user, $jumlah_poin) {
        $query = "UPDATE poin_user SET poin_now = poin_now - :jumlah_poin WHERE id_user = :id_user";
        $this->db->query($query);
        $this->db->bind('jumlah_poin', $jumlah_poin);
        $this->db->bind('id_user', $id_user);
        return $this->db->execute();
    }
    

}
