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


			<form action="proEdit.php" method="post">
			<table>
				<tr>
					<td>Nombres</td>
					<td><input type="text" name="name" value="<?= $nombres; ?>" /></td>
				</tr>
				<tr>
					<td>Apellidos</td>
					<td><input type="text" name="lname" value="<?= $apellidos; ?>" /></td>
				</tr>
			</table>
				<button type="submit">Actualizar</button>
				<a href="system.php">Cancelar</a>

			</form>
			
		</fieldset>
	</div>
	
</body>
</html>