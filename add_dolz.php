<?php
	require_once 'config.php';
	session_start();

	if(!isset($_SESSION['role']) || $_SESSION['role']!='Администратор' || !isset($_POST['dolz_add'])){
		header("Location: $path/logout.php");
		exit();
	}

	$conn = "hostaddr=$host port=5432 dbname=$dbname user=$user password=$password";
	$dbconn = pg_connect($conn);

	$query = "SELECT id FROM dolz WHERE name='{$_POST['dolz_add']}'";
	$res = pg_query($query);
	if(pg_fetch_assoc($res))
	{
		header("Location: $path/admin.php");
		exit();
	}

	$query="INSERT INTO dolz(name,role_id) VALUES('{$_POST['dolz_add']}',{$_POST['role_id']})";
	$res = pg_query($query);
	header("Location: $path/admin.php");
?>