<?php
	require_once 'config.php';
	session_start();
	if(!isset($_SESSION['role']) || $_SESSION['role']!='Администратор'){
		header("Location: $path/logout.php");
		exit();
	}
	//echo "Добро пожаловать, Администратор";


?>

<!DOCTYPE html>
<html>
<head>
	<title>Админская</title>
	<link rel="stylesheet" type="text/css" href="style_admin.css">
</head>
<body>
	<header>
		<form action="main.php" method="POST">
			<button type="submit">Главная</button>
		</form>
		<form action="logout.php" method="POST">
			<button type="submit">Выйти</button>
		</form>
	</header>

		<div class="tools">
  		<ul>
	    	<li><a href="#" onclick="show_all()">Вывести всех</a></li>
			<li><a href="#" onclick="add_role()">Добавить роль</a></li>
			<li><a href="#" onclick="add_dolz()">Добавить должность</a></li>
			<li><a href="#" onclick="add_user()">Добавить пользователя</a></li>
  		</ul>
	</div>
	<form id="add_role" action="add_role.php" method="post">
	  <label for="role">Название роли:</label>
	  <input type="text" id="name" name="role_add" required>
	  <button type="submit">Добавить роль</button>
	</form>
	<div id="response">
		
	</div>


	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script type="text/javascript" src="script_admin.js"></script>
</body>
</html>