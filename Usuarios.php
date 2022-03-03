<?php 

	class Usuarios extends ConexionDB
	{

		public function __construct(){
			parent::__construct();
		}

		public function save()
		{

			if(	!$this->verifyUser() )///true//false
			{
				$this->insert();
				return true;
			}

			return false;			
		
		}

		public function verifyUser()
		{

			$conexion=$this->conexion;

			$query="SELECT nombres, apellidos FROM users where nick=?";//limpia=sql, 
			$result=$this->prepQuery($query,$this->mCampos['nick']);
			return $result->num_rows;//true
				
					
			

		}

		function getData($campoRequerido,$id)
		{
			$conexion=$this->conexion;

			$query="SELECT $campoRequerido FROM users where id=?";
			$result=$this->prepQuery($query,$id);
			$datos=$result->fetch_assoc();
			
			return $datos[$campoRequerido];
		}


		function getDataUser($id)
		{
			$conexion=$this->conexion;

			$query="SELECT nombres,apellidos, email,sexo,fRegistro, fotoPerfil FROM users where id=?";
			$result=$this->prepQuery($query,$id);
			$datos=$result->fetch_assoc();
			return $datos;
		}

		function getId($user)
		{
			$conexion=$this->conexion;

			$query="SELECT id FROM users where nick=?";
			$result=$this->prepQuery($query,$user);
			$datos=$result->fetch_assoc();
			return $datos['id'];	
		}

		function upFPerfil($fotoPerfil)
		{
			
			$conexion=$this->conexion;

			$qUpdate="update users set fotoPerfil=? where id=?";

			if(!($sentencia=$conexion->prepare($qUpdate)))
			{
				echo "Error: ",$conexion->error;
				die("Error en la preparación de la consulta");
			}

			if(!$sentencia->bind_param("si", $fotoPerfil , $_SESSION['idUser']))//juancito
			{
				echo "Error: ",$sentencia->error;
				die("Error en la vinculación de datos");	
			}

			if($sentencia->execute())
			{
				var_dump($sentencia->get_result());
				return true;
			}else{
			}

		}

		function upUser($name,$lname)
		{
			
			$conexion=$this->conexion;

			$qUpdate="update users set nombres=?, apellidos=? where id=?";

			if(!($sentencia=$conexion->prepare($qUpdate)))
			{
				echo "Error: ",$conexion->error;
				die("Error en la preparación de la consulta");
			}

			if(!$sentencia->bind_param("ssi", $name,$lname , $_SESSION['idUser']))//juancito
			{
				echo "Error: ",$sentencia->error;
				die("Error en la vinculación de datos");	
			}

			if($sentencia->execute())
			{
				return true;
			}else{
			}

		}


		function upMailUser($mail)
		{
			
			$conexion=$this->conexion;

			$qUpdate="update users set email=? where id=?";

			if(!($sentencia=$conexion->prepare($qUpdate)))
			{
				echo "Error: ",$conexion->error;
				die("Error en la preparación de la consulta");
			}

			if(!$sentencia->bind_param("si", $mail , $_SESSION['idUser']))//juancito
			{
				echo "Error: ",$sentencia->error;
				die("Error en la vinculación de datos");	
			}

			if($sentencia->execute())
			{
				return true;
			}else{
			}

		}

		function upPassUser($nKey)
		{
			
			$conexion=$this->conexion;

			$qUpdate="update users set password=? where id=?";

			if(!($sentencia=$conexion->prepare($qUpdate)))
			{
				echo "Error: ",$conexion->error;
				die("Error en la preparación de la consulta");
			}

			if(!$sentencia->bind_param("si", $nKey , $_SESSION['idUser']))//juancito
			{
				echo "Error: ",$sentencia->error;
				die("Error en la vinculación de datos");	
			}

			if($sentencia->execute())
			{
				return true;
			}else{
			}

		}

	}

 ?>

























