<?php 

	include "myClass.php";

	$user=new Usuarios();
	$seguridad=new sessionSecurity();

	extract($_POST);

	if(password_verify($password, $user->getData("password",$_SESSION['idUser'])))
	{

		if($user->upMailUser($mail))
		{
			header("location:system.php");
			die();
		}

	}else{
		header("location:system.php");
			die();
	}


 ?>