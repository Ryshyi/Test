<?php
	error_reporting(-1);
	$root=__DIR__.DIRECTORY_SEPARATOR;
	require $root.'prepare.php'; #Здесь будут производиться подготовительные действия, объявления функций и т.д.
	require $root.'auth.php'; #Здесь будет происходить авторизация пользователя
	require $root.'add_task.php';
	
?>