<?php
	require_once 'config.php';
	session_start();

	if(!isset($_SESSION['role']) || $_SESSION['role']!='Администратор' || !isset($_POST['user_id_del'])){
		header("Location: $path/logout.php");
		exit();
	}

	$conn = "hostaddr=$host port=5432 dbname=$dbname user=$user password=$password";
	$dbconn = pg_connect($conn);

	$query = "DELETE FROM users WHERE id='{$_POST['user_id_del']}'";
	$res = pg_query($query);

	header("Location: $path/admin.php");
?>