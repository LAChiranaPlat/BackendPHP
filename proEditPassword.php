<?php 

	include "myClass.php";

	$user=new Usuarios();
	$seguridad=new sessionSecurity();

	extract($_POST);

	if(password_verify($key, $user->getData("password",$_SESSION['idUser'])))
	{

		$_SESSION['codVerify']=rand(1000,9999);
		$_SESSION['newPass']=$nKey;
		
		header("location:updatePassword.php");
		die();
/*
		echo $_SESSION['codVerify'];
		echo "Ingrese el codigo que se envio a su correo electronico";
		?>
			<form>
				<input type="password" name="newKey" />
			</form>
		<?php
*/		

	}else{
		echo "no";
		header("location:system.php");
		die();
	}

 ?>