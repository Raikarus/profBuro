<?php
	require_once 'config.php';
	require_once 'connect_database.php';
	session_start();

	if(!isset($_SESSION['role']) || $_SESSION['role']!='Администратор' || !isset($_POST['dolz_add'])){
		header("Location: $path/logout.php");
		exit();
	}	

	$query = "SELECT id FROM dolz WHERE name='{$_POST['dolz_add']}'";
	$res = pg_query($query);
	if(pg_num_rows($res)>0)
	{
		header("Location: $path/admin.php");
		pg_close($dbconn);
		exit();
	}

	$query="INSERT INTO dolz(name,role_id) VALUES('{$_POST['dolz_add']}',{$_POST['role_id']})";
	$res = pg_query($query);
	pg_close($dbconn);
	header("Location: $path/admin.php");
?>