<?php session_start();
	if (isset($_SESSION['usuario'])) {
		session_destroy();
		$_SESSION = array();
		header('location: login.php');
	} else {
		echo "asdsadsad";
	}
?>