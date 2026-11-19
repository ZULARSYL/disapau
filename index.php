<?php
	// error_reporting(0);
	// error_reporting(error_reporting() & ~E_NOTICE);
	// My session start function support timestamp management
	function my_session_start() {
		session_start();
		// Do not allow to use too old session ID
		if (!empty($_SESSION['deleted_time']) && $_SESSION['deleted_time'] < time() - 180) {
				session_destroy();
				session_start();
		}
	}
	
	if(!session_id())my_session_start();
	require_once 'app/init.php';

	$app = new App;

?>
