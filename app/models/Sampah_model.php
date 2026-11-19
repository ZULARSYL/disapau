<?php
    class Sampah_model{
        private $tabel = 'sampah';
        private $db;

        public function __construct() {
            $this->db = new Database;
        }

        public function detail_kategori($id){
            $sql = "select * from kategori_sampah where id_kategori=:id";
            $this->db->query($sql);
            $this->db->bind("id",$id);
            $this->db->execute();
            return $this->db->single();
        }

        public function check_sub_kategori($id){
            $sql = "select * from sampah where id_kategori=:id";
            $this->db->query($sql);
            $this->db->bind("id",$id);
            $this->db->execute();
            return $this->db->rowCount();
        }

        public function check_trans_sampah($id){
            $sql = "select * from transaksi where id_sampah=:id";
            $this->db->query($sql);
            $this->db->bind("id",$id);
            $this->db->execute();
            return $this->db->rowCount();
        }

        public function getSubkategori($id=""){
            $this->db->query("select * from ".$this->tabel."");
            $this->db->execute();
            return $this->db->resultSet();
        }

        public function getSubKategoriSampah($id){
            $sql = "select * from sampah where id_kategori=:id";
            $this->db->query($sql);
            $this->db->bind("id",$id);
            $this->db->execute();
            return $this->db->resultSet();
        }

        public function getSampah(){
            $this->db->query('SELECT '.$this->tabel.'.*, kategori_sampah.kategori FROM '.$this->tabel.' JOIN kategori_sampah ON sampah.id_kategori = kategori_sampah.id_kategori');
            return $this->db->resultSet();
        }

        public function getKategori(){
            $this->db->query('SELECT * FROM `kategori_sampah`');
            return $this->db->resultSet();
        }

        public function detail_sampah_byid($id){
            $this->db->query("SELECT s.*, k.kategori FROM sampah s, kategori_sampah k WHERE k.id_kategori = s.id_kategori and s.id_sampah=:id ");
            $this->db->bind("id",$id);
            $this->db->execute();
            return $this->db->single();
        }
        
        // public function getSubkategori(){
        //     $this->db->query('SELECT * FROM `sampah`');
        //     return $this->db->resultSet();
        // }
        public function getKategoribyId($id){
            $this->db->query('SELECT * FROM `kategori_sampah` WHERE id_kategori=:id');
            $this->db->bind('id_kategori',$id);
            return $this->db->single();
        }

        public function simpan_kategori($data){
            $sql = "insert into kategori_sampah(kategori,deskripsi,updater) values(:kategori,:deskripsi,:updater)";
            $this->db->query($sql);
            $this->db->bind("kategori",$data['kategori']);
            $this->db->bind("deskripsi",$data['deskripsi']);
            $this->db->bind("updater",$_SESSION['data_disapu']['nama']);
            $this->db->execute();
            return $this->db->rowCount();
        }

        public function update_kategori($data){
            $sql = "update kategori_sampah set kategori=:kategori, deskripsi=:deskripsi, updater=:updater, tgl_update=:tgl_update where id_kategori=:id_kategori";
            $this->db->query($sql);
            $this->db->bind("id_kategori",$data['id_kategori_edit']);
            $this->db->bind("kategori",$data['kategori_edit']);
            $this->db->bind("deskripsi",$data['deskripsi_edit']);
            $this->db->bind("updater",$_SESSION['data_disapu']['nama']);
            $this->db->bind("tgl_update",date("Y-m-d h:i:s"));
            $this->db->execute();
            return $this->db->rowCount();
        }

        public function hapus_kategori($id){
            $this->db->query("delete from kategori_sampah where id_kategori=:id");
            $this->db->bind("id",$id);
            $this->db->execute();
            return $this->db->rowCount();
        }

        public function hapus_sampah($id){
            $this->db->query("delete from sampah where id_sampah=:id");
            $this->db->bind("id",$id);
            $this->db->execute();
            return $this->db->rowCount();
        }

        public function nilai_tukar(){
            $this->db->query("select * from kurs_poin where id='1'");
            $this->db->execute();
            return $this->db->single();
        }

        public function min_poin(){
            $this->db->query("select min(harga_beli) as minpoin from sampah");
            return $this->db->single();
        }

        public function update_min_poin($poin){
            $this->db->query("INSERT INTO kurs_poin(id, poin, kurs) values(:id,:poin,:kurs) ON DUPLICATE KEY UPDATE id=VALUES(id), poin=VALUES(poin), kurs=VALUES(kurs)");
            $this->db->bind("id",'1');
            $this->db->bind("poin",'1');
            $this->db->bind("kurs",$poin);
            $this->db->execute();
            return $this->db->rowCount();
        }

        public function simpan_sampah($data,$gambar){
            $sql = "INSERT INTO sampah(id_kategori, nama_klasifikasi, satuan_berat, harga_beli, harga_jual, updater, nama_file) values(:id_kategori, :nama_klasifikasi, :satuan_berat, :harga_beli, :harga_jual, :updater, :nama_file)";
            $this->db->query($sql);
            $this->db->bind("id_kategori",$data['pilih_kategori']); 
            $this->db->bind("nama_klasifikasi",$data['nama_sampah']);
            $this->db->bind("satuan_berat",$data['satuan_beli']);
            $this->db->bind("harga_beli",$data['harga_beli']);
            $this->db->bind("harga_jual",$data['harga_jual']);
            $this->db->bind("nama_file",$gambar);
            $this->db->bind("updater",$_SESSION['data_disapu']['nama']);
            $this->db->execute();
            return $this->db->rowCount();
        }

        public function update_sampah($data,$gambar){
            $d = $this->detail_sampah_byid($data['id_sampah']);
            if($gambar==""){
                $nama_file = $d['nama_file'];
            }else{
                $nama_file = $gambar;
            }
            $sql = "UPDATE sampah SET id_kategori=:id_kategori, nama_klasifikasi=:nama_klasifikasi, satuan_berat=:satuan_berat, harga_beli=:harga_beli, harga_jual=:harga_jual, updater=:updater, nama_file=:nama_file, tgl_update=:tgl_update where id_sampah=:id";
            $this->db->query($sql);
            $this->db->bind("id",$data['id_sampah']); 
            $this->db->bind("id_kategori",$data['pilih_kategori_edit']); 
            $this->db->bind("nama_klasifikasi",$data['nama_sampah_edit']);
            $this->db->bind("satuan_berat",$data['satuan_beli_edit']);
            $this->db->bind("harga_beli",$data['harga_beli_edit']);
            $this->db->bind("harga_jual",$data['harga_jual_edit']);
            $this->db->bind("nama_file",$nama_file);
            $this->db->bind("updater",$_SESSION['data_disapu']['nama']);
            $this->db->bind("tgl_update",date("Y-m-d h:i:s"));
            $this->db->execute();
            return $this->db->rowCount();
        }
    }

?>