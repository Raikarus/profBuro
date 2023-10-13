<?php
	require_once 'config.php';
	require_once 'connect_database.php';
	session_start();

	if(!isset($_SESSION['role']) || $_SESSION['role']!='Администратор' || !isset($_POST['role_up'])){
		header("Location: $path/logout.php");
		exit();
	}

	$query = "SELECT id FROM role WHERE name='{$_POST['role_newname']}'";
	$res = pg_query($query);

	if(pg_num_rows($res)>0)
	{
		header("Location: $path/admin.php");
		pg_close($dbconn);
		exit();
	}

	$query="UPDATE role SET name='{$_POST['role_newname']}' WHERE id={$_POST['role_up']}";
	$res = pg_query($query);
	pg_close($dbconn);
	header("Location: $path/admin.php");
?>