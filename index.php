<?php
define("BASEPATH", gethostbyaddr($_SERVER['REMOTE_ADDR']));
define('ROOT', dirname(__FILE__));
define('DS', DIRECTORY_SEPARATOR);
define('FOLDER', 'class');

include __DIR__ .  DS . FOLDER . DS . 'conn_db.php';
include __DIR__ .  DS . FOLDER . DS . 'file.inc.php';
// include __DIR__ .  DS . FOLDER . DS . 'lib' . DS . 'function.php';

define('BASE_URL', $host);
include __DIR__ .  DS . FOLDER . DS . 'template.inc.php';
?>