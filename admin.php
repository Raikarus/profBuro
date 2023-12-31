<?php
	require_once 'config.php';
	require_once 'connect_database.php';
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
		<form action=<?php
				echo "{$path}/main.php";
			?> method="POST">
			<button type="submit">Главная</button>
		</form>
		<div class="welcome">
  			<h1>Добро пожаловать, <span id="username">
  				<?php
  					echo $_SESSION['nickname'];
  				?>
  			</span>!</h1>
		</div>
		<form action=<?php
				echo "{$path}/logout.php";
			?> method="POST">
			<button type="submit">Выйти</button>
		</form>
	</header>

	<div class="tools">
  		<ul>
	    	<li><a href="#" onclick="show_smth('users')">Вывести пользователей</a></li>
	    	<li><a href="#" onclick="show_smth('role')">Вывести роли</a></li>
			<li><a href="#" onclick="show_form('add_role')">Добавить роль</a></li>
			<li><a href="#" onclick="show_form('add_dolz')">Добавить должность</a></li>
			<li><a href="#" onclick="show_form('add_user')">Добавить пользователя</a></li>
  		</ul>
	</div>

	<div class="tools">
  		<ul>
			<li><a href="#" onclick="show_form('up_role')">Изменить роль</a></li>
			<li><a href="#" onclick="show_form('up_dolz')">Изменить должность</a></li>
			<li><a href="#" onclick="show_form('up_user')">Изменить пользователя</a></li>
  		</ul>
	</div>

	<div class="tools">
  		<ul>
			<li><a href="#" onclick="show_form('del_role')">Удалить роль</a></li>
			<li><a href="#" onclick="show_form('del_dolz')">Удалить должность</a></li>
			<li><a href="#" onclick="show_form('del_user')">Удалить пользователя</a></li>
  		</ul>
	</div>

	<form class="hide_n_seek" id="add_role" action=<?php
				echo "{$path}/add_role.php";
			?> method="post">
	  <label for="role">Название роли:</label><br>
	  <input type="text" id="role" name="role_add" required><br>
	  <button type="submit">Добавить роль</button>
	</form>

	<form class="hide_n_seek" id="add_dolz" action=<?php
				echo "{$path}/add_dolz.php";
			?> method="post">
	  <label for="dolz">Название должности:</label><br>
	  <input type="text" id="dolz" name="dolz_add" required><br>
	  <label for="role_id">Выберите роль:</label><br>
	  <select id="role_id" name="role_id">
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

	<form class="hide_n_seek" id="add_user" action=<?php
				echo "{$path}/add_user.php";
			?> method="post">
	  <label for="user_add">Имя пользователя:</label><br>
	  <input type="text" id="user_add" name="user_add" required><br>
	  <label for="nickname">Никнейм:</label><br>
	  <input type="text" id="nickname" name="nickname" required><br>
      <label for="birthdate">Дата рождения:</label><br>
  	  <input type="date" id="birthdate" name="birthdate" required><br>
	  <label for="login">Логин пользователя:</label><br>
	  <input type="text" id="login" name="login" required><br>
	  <label for="password">Пароль пользователя:</label><br>
	  <input type="text" id="password" name="password" required><br>
  	  <label for="dolz_id">Выберите должность:</label><br>
	  <select id="dolz_id" name="dolz_id">
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

	<form class="hide_n_seek" id="up_role" action=<?php
				echo "{$path}/up_role.php";
			?> method="post">
	  <label for="role_up">Выберите роль:</label><br>
	  <select id="role_up" name="role_up">
	  	<?php
			$query = "SELECT id,name FROM role";
			$res = pg_query($query);
			while($option = pg_fetch_assoc($res)){
				echo "<option value=\"{$option['id']}\">{$option['name']}</option>";
			}
	  	?>
	  </select><br><br>
	  <label for="role_newname">Новое название роли:</label><br>
	  <input type="text" id="role_newname" name="role_newname" required><br>
	  <button type="submit">Изменить роль</button>
	</form>

	<form class="hide_n_seek" id="up_dolz" action=<?php
				echo "{$path}/up_dolz.php";
			?> method="post">
	  <label for="dolz_id_up">Выберите должность:</label><br>
	  <select id="dolz_id_up" name="dolz_id_up">
	  	<?php
			$query = "SELECT id,name FROM dolz";
			$res = pg_query($query);
			while($option = pg_fetch_assoc($res)){
				echo "<option value=\"{$option['id']}\">{$option['name']}</option>";
			}
	  	?>
	  </select><br><br>
	  <label for="dolz_newname">Новое название должности:</label><br>
	  <input type="text" id="dolz_newname" name="dolz_newname" required><br>
	  <label for="role_id_up">Новая роль:</label><br>
	  <select id="role_id_up" name="role_id_up">
	  	<?php
			$query = "SELECT id,name FROM role";
			$res = pg_query($query);
			while($option = pg_fetch_assoc($res)){
				echo "<option value=\"{$option['id']}\">{$option['name']}</option>";
			}
	  	?>
	  </select><br><br>
	  <button type="submit">Изменить роль</button>
	</form>

	<form class="hide_n_seek" id="up_user" action=<?php
				echo "{$path}/up_user.php";
			?> method="post">
	  <label for="user_id_up">Выберите пользователя:</label><br>
	  <select id="user_id_up" name="user_id_up">
	  	<?php
			$query = "SELECT user_id,full_name,nickname FROM users JOIN secure_info ON users.id=user_id";
			$res = pg_query($query);
			while($option = pg_fetch_assoc($res)){
				echo "<option value=\"{$option['user_id']}\" data-nickname=\"{$option['nickname']}}\">{$option['full_name']}</option>";
			}
	  	?>
	  </select><br><br>
	  <label for="user_new_name">Новое ФИО:</label><br>
	  <input type="text" id="user_new_name" name="user_new_name"><br>
	  <label for="user_new_nickname">Новый ник:</label><br>
	  <input type="text" id="user_new_nickname" name="user_new_nickname"><br>
	  <label for="birthdate">Новая дата рождения:</label><br>
  	  <input type="date" id="birthdate" name="birthdate"><br>
	  <label for="user_new_login">Новый логин:</label><br>
	  <input type="text" id="user_new_login" name="user_new_login"><br>
	  <label for="user_new_password">Новый пароль:</label><br>
	  <input type="text" id="user_new_password" name="user_new_password"><br>
	  <label for="dolz_id_up">Выберите должность:</label><br>
	  <select id="dolz_id_up" name="dolz_id_up">
	  	<?php
			$query = "SELECT id,name FROM dolz";
			$res = pg_query($query);
			while($option = pg_fetch_assoc($res)){
				echo "<option value=\"{$option['id']}\">{$option['name']}</option>";
			}
	  	?>
	  </select><br><br>
	  <button type="submit">Изменить пользователя</button>
	</form>

	<form class="hide_n_seek" id="del_role" action=<?php
				echo "{$path}/del_role.php";
			?>" method="post">
	  <label for="role_id_del">Выберите роль для удаления:</label><br>
	  <select id="role_id_del" name="role_id_del">
	  	<?php
			$query = "SELECT id,name FROM role";
			$res = pg_query($query);
			while($option = pg_fetch_assoc($res)){
				echo "<option value=\"{$option['id']}\">{$option['name']}</option>";
			}
	  	?>
	  </select><br><br>
	  <button type="submit">Удалить роль</button>
	</form>

	<form class="hide_n_seek" id="del_dolz" action=<?php
				echo "{$path}/del_dolz.php";
			?> method="post">
	  <label for="dolz_id_del">Выберите должность для удаления:</label><br>
	  <select id="dolz_id_del" name="dolz_id_del">
	  	<?php
			$query = "SELECT id,name FROM dolz";
			$res = pg_query($query);
			while($option = pg_fetch_assoc($res)){
				echo "<option value=\"{$option['id']}\">{$option['name']}</option>";
			}
	  	?>
	  </select><br><br>
	  <button type="submit">Удалить должность</button>
	</form>

	<form class="hide_n_seek" id="del_user" action=<?php
				echo "{$path}/del_user.php";
			?> method="post">
	  <label for="user_id_del">Выберите пользователя для удаления:</label><br>
	  <select id="user_id_del" name="user_id_del">
	  	<?php
			$query = "SELECT id,full_name FROM users";
			$res = pg_query($query);
			while($option = pg_fetch_assoc($res)){
				echo "<option value=\"{$option['id']}\">{$option['full_name']}</option>";
			}
	  	?>
	  </select><br><br>
	  <button type="submit">Удалить пользователя</button>
	</form>

	<div id="response">
		
	</div>


	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script type="text/javascript" src="script_admin.js"></script>
</body>
</html>