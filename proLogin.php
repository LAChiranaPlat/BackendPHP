<?php 

	if($_SERVER["REQUEST_METHOD"]!="POST")
		{
			header("location:error.php");
			die("Sistema Fuera de Linea");//FINALIZO APP
		}

	include "myClass.php";

	$frm=new Form($_POST);


	$frm->dataClear["nick"]= $frm->verifyString($_POST["nick"],"nickError");
	$frm->dataClear["password"]= $frm->verifyPassword(true);
	
	$frm->verifyForm("login.php");
	
	$sesionUser=new sessionSecurity("actividades");

	$sesionUser->login($frm->dataClear["nick"],$frm->dataClear["password"]);

 ?>