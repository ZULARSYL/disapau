<?php
  class Shop_model {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function need_confirm(){
      $this->db->query("select * from tukar_poin where status_checkout is NULL and tgl_checkout is NULL");
      $this->db->execute();
      return $this->db->resultSet();
    }

    public function detail_confim($id){
      $this->db->query("select * from tukar_poin where id_tukar=:id");
      $this->db->bind("id",$id);
      $this->db->execute();
      return $this->db->single();
    }

    public function check_out($data){
      $keyid = randString(5);
      $sql = "INSERT INTO tukar_poin(id_hadiah, id_user, nama_user, nama_hadiah, poin_checkout, updater, key_checkout) VALUES(:id_hadiah, :id_user, :nama_user, :nama_hadiah, :poin_checkout, :updater, :key_checkout)";
      $this->db->query($sql);
      $this->db->bind("id_hadiah", $data['id_hadiah']);
      $this->db->bind("id_user", $data['id_user']);
      $this->db->bind("nama_user", $data['nama_user']);
      $this->db->bind("nama_hadiah", $data['nama_hadiah']);
      $this->db->bind("poin_checkout", $data['poin_checkout']);
      $this->db->bind("key_checkout", $keyid);
      $this->db->bind("updater", $_SESSION['data_disapu']['nama']);
      $this->db->execute();
      return $this->db->rowCount();
    }

    public function konfirm($data){
      $sql = "UPDATE tukar_poin SET status_checkout ='Y', tgl_checkout=:tgl, updater=:updater WHERE id_tukar=:id_tukar and id_hadiah=:id_hadiah and id_user=:id_user";
      $this->db->query($sql);
      $this->db->bind("tgl",date("Y-m-d h:i:s"));
      $this->db->bind("updater",$_SESSION['data_disapu']['nama']);
      $this->db->bind("id_tukar",$data['id_tukar']);
      $this->db->bind("id_hadiah",$data['id_hadiah']);
      $this->db->bind("id_user",$data['id_user']);
      $this->db->execute();
      return $this->db->rowCount();

    }
  }
?>