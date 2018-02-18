<?php 
	session_start();
	if (!isset($_SESSION['customer'])) {
		header("Location: index.php");
	} else if(isset($_SESSION['customer'])!="") {
		header("Location: home.php");
	}

	if (isset($_GET['logout'])) {
		unset($_SESSION['customer']);
		session_unset();
		session_destroy();
		header("Location: index.php");
		exit;
	}
 ?>