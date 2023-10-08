<?php
	require_once 'config.php';
	session_start();

	if(!isset($_SESSION['role']) || $_SESSION['role']!='Администратор' || !isset($_POST['user_add'])){
		header("Location: $path/logout.php");
		exit();
	}

?>