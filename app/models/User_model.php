<?php

  class User_model{

    private $db;
    public function __construct() {
        $this->db = new Database;
    }
  
    public function getDataUser(){
      $this->db->query("select * from user where id_level='1'");
      return $this->db->resultSet();
    }
  
  }

?>