<?php
require_once 'config.php';
	session_start();

	if(!isset($_SESSION['role']) || $_SESSION['role']!='Администратор' || !isset($_POST['dolz_id_del'])){
		header("Location: $path/logout.php");
		exit();
	}

	$conn = "hostaddr=$host port=5432 dbname=$dbname user=$user password=$password";
	$dbconn = pg_connect($conn);

	$query = "DELETE FROM dolz WHERE id='{$_POST['dolz_id_del']}'";
	$res = pg_query($query);
	pg_close($dbconn);
	header("Location: $path/admin.php");
?>