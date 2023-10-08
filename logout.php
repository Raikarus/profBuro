<?php 
	require_once 'config.php';
	session_start(); // начало сессии

	// удаление всех переменных сессии
	$_SESSION = array();

	// удаление cookie сессии, если они используются
	if (ini_get("session.use_cookies")) {
	  $params = session_get_cookie_params();
	  setcookie(session_name(), '', time() - 42000,
	    $params["path"], $params["domain"],
	    $params["secure"], $params["httponly"]
	  );
	}

	// уничтожение сессии
	session_destroy();

	// перенаправление на страницу авторизации
	header("Location: $path/index.php");
	exit();
?>