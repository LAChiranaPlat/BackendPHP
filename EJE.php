<?php 


	$nombres="Maria";

	function saludar(&$names)//maria
	{
		$names="Juan";//reemplazado x juan
		echo $names;
	}

	saludar($nombres);

	echo "<br /> $nombres <br />";//maria

 ?>