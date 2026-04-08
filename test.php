<?php 
	  require './dompdf/dompdf_config.inc.php';
	  $obj_pdf=new DOMPDF();
	  $page=file_get_contents('create_pdf.php');
	  //pdf page load here
	  $obj_pdf->load_html($page);
	  //pdf create
	  $obj_pdf->render();
	  //whats your pdf file name
	  $obj_pdf->stream('demo.pdf');
	  header('location:registration_form.php');
?>