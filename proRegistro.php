<?php 
	

	if($_SERVER["REQUEST_METHOD"]!="POST")
	{
		header("location:error.php");
		die("Sistema Fuera de Linea");//FINALIZO APP
	}

	spl_autoload_register(function ($x) {
	    include $x . '.php';
	});

	$frm=new Form($_POST);


	$frm->dataClear["nombres"]= $frm->verifyString($_POST["name"],"nameError");
	$frm->dataClear["apellidos"]= $frm->verifyString($_POST["lname"],"lnameError");
	$frm->dataClear["sexo"]= $frm->verifyString($_POST["sexo"],"sexoError");
	$frm->dataClear["email"]= $frm->verifyEmail();
	$frm->dataClear["password"]= $frm->verifyPassword();
	$frm->dataClear["nick"]= $frm->verifyString($_POST["nick"],"nickError");
	
	$frm->verifyForm("register.php");

	$newRegistro=new ConexionDB("localhost","root","","system22");
	$newRegistro->table="users";
	$newRegistro->mCampos=$frm->dataClear;
	
	if($newRegistro->insert()){
		header("location:system.php");
		die("Fin del Script");
	}

 ?>