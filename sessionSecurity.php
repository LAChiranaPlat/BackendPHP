<?php 

class sessionSecurity extends ConexionDB
{

	public function __construct($table="")
	{

		parent::__construct();
		$this->table=$table;
		date_default_timezone_set("America/Lima");
		session_start();
	}


	public function save()
	{
		$this->insert();
	}


	public function login($nick,$password)//juancito-1234
	{
		$conex=$this->conexion;
		$query="select id,type, password from users where nick=?";//tadeo

		$data=$this->prepQuery($query,$nick);

		if($data->num_rows){

			$info=$data->fetch_assoc();

			if(password_verify($password, $info["password"]))
			{
				$this->initSession($nick,$info["id"],$info["type"]);
				die();
			}

				echo "Credenciales incorrectas";
				header("Location:login.php?error=Credenciales Incorrectas");


		}else{

			echo "El usuario ingresado no existe";
			header("Location:login.php?error=La cuenta de usuario no existe");

		}

	}

	public function initSession($nick,$idUser,$typeUser=0)
	{//JUAN

		$_SESSION['user']=$nick;//elgerrero/hackerman//devPHP
		$_SESSION['idUser']=$idUser;//codigo:50 100 1000000
		$_SESSION['status']=1;
		$_SESSION['token']=md5(uniqid(rand(),true));

		$campos["dia"]=date("Y-m-d");
		$campos["horaEntrada"]=date("h:i:s a");
		$campos["token"]=$_SESSION["token"];
		$campos["status"]=$_SESSION["status"];
		$campos["idUser"]=$idUser;

		$this->mCampos=$campos;
		
		$this->save();

		if($typeUser){
			header("location:systemAdmin.php");//cantidada de usuarios//lista de usuarios//historial de actividades por usuario
		}else{
			header("location:system.php");
		}
		die("Session Iniciada");

	}

	public function verifySession()
	{
		if(isset($_SESSION["user"]) and !empty($_SESSION['user']))//ok
		{
			//VICTOR
			$conexDB=$this->conexion;
			$query="select token, status from actividades where idUser=? and status=1";
	
			$data=$this->prepQuery($query,$_SESSION["idUser"]);
			
			$info=$data->fetch_assoc();
				/*1234*/				/**/
			if( $_SESSION['token'] != $info["token"])
			{
				header("Location:error.php");
				die();
			}
			
		}else{

			header("Location:error.php");

		}
	}


	function verifyIniSession()
	{
		if(isset($_SESSION["user"]) and !empty($_SESSION['user']))//ok
		{
			//VICTOR
			$conexDB=$this->conexion;
			$query="select token, status from actividades where idUser=? and status=1";
	
			$data=$this->prepQuery($query,$_SESSION["idUser"]);
			
			$info=$data->fetch_assoc();

			if( $_SESSION['token'] == $info["token"])
			{
				header("Location:system.php");
				die();
			}else{
				header("Location:error.php");
				die();
			}
			
		}

	}


/**/
	function closeSession()
	{
		$conexion=$this->conexion;

		$query="update actividades
			set status=0, horaSalida='".date("h:i:s a")."' where idUser=? and token=?";

		if(!($sentencia=$conexion->prepare($query)))
		{
			echo "Error: ",$conex->error;
			die("Error en la preparación de la consulta");
		}

		if(!$sentencia->bind_param("is",$_SESSION['idUser'],$_SESSION['token']))//juancito
		{
			echo "Error: ",$sentencia->error;
			die("Error en la vinculación de datos");	
		}

		if($sentencia->execute())
		{
			session_destroy();
			header("location:index.php");
			die();
		}

	}

}

 ?>

