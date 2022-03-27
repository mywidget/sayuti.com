<?php
include "config.php";

$id_und=$_POST['id_und'];
$query=mysql_query("select * from tbl_und_blangko where id_und=$id_und");
$array = array();
while($data = mysql_fetch_array($query)){
	$array['id_und']= $data['id_und'];
	$array['kode']= $data['kode'];
	$array['merk']= $data['merk'];
	$array['harga']= $data['harga'];
	$array['uk']= $data['ukuran'];
	$array['oc']= $data['oc'];
	$array['master']= $data['master'];
	$array['lp']= $data['lebar_plastik'];
	$array['hp']= $data['harga_plastik'];
	$array['sm']= $data['stokmasuk'];
	$array['sk']= $data['stokkeluar'];

}
echo json_encode($array);

?>