<?php
	require_once 'config.php';
	require_once 'connect_database.php';
	session_start();

	if(!isset($_SESSION['role']) || $_SESSION['role']!='Администратор' || !isset($_POST['user_add'])){
		header("Location: $path/logout.php");
		exit();
	}
	echo '<form action="admin.php" method="POST"><button type="submit">Админ</button></form><br>';

	$query = "SELECT id FROM users WHERE full_name='{$_POST['user_add']}'";
	$res = pg_query($query);
	if(pg_num_rows($res)>0)
	{
		echo "Такой пользователь уже есть";
		pg_close($dbconn);
		exit();
	}
	$query = "SELECT user_id FROM secure_info WHERE login='{$_POST['login']}' OR nickname='{$_POST['nickname']}'";
	$res = pg_query($query);
	if(pg_num_rows($res)>0)
	{
		echo "Логин занят";
		pg_close($dbconn);
		exit();
	}

	$query="INSERT INTO users(full_name,dolz_id) VALUES('{$_POST['user_add']}',{$_POST['dolz_id']})";
	$res = pg_query($query);
	$date = date($_POST['birthdate']);
	$query="INSERT INTO secure_info(user_id,password,date_of_birth,login,nickname) SELECT id,'{$_POST['password']}','{$date}','{$_POST['login']}','{$_POST['nickname']}' FROM users WHERE full_name='{$_POST['user_add']}'";
	$res = pg_query($query);
	pg_close($dbconn);
	echo $query;
	if($res) {
		echo "<br><b>Добавлено</b>";
	}
	else{
		echo "<br><b>Ошибка</b>";
	}
	//header("Location: $path/admin.php");
?>