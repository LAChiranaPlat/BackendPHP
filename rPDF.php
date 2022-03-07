<?php 

	include "dompdf/autoload.inc.php";

	use Dompdf\Dompdf;

	$pdf=new Dompdf();

	ob_start();
	include "reportUser.php";
	$html=ob_get_clean();

	$pdf->loadHtml($html);
	$pdf->render();
	header("Content-type: application/pdf");
	header("Content-Disposition: inline; filename=aaaa.pdf");
	echo $pdf->output();

 ?>