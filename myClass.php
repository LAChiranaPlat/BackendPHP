<?php 

	spl_autoload_register(function ($x) {
	    include $x . '.php';
	});

 ?>