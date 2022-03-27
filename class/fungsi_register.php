<?php 
if (! defined('BASEPATH')) exit('No direct script access allowed');
function CekPendaftaran($todays_date,$start_date,$end_date) {
$start_date = strtotime($start_date); 
$end_date = strtotime($end_date); 
$todays_date = strtotime($todays_date); 
if ($todays_date >= $start_date && $todays_date <= $end_date) {
return 0;//BUKA 
} else {
if($start_date >= $todays_date) {
return 1; //sedang 
} else {
return 2; //LEWAT 
}
	} 
		}

?>
