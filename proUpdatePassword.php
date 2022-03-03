<?php 

	include "myClass.php";

	$user=new Usuarios();
	$seguridad=new sessionSecurity();

	extract($_POST);

	if($codigo==$_SESSION["codVerify"])
	{

		$key=password_hash(htmlentities(stripslashes($_SESSION['newPass'])), PASSWORD_DEFAULT);

		if($user->upPassUser($key))
		{
			unset($_SESSION["codVerify"]);
			unset($_SESSION["newPass"]);

			header("location:system.php");
			die();
		}

	}else{
		header("location:system.php");
		die();		
	}

 ?>