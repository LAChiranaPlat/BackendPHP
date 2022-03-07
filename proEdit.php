<?php 
	
	include "myClass.php";

	$user=new Usuarios();
	$seguridad=new sessionSecurity();

	extract($_POST);


	if($user->upUser($name,$lname,$_SESSION["idUser"]))
	{
		header("location:system.php");
		die();
	}


?>