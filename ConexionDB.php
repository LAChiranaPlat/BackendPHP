
<?php 
	class ConexionDB
	{

		public $table;//TABLAS
		public $mCampos;//KEYS(NOMBRES DE LOS CAMPOS EN LAS TABLAS) -> VALORES

		protected $strCampos;
		protected $strValues;

		protected $conexion;//CONEXION A LA BASE DE DATO
		protected $strType;

		protected $server="localhost";
		protected $user="root";
		protected $key="";
		protected $db="system22";
				
		function __construct()
		{
			$this->conexion=new mysqli($this->server,$this->user,$this->key,$this->db);

			if($this->conexion->connect_errno)
			{
				die("Error en la conexion ".$this->conexion->connect_error);
			}
		}

		protected function insert(){//X

			$this->proDataInsert();

			$conex=$this->conexion;
														
			$q="insert into {$this->table} ({$this->strCampos}) values({$this->strValues})";//?,?,?

			if(		!($qPrepare=$conex->prepare($q))	)
			{
				die("Error en la preparación de la consulta: {$conex->error}");
			}
			
			if(	!$qPrepare->bind_param($this->strType, ...$this->values)	)
			{
				die("Error en la vinculacion de Datos: {$qPrepare->error}");
			}

			if($qPrepare->execute())
			{
				return true;
				$qPrepare->close();

			}
				
		}

		protected function select(){}//OK

		protected function delete(){}

		protected function update(){}

		protected function proDataInsert()
		{
			$keys="";		//claves/indices del array
			$values="";		//valores		del array
			$comodin="";	//?????????????????????
			$types="";		//letritas: sisisisisi

			$tipos=[
				"string"=>"s",
				"integer"=>"i"
			];

			foreach ($this->mCampos as $key => $value) {

				$keys .= $key.",";
				$comodin .= "?,";
				$types .= $tipos[gettype($value)];

			}
			
			$this->strCampos=substr_replace($keys, "", strlen($keys)-1);
			$this->values=array_values($this->mCampos);
			$this->strValues=substr_replace($comodin, "", strlen($comodin)-1);
			$this->strType=$types;
		}
		

		function prepQuery($query,...$dataUser)
		{
			$conexion=$this->conexion;
			
			
			if(!($qPreparada=$conexion->prepare($query)))//
			{
				echo $qPreparada->error;
				die("Final del script: Error en Preparación de Consulta");
			}
			//OK

			$types="";

			if(gettype($dataUser)=="array"){

				foreach ($dataUser as $key => $value) {

					$types .= is_numeric($value)?"i":"s";

				}

				if(!$qPreparada->bind_param($types,...$dataUser))
				{
					echo $qPreparada->error;
					die("Final del script: Error en Vinculación de datos");
				}//VARIA

			}else{
			
				$tipoData=is_numeric($dataUser)?"i":"s";//VARIA SEGUN LOS DATOS

				if(!$qPreparada->bind_param($tipoData,$dataUser))
				{
					echo $qPreparada->error;
					die("Final del script: Error en Vinculación de datos");
				}//VARIA
			
			}


			if($qPreparada->execute())
			{
				$result=$qPreparada->get_result();

				return $result;
			}//OK

		}
	
	}

 ?>