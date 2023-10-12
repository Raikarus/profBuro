<?php
	require_once 'config.php';
	session_start();

	if(!isset($_SESSION['user_id']) || !isset($_POST['shift_date'])){
		header("Location: $path/logout.php");
		exit();
	}

	$conn = "hostaddr=$host port=5432 dbname=$dbname user=$user password=$password";
	$dbconn = pg_connect($conn);

	$shift_date = date($_POST['shift_date']);
	$start_time = date('H:i:s', strtotime($_POST['start_time']));
	$end_time = date('H:i:s', strtotime($_POST['end_time']));

	$query = "INSERT INTO schedule(user_id,shift_date,start_time,end_time,notes) VALUES({$_SESSION['user_id']},'{$shift_date}','{$start_time}','{$end_time}','{$_POST['notes']}')";
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