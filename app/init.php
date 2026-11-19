<?php
    // error_reporting(0);
	error_reporting(error_reporting() & ~E_NOTICE);
	
 	require_once 'config/config.php';
	if(empty($_SESSION['crfs'])){
		$_SESSION['crfs'] = bin2hex(random_bytes(32));
		//membuat token screet key
		$csrf = hash_hmac('sha256', KUNCITOKEN, $_SESSION['crfs']);
	}
	require_once 'core/App.php';
	require_once 'core/Controller.php';
	require_once 'core/Database.php';
	require_once 'core/Flasher.php';
	require_once 'core/Static.php';

	date_default_timezone_set('Asia/Jakarta');
?>