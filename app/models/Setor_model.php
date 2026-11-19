<?php
  class Setor_model{
    private $db;
    public function __construct() {
      $this->db = new Database;
    }

    public function proses_setor($data){
      $sql = "INSERT INTO setor_sampah(id_user, nama_user, id_kategori, kategori, id_sampah, nama_klasifikasi, harga_jual, qty_setor, kurs_poin, total_poin, updater) VALUES(:id_user, :nama_user, :id_kategori, :kategori, :id_sampah, :nama_klasifikasi, :harga_jual, :qty_setor, :kurs_poin, :total_poin, :updater)";
      $this->db->query($sql);
      $this->db->bind("id_user",$data['id_user']);
      $this->db->bind("nama_user",$data['nama_user']);
      $this->db->bind("id_kategori",$data['id_kategori']);
      $this->db->bind("kategori",$data['kategori']);
      $this->db->bind("id_sampah",$data['id_sampah']);
      $this->db->bind("nama_klasifikasi",$data['nama_klasifikasi']);
      $this->db->bind("harga_jual",$data['harga_jual']);
      $this->db->bind("qty_setor",$data['qty_setor']);
      $this->db->bind("kurs_poin",$data['kurs_poin']);
      $this->db->bind("total_poin",$data['total_poin']);
      $this->db->bind("updater",$_SESSION['data_disapu']['nama']);
      $this->db->execute();
      return $this->db->rowCount();
    }
  }
?>