<?php
	require_once 'config.php';
	session_start();
	if(!isset($_SESSION['user_id'])){
		header("Location: $path/index.php");
		exit();
	}
	echo "Добро пожаловать!";

	$conn = "hostaddr=$host port=5432 dbname=$dbname user=$user password=$password";
	$dbconn = pg_connect($conn);
	$query = "SELECT name FROM role WHERE id=".$_SESSION['role_id'];
	$res = pg_query($query);
	$_SESSION['role'] = pg_fetch_assoc($res)['name'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Главная</title>
</head>
<body>
	<form action="logout.php" method="POST">
		<button type="submit">Выйти</button>
	</form>
	<?php
	if($_SESSION['role']=="Администратор"){
	?>
		<form action="admin.php" method="POST">
			<button type="submit">Админ</button>
		</form>
	<?php
	}
	?>
</body>
</html>