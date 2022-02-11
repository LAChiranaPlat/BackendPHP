<!DOCTYPE html>
<html>
<head>
	<title>Registro de Nuevo Usuario</title>
</head>
<body>
	
	<?php 

		require "tools.php";

		if(isset($_GET["formData"]))
		{
			$dataForm=unserialize($_GET["formData"]);
			$dataError=unserialize($_GET["error"]);
		}

	 ?>

	<form action="proRegistro.php" method="POST">
		<fieldset>
			<legend>Registro de Nuevo Usuario</legend>
			<table>
				<tr>
					<td><label for="name">Nombres</label></td>
					<td>
					<input 
						id="name"
						type="text" 
						name="name"
						value="<?= $dataForm["name"] ?>" 
						placeholder="Ingrese sus Nombres Aqui" />

					</td>
				</tr>

				<tr>
					<td colspan="2"><?= "<code style='color: red'>".$dataError["nameError"]."</code>"; ?></td><!--ERRORES-->
				</tr>

				<tr>
					<td><label for="lname">Apellidos</label></td>
					<td>
					<input 
						id="lname"
						type="text" 
						name="lname" 
						value="<?= $dataForm["lname"] ?>" 
						placeholder="Ingrese sus Apellidos Aqui" />

					</td>
				</tr>
				<tr>
					<td colspan="2"><?= "<code style='color: red'>".$dataError["lnameError"]."</code>"; ?></td><!--ERRORES-->
				</tr>

				<tr>
					<td><label for="email">Email</label></td>
					<td>
					<input 
						id="email"
						type="text" 
						name="email" 
						value="<?= $dataForm["email"] ?>" 
						require="true"
						placeholder="Ingrese sus Apellidos Aqui" />

					</td>
				</tr>
				<tr>
					<td colspan="2"><?= "<code style='color: red'>".$dataError["emailError"]."</code>"; ?></td><!--ERRORES-->
				</tr>

				<tr>
					<td colspan="2">Sexo</td>
				</tr>
				<tr>	
					<input type="hidden" name="sexo" value="0" />
					<td>
					<input 
						type="radio" 
						name="sexo" value="m" id="m" /><label for="m">Masculino</label>
					</td>
					<td>
					<input 
						type="radio" 
						name="sexo" value="f" id="f" /><label for="f">Femenino</label>
					</td>
				</tr>
				<tr>
					<td colspan="2"><?= "<code style='color: red'>".$dataError["sexoError"]."</code>"; ?></td><!--ERRORES-->
				</tr>
				<tr>
					<td><label for="nick">Nombre de Usuario</label></td>
					<td>
					<input 
						id="nick"
						type="text" 
						name="nick" 
						value="<?= $dataForm["nick"] ?>" 
						placeholder="Nombre de Nuevo Usuario" />

					</td>
				</tr>
				
				<tr>
					<td colspan="2"><?= "<code style='color: red'>".$dataError["nickError"]."</code>"; ?></td><!--ERRORES-->
				</tr>

				<tr>
					<td><label for="password">Password</label></td>
					<td>
					<input 
						id="password"
						
						type="password" 
						name="key" 
						placeholder="Clave de Acceso" />

					</td>
					</tr>
				<tr>
					<td><label for="repassword">RePassword</label></td>
					<td>
					<input 
						
						type="password" 
						name="rekey" 
						id="repassword"
						placeholder="Clave de Acceso" />

					</td>
				</tr>

				<tr>
					<td colspan="2"><?= "<code style='color: red'>".$dataError["keyError"]."</code>"; ?></td><!--ERRORES-->
				</tr>
				
				<tr>
					<td colspan="2"><button type="submit">Registrar</button></td>
				</tr>
				
			</table>
		</fieldset>
	</form>
</body>
</html>