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

	}

 ?>