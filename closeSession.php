<?php 

	include "conexionDB.php";
	include "sessionSecurity.php";

	$objSession=new sessionSecurity();
	$objSession->closeSession();

 ?>