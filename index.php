<?php 
	require_once 'config.php';
	
	session_start();
	
	$conn = "hostaddr=$host port=5432 dbname=$dbname user=$user password=$password";
	$dbconn = pg_connect($conn);
	if(isset($_SESSION['user_id']))
	{
		header("Location: $path/main.php");
		exit();
	}
	if(isset($_POST['lgn']) && isset($_POST['pwd'])) {
		$login = $_POST['lgn'];
		$password = $_POST['pwd'];

		$query = "SELECT user_id FROM secure_info WHERE login='$login' AND password='$password'";
		$res = pg_query($query);
		$res = pg_fetch_assoc($res);
		if($res['user_id']>0)
		{
			$user_id = $res['user_id'];
			$_SESSION['user_id'] = $user_id;
			$query = "SELECT dolz.name AS dolz,role.name AS role, full_name AS user, nickname FROM users JOIN dolz ON users.dolz_id=dolz.id JOIN role ON dolz.role_id=role.id JOIN secure_info ON users.id=user_id WHERE users.id=$user_id";
			$res = pg_query($query);
			$res = pg_fetch_assoc($res);
			$_SESSION['dolz'] = $res['dolz'];
			$_SESSION['role'] = $res['role'];
			$_SESSION['user'] = $res['user'];
			$_SESSION['nickname'] = $res['nickname'];
			header("Location: $path/main.php");
			exit();
		} else {
			$error = "Неверный логин и/или пароль";
		}
	}
?>

<!DOCTYPE html>
<html lang='ru'>

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
    <link rel="stylesheet" type="text/css" href="style_index.css">
</head>

<body>
	<div id="access_form" >
		<form method="POST">
			<div>
				<label for="lgn">Логин:</label>
				<input type="text" name="lgn" required>
			</div>	<div>
				<label for="pwd">Пароль:</label>
				<input type="password" name="pwd" required>
			</div>
			<input type="submit" value="Войти">
		</form>
	</div>
		<?php 
			if(isset($error)){
				echo "<div id='error'>$error</div>";
			}
		 ?>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script type="text/javascript" src="script_index.js"></script>
</body>

</html>