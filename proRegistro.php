<?php 
	

	if($_SERVER["REQUEST_METHOD"]!="POST")
	{
		header("location:error.php");
		die("Sistema Fuera de Linea");//FINALIZO APP
	}

	require "tools.php";

	extract($_POST);//DATOS CRUDOS

	$data=[];//DATOS LIMPIOS
	
	$formPrevio=$_POST;//VALORES PREVIOS
	
	$campos=7;
	$camposVerificados=0;//4

	$errores=[
		"v"=>0,//VACIOS
		"t"=>0//ERRORES DE TIPO
	];	

	$data["name"]=verifyString($name,"Debe llenar el campo Nombres","nameError", $errores ,$dataError,$camposVerificados);
	$data["lname"]=verifyString($lname,"Debe llenar el campo Apellidos","lnameError", $errores ,$dataError,$camposVerificados);
	$data["nick"]=verifyString($nick,"Debe llenar el campo Nick","nickError", $errores ,$dataError,$camposVerificados);
	$data["sexo"]=verifyString($sexo,"Debe Elegir una Opción","sexoError", $errores ,$dataError,$camposVerificados);
	$data["email"]=verifyEmail($email, $errores ,$dataError,$camposVerificados);

	$data["key"]=verifyPass($key,$rekey, $errores ,$dataError,$camposVerificados);
	
	
	if($camposVerificados==$campos){

		if($errores["v"] || $errores["t"])
		{

			//SERIALIZE(VUELVE LA ESTRUCTURA UN STRING) - URLENCODE(CONVIERTE A UNA CADENA URL VALIDA)
			$dataForm=arrayToUrl($formPrevio);//VALORES DEL FORMULARIO
			$dataError=arrayToUrl($dataError);//ERRORES DETECTADOS

			header("location:index.php?formData=$dataForm&error=$dataError");
			die("Cierre de la Aplicación");
		}
		
	}else{
		echo "Falta verificar campos";

	}
	

	echo "<h1>Bienvenido al Sistema</h1>";

	echo "<pre>";
	var_dump($data);
	echo "</pre>";

 ?>