<?php
	require_once 'config.php';
	session_start();
	if(!isset($_SESSION['user_id'])){
		header("Location: $path/index.php");
		exit();
	}
	$conn = "hostaddr=$host port=5432 dbname=$dbname user=$user password=$password";
	$dbconn = pg_connect($conn);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Главная</title>
	<link rel="stylesheet" type="text/css" href="style_main.css">
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
			<form action="admin.php" method="POST">
				<button type="submit">Админ</button>
			</form>
		<?php
		}
		?>
		<form action="logout.php" method="POST">
			<button type="submit">Выйти</button>
		</form>
	</header>

	<div class="flex_between">
		<form id="add_to_schedule" action="add_to_schedule.php" method="POST">
			<label for="shift_date">Дата дежурства:</label><br>
				<input type="date" id="shift_date" name="shift_date" required><br>
			<label for="start_time">Начало дежурства:</label><br>
				<input type="time" id="start_time" name="start_time" required><br>
			<label for="end_time">Конец дежурства:</label><br>
				<input type="time" id="end_time" name="end_time" required><br>
			<label for="notes">Комментарий к записи:</label><br>
				<input type="text" id="notes" name="notes"><br>
			<button type="submit">Сделать запись</button>
		</form>

		<div class="schedule">
		  <div class="grid gridhour">
		  	  <div class="hour"></div>
		  	  <div class="hour">9:00</div>
			  <div class="hour">10:00</div>
			  <div class="hour">11:00</div>
			  <div class="hour">12:00</div>
			  <div class="hour">13:00</div>
			  <div class="hour">14:00</div>
			  <div class="hour">15:00</div>
		  </div>
		  <div class="grid gridday">
			  <?php
				$days = array('Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота','Воскресенье');
				$current_date = date('d-m-Y');
				
			  	for ($i=14; $i >= 0; $i--) { 
			  ?>
				  <div class="day">
				  	<?php
						$date_i = date('d-m-Y', strtotime('-'.$i.' day'));
						$day_of_week = date('N',strtotime('-'.$i.' day'));
				  		echo "{$days[$day_of_week-1]}<br><i>{$date_i}</i>";
				  	?>
				  </div>

			  <?php
			  	}
			  ?>

			  <?php
			  	$query = "SELECT full_name,shift_date,EXTRACT(DAY FROM AGE(NOW(), shift_date)) AS datedif,EXTRACT(HOUR FROM start_time) as start_hour,EXTRACT(HOUR FROM end_time) AS end_hour,notes FROM schedule JOIN users ON user_id=users.id WHERE shift_date >= NOW() - INTERVAL '14 days'";
			  	$res = pg_query($query);
			  	while($zap = pg_fetch_assoc($res)){
			  		$grid_column_start = 14-$zap['datedif'];
			  		$grid_row_start = $zap['start_hour']-7;
			  		$grid_row_end = $zap['end_hour']-7;

			  		echo "<div class='schedule_item' style='
			  			grid-column-start: {$grid_column_start};
			  			grid-row-start: {$grid_row_start};
			  			grid-row-end: {$grid_row_end}
			  		'>
			  		{$zap['full_name']}</div>";
			  	}
			  ?>
		  </div>
		</div>
	</div>
	<?php
		pg_close($dbconn);
	?>
</body>
</html>