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