<?php
	require_once 'config.php';
	session_start();

	if(!isset($_SESSION['role']) || $_SESSION['role']!='Администратор' || !isset($_POST['user_add'])){
		header("Location: $path/logout.php");
		exit();
	}
	echo '<form action="admin.php" method="POST"><button type="submit">Админ</button></form>';

	$conn = "hostaddr=$host port=5432 dbname=$dbname user=$user password=$password";
	$dbconn = pg_connect($conn);

	$query = "SELECT id FROM users WHERE full_name='{$_POST['user_add']}'";
	$res = pg_query($query);
	if(pg_num_rows($res)>0)
	{
		echo "Такой пользователь уже есть";
		exit();
	}
	$query = "SELECT user_id FROM secure_info WHERE login='{$_POST['login']}'";
	$res = pg_query($query);
	if(pg_num_rows($res)>0)
	{
		echo "Логин занят";
		exit();
	}

	$query="INSERT INTO users(full_name,dolz_id) VALUES('{$_POST['user_add']}',{$_POST['dolz_id']})";
	$res = pg_query($query);
	$date = date($_POST['birthdate']);
	$query="INSERT INTO secure_info(user_id,password,date_of_birth,login) SELECT id,'{$_POST['password']}','{$date}','{$_POST['login']}' FROM users WHERE full_name='{$_POST['user_add']}'";
	$res = pg_query($query);
	echo $query;
	if($res)
	{
		echo "Добавлено";
	}
	//header("Location: $path/admin.php");
?>