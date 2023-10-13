<?php
require_once 'config.php';
require_once 'connect_database.php';

	session_start();

	if(!isset($_SESSION['role']) || $_SESSION['role']!='Администратор' || !isset($_POST['dolz_id_del'])){
		header("Location: $path/logout.php");
		exit();
	}



	$query = "DELETE FROM dolz WHERE id='{$_POST['dolz_id_del']}'";
	$res = pg_query($query);
	pg_close($dbconn);
	header("Location: $path/admin.php");
?>