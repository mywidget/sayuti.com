<?php
define("BASEPATH", gethostbyaddr($_SERVER['REMOTE_ADDR']));
include "../class/filter.inc.php";
include "../class/Mobile_Detect.php";
include "../class/alert.php";
$detect = new Mobile_Detect();
$no = filterget('no');
$msg0 = filterget('msg');
$msg = urlencode($msg0);
if ($detect->isMobile()) {
redirect('https://wa.me/'.$no.'?text='.$msg);
}else{
redirect('https://api.whatsapp.com/send?phone='.$no.'&text='.$msg);
}
?>