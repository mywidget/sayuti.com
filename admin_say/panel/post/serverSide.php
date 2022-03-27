<?php
define("BASEPATH", gethostbyaddr($_SERVER['REMOTE_ADDR']));
include "../../../class/timeago.php";
		function mysqliConnection()
			{
include "../../../class/config_db.php";
				// Database connection information
				$gaSql['user']     = DBUSER;
				$gaSql['password'] = DBPASS;   
				$gaSql['db']       = DBNAME;  //Database
				$gaSql['server']   = DBSERVER;   
				$gaSql['port']     = 3306; // 3306 is the default MySQL port
				$gaSql['charset']  = 'utf8';
				$db = new mysqli($gaSql['server'], $gaSql['user'], $gaSql['password'], $gaSql['db'], $gaSql['port']);
				if (mysqli_connect_error()) {
					die( 'Error connecting to MySQL server (' . mysqli_connect_errno() .') '. mysqli_connect_error() );
				}
				
				if (!$db->set_charset($gaSql['charset'])) {
					die( 'Error loading character set "'.$gaSql['charset'].'": '.$db->error );
				}
				return $db;
			}
			
		function Paging( $input )
			{
				$sLimit = "";
				if ( isset( $input['iDisplayStart'] ) && $input['iDisplayLength'] != '-1' ) {
					$sLimit = " LIMIT ".intval( $input['iDisplayStart'] ).", ".intval( $input['iDisplayLength'] );
				}
				
				return $sLimit;
			}
			
			
		function Ordering( $input, $aColumns )
			{
				$aOrderingRules = array();
				if ( isset( $input['iSortCol_0'] ) ) {
					$iSortingCols = intval( $input['iSortingCols'] );
					for ( $i=0 ; $i<$iSortingCols ; $i++ ) {
						if ( $input[ 'bSortable_'.intval($input['iSortCol_'.$i]) ] == 'true' ) {
							$aOrderingRules[] =
							$aColumns[ intval( $input['iSortCol_'.$i] ) ]." "
							.($input['sSortDir_'.$i]==='asc' ? 'asc' : 'desc');
						}
					}
				}
				
				if (!empty($aOrderingRules)) {
					$sOrder = " ORDER BY ".implode(", ", $aOrderingRules);
					} else {
					$sOrder = "";
				}
				return $sOrder;
			}
			
		function Filtering( $aColumns, $iColumnCount, $input, $db )
			{
				if ( isset($input['sSearch']) && $input['sSearch'] != "" ) {
					$aFilteringRules = array();
					for ( $i=0 ; $i<$iColumnCount ; $i++ ) {
						if ( isset($input['bSearchable_'.$i]) && $input['bSearchable_'.$i] == 'true' ) {
							$aFilteringRules[] = $aColumns[$i]." LIKE '%".$db->real_escape_string( $input['sSearch'] )."%'";
						}
					}
					if (!empty($aFilteringRules)) {
						$aFilteringRules = array('('.implode(" OR ", $aFilteringRules).')');
					}
				}
				
				// Individual column filtering
				for ( $i=0 ; $i<$iColumnCount ; $i++ ) {
					if ( isset($input['bSearchable_'.$i]) && $input['bSearchable_'.$i] == 'true' && $input['sSearch_'.$i] != '' ) {
						$aFilteringRules[] = $aColumns[$i]."  LIKE '%".$db->real_escape_string($input['sSearch_'.$i])."%'";
					}
				}
				
				if (!empty($aFilteringRules)) {
					$sWhere = "WHERE ".implode(" AND ", $aFilteringRules);
					} else {
					$sWhere = "WHERE 1=1 ";
				}
				return $sWhere;
			}
			

	mb_internal_encoding('UTF-8');
	$aColumns = array('pv.id_post','pv.judul','pv.publish','pv.tanggal', 'kt.nama_kategori'); //Kolom Pada Tabel
	
	// Indexed column (used for fast and accurate table cardinality)
	$sIndexColumn = 'id_post';
	
	// DB table to use
	$sTable = 'posting'; // Nama Tabel
	$sTable2 = 'cat'; // Nama Tabel
	// $sTable3 = 'all_provinsi'; // Nama Tabel
	
	
	// Input method (use $_GET, $_POST or $_REQUEST)
	$input =& $_POST;

	
	$iColumnCount = count($aColumns);
	
	$db = mysqliConnection();
	$sLimit = Paging( $input );
	$sOrder = Ordering( $input, $aColumns );
	$sWhere = Filtering( $aColumns, $iColumnCount, $input, $db );
	
	$aQueryColumns = array();
	foreach ($aColumns as $col) {
		if ($col != ' ') {
			$aQueryColumns[] = $col;
		}
	}
	
	$sQuery = "
    SELECT SQL_CALC_FOUND_ROWS pv.id_post, pv.judul,pv.publish,pv.tanggal,  kt.id_cat, kt.nama_kategori
    FROM ".$sTable2." AS kt 
	inner join ".$sTable." AS pv on
	pv.id_cat=kt.id_cat
	".$sWhere.$sOrder.$sLimit;
	
	
	$rResult = $db->query( $sQuery ) or die($db->error);
	// Data set length after filtering
	$sQuery = "SELECT FOUND_ROWS()";
	$rResultFilterTotal = $db->query( $sQuery ) or die($db->error);
	list($iFilteredTotal) = $rResultFilterTotal->fetch_row();
	
	// Total data set length
	$sQuery = "SELECT COUNT(pv.".$sIndexColumn.") FROM ".$sTable." AS pv INNER JOIN ".$sTable2." AS kt ON pv.id_cat = kt.id_cat";
	$rResultTotal = $db->query( $sQuery ) or die($db->error);
	list($iTotal) = $rResultTotal->fetch_row();
	
	/**
		* Output
	*/
	$output = array(
    "sEcho"                => intval($input['sEcho']),
    "iTotalRecords"        => $iTotal,
    "iTotalDisplayRecords" => $iFilteredTotal,
    "aaData"               => array(),
	);
$mode = "panel";
$module = "post"; 
	// Looping Data
	$no=1;
	while ( $aRow = $rResult->fetch_assoc() ) {
		$row = array();
	if($aRow['publish'] == 'Y'){
	$titles	= "unpublish";
	$links 	= "?$mode=$module&act=publish&status=$titles&id=$aRow[id_post]";
	$gbrs	= '<img src="img/yes.png" alt="" />';
	}
	if($aRow['publish'] == 'N'){
	$titles	= "publish";
	$links 	= "?$mode=$module&act=publish&status=$titles&id=$aRow[id_post]";
	$gbrs	= '<img src="img/no.png" alt="" />';
	}
	$publish = '<a href="'.$links.'"  data-toggle="tooltip" title="'.$titles.'"><center>'.$gbrs.'</center></a>';
	$tgl_posting=dtimes($aRow['tanggal'], false,false);
	$judul = "<a href='?$mode=$module&act=edit$module&id=$aRow[id_post]'  data-toggle='tooltip' title='Edit Data'>$aRow[judul]</a>";
	$edit = "<a href='?$mode=$module&act=edit$module&id=$aRow[id_post]'  data-toggle='tooltip' title='Edit Data'><i class='fa fa-edit'></i> </a>";
	$hapus= '<a data-href="?'.$mode.'='.$module.'&act=hapus&id='.$aRow['id_post'].'" data-toggle="modal" data-target="#confirm-delete" href="#" data-toggle="tooltip" title="Hapus Data"><i class="fa fa-trash-o"></i></a>';
	$aksi = $edit.$hapus;
		$row = array( 
		$no++, 
		$judul, 
		$aRow['nama_kategori'],
		$publish,
		$tgl_posting,
		$aksi
		);
		$output['aaData'][] = $row;
	}
	
	echo json_encode( $output );
?>