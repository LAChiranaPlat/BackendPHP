<?php 

	include "myClass.php";

	$user=new Usuarios();
	$seguridad=new sessionSecurity();

	$extencion=pathinfo($_FILES['avatar']['name'],PATHINFO_EXTENSION);
	$newImage="image/avatars/".basename("avatarUser".date("dmYGis").".".$extencion);

	$subidaOK=1;

	if(isset($_POST['envio']))
	{
		$info=getimagesize($_FILES['avatar']['tmp_name']);

		if($info!==false){
			$subidaOK=1;

		}

		if(file_exists($newImage))
		{
			echo "el archivo ya existe";
			$subidaOK=0;
			die();
		}

		if($_FILES["avatar"]["size"]>4000000)
		{
			echo "Exceso de tamaño";
			$subidaOK=0;
			die();
		}

		if($extencion!="jpg" and $extencion!="png")
		{
			echo "Formato no permitido";
			$subidaOK=0;
			die();
		}

		if($subidaOK==1)
		{

			if(move_uploaded_file($_FILES["avatar"]["tmp_name"], $newImage))
			{
				if($user->upFPerfil($newImage))
				{
					header("Location:system.php");
					die();
				}
			}

		}else{
			echo "Problemas en la subida del fichero";
		}

	}


 ?>