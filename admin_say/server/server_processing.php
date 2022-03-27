<?php

/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simply to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */

// DB table to use
$table = 'invoice';

// Table's primary key
$primaryKey = 'id_invoice';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
	array( 'db' => '`inv`.`id_invoice`', 	'dt' => 0, 'field' => 'id_invoice' ),
	array( 'db' => '`inv`.`tgl_invoice`', 	'dt' => 1, 'field' => 'tgl_invoice', 'formatter' => function( $d, $row ) {
	return date( 'd-m-Y', strtotime($d));
	}),
	array( 'db' => '`kon`.`nama`',     		'dt' => 2, 'field' => 'nama' ),
	array( 'db' => '`kon`.`telp`',     		'dt' => 3, 'field' => 'telp' ),
	array( 'db' => '`u`.`nama`',   			'dt' => 5, 'field' => 'nama' ),
	array('db'  => '`inv`.`id_invoice`', 	'dt' => 6, 'field' => 'id_invoice', 'edit' => function( $d, $row ) {return ($d);}),
	array('db'  => '`inv`.`cetak`', 		'dt' => 7, 'field' => 'cetak', 'edit' => function( $d, $row ) {
	return ($d);})
);

// SQL server connection information
$db_username 	= 'root';
$db_password 	= '';
$db_name 		= 'db_travel';
$db_host 		= 'localhost';

$sql_details = array(
	'user' => $db_username,
	'pass' => $db_password,
	'db'   => $db_name,
	'host' => $db_host
);

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */

// require( 'ssp.class.php' );
require('ssp.customized.class.php' );

// $joinQuery = "FROM `konsumen` AS `kon` INNER JOIN `invoice` AS `inv` ON (`kon`.`id_konsumen` = `inv`.`id_konsumen`)";
$joinQuery = "FROM `konsumen` AS `kon`
			  INNER JOIN `invoice` AS `inv` ON (`kon`.`id_konsumen` = `inv`.`id_konsumen`)
			  INNER JOIN `user` AS `u` ON (`inv`.`id_user` = `u`.`id_user`)";
$extraWhere = "`kon`.`id_konsumen`=`inv`.`id_konsumen`";        
  
echo json_encode(
	SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere )
);