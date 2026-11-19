<?php

  class m_serverside{

    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function recordServerSide($id,$data){
      $sql = "select trans.*, debet.nama_akun as debet, kredit.nama_akun as kredit from tbl_transaksi_keuangan trans, tbl_akun_akuntansi debet, tbl_akun_akuntansi kredit where trans.id_kantor_cabang ='".$id."' and debet.id_akun = trans.id_debet and kredit.id_akun = trans.id_kredit ";
      $column_order = array(null, 'id_transaksi','tgl_nota','nama_transaksi','debet','kredit','nominal','updater'); //field yang ada di table user
      $column_search = array('id_transaksi','tgl_nota','nama_transaksi','debet','kredit','nominal','updater'); //field yang diizin untuk pencarian 
      $order = array('tgl_nota' => " STR_TO_DATE(tgl_nota,'%Y-%m-%d') DESC, id_transaksi DESC"); // default order

      // $this->db->from($this->table);
 		    $i = 0;
        $search = "";
    		foreach ($column_search as $item) { // looping awal
					if($data['search']['value']){ // jika datatable mengirimkan pencarian dengan metode POST
            $search .= " AND ( ";
						if($i===0){ // looping awal
							$search .= $item." LIKE '%".$_POdataST['search']['value']."%' ";
						}else{
							$search .= " OR ".$item." LIKE '%".$data['search']['value']."%' ";
						}
						if(count($column_search) - 1 == $i) $search .= ")"; 
					}
          $i++;
        }
         
        if(isset($data['order'])) {
          $order = " ORDER BY ".$column_order[$data['order']['0']['column']].",". $data['order']['0']['dir']." LIMIT ".$data['start']." ,".$data['length'];
        } 
        else if(isset($order)){
					$order = $order;
        }
      return "SQL : ".$sql." Search: ".$search." ORDER : ".$order;

    }

    public function record_transaksi($id){
      $this->db->query("select trans.*, debet.nama_akun as debet, kredit.nama_akun as kredit from tbl_transaksi_keuangan trans, tbl_akun_akuntansi debet, tbl_akun_akuntansi kredit where trans.id_kantor_cabang =:id and debet.id_akun = trans.id_debet and kredit.id_akun = trans.id_kredit order by STR_TO_DATE(tgl_nota,'%Y-%m-%d') DESC, id_transaksi DESC");
      $this->db->bind("id",$id);
      $this->db->execute();
      return $this->db->resultSet();
    }

    public function record_data($sql){
      $this->db->query($sql);
      return $this->db->resultSet();
    }

  }
?>