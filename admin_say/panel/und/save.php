<?php
include "config.php";
$id_und = $_POST['id_und'];
$kode = $_POST['kode'];
$merk = $_POST['merk'];
$harga = $_POST['harga'];
$ukuran = $_POST['uk'];
$oc = $_POST['oc'];
$master = $_POST['master'];
$lp = $_POST['lp'];
$hp = $_POST['hp'];
$sm = $_POST['sm'];
$sk = $_POST['sk'];
$crud=$_POST['crud'];

if($crud=='N'){
	mysql_query("insert into tbl_und_blangko(kode,merk,harga,ukuran,oc,master,lebar_plastik,harga_plastik,stokmasuk,stokkeluar) 
	values('$kode','$merk','$harga','$ukuran','$oc','$master','$lp','$hp','$sm','$sk')");
	if(mysql_error()){
		$result['error']=mysql_error();
		$result['result']=0;
	}else{
		$result['error']='';
		$result['result']=1;
	}
}else if($crud == 'E'){
	mysql_query("update tbl_und_blangko set kode='$kode', merk='$merk', harga='$harga', ukuran='$ukuran', oc='$oc', master='$master', lebar_plastik='$lp', harga_plastik='$hp', stokmasuk='$sm', stokkeluar='$sk' where id_und=$id_und");
	if(mysql_error()){
		$result['error']=mysql_error();
		$result['result']=0;
	}else{
		$result['error']='';
		$result['result']=1;
	}
}else{

	$result['error']='Invalid Order';
	$result['result']=0;
}
$result['crud']=$crud;
echo json_encode($result);

?>