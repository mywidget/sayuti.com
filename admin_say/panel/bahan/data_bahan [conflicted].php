<?php
error_reporting(0);
session_start();
if (empty($_SESSION['namauser'])){
header('location:../index.php');
}else{
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
	include "../../../conn/konfigurasi.php";
	include "../../../lib/function.php";
	$aColumns = array('Kd_Bhn', 'id_kategori', 'Nm_Bhn', 'Harga_Bahan', 'Tinggi', 'Lebar', 'Tebal', 'Ceklist','publish');
	
	/* Indexed column (used for fast and accurate table cardinality) */
	$sIndexColumn = "Kd_Bhn";
	
	/* DB table to use */
	$sTable = "tbl_bahan";
	
	/* Database connection information */
	$gaSql['user']       = DB2_USER;
	$gaSql['password']   = DB2_PASSWORD;
	$gaSql['db']         = DB2_NAMA;
	$gaSql['server']     = DB2_HOST;
	
	
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
	$sWhere = "";
	if ( $_GET['sSearch'] != "" )
	{
		$sWhere = "WHERE (";
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
	$i=0;
	while ( $aRow = mysql_fetch_array( $rResult ) )
	{
	if($aRow['publish']=='Y'){
	  $publish ='<a href="?'.paramEncrypt('module=bahan&act=unpublish&id='.$aRow['Kd_Bhn'].'').'"><img src="img/yes.png" data-toggle="tooltip" title="unpublish" width="16" alt="" /></a>';
	  }else{
	  $publish ='<a href="?'.paramEncrypt('module=bahan&act=publish&id='.$aRow['Kd_Bhn'].'').'"><img src="img/no.png" data-toggle="tooltip" title="publish" width="16" alt="" /></a>';
	  }
	 $btn = "<a href='#' onClick='showModalsk({$aRow[Kd_Bhn]})'>{$aRow[Nm_Bhn]}</a>";
	$edit = paramEncrypt('module=bahan&act=editbahan&id='.$aRow['Kd_Bhn']);
	$edit_adm ='<a href="?'.$edit.'"  data-toggle="tooltip" title="Edit Data">'.$aRow['Nm_Bhn'].'';
	// $hapus = paramEncrypt('module=bahan&act=hapus&id='.$aRow['Kd_Bhn']);	
	$hapus = "<a href='#' onClick='deleteUserk({$aRow[Kd_Bhn]})'><i class='fa fa-trash-o'></i></a>";	
	$data ='<a href="?'.$edit.'"  data-toggle="tooltip" title="Edit Data"><i class="fa fa-edit"></i></a> '.$hapus;
	$harga = '<input style="width:100px !important;" class="text-center" type="text" id="harga'.$aRow['Kd_Bhn'].'" onchange="savharga('.$aRow['Kd_Bhn'].')" value="'.$aRow['Harga_Bahan'].'" >';
	
	  // $aColumns = array('Kd_Bhn', 'id_kategori', 'Nm_Bhn', 'Harga_Bahan', 'Tinggi', 'Lebar', 'Tebal', 'Ceklist','publish');
		$row = array();
		$i++;
		$row[]=$i;
		$row[]=$btn;//nama
		$row[]=$aRow['Tinggi'].'x'.$aRow['Lebar'].'cm';//ukuran
		$row[]=$harga;//$aRow['Harga_Bahan'];//harga
		$row[]=$aRow['Tebal'];//tebal
		$row[]=$publish;//publish
		$row[]=$data;//aksi
		$output['aaData'][] = $row;
	}
	
	echo json_encode($output);
}
?>