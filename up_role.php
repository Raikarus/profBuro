<?php
	require_once 'config.php';
	session_start();

	if(!isset($_SESSION['role']) || $_SESSION['role']!='Администратор' || !isset($_POST['role_up'])){
		header("Location: $path/logout.php");
		exit();
	}

	$conn = "hostaddr=$host port=5432 dbname=$dbname user=$user password=$password";
	$dbconn = pg_connect($conn);

	$query = "SELECT id FROM role WHERE name='{$_POST['role_newname']}'";
	$res = pg_query($query);

	if(pg_num_rows($res)>0)
	{
		header("Location: $path/admin.php");
		exit();
	}

	$query="UPDATE role SET name='{$_POST['role_newname']}' WHERE id={$_POST['role_up']}";
	$res = pg_query($query);
	header("Location: $path/admin.php");
?>