<?php
class Riwayat_model {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getRiwayat($id_user) {
        $query = "SELECT * FROM transaksi WHERE id_user = :id_user";
        $this->db->query($query);
        $this->db->bind('id_user', $id_user);
        return $this->db->resultSet();
    }
    public function getRiwayatuser() {
        $query = "SELECT * FROM transaksi WHERE sifat = '1'";
        $this->db->query($query);
        return $this->db->resultSet();
    }
    public function getRiwayatuserDone() {
        $query = "SELECT * FROM transaksi WHERE sifat = '2'";
        $this->db->query($query);
        return $this->db->resultSet();
    }
    public function getRiwayatAsAdmin() {
        $query = "SELECT * FROM transaksi";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function cancelTransaction($id_transaksi, $jumlah_poin, $id_user) {
        // Hapus transaksi dari tabel transaksi
        $query = "DELETE FROM transaksi WHERE id_transaksi = :id_transaksi";
        $this->db->query($query);
        $this->db->bind('id_transaksi', $id_transaksi);
        $this->db->execute();
    
        // Tambahkan poin kembali ke akun pengguna
        $query2 = "UPDATE poin_user SET poin_now = poin_now + :jumlah_poin WHERE id_user = :id_user";
        $this->db->query($query2);
        $this->db->bind('jumlah_poin', $jumlah_poin);
        $this->db->bind('id_user', $id_user);
        return $this->db->execute();
    }

    public function kurangiStokHadiah($id_hadiah) {
        $query = "UPDATE hadiah SET stok_barang = stok_barang - 1 WHERE id_hadiah = :id_hadiah AND stok_barang > 0";
        $this->db->query($query);
        $this->db->bind('id_hadiah', $id_hadiah);
        return $this->db->execute();
    }
    

    public function terimaTransaksi($id_transaksi, $id_admin, $nama_admin, $id_hadiah) {
        // Kurangi stok hadiah
        $this->kurangiStokHadiah($id_hadiah);
    
        // Update transaksi
        $query = "UPDATE transaksi 
                  SET tgl_checkout = NOW(), 
                      id_admin = :id_admin, 
                      nama_admin = :nama_admin, 
                      sifat = 2 
                  WHERE id_transaksi = :id_transaksi";
        $this->db->query($query);
        $this->db->bind('id_admin', $id_admin);
        $this->db->bind('nama_admin', $nama_admin);
        $this->db->bind('id_transaksi', $id_transaksi);
        return $this->db->execute();
    }

    public function getRiwayatBySifat($sifat, $id_user) {
        $query = "SELECT * FROM transaksi WHERE sifat = :sifat AND id_user = :id_user";
        $this->db->query($query);
        $this->db->bind('sifat', $sifat);
        $this->db->bind('id_user', $id_user);
        return $this->db->resultSet();
    }
    
}
?>
