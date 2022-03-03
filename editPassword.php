<!DOCTYPE html>
<html>
<head>
	<title>Perfil de Usuario</title>
</head>
<body>

<?php 
	
	include "myClass.php";
	$nUser=new Usuarios();
	$seguridad=new sessionSecurity();
	
	
	extract($nUser->getDataUser($_SESSION['idUser']));
	

 ?>

	<div class="personal">
		<fieldset>
			<legend>Datos Personales</legend>


			<form action="proEditPassword.php" method="post">
			<table>
				<tr>
					<td>Password Actual</td>
					<td><input type="text" name="key" /></td>
				</tr>
				<tr>
					<td>Nueva Password</td>
					<td><input type="text" name="nKey" /></td>
				</tr>
			</table>
				<button type="submit">Cambiar</button>
			</form>
			
		</fieldset>
	</div>
	
</body>
</html>