<?php 

	$dataForm=[
			"name"=>"",
			"lname"=>"",
			"nick"=>"",
			"email"=>"",

		];

	$dataError=[
		"nameError"=>"",
		"lnameError"=>"",
		"nickError"=>"",
		"sexoError"=>"",
		"emailError"=>"",
		"keyError"=>""
	];

	function arrayToUrl($array)
	{
		return urlencode(	serialize($array)	);
	}

	function verifyString(
		$campo,
		$message, 
		$indice,
		&$errores,//PASO POR REFERENCIA
		&$error,
		&$verificados)
	{
		$verificados++;

		if(empty($campo))
		{
			$error[$indice]=$message;
			$errores["v"]++;
			return ;
		}

		$campo=trim($campo);

		$matriz=explode(" ", $campo);//sofia
		$campo="";

		$sTilde=["a","e","i","o","u","ñ","A","E","I","O","U","Ñ"];
		$cTilde=["á","é","í","ó","ú","n","Á","É","Í","Ó","Ú","N"];

		foreach ($matriz as $item) {

			$valueTemp=str_replace($cTilde, $sTilde, $item);

			if(!ctype_alpha($valueTemp)){
				$errores["t"]++;
				$error[$indice]=$message;
				return;
			}

			$campo .= $item." ";

		}

		return htmlentities((trim($campo)));//lo ultimo en la funcion

	}


	function verifyEmail(
		$campo,
		&$errores,
		&$error,
		&$verificados)
	{
		$verificados++;

		if(empty($campo))
		{
			$error["emailError"]="Debe ingresar un correo electronico";
			$errores["v"]++;
			return ;
		}

		$campo=trim($campo);
		$email=filter_var($campo,FILTER_SANITIZE_EMAIL);

		if(filter_var($email,FILTER_VALIDATE_EMAIL))
		{
			return htmlentities($email);
		}

		$error["emailError"]="El correo ingresado no es valido";
		$errores["t"]++;

	}

	function verifyPass(
		$key,
		$rkey,
		&$errores,
		&$error,
		&$verificados)
	{
		$verificados += 2;
		$key=trim($key);
		$rkey=trim($rkey);

		if($key!=$rkey || empty($key) || empty($rkey)){
			$errores["v"]++;
			$error["keyError"]="Las claves no coinciden";

			return;
		}

		if(strlen($key)<6){
			$errores["t"]++;
			$error["keyError"]="La clave debe tener minimo 6 caracteres";
			return;
		}


		return password_hash(htmlentities(stripslashes($rkey)), PASSWORD_DEFAULT);

	}

 ?>