<?php
/* Database connection start */
$servername = "localhost";
$username = "sayutic1_neo";
$password = "Llbt=DEWVZH1";
$dbname = "sayutic1_neo";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());

/* Database connection end */


// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;

$columns = array( 
// datatable column index  => database column name
	0 =>'kode', 
	1 =>'photo',
	2=>'harga',
	3=>'ukuran',
	4=>'oc',
	5=>'master',
	6=>'lebar_plastik',
	7=>'harga_plastik',
	8=>'stokmasuk',
	9=>'stokkeluar',
	10=>'merk'
);

// getting total number records without any search
$sql = "SELECT * ";
$sql.=" FROM tbl_und_blangko";
$query=mysqli_query($conn, $sql) or die("data_undangan.php: get tbl_und_blangko");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


$sql = "SELECT * ";
$sql.=" FROM tbl_und_blangko WHERE 1=1";
if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$sql.=" AND ( kode LIKE '".$requestData['search']['value']."%' ";    
	$sql.=" OR harga LIKE '".$requestData['search']['value']."%' ";
}
$query=mysqli_query($conn, $sql) or die("data_undangan.php: get tbl_und_blangko");
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	
$query=mysqli_query($conn, $sql) or die("data_undangan.php: get tbl_und_blangko");

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$nestedData=array(); 

	$nestedData[] = $row["kode"];
	$nestedData[] = $row["merk"];
	$nestedData[] = $row["harga"];
	$nestedData[] = $row["master"];
	$nestedData[] = $row["ukuran"];
	$nestedData[] = $row["oc"];
	$nestedData[] = $row["lebar_plastik"];
	$nestedData[] = $row["harga_plastik"];
	$nestedData[] = $row["stokmasuk"];
	$nestedData[] = $row["stokkeluar"];
	
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