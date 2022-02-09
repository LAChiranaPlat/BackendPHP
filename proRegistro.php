<?php 
	

	if($_SERVER["REQUEST_METHOD"]!="POST")
	{
		header("location:error.php");
		die("Sistema Fuera de Linea");//FINALIZO APP
	}

	require "tools.php";
	require "Class/Form.php";

	$frm=new Form($_POST);

	$frm->dataClear["name"]= $frm->verifyString($_POST["name"],"nameError");
	$frm->dataClear["lname"]= $frm->verifyString($_POST["lname"],"lnameError");
	$frm->dataClear["sexo"]= $frm->verifyString($_POST["sexo"],"sexoError");
	$frm->dataClear["email"]= $frm->verifyEmail();
	$frm->dataClear["key"]= $frm->verifyPassword();

	$frm->campos=6;

	$frm->verifyForm();

	echo "<h1>Bienvenido al Sistema</h1>";
	
 ?>