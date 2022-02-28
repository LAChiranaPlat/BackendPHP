<!DOCTYPE html>
<html>
<head>
	<title>Perfil de Usuario</title>
</head>
<body>

<?php 
	
	include "myClass.php";
	$nUser=new Usuarios();
	
	
	extract($nUser->getDataUser($_SESSION['idUser']));
	

 ?>

	<div class="personal">
		<fieldset>
			<legend>Datos Personales</legend>
			<figure>
				<img src="<?= !empty($fotoPerfil)? $fotoPerfil :"image/avatar.webp" ?>" width="150px" />
			</figure>

			<form action="uploading.php" method="post" enctype="multipart/form-data">
				<input type="file" name="avatar" />
				<button type="submit" name="envio" value="1">Subir</button>
			</form>

			<table>
				<tr>
					<td>Nombres</td>
					<td><?= $nombres; ?></td>
				</tr>
				<tr>
					<td>Apellidos</td>
					<td><?= $apellidos; ?></td>
				</tr>
			</table>
			<form action="edit.php">
				<button type="submit">Editar</button>
			</form>
			
		</fieldset>
	</div>
	
	<div class="seguridad">
		<fieldset>
			<legend>Seguridad de Cuenta</legend>
				<table>
					<tr>
						<td>Correo Electronico</td>
						<td><?= $email ?></td>
					</tr>
					<tr>
						<td colspan="2">
							<form action="editMail.php">
								<button type="submit">Editar</button>
							</form>
						</td>
					</tr>
					<tr>
						<td>Contraseña de Cuenta</td>
						<td>***</td>
					</tr>
				</table>
				
			</fieldset>
		</div>
	</div>

	<div class="cuentaConfig">
		
	</div>

</body>
</html>