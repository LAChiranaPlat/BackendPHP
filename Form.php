<?php

	class Form
	{
		//MIEMBROS: PROPIEDADES Y LOS METODOS

		//public $formPrev;
		public $dataClear;
		public $campos;					//cantidad de campos
		private $camposVerificados;
		
		private $vacios=0;
		private $errorTipo=0;
		private $messageError=[
			"nameError"=>"",
			"lnameError"=>"",
			"nickError"=>"",
			"sexoError"=>"",
			"emailError"=>"",
			"keyError"=>""
		];

		private $sTilde=["a","e","i","o","u","n","A","E","I","O","U","N"];
		private $cTilde=["á","é","í","ó","ú","ñ","Á","É","Í","Ó","Ú","Ñ"];	

		//alexañder
		function __construct(public $form)//paremetros: PHP8
		{		
			$this->campos=count($form);

			echo $this->campos;
			echo "<br />";
			var_dump($form);
			echo "<br />";

		}


		function verifyString($campo,$indice)//name//nameError
		{
			$this->camposVerificados++;

			if(empty($campo))
			{
				$this->messageError[$indice]="Debe llenar el Campo";//mensajes Vacios
				$this->vacios++;
				return ;
			}

			$campo=trim($campo);
			$boxCampo=explode(" ", $campo);
			
			$campo="";
			$valueTemp="";

			foreach ($boxCampo as $item) {

				$valueTemp=str_replace($this->cTilde, $this->sTilde, $item);

				if(!ctype_alpha($valueTemp)){
					$this->errorTipo++;
					$this->messageError[$indice]="El tipo de dato ingresado no es correcto";//mensajes Tipos
					return;
				}

				$campo .= $item." ";

			}

			return htmlentities((trim($campo)));
		}

		function verifyEmail()
		{
			$this->camposVerificados++;

			if(empty($this->form["email"]))
			{
				$this->messageError["emailError"]="Debe ingresar un correo electronico";
				$this->vacios++;
				return ;
			}

			$campo=trim($this->form["email"]);
			$email=filter_var($campo,FILTER_SANITIZE_EMAIL);

			if(filter_var($email,FILTER_VALIDATE_EMAIL))
			{
				return htmlentities($email);
			}

			$this->messageError["emailError"]="El correo ingresado no es valido";
			$this->errorTipo++;
		}

		function verifyPassword($contexto=false)
		{


			if($contexto)//login
			{
				$this->camposVerificados++;
				$key=trim($this->form["key"]);
				return password_hash(htmlentities(stripslashes($this->form["key"])), PASSWORD_DEFAULT);

			}else{//register

				$this->camposVerificados += 2;

				$key=trim($this->form["key"]);
				$rkey=trim($this->form["rekey"]);

				if($key!=$rkey || empty($key) || empty($rkey)){
					$this->vacios++;
					$this->messageError["keyError"]="Las claves no coinciden o estan Vacias";

					return;
				}

				if(strlen($key)<6){
					$this->errorTipo++;
					$this->messageError["keyError"]="La clave debe tener minimo 6 caracteres";
					return;
				}


				return password_hash(htmlentities(stripslashes($rkey)), PASSWORD_DEFAULT);

			}
		}

		function verifyForm($file)
		{
			if($this->camposVerificados==$this->campos){

				if($this->vacios || $this->errorTipo)
				{

					//SERIALIZE(VUELVE LA ESTRUCTURA UN STRING) - URLENCODE(CONVIERTE A UNA CADENA URL VALIDA)
					$dataForm=$this->arrayToUrl($this->form);//VALORES DEL FORMULARIO
					$dataError=$this->arrayToUrl($this->messageError);//ERRORES DETECTADOS

					header("location:$file?formData=$dataForm&error=$dataError");
					die("Cierre de la Aplicación");

				}

			}else{
				echo $this->camposVerificados, " / ",$this->campos;
				echo "Falta verificar campos";

			}

		}

		private function arrayToUrl($array)
		{
			return urlencode(	serialize($array) );
		}

	}

?>
