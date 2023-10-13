<?php
	require_once 'config.php';
	require_once 'connect_database.php';
	session_start();

	if(!isset($_SESSION['role']) || $_SESSION['role']!='Администратор' || !isset($_POST['role_add'])){
		header("Location: $path/logout.php");
		exit();
	}

	$query = "SELECT id FROM role WHERE name='{$_POST['role_add']}'";
	$res = pg_query($query);
	if(pg_num_rows($res)>0)
	{
		header("Location: $path/admin.php");
		pg_close($dbconn);
		exit();
	}

	$query="INSERT INTO role(name) VALUES('{$_POST['role_add']}')";
	$res = pg_query($query);
	pg_close($dbconn);
	header("Location: $path/admin.php");
	
?>