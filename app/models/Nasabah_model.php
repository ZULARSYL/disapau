<?php
    class Nasabah_model{
        private $tabel = 'user';
        private $db;

        public function __construct() {
            $this->db = new Database;
        }

        public function getNasabah(){
            $this->db->query('SELECT u.*, p.poin_now FROM user u, poin_user p where p.id_user = u.id_user and u.id_level=1');
            return $this->db->resultSet();
        }

        public function getTotalPoin(){
            $this->db->query('SELECT sum(poin_now) as poin FROM `poin_user`');
            return $this->db->single();
        }

        public function getStatistic(){
            $this->db->query("select SUM(if(jk = 'Laki-laki', 1, 0)) AS l, SUM(if(jk = 'Perempuan', 1, 0)) AS p from user WHERE id_level = 1");
            return $this->db->single();
        }

        public function getJmlhadmin(){
            $this->db->query('SELECT COUNT(*) AS jmlh_admin FROM '.$this->tabel.' WHERE id_level = 2');
            return $this->db->single()['jmlh_admin'];
        }

        public function getJmlhuser(){
            $this->db->query('SELECT COUNT(*) AS jmlh_user FROM '.$this->tabel.' WHERE id_level = 1');
            return $this->db->single()['jmlh_user'];
        }

        public function check_username(){

        }

        public function detail_user($id){
            $this->db->query("select * from user where id_user=:id");
            $this->db->bind("id",$id);
            $this->db->execute();
            return $this->db->single();
        }

        public function create_poin($id){
            $sql="INSERT INTO poin_user(id_user, poin_in, poin_out, poin_now, updater) VALUES(:id_user, :poin_in, :poin_out, :poin_now, :updater)";
            $this->db->query($sql);
            $this->db->bind("id_user",$id);
            $this->db->bind("poin_in", "0");
            $this->db->bind("poin_out", "0");
            $this->db->bind("poin_now", "0");
            $this->db->bind("updater",$_SESSION['data_disapu']['nama']);
            $this->db->execute();
            return $this->db->rowCount();
        }

        public function simpan_user($data){
            $sql = "INSERT INTO `user`(id_user, `username`, `password`, `hash_password`, `nama`, `alamat`, `no_telp`,  `updater`, rt, rw, nik, jk, dusun, id_level) VALUES(:id, :username_inp, :password_inp, :hash_password, :nama_inp, :alamat_inp, :no_telp, :updater, :rt_inp, :rw_inp, :nik_inp, :jk, :dusun_inp, :id_level)";
            $this->db->query($sql);
            $this->db->bind("id",$data['id_user']); 
            $this->db->bind("username_inp",$data['username']); 
            $this->db->bind("password_inp",$data['password']);
            $this->db->bind("hash_password",md5($data['password']));
            $this->db->bind("nama_inp",$data['nama']);
            $this->db->bind("nik_inp",$data['nik']);
            $this->db->bind("jk",$data['jk']);
            $this->db->bind("rt_inp",$data['rt']);
            $this->db->bind("rw_inp",$data['rw']);
            $this->db->bind("dusun_inp",$data['dusun']);
            $this->db->bind("alamat_inp",$data['kelurahan']);
            $this->db->bind("id_level",'1');
            $this->db->bind("no_telp",$data['notelp']);
            $this->db->bind("updater",$_SESSION['data_disapu']['nama']);
            $this->db->execute();
            return $this->db->rowCount();
        }

        public function update_user($data){
            $sql = "UPDATE user set username=:username_inp, password=:password_inp, hash_password=:hash_password, nama=:nama_inp, alamat=:alamat_inp, no_telp=:no_telp,  updater=:updater, rt=:rt_inp, rw=:rw_inp, nik=:nik_inp, jk=:jk_inp, dusun=:dusun_inp, tgl_update=:tgl_update where id_user=:id";
            $this->db->query($sql);
            $this->db->bind("id",$data['id_user_edit']); 
            $this->db->bind("username_inp",$data['username_edit']); 
            $this->db->bind("password_inp",$data['password_edit']);
            $this->db->bind("hash_password",md5($data['password_edit']));
            $this->db->bind("nama_inp",$data['nama_edit']);
            $this->db->bind("nik_inp",$data['nik_edit']);
            $this->db->bind("jk_inp",$data['jk_edit']);
            $this->db->bind("rt_inp",$data['rt_edit']);
            $this->db->bind("rw_inp",$data['rw_edit']);
            $this->db->bind("dusun_inp",$data['dusun_edit']);
            $this->db->bind("alamat_inp",$data['kelurahan_edit']);
            $this->db->bind("no_telp",$data['notelp_edit']);
            $this->db->bind("tgl_update",date("Y-m-d h:i:s"));
            $this->db->bind("updater",$_SESSION['data_disapu']['nama']);
            $this->db->execute();
            return $this->db->rowCount();
        }

        public function hapus_user($id){
            $sql = "DELETE FROM user where id_user=:id";
            $this->db->query($sql);
            $this->db->bind("id",$id);
            $this->db->execute();
            return $this->db->rowCount();
        }

    }

?>