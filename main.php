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
			  	for ($i=0; $i < 2; $i++) { 
			  ?>
				  <div class="day">Понедельник</div>
				  <div class="day">Вторник</div>
				  <div class="day">Среда</div>
				  <div class="day">Четверг</div>
				  <div class="day">Пятница</div>
			  <?php
			  	}
			  ?>
		  </div>
		</div>
	</div>
</body>
</html>