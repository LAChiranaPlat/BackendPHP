
<?php 
	class ConexionDB
	{

		public $table;
		public $mCampos;

		public $strCampos;
		public $strValues;

		public $conexion;
		public $strType;
				
		public function __construct(
			public $server, public $user, public $key, public $db
		)
		{
			$this->conexion=new mysqli($server,$user,$key,$db);

			if($this->conexion->connect_errno)
			{
				die("Error en la conexion ".$this->conexion->connect_error);
			}
		}

		public function insert(){

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

		public function select(){}

		public function delete(){}

		public function update(){}

		private function proDataInsert()
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
		

	
	}

 ?>