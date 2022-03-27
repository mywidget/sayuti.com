<?php 
  // error_reporting(0);
  //Deteksi hanya bisa diinclude, tidak bisa langsung dibuka (direct open)
if(count(get_included_files())==1)
{
	echo "<meta http-equiv='refresh' content='0; url=http://$_SERVER[HTTP_HOST]'>";
	exit("Direct access not permitted.");
}
function add_menu($tipe,$posisi) {
	global $db;
	if($posisi == 'Menu') : 
	elseif($posisi == 'footer') : 
	endif;
switch($tipe) {
		case $tipe:
		$query = $db->query("select * from modul where nama_modul='".$posisi."' and publish='Y'");
		$menu = $query->num_rows;
		// $menu=mysql_num_rows(mysql_query("select * from modul where nama_modul='".$posisi."' and publish='Y'"));
		if ($menu > 0){
echo "<ul>";
      function get_menu($data, $parent = 0) {
          static $i = 1;
          $tab = str_repeat("", $i);
          if ($data[$parent]) {
              $html = "$tab";
              $i++;
              foreach ($data[$parent] as $v) {
                   $child = get_menu($data, $v->id_menu);
                   $html .= "$tab<li>";
                   $html .= '<a href="'.BASE_URL.$v->link.'">'.$v->nama_menu.'</a>';
                    if ($child) {
                       $i--;
                       $html .= "<ul>$child";
                       $html .= "$tab</ul>";
                   }
                   $html .= '</li>';
              }
              $html .= "$tab";
              return $html;
          }
        else {
              return false;
          }
      }
		$query = $db->query("SELECT * FROM menu where aktif='Y' and posisi='".$tipe."' ORDER BY urutan");
      while ($row = $query->fetch_array()) {
           $data[$row->id_parent][] = $row;
      }
      $menu = get_menu($data);
      echo "$menu";   
echo "</ul>";
	}
		break;
	
}
	return $printBanner;
	
	echo $printBanner;
}
function add_menub($tipe,$posisi) {
	if($posisi == 'Menu') : 
	elseif($posisi == 'Bawah') : 
	endif;
switch($tipe) {
		case $tipe:
		$menu=mysql_num_rows(mysql_query("select * from modul where nama_modul='".$posisi."' and publish='Y'"));
		if ($menu > 0){
echo "<ul>";
      function get_menub($data, $parent = 0) {
          static $i = 1;
          $tab = str_repeat("", $i);
          if ($data[$parent]) {
              $html = "$tab";
              $i++;
              foreach ($data[$parent] as $v) {
                   $child = get_menub($data, $v->id_menu);
                   $html .= "$tab<li>";
                   $html .= '<a href="'.BASE_URL.$v->link.'">'.$v->nama_menu.'</a>';
                    if ($child) {
                       $i--;
                       $html .= "<ul>$child";
                       $html .= "$tab</ul>";
                   }
                   $html .= '</li>';
              }
              $html .= "$tab";
              return $html;
          }
        else {
              return false;
          }
      }
      $result = mysql_query("SELECT * FROM menu where aktif='Y' and posisi='".$tipe."' ORDER BY urutan");
      while ($row = mysql_fetch_object($result)) {
           $data[$row->id_parent][] = $row;
      }
      $menu = get_menub($data);
      echo "$menu";   
echo "</ul>";
	}
		break;
	
}
	return $printBanner;
	
	echo $printBanner;
}
function add_footer($tipe,$posisi) {
	if($posisi == 'Menu') : 
	elseif($posisi == 'Bawah') : 
	endif;
switch($tipe) {
		case $tipe:
		$menu=mysql_num_rows(mysql_query("select * from modul where nama_modul='".$posisi."' and publish='Y'"));
		if ($menu > 0){
      $result = mysql_query("SELECT * FROM menu where aktif='Y' and posisi='".$tipe."' ORDER BY urutan");
      while ($row = mysql_fetch_array($result)) {
         echo "|<a href='".BASE_URL.$row['link']."'>$row[nama_menu]</a>|";
			}
		}
		break;
	
}
	return $printBanner;
	
	echo $printBanner;
}
?>