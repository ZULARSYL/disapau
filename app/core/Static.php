<?php

  //constant switch bulan forat indonesia
  function Bulan($bln){
    switch ($bln){
      case 1:
        return "Januari";
        break;
      case 2:
        return "Februari";
        break;
      case 3:
        return "Maret";
        break;
      case 4:
        return "April";
        break;
      case 5:
        return "Mei";
        break;
      case 6:
        return "Juni";
        break;
      case 7:
        return "Juli";
        break;
      case 8:
        return "Agustus";
        break;
      case 9:
        return "September";
        break;
      case 10:
        return "Oktober";
        break;
      case 11:
        return "November";
        break;
      case 12:
        return "Desember";
        break;
    }
  }

  //hari dalam bahasa indonesia
  function getHari($hari){
    switch ($hari){
      case 11:
        return "Senin";
        break;
      case 12:
        return "Selasa";
        break;
      case 13:
        return "Rabu";
        break;
      case 14:
        return "Kamis";
        break;
      case 15:
        return "Jum'at";
        break;
    }
  }

  //format tanggal bahasa indonesia
  function datetime_indo($tgl){
		$tanggal = explode(" ",$tgl);
		$t = explode("-",$tanggal[0]);
		$date_timeindo = $t[2]." ".Bulan($t[1])." ".$t[0]." ".$tanggal[1];
		return $date_timeindo;
	}

  //palet color peringkat
  function medal_color($peringkat){
    $color = "";
    if($peringkat=="gold"){
      $color = "#C9B037";
    }
    if($peringkat=="platinum"){
      $color = "#B4B4B4";
    }
    if($peringkat=="bronze"){
      $color = "#6A3805";
    }
    return $color;
  }

  //Masking Text menjadi *
  function masking_text(string $string = NULL){
    if (!$string) {
        return NULL;
    }
    $length = strlen($string);
    $visibleCount = (int) round($length / 4);
    $hiddenCount = $length - ($visibleCount * 2);
    return substr($string, 0, $visibleCount) . str_repeat('*', $hiddenCount) . substr($string, ($visibleCount * -1), $visibleCount);
  }


  //masking ke nominal rupiah
	function rupiah($nominal){
		$hasil = number_format($nominal,2,',','.');
		return $hasil;
	}

  //masking untuk edit nominal rupiah
	function rupiahedit($nominal){
		$hasil = number_format($nominal,2,",",".");
		return $hasil;
	}

  //convert rupiah ke text
	function penyebut($nilai) {
		$nilai = abs($nilai);
		$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		$temp = "";
		if ($nilai < 12) {
			$temp = " ". $huruf[$nilai];
		} else if ($nilai <20) {
			$temp = penyebut($nilai - 10). " belas";
		} else if ($nilai < 100) {
			$temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
		} else if ($nilai < 200) {
			$temp = " seratus" . penyebut($nilai - 100);
		} else if ($nilai < 1000) {
			$temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
		} else if ($nilai < 2000) {
			$temp = " seribu" . penyebut($nilai - 1000);
		} else if ($nilai < 1000000) {
			$temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
		} else if ($nilai < 1000000000) {
			$temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
		} else if ($nilai < 1000000000000) {
			$temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
		} else if ($nilai < 1000000000000000) {
			$temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
		}
		return $temp;
	}

  // convert rupiah ke text
	function terbilang($nilai) {
		if($nilai<0) {
			$hasil = "minus ". trim(penyebut($nilai));
		} else {
			$hasil = trim(penyebut($nilai));
		}
		return $hasil;
	}

  function randString($length) {
    $char = "ABCDEFGHJKMNPQRSTUVWXYZ23456789";
    $char = str_shuffle($char);
    for($i = 0, $rand = '', $l = strlen($char) - 1; $i < $length; $i ++) {
        $rand .= $char[mt_rand(0, $l)];
    }
    return $rand;
  }

  function poin_user($id){
    $db = new Database;
    $db->query("select * from poin_user where id_user=:id");
    $db->bind("id",$id);
    $db->execute();
    return $db->single();
  }
?>