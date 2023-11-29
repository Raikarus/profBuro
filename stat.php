<?php
	$query = "SELECT full_name,SUM(total_time_min) as total FROM users LEFT OUTER JOIN schedule ON users.id=schedule.user_id GROUP BY full_name HAVING SUM(total_time_min)>0 ORDER BY total DESC";
	$res = pg_query($query);
	echo "<table>";
	echo "<tr><th>ФИО:</th><th>Минуты:</th></tr>";
	while ($zap = pg_fetch_assoc($res)) {
		echo "<tr><td>{$zap['full_name']}</td><td>{$zap['total']}</td></tr>";
		}
	echo "</table>";
?>