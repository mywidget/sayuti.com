<?php
session_start();
if (empty($_SESSION['mailuser'])){
header('location:../index.php');
}else{
if(isset($_POST['page'])){
    //Include pagination class file
    // include('Pagination.php');
	include "../../../conn/konfigurasi.php";
	include "../../../conn/Pagination.php";
	include "../../lib/function.php";
$mysqliDebug = true;

// definisikan koneksi ke database
$gaSql['user']       = DB2_USER;
$gaSql['password']   = DB2_PASSWORD;
$gaSql['db']         = DB2_NAMA;
$gaSql['server']     = DB2_HOST;
// Create database connection
$db = new mysqli($gaSql['server'], $gaSql['user'], $gaSql['password'], $gaSql['db']);
    if ($db->connect_errno) {
        echo '<p>There was an error connecting to the database!</p>';
        if ($mysqliDebug) {
            echo $db->connect_error;
        }
        die();
    }
    $start = !empty($_POST['page'])?$_POST['page']:0;
    $limit = 10;
    
    //set conditions for search
    $whereSQL = $orderSQL = '';
    $keywords = $_POST['keywords'];
	if (strlen($_POST["keywords"]) >4 ){
	if ( $_POST["keywords"] != "" )
	{
		$whereSQL = "WHERE Nm_Bhn LIKE '%".$keywords."%'";
	}else{
		$whereSQL = "";
	}
	}
    //get number of rows
    $queryNum = $db->query("SELECT COUNT(*) as postNum FROM tbl_bahan ".$whereSQL);
    $resultNum = $queryNum->fetch_assoc();
    $rowCount = $resultNum['postNum'];

    //initialize pagination class
    $pagConfig = array(
        'currentPage' => $start,
        'totalRows' => $rowCount,
        'perPage' => $limit,
        'link_func' => 'cariFilter'
    );
    $pagination =  new Pagination($pagConfig);
    
    //get rows
    $query = $db->query("SELECT * FROM tbl_bahan $whereSQL ORDER BY Nm_Bhn ASC LIMIT $start,$limit ");
    $page = ceil($query->num_rows / $limit);
    if($query->num_rows > 0){ ?>
        <div class="posts_list">
<table class="table table-bordered table-striped">  
<thead>  
		<tr>
			<th style="width:2%;">No</th>
			<th class="text-center">Nama Bahan</th>
			<th class="text-center" style="width:15%;">Ukuran</th>
			<th class="text-center" style="width:8%;">Harga</th>
			<th class="text-center" style="width:6%;">Tebal</th>
			<th class="text-center" style="width:3%;">Publish (Y/N)</th>
			<th class="text-center" style="width:5%">Aksi</th>
		</tr>
</thead>  
<tbody> 
        <?php
	$no = $start + 1;
	while($aRow = $query->fetch_assoc()){

	$edit = paramEncrypt('module=bahan&act=editbahan&id='.$aRow['Kd_Bhn']);
	$edit_adm ='<a href="?'.$edit.'"  data-toggle="tooltip" title="Edit Data">'.$aRow['Nm_Bhn'].'';
	
	$nama = '<input style="width:100%;" class="text-left" type="text" id="nama'.$aRow['Kd_Bhn'].'" onchange="savharga('.$aRow['Kd_Bhn'].')" value="'.$aRow['Nm_Bhn'].'" >';
	
	$tinggi = '<input style="width:50px !important;" class="text-center" type="text" id="tinggi'.$aRow['Kd_Bhn'].'" onchange="savharga('.$aRow['Kd_Bhn'].')" value="'.$aRow['Tinggi'].'" >';
	
	$lebar = '<input style="width:50px !important;" class="text-center" type="text" id="lebar'.$aRow['Kd_Bhn'].'" onchange="savharga('.$aRow['Kd_Bhn'].')" value="'.$aRow['Lebar'].'" >';
	
	$harga = '<input style="width:100px !important;" class="text-center" type="text" id="harga'.$aRow['Kd_Bhn'].'" onchange="savharga('.$aRow['Kd_Bhn'].')" value="'.$aRow['Harga_Bahan'].'" >';
	
	$tebal = '<input style="width:100px !important;" class="text-center" type="text" id="tebal'.$aRow['Kd_Bhn'].'" onchange="savharga('.$aRow['Kd_Bhn'].')" value="'.$aRow['Tebal'].'" >';
	
	$pub = '<input style="width:80px !important;" class="text-center" type="text" id="pub'.$aRow['Kd_Bhn'].'" onchange="savharga('.$aRow['Kd_Bhn'].')" value="'.$aRow['publish'].'" >';
	
	// $hapus = paramEncrypt('module=bahan&act=hapus&id='.$aRow['Kd_Bhn']);	
	$hapus = "<a href='#' onClick='deleteUserk({$aRow['Kd_Bhn']})'><i class='fa fa-trash-o'></i></a>";	
	$data ='<a href="?'.$edit.'"  data-toggle="tooltip" title="Edit Data"><i class="fa fa-edit"></i></a> '.$hapus;
        ?>
            <tr>  
            <td><?=$no++;?></td>  
            <td><?=$nama; ?></td>  
            <td><?=$tinggi.'x'.$lebar.'cm'; ?></td>  
            <td><?=$harga;?></td>
            <td><?=$tebal; ?></td> 
            <td><?=$pub; ?></td>  
            <td><?=$data; ?></td>  
            </tr> 
        <?php } ?>
</tbody>  
</table>  
        </div>
		<div style="float:right">
        <?php echo $pagination->createLinks(); ?>
        </div>
<?php }} } ?>

