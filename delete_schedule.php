<?php
	session_start();
	require_once 'config.php';
	require_once 'connect_database.php';
	echo $_POST['schedule_id'];
	
	$query = "DELETE FROM schedule WHERE id = {$_POST['schedule_id']}";
	$res = pg_query($query);
	header("Location: $path/main.php");
?>