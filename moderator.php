<?php
		$query = "SELECT * FROM schedule WHERE user_id={$_SESSION['user_id']}";
		if ($_SESSION['role']!="Пользователь") {
			$query = "SELECT * FROM schedule";
		}
		$res = pg_query($query);
	
	echo "<table>";
	echo "<tr><th>Пользователь:</th><th>Дата:</th><th>Время</th><th>Действие</th></tr>";
		while ($zap = pg_fetch_assoc($res)) {
			$query2 = "SELECT full_name FROM users WHERE id={$zap['user_id']}";
			$username = pg_fetch_assoc(pg_query($query2))['full_name'];
			echo "<form action='{$path}/delete_schedule.php' method='POST'><tr><td>{$username}</td><td>{$zap['shift_date']}</td><td>{$zap['start_time']} - {$zap['end_time']}</td><td><input name='schedule_id' type='hidden' value='{$zap['id']}'><input type='submit' value='Удалить'></td></tr></form>";
		}
?>