<?php
	require_once 'config.php';
	require_once 'connect_database.php';
	session_start();

	if(!isset($_SESSION['role']) || $_SESSION['role']!='Администратор' || !isset($_POST['user_id_up'])){
		header("Location: $path/logout.php");
		exit();
	}
	echo '<form action="admin.php" method="POST"><button type="submit">Админ</button></form><br>';

	$query_users = "";
	$query_secure_info = "";


	if(strlen($_POST['user_new_nickname'])!=0){
		$query = "SELECT user_id FROM secure_info WHERE nickname='{$_POST['user_new_nickname']}'";
		check_query($query);
		$query_secure_info .= "nickname='{$_POST['user_new_nickname']}'";
	}

	if(strlen($_POST['birthdate'])!=0){
		$date = date($_POST['birthdate']);
		if(strlen($query_secure_info)!=0){
			$query_secure_info .= ", ";
		}
		$query_secure_info .= "date_of_birth='{$date}'";
	}

	if(strlen($_POST['user_new_login'])!=0){
		$query = "SELECT user_id FROM secure_info WHERE login='{$_POST['user_new_login']}'";
		check_query($query);
		if(strlen($query_secure_info)!=0){
			$query_secure_info .= ", ";
		}
		$query_secure_info .= "login='{$_POST['user_new_login']}'";
	}

	if(strlen($_POST['user_new_password'])!=0){
		if(strlen($query_secure_info)!=0){
			$query_secure_info .= ", ";
		}
		$query_secure_info .= " password='{$_POST['user_new_password']}'";
	}

	if(strlen($_POST['dolz_id_up'])!=0){
		$query_users .= "dolz_id='{$_POST['dolz_id_up']}'";
	}

	if(strlen($_POST['user_new_name'])!=0){
		$query = "SELECT id FROM users WHERE full_name='{$_POST['user_new_name']}'";
		check_query($query);
		if(strlen($query_users)!=0){
			$query_users .= ", ";
		}
		$query_users .= "name='{$_POST['user_new_name']}' ";
	}

	if(strlen($query_users)!=0) {
		$query="UPDATE users SET {$query_users} WHERE id={$_POST['user_id_up']}";
		$res = pg_query($query);
	}
	if(strlen($query_secure_info)!=0) {
		$query="UPDATE secure_info SET {$query_secure_info} WHERE user_id={$_POST['user_id_up']}";
		$res = pg_query($query);
	}
	pg_close($dbconn);
	function check_query($query){
		$res = pg_query($query);
		if(pg_num_rows($res)>0)
		{
			echo $query."<br>Не работает";
			//header("Location: $path/admin.php");
			pg_close($dbconn);
			exit();
		}
	}
?>

