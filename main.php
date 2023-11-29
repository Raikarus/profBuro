<?php
	require_once 'config.php';
	require_once 'connect_database.php';
	session_start();
	if(!isset($_SESSION['user_id'])){
		header("Location: $path/index.php");
		exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Главная</title>
	<link rel="stylesheet" type="text/css" href=
	<?php
		echo "{$path}/style_main.css";
	?>
	>
</head>
<body>
	
	<header>
		<span id="welcome">Добро пожаловать, 
			<?php
				echo $_SESSION['nickname'];
			?>
		</span>
		<?php
		if($_SESSION['role']=="Администратор"){
		?>
			<form action=
			<?php
				echo "{$path}/admin.php";
			?> method="POST">
				<button type="submit">Админ</button>
			</form>
		<?php
		}
		if($_SESSION['role']!="Пользователь"){
		?>
			<a href=
			<?php
				echo "{$path}/main.php/?page=moderator";
			?>
			><button>Модератор</button></a>
		<?php
		}
		?>
		<a href=
			<?php
				echo "{$path}/main.php/?page=schedule";
			?>
		><button>Расписание</button></a>
		<a href=
			<?php
				echo "{$path}/main.php/?page=stat";
			?>
		><button>Статистика</button></a>
		<form action=<?php
				echo "{$path}/logout.php";
			?> method="POST">
			<button type="submit">Выйти</button>
		</form>
	</header>


	<?php
		switch ($_GET['page']) {
			case 'schedule':
				include('schedule.php');
				break;

			case 'moderator':
				include('moderator.php');
				break;

			case 'stat':
			include('stat.php');
			break;

			default:
				include('schedule.php');
				break;
		}
		

		pg_close($dbconn);
	?>
</body>
</html>