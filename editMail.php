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

			<form action="proEditMail.php" method="post">

			<table>
				<tr>
					<td>Email</td>
					<td><input type="text" name="mail" value="<?= $email; ?>" /></td>
				</tr>

				<tr>
					<td>Ingrese Clave para Continuar</td>
					<td><input type="password" name="password" /></td>
				</tr>
				
			</table>
				<button type="submit">Actualizar</button>
				<a href="system.php">Cancelar</a>
			</form>
			
		</fieldset>
	</div>
	
</body>
</html>