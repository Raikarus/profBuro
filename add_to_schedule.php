<?php
	require_once 'config.php';
	require_once 'connect_database.php';
	session_start();

	if(!isset($_SESSION['user_id']) || !isset($_POST['shift_date'])){
		header("Location: $path/logout.php");
		exit();
	}

	$shift_date = date($_POST['shift_date']);
	$start_time = date('H:i:s', strtotime($_POST['start_time']));
	$end_time = date('H:i:s', strtotime($_POST['end_time']));

	$diff_minutes = floor((strtotime($_POST['end_time'])-strtotime($_POST['start_time']))/60);

	$query = "INSERT INTO schedule(user_id,shift_date,start_time,end_time,notes,total_time_min) VALUES({$_SESSION['user_id']},'{$shift_date}','{$start_time}','{$end_time}','{$_POST['notes']}',{$diff_minutes})";
	echo $query;

	$res = pg_query($query);

	if($res) {
		echo "<br><b>Добавлено</b>";
	}
	else{
		echo "<br><b>Ошибка</b>";
	}
	pg_close($dbconn);
	header("Location: $path/main.php")
?>