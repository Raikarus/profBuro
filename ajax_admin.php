<?php
	require_once 'config.php';
	require_once 'connect_database.php';
	session_start();

	if(!isset($_SESSION['role']) || $_SESSION['role']!='Администратор' || !isset($_POST['action'])){
		header("Location: $path/logout.php");
		exit();
	}

	$action = $_POST['action'];

	switch ($action) {
		case 'users':
			$result = show_users();
			break;
		case 'role':
			$result = show_role();
			break;
		default:
			$result = 'Неизвестная ошибка';
			break;
	}
	
	pg_close($dbconn);
	echo $result;

	function show_users(){
		$query="SELECT full_name,dolz.name AS dolz_name,date_of_birth,login,password,role.name  AS role_name,nickname FROM users JOIN secure_info ON users.id=secure_info.user_id JOIN dolz ON dolz_id=dolz.id JOIN role ON role_id=role.id";
		$res = pg_query($query);

		$return = "<table>";
			$return .= "<tr>";
				$return .= "<th>";
				$return .= "ФИО:";
				$return .= "</th><th>";
				$return .= "Должность:";
				$return .= "</th><th>";
				$return .= "Дата рождения:";
				$return .= "</th><th>";
				$return .= "Логин:";
				$return .= "</th><th>";
				$return .= "Пароль:";
				$return .= "</th><th>";
				$return .= "Роль:</th>";
			$return .= "</tr>";
		while ($user = pg_fetch_assoc($res)) {
			$return .= "<tr>";
				$return .= "<td title='{$user['nickname']}'>";
				$return .= $user['full_name'];
				$return .= "</td><td>";
				$return .= $user['dolz_name'];
				$return .= "</td><td>";
				$return .= $user['date_of_birth'];
				$return .= "</td><td>";
				$return .= $user['login'];
				$return .= "</td><td>";
				$return .= $user['password'];
				$return .= "</td><td>";
				$return .= $user['role_name'];
				$return .= "</td>";
			$return .= "</tr>";
		}
		$return .= '</table>';
		return $return;
	}

	function show_role(){
		$query="SELECT dolz.name AS dolz_name,role.name AS role_name FROM role JOIN dolz ON role.id=role_id";
		$res = pg_query($query);

		$return = "<table>";
			$return .= "<tr>";
				$return .= "<th>";
				$return .= "Должность:";
				$return .= "</th><th>";
				$return .= "Роль:</th>";
			$return .= "</tr>";
		while ($user = pg_fetch_assoc($res)) {
			$return .= "<tr>";
				$return .= "<td>";
				$return .= $user['dolz_name'];
				$return .= "</td><td>";
				$return .= $user['role_name'];
				$return .= "</td>";
			$return .= "</tr>";
		}
		$return .= '</table>';
		return $return;
	}

?>