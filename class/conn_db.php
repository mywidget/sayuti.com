<?php
// error_reporting(0);
// if (! defined('BASEPATH')) exit('No direct script access allowed');
	$mysqliDebug = true;
	include 'config_db.php';
     $db = @new mysqli(DBSERVER,DBUSER,DBPASS,DBNAME);

    if ($db->connect_errno) {
        echo '<p>There was an error connecting to the database!</p>';
        if ($mysqliDebug) {
            echo $db->connect_error;
        }
        die();
    }
?>