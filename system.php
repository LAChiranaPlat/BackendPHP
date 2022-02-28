
<?php 

	include "myClass.php";

	$objSession=new sessionSecurity();
	$objSession->verifySession();

	echo "<h1>Bienvenidos ", $_SESSION['user']," al Sistema</h1>";
 ?>
 <a href="closeSession.php">Cerrar sesión</a>
 <?php 

 	include "profile.php";

  ?>