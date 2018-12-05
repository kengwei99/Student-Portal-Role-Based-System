<?php
	session_start();

	//admin session unset
	unset($_SESSION['adminUsername']);

	//manager session unset
	unset($_SESSION['managerUsername']);

	//co-ordiantor session unset
	unset($_SESSION['coordinatorUsername']);

	//student session unset
	unset($_SESSION['studentUsername']);



	//redirect to login page
	header('Location: index.php');
?>