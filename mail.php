<?php 

	$para="huarseral@hotmail.com";
	$titulo=utf8_decode("Saludos de .....");

	ob_start();
 ?>

 	<!DOCTYPE html>
 	<html>
 	<head>
 		<style type="text/css">
 			
 		</style>
 	</head>
 	<body>
		<h1>LAChirana Plat</h1>
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p> 	
 	</body>
 	</html>


 <?php
 	
 	$message=ob_get_contents();
 	ob_end_clean();

 	$cab="'MIME-Version: 1.0' \r\n";
 	$cab="'Content-type:text/html; utf-8' \r\n";
 	$cab="'from: LAChirana Plat <plat@LAChirana.com>' \r\n";

 	if(mail($para,$titulo,$utf8_decode($message),$cab))
 	{
 		echo "correo mandado";
 	}else{
 		echo error_get_last()['message'];
 	}

 ?>