<!DOCTYPE html>
<html>
<head>
	<title>Perfil de Usuario</title>
</head>
<body>

<?php 
	
	include "myClass.php";
	$nUser=new Usuarios();
	
	
	extract($nUser->getDataUser(111));
	

 ?>

	<div class="personal">
		<fieldset>
			<legend>Datos Personales</legend>


			<table>
				<tr>
					<td>Nombres</td>
					<td><input type="text" name="names" value="<?= $nombres; ?>" /></td>
				</tr>
				<tr>
					<td>Apellidos</td>
					<td><input type="text" name="names" value="<?= $apellidos; ?>" /></td>
				</tr>
			</table>
			<form action="edit.php">
				<input type="hidden" name="idUser" value="id" />
				<button type="submit">Actualizar</button>
			</form>
			
		</fieldset>
	</div>
	
</body>
</html>