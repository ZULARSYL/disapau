<?php
  class Profile_model{
    private $db;
    public function __construct() {
      $this->db = new Database;
    }

    public function detail_profil($id){
      $this->db->query("select * from user where id_user=:id");
      $this->db->bind("id",$id);
      $this->db->execute();
      return $this->db->single();
    }

    public function poin_user($id){
      $this->db->query("select * from poin_user where id_user=:id");
      $this->db->bind("id",$id);
      $this->db->execute();
      return $this->db->single();
    }

    public function setor_sampah_user($id){
      $this->db->query("select * from setor_sampah where id_user=:id");
      $this->db->bind("id",$id);
      $this->db->execute();
      return $this->db->resultSet();
    }

    public function alert_checkout($id){
      $this->db->query("select * from tukar_poin where id_user=:id and status_checkout is NULL and tgl_checkout is NULL");
      $this->db->bind("id",$id);
      $this->db->execute();
      return $this->db->resultSet();
    }

    public function riwayat_checkout($id){
      $this->db->query("select * from tukar_poin where id_user=:id");
      $this->db->bind("id",$id);
      $this->db->execute();
      return $this->db->resultSet();
    }

    public function kurangi_poin_user($data){
      $data_poin = $this->poin_user($data['id_user']);
      $poin_out = $data_poin['poin_out']+$data['poin_checkout'];
      $poin_now = $data_poin['poin_now']-$data['poin_checkout'];
      $this->db->query("update poin_user set poin_out=:po, poin_now=:pn, tgl_update=:tgl, updater=:updater where id_user=:id");
      $this->db->bind("pn",$poin_now);
      $this->db->bind("po",$poin_out);
      $this->db->bind("tgl",date("Y-m-d h:i:s"));
      $this->db->bind("id",$data['id_user']);
      $this->db->bind("updater",$_SESSION['data_disapu']['nama']);
      $this->db->execute();
      return $this->db->rowCount();
    }

    public function tambah_poin_user($data){
      $data_poin = $this->poin_user($data['id_user']);
      $poin_in = $data_poin['poin_in']+$data['total_poin'];
      $poin_now = $data_poin['poin_now']+$data['total_poin'];
      $this->db->query("update poin_user set poin_in=:pi, poin_now=:pn, tgl_update=:tgl, updater=:updater where id_user=:id");
      $this->db->bind("pn",$poin_now);
      $this->db->bind("pi",$poin_in);
      $this->db->bind("tgl",date("Y-m-d h:i:s"));
      $this->db->bind("id",$data['id_user']);
      $this->db->bind("updater",$_SESSION['data_disapu']['nama']);
      $this->db->execute();
      return $this->db->rowCount();
    }
  }
?>