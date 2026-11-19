<?php
    class TukarPoin extends Controller {

        public function index(){
            $data['hadiah'] = $this->model("Tukar_model")->getStok();
            $data['token_screetkey'] = hash_hmac('sha256', KUNCITOKEN, $_SESSION['crfs']);
            $id_user = $_SESSION['data_disapu']['id_user'];
            if($_SESSION['data_disapu']['level'] == 1){
                $data['poin_now'] = $this->model("Tukar_model")->getPoin($id_user)['poin_now'];
            }
            $this->view('Templates/header');
            $this->view('TukarPoin/index', $data);
            $this->view('Templates/footer');
        }

        public function check_out(){
            
        }

        public function tukarPoin() {
            $id_user = $_POST['id_user'];
            $id_hadiah = $_POST['id_hadiah'];
            $user_poin = $this->model("Tukar_model")->getPoin($id_user)['poin_now'];
            $namahadiah = $_POST['nama_hadiah'];
            $total_poin = $_POST['poin'];
            $stok = $_POST['stok_barang'];

            if ($stok > 0) {
                if ($user_poin >= $total_poin) {
                    $data = [
                        'id_hadiah' => $id_hadiah,
                        'nama_hadiah' => $namahadiah,
                        'jumlah_poin' => $total_poin,
                        'id_user' => $id_user,
                        'nama_user' => $_SESSION['data_disapu']['nama'],
                        'tgl_input' => date('Y-m-d H:i:s'),
                        'tgl_checkout' => null,
                        'sifat' => 1
                    ];

                    if ($this->model("Tukar_model")->penukaran($data) > 0) {
                        // Kurangi poin pengguna
                        $this->model("Tukar_model")->kurangiPoin($id_user, $total_poin);
                        $_SESSION['message'] = "Penukaran berhasil.";
                    } else {
                        $_SESSION['message'] = "Penukaran gagal. Error in SQL execution.";
                        $this->model("Tukar_model")->kurangiPoin($id_user, $total_poin);

                    }
                } else {
                    $_SESSION['message'] = "Poin Anda tidak mencukupi.";
                }
            } else {
                $_SESSION['message'] = "Maaf, stok saat ini sedang kosong.";
            }

            header('Location: ' . BASEURL . 'TukarPoin');
            exit;
        }



    }
?>
