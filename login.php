<!DOCTYPE html>
<html>
<head>
	<title>Identificación de Usuario</title>
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
 
<a href="index.php">Atras</a>
<form action="proLogin.php" method="post">
	
	<fieldset>
		<legend>Validación de Usuario</legend>
		<div class="error"><?= isset($_GET["error"])?$_GET["error"]:"" ?></div>
		<div>
			<div>
				Nombre de Usuario 
				<input type="text" name="nick" value="<?= $dataForm["nick"]; ?>" />

				<br /><?= "<code style='color: red'>".$dataError["nickError"]."</code>"?></div>
			<div>Password <input type="password" name="key" /></div>
			<button type="submit">Ingresar</button>
		</div>

	</fieldset>

</form>

</body>
</html>