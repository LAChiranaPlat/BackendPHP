<style type="text/css">
	*{
		color:red;
	}
</style>
<?php 

	include "myClass.php";

	$usuario= new Usuarios();
	$seguridad=new sessionSecurity();

	//$query="select nombres, apellidos, type, nick from users where type=?";

	$query="select U.nombres, U.apellidos, A.dia, A.horaEntrada,A.horaSalida, timediff(horaSalida,horaEntrada) Activo from users U inner join actividades A 
	on U.id=A.idUser where U.id=?";

	$data=$usuario->report($query,$_SESSION["idUser"]);
	
	$rows1=$data->fetch_assoc();	//1° item

	$trabajador=$rows1["nombres"]. " ". $rows1["apellidos"];

	?>

	<h1>Reporte Trabajador: <?= $trabajador ?></h1>
	<hr />
	<hr />
	<a href="rPDF.php" target="_blank">Exportar</a>
	<table>

		<thead>
			<th>Fecha</th>
			<th>Hora Entrada</th>
			<th>Tiempo Activo</th>
			<th>Hora Salida</th>
		</thead>
		
	<?php


	while ($campo=$data->fetch_assoc()) 
	{
		$trabajador=$campo['nombres']." ".$campo['apellidos'];
		
		echo "<tr>
				<td>${campo['dia']}</td>
				<td>${campo['horaEntrada']}</td>
				<td>${campo['Activo']}</td>
				<td>${campo['horaSalida']}</td>
			</tr>";
	}

 ?>
	</table>