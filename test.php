<?php 
/*
	$servidor=new mysqli("localhost","root", "", "system22");


	if($servidor->connect_errno)
	{
		echo "<strong>Error de Conexión</strong>",$servidor->connect_error;
	}

*/

	include "Class\ConexionDB.php";
	$newRegistro=new ConexionDB("localhost","root","","system22");


	$data=[
		"nombres"=>"Alexander",
		"apellidos"=>"huarcaya",	
		"email"=>"huarseral@gmail.com",
		"sexo"=>"m",
		"nick"=>"huarseral"
	];


	$newRegistro->table="users";
	$newRegistro->mCampos=$data;
	$newRegistro->insert();


 ?>