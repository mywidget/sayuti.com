<?php
$servername = "localhost";
$username = "sayutic1_neo";
$password = "Llbt=DEWVZH1";
$dbname = "sayutic1_neo";
mysql_connect($servername,$username,$password) or die("Koneksi gagal");
mysql_select_db($dbname) or die("Database tidak bisa dibuka");
$query=mysql_query("SELECT @rownum := @rownum + 1 AS urutan,t.*
	FROM tbl_und_blangko t, 
	(SELECT @rownum := 0) r");
	
$data = array();
while($r = mysql_fetch_assoc($query)) {
	$data[] = $r;
}
$i=0;
foreach ($data as $key) {
		// add new button
	$data[$i]['button'] = '<button type="submit" id_und="'.$data[$i]['id_und'].'" class="btn btn-primary btn-xs btnedit" ><i class="fa fa-edit"></i></button> 
							   <button type="submit" id_und="'.$data[$i]['id_und'].'" kode="'.$data[$i]['kode'].'" class="btn btn-primary btn-xs btnhapus" ><i class="fa fa-remove"></i></button>';
	$i++;
}
$datax = array('data' => $data);
echo json_encode($datax);
?>