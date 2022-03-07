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

			$query="SELECT nombres, apellidos FROM users where nick=?";//limpia=sql, 
			$result=$this->prepQuery($query,$this->mCampos['nick']);
			return $result->num_rows;//true
				
		}

		function getData($campoRequerido,$id)//type,idUser
		{

			$query="SELECT $campoRequerido FROM users where id=?";
			$result=$this->prepQuery($query,$id);
			$datos=$result->fetch_assoc();
			
			return $datos[$campoRequerido];
		}


		function getDataUser($id)
		{

			$query="SELECT nombres,apellidos, email,sexo,fRegistro, fotoPerfil FROM users where id=?";
			$result=$this->prepQuery($query,$id);
			$datos=$result->fetch_assoc();
			return $datos;
		}

		function getId($user)
		{
			

			$query="SELECT id FROM users where nick=?";
			$result=$this->prepQuery($query,$user);
			$datos=$result->fetch_assoc();
			return $datos['id'];	
		}

		function upFPerfil(...$data)
		{
			
			$qUpdate="update users set fotoPerfil=? where id=?";//CONSULTA
			$result=$this->prepQuery($qUpdate,...$data);
			return true;

		}

		function upUser(...$data)
		{

			$qUpdate="update users set nombres=?, apellidos=? where id=?";
			$result=$this->prepQuery($qUpdate,...$data);
			return true;

		}


		function upMailUser(...$data)
		{
			
			$qUpdate="update users set email=? where id=?";
			$result=$this->prepQuery($qUpdate,...$data);
			return true;
			

		}

		function upPassUser(...$data)
		{
			
			$qUpdate="update users set password=? where id=?";
			$result=$this->prepQuery($qUpdate,...$data);
			return true;

		}

		function report($q,...$data)
		{

			$result=$this->prepQuery($q,...$data);
			return $result;

		}

	}

 ?>

























