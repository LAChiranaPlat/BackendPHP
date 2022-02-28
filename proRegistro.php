<?php 
	

	if($_SERVER["REQUEST_METHOD"]!="POST")
	{
		header("location:error.php");
		die("Sistema Fuera de Linea");//FINALIZO APP
	}

	include "myClass.php";

	$frm=new Form($_POST);

	$frm->dataClear["nombres"]= $frm->verifyString($_POST["name"],"nameError");
	$frm->dataClear["apellidos"]= $frm->verifyString($_POST["lname"],"lnameError");
	$frm->dataClear["sexo"]= $frm->verifyString($_POST["sexo"],"sexoError");
	$frm->dataClear["email"]= $frm->verifyEmail();
	$frm->dataClear["password"]= $frm->verifyPassword();
	$frm->dataClear["nick"]= $frm->verifyString($_POST["nick"],"nickError");
	
	$frm->verifyForm("register.php");
//ok=		vacios=0/erroresTipo=0/verificado todo

	$newRegistro=new Usuarios("localhost","root","","system22");
	$newRegistro->table="users";
	$newRegistro->mCampos=$frm->dataClear;
	
	if($newRegistro->save()){

		$sesionUser=new sessionSecurity("actividades");
		$sesionUser->initSession(
									$frm->dataClear["nick"],
									$newRegistro->getId($frm->dataClear["nick"])
								);

	}
	
	$frm->returnNickError("register.php");
	

 ?>