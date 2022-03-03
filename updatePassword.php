<?php 
include "myClass.php";

	$user=new Usuarios();
	$seguridad=new sessionSecurity();

		echo $_SESSION["codVerify"];
		echo "Ingrese el codigo que se envio a su correo electronico";
		?>
			<form action="proUpdatePassword.php" method="post">
				<input type="text" name="codigo" />
				<button type="submit">Actualizar</button>
			</form>
	<?php

 ?>