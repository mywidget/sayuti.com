<?php
define("BASEPATH", gethostbyaddr($_SERVER['REMOTE_ADDR']));

require_once '../../../class/conn_db.php';
	$type = $_GET['type'];
	$id = $_GET['id'];
	switch ($type) {
		//Tampilkan Data 
		case "get":
			$data = array();
			$SQL = $db->query("SELECT * FROM menu WHERE id='".$id."'");
			$return = $SQL->fetch_array();
			$data = array(
				'id' => $return['id'],
				'label' => $return['name'],
				'link' => $return['link'],
				'eclass' => $return['class'],
				'aktif' => $return['status']
				);	
			echo json_encode($data);
			break;
	}

?>