<?php
	require_once 'config.php';
	session_start();

	if(!isset($_SESSION['role']) || $_SESSION['role']!='Администратор' || !isset($_POST['role_add'])){
		header("Location: $path/logout.php");
		exit();
	}

	$conn = "hostaddr=$host port=5432 dbname=$dbname user=$user password=$password";
	$dbconn = pg_connect($conn);

	$query = "SELECT id FROM role WHERE name='{$_POST['role_add']}'";
	$res = pg_query($query);
	if($res)
	{
		echo "<script>alert('{$_POST['role_add']} уже существует');</script>";
		header("Location: $path/admin.php");
		exit();
	}

	$query="INSERT INTO role(name) VALUES('".$_POST['role_add']."')";
	$res = pg_query($query);
	header("Location: $path/admin.php");
	
?>