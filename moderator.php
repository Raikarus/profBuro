<?php
		if(!isset($_SESSION['role']) || ($_SESSION['role']!='Модератор' && $_SESSION['role']!='Администратор')){
			header("Location: $path/logout.php");
			exit();
		}
		$query = "SELECT * FROM schedule WHERE user_id={$_SESSION['user_id']}";
		if ($_SESSION['role']!="Пользователь") {
			$query = "SELECT * FROM schedule";
		}
		$res = pg_query($query);

		while ($zap = pg_fetch_assoc($res)) {
			$query2 = "SELECT full_name FROM users WHERE id={$zap['user_id']}";
			$username = pg_fetch_assoc(pg_query($query2))['full_name'];
			echo "<form action='{$path}./delete_schedule.php' method='POST'>Пользователь: <b>{$username}</b>. Дата: <b>{$zap['shift_date']}</b>. Время: <b>{$zap['start_time']} - {$zap['end_time']}</b><input name='schedule_id' type='hidden' value='{$zap['id']}'><input type='submit' value='Удалить'></form>";
		}
?>