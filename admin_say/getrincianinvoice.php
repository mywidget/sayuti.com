<?php
/*
Site : http:www.smarttutorials.net
Author :muni
*/
require_once 'config.php';

	
	$query = "SELECT MAX(id_rincianinvoice) as kd_max FROM invoice_detail";
	$result = mysqli_query($con, $query);
	$data = array();
	while ($row = mysqli_fetch_assoc($result)) {
		$name = $row['kd_max'];
		array_push($data, $name);	
	}	
	echo json_encode($data);

	