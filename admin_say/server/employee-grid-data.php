<?php
/* Database connection start */
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_travel";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());

/* Database connection end */


// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column name
	0 =>'id_invoice', 
	1 => 'id_departemen',
	2=> 'id_user',
	3=> 'tgl_invoice',
	4=> 'handling',
	5=> 'id_konsumen',
	6=> 'cetak'
);

// getting total number records without any search
$sql = "SELECT id_invoice, id_departemen,id_user,tgl_invoice,handling,id_konsumen,cetak";
$sql.=" FROM invoice";
$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


$sql = "SELECT id_invoice, id_departemen,id_user,tgl_invoice,handling,id_konsumen,cetak";
$sql.=" FROM invoice";
if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$sql.=" AND ( id_invoice LIKE '".$requestData['search']['value']."%' ";    
	$sql.=" OR  handling LIKE '".$requestData['search']['value']."%' ";

	$sql.=" OR tgl_invoice LIKE '".$requestData['search']['value']."%' )";
}
$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees");
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	
$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees");

$data = array();
$no=0;
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$nestedData=array(); 
	$sql2 = "SELECT nama,telp ";
	$sql2.=" FROM konsumen WHERE id_konsumen='$row[id_konsumen]'";
	$query2=mysqli_query($conn, $sql2) or die("employee-grid-data.php: get employees");
	$row2=mysqli_fetch_array($query2);	
	
	$sql3 = "SELECT nama";
	$sql3.=" FROM user WHERE id_user='$row[id_user]'";
	$query3=mysqli_query($conn, $sql3) or die("employee-grid-data.php: get employees");
	$row3=mysqli_fetch_array($query3);
	//edit
	$aksi_edit = '<input type="hidden" id="idinvoice'.$no.'" value="'.$row['id_invoice'].'"><a href="#" data-toggle="modal" data-target="#formadmin"  data-toggle="tooltip"  onclick="getid('.$no.')" title="Rubah Invoice"><i class="fa fa-edit"></i> </a>';
	// <!--View invoice-->
	$aksi_view = '<a href="?panel=invoice&act=invoice&inv='.$row['id_invoice'].'&status=view" data-toggle="tooltip" title="Lihat invoice"><i class="fa fa-search"></i> </a>';
	// <!--Print invoice-->
	$aksi_cetak = '<a href="?panel=invoice&act=cetak&id='.$row['id_invoice'].'&jmlcetak='.$row['cetak'].'&status=cetak" data-toggle="tooltip" title="Print Invoice"><i class="fa fa-print"></i> </a>';
	// <!--Batal invoice-->
	$aksi_batal = '<a href="#" data-toggle="modal" data-target="#formbatal"  data-toggle="tooltip"  onclick="getid('.$no.')" title="Batalin Invoice"><i class="fa fa-trash-o"></i> </a>';
	//while json
	$aksi_gabung = $aksi_edit.$aksi_view.$aksi_cetak.$aksi_batal;
	$nestedData[] = $row["id_invoice"];
	$nestedData[] = $row["tgl_invoice"];
	$nestedData[] = $row2["nama"];
	$nestedData[] = $row2["telp"];
	$nestedData[] = $row["handling"];
	$nestedData[] = $row3["nama"];
	$nestedData[] = $aksi_gabung;
	
	$no++;
	$data[] = $nestedData;
}



$json_data = array(
			"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
			"recordsTotal"    => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
			);

echo json_encode($json_data);  // send data as json format

?>
