<?php
	require_once 'config.php';
	session_start();
	if(!isset($_SESSION['role']) || $_SESSION['role']!='Администратор'){
		header("Location: $path/logout.php");
		exit();
	}
	//echo "Добро пожаловать, Администратор";
	
	$conn = "hostaddr=$host port=5432 dbname=$dbname user=$user password=$password";
	$dbconn = pg_connect($conn);

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

	<form class="hide_n_seek" id="add_role" action="add_role.php" method="post">
	  <label for="role">Название роли:</label><br>
	  <input type="text" id="role" name="role_add" required><br>
	  <button type="submit">Добавить роль</button>
	</form>
	<form class="hide_n_seek" id="add_dolz" action="add_dolz.php" method="post">
	  <label for="dolz">Название должности:</label><br>
	  <input type="text" id="dolz" name="dolz_add" required><br>
	  <label for="role_link">Выберите роль:</label><br>
	  <select id="role_link" name="role_link">
	  	<?php
			$query = "SELECT id,name FROM role";
			$res = pg_query($query);
			while($option = pg_fetch_assoc($res)){
				echo "<option value=\"{$option['id']}\">{$option['name']}</option>";
			}
	  	?>
	  </select><br><br>
	  <button type="submit">Добавить должность</button>
	</form>
	
	<form class="hide_n_seek" id="add_user" action="add_user.php" method="post">
	  <label for="user">Имя пользователя:</label><br>
	  <input type="text" id="user" name="role_add" required><br>
      <label for="birthdate">Дата рождения:</label><br>
  	  <input type="date" id="birthdate" name="birthdate"><br>
	  <label for="login">Логин пользователя:</label><br>
	  <input type="text" id="login" name="login" required><br>
	  <label for="password">Пароль пользователя:</label><br>
	  <input type="text" id="password" name="password" required><br>
  	  <label for="dolz_link">Выберите должность:</label><br>
	  <select id="dolz_link" name="dolz_link">
	  	<?php
			$query = "SELECT id,name FROM dolz";
			$res = pg_query($query);
			while($option = pg_fetch_assoc($res)){
				echo "<option value=\"{$option['id']}\">{$option['name']}</option>";
			}
	  	?>
	  </select><br><br>

	  <button type="submit">Добавить пользователя</button>
	</form>

	<div id="response">
		
	</div>


	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script type="text/javascript" src="script_admin.js"></script>
</body>
</html>