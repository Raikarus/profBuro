<?php
	$query = "SELECT full_name,nickname,date_of_birth,login,password FROM users JOIN secure_info ON users.id=user_id WHERE users.id='{$_SESSION['user_id']}'";
	$res = pg_query($query);
	$res = pg_fetch_assoc($res);
	
	echo "<table>";
	echo "<tr><td>Имя:</td><td>{$res['full_name']}</td></tr>";
	echo "<tr><td>Ник:</td><td>{$res['nickname']}</td></tr>";
	echo "<tr><td>День рождения:</td><td>{$res['date_of_birth']}</td></tr>";
	echo "<tr><td>Логин:</td><td>{$res['login']}</td></tr>";
	echo "<tr><td>Пароль:</td><td>{$res['password']}</td></tr>";
	echo "</table>";
?>

<form id="up_user" action=<?php
				echo "{$path}/up_user.php";
			?> method="post">
  <input type="text" id="user_id_up" name="user_id_up" hidden value=
  <?php
  	echo "{$_SESSION['user_id']}";
  ?>
  >

  <label for="user_new_name">Новое ФИО:</label>
  <input type="text" id="user_new_name" name="user_new_name"><br>

  <label for="user_new_nickname">Новый ник:</label>
  <input type="text" id="user_new_nickname" name="user_new_nickname"><br>

  <label for="birthdate">Новая дата рождения:</label>
  <input type="date" id="birthdate" name="birthdate"><br>

  <label for="user_new_login">Новый логин:</label>
  <input type="text" id="user_new_login" name="user_new_login"><br>

  <label for="user_new_password">Новый пароль:</label>
  <input type="text" id="user_new_password" name="user_new_password"><br>

  <button type="submit">Изменить пользователя</button>
</form>