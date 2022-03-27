<?php
session_start();
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
header('location:../index.php');
}else{
	// include "../g-asset/web_function.php";
	// include "../mod_khusus.php";
	/*
	 * Script:    DataTables server-side script for PHP and MySQL
	 * Copyright: 2010 - Allan Jardine
	 * License:   GPL v2 or BSD (3-point)
	 */
	
	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Easy set variables
	 */
	
	/* Array of database columns which should be read and sent back to DataTables. Use a space where
	 * you want to insert a non-database field (for example a counter or static image)
	 */
	$aColumns = array( 'i.id_invoice', 'k.nama', 'k.telp', 'i.id_user', 'i.tgl_invoice',  'i.cetak');
	
	
	/* Indexed column (used for fast and accurate table cardinality) */
	$sIndexColumn = "i.id_invoice";
	
	/* DB table to use */
	$sTable = "invoice i, konsumen k";
	
	$sWhere = "WHERE i.id_konsumen = k.id_konsumen AND i.oto = 'save' ";
	
	
	/* Database connection information */
	$gaSql['user']       = "root";
	$gaSql['password']   = "";
	$gaSql['db']         = "db_eshopping";
	$gaSql['server']     = "localhost";
	
	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * If you just want to use the basic configuration for DataTables with PHP server-side, there is
	 * no need to edit below this line
	 */
	
	/* 
	 * MySQL connection
	 */
	$gaSql['link'] =  mysql_pconnect( $gaSql['server'], $gaSql['user'], $gaSql['password']  ) or
		die( 'Could not open connection to server' );
	
	mysql_select_db( $gaSql['db'], $gaSql['link'] ) or 
		die( 'Could not select database '. $gaSql['db'] );
	
	
	/* 
	 * Paging
	 */
	$sLimit = "";
	if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
	{
		$sLimit = "LIMIT ".mysql_real_escape_string( $_GET['iDisplayStart'] ).", ".
			mysql_real_escape_string( $_GET['iDisplayLength'] );
	}
	
	
	/*
	 * Ordering
	 */
	if ( isset( $_GET['iSortCol_0'] ) )
	{
		$sOrder = "ORDER BY  ";
		for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
		{
			if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
			{
				$sOrder .= $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."
				 	".mysql_real_escape_string( $_GET['sSortDir_'.$i] ) .", ";
			}
		}
		
		$sOrder = substr_replace( $sOrder, "", -2 );
		if ( $sOrder == "ORDER BY" )
		{
			$sOrder = "";
		}
	}
	
	
	/* 
	 * Filtering
	 * NOTE this does not match the built-in DataTables filtering which does it
	 * word by word on any field. It's possible to do here, but concerned about efficiency
	 * on very large tables, and MySQL's regex functionality is very limited
	 */
//	$sWhere = "";
	if ( $_GET['sSearch'] != "" )
	{
		$sWhere .= " AND (";
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
			$sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
		}
		$sWhere = substr_replace( $sWhere, "", -3 );
		$sWhere .= ')';
	}
	
	/* Individual column filtering */
	for ( $i=0 ; $i<count($aColumns) ; $i++ )
	{
		if ( $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
		{
			if ( $sWhere == "" )
			{
				$sWhere = "WHERE ";
			}
			else
			{
				$sWhere .= " AND ";
			}
			$sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
		}
	}
	
	
	/*
	 * SQL queries
	 * Get data to display
	 */
	$sQuery = "
		SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns))."
		FROM   $sTable 
		$sWhere
		$sOrder
		$sLimit
	";
	

	
	$rResult = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());
	
	/* Data set length after filtering */
	$sQuery = "
		SELECT FOUND_ROWS()
	";
	$rResultFilterTotal = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());
	$aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
	$iFilteredTotal = $aResultFilterTotal[0];
	
	/* Total data set length */
	$sQuery = "
		SELECT COUNT(".$sIndexColumn.")
		FROM   $sTable
	";
	$rResultTotal = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());
	$aResultTotal = mysql_fetch_array($rResultTotal);
	$iTotal = $aResultTotal[0];
	
	
	/*
	 * Output
	 */
	$output = array(
		"sEcho" => intval($_GET['sEcho']),
		"iTotalRecords" => $iTotal,
		"iTotalDisplayRecords" => $iFilteredTotal,
		"aaData" => array()
	);

	$no=0;
	while ( $aRow = mysql_fetch_array( $rResult ) )
	{

	
	$sql3=mysql_query("SELECT nama FROM user WHERE id_user=".$aRow['id_user']."");
	$row3=mysql_fetch_array($sql3);
	
	//edit
	$aksi_edit = '<input type="hidden" id="idinvoice'.$no.'" value="'.$aRow['id_invoice'].'"><a href="#" data-toggle="modal" data-target="#formadmin"  data-toggle="tooltip"  onclick="getid('.$no.')" title="Rubah Invoice"><i class="fa fa-edit"></i> </a>';
	// <!--View invoice-->
	$aksi_view = '<a href="?panel=invoice&act=invoice&inv='.$aRow['id_invoice'].'&status=view" data-toggle="tooltip" title="Lihat invoice"><i class="fa fa-search"></i> </a>';
	// <!--Print invoice-->
	$aksi_cetak = '<a href="?panel=invoice&act=cetak&id='.$aRow['id_invoice'].'&jmlcetak='.$aRow['cetak'].'&status=cetak" data-toggle="tooltip" title="Print Invoice"><i class="fa fa-print"></i> </a>';
	// <!--Batal invoice-->
	$aksi_batal = '<a href="#" data-toggle="modal" data-target="#formbatal"  data-toggle="tooltip"  onclick="getid('.$no.')" title="Batalin Invoice"><i class="fa fa-trash-o"></i> </a>';
	//while json
	$aksi_gabung = $aksi_edit.$aksi_view.$aksi_cetak.$aksi_batal;
	
		$row = array();
		$no++;

		$row[]=$aRow['id_invoice'];
		$row[]=$aRow['tgl_invoice'];
		$row[]=$aRow['nama'];
		$row[]=$aRow['telp'];
		$row[]=$row3['nama'];
		$row[]=$aksi_gabung;
		$output['aaData'][] = $row;
	}
	echo json_encode( $output );
}
?>