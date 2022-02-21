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
		$query="select id, password from users where nick=?";//tadeo

		$data=$this->prepQuery($query,$nick);

		if($data->num_rows){

			$info=$data->fetch_assoc();

			if(password_verify($password, $info["password"]))
			{
				$this->initSession($nick,$info["id"]);
				die();
			}

				echo "Credenciales incorrectas";
				header("Location:login.php?error=Credenciales Incorrectas");


		}else{

			echo "El usuario ingresado no existe";
			header("Location:login.php?error=La cuenta de usuario no existe");

		}


	}

	public function initSession($nick,$idUser)
	{//JUAN

		$_SESSION['user']=$nick;

		$_SESSION['idUser']=$idUser;
		
		$_SESSION['status']=1;
		$_SESSION['token']=md5(uniqid(rand(),true));

		$campos["dia"]=date("Y-m-d");
		$campos["horaEntrada"]=date("h:i:s a");
		$campos["token"]=$_SESSION["token"];
		$campos["status"]=$_SESSION["status"];
		$campos["idUser"]=$idUser;

		$this->mCampos=$campos;
		
		$this->save();

		header("location:system.php");
		die("Session Iniciada");

	}

	public function verifySession()
	{
		if(isset($_SESSION["user"]) and !empty($_SESSION['users']))
		{
			//VICTOR
			$conexDB=$this->conexion;
			$query="select token, status from actividades where idUser=? and status=1";
	
			$data=$this->prepQuery($query,$_SESSION["idUser"]);
			
			$info=$data->fetch_assoc();

			if( $_SESSION['token'] == $info["token"])
			{
				//ingreso al sistema
			}else{
				header("Location:error.php");
				die();
			}

		}else{

			header("Location:error.php");

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

