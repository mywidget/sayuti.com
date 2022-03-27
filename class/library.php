<?php
// error_reporting(0);
//Deteksi hanya bisa diinclude, tidak bisa langsung dibuka (direct open)
if(count(get_included_files())==1)
{
	echo "<meta http-equiv='refresh' content='0; url=http://$_SERVER[HTTP_HOST]'>";
	exit("Direct access not permitted.");
}
date_default_timezone_set('Asia/Jakarta'); // PHP 6 mengharuskan penyebutan timezone.

$seminggu = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
$hari = date("w");
$hari_ini = $seminggu[$hari];

$tgl_sekarang = date("Y-m-d");
$tgl_skrg     = date("d");
$bln_sekarang = date("m");
$thn_sekarang = date("Y");
$jam_sekarang = date("H:i:s");
$date_time 	  = date("Y-m-d H:i:s");

//konversi tanggal
	function date_times($tgld){
	$tgl_last = date('d F Y H:i:s',strtotime($tgld));
			return $tgl_last;		 
	}
	function tgl_exp($tglp){
	$tgl_post = date('Y-m-d',strtotime($tglp));
			return $tgl_post;		 
	}	
	function tgl_reg($tglp){
	$tgl_post = date('d M Y',strtotime($tglp));
			return $tgl_post;		 
	}
	function jam_reg($jam){
	$jam_post = date('H:i:s',strtotime($jam));
			return $jam_post;		 
	}
	function hari_reg($day){
	$array_hari = array(1=>'Senin','Selasa','Rabu','Kamis','Jumat', 'Sabtu','Minggu');
	$day_post = $array_hari[date('N',strtotime($day))];
			return $day_post;		 
	}	
	
$nama_bln=array(1=> "Januari", "Februari", "Maret", "April", "Mei", 
                    "Juni", "Juli", "Agustus", "September", 
                    "Oktober", "November", "Desember");
					
	function tgl_indo($tgl){
			$tanggal = substr($tgl,8,2);
			$bulan = getBulan(substr($tgl,5,2));
			$tahun = substr($tgl,0,4);
			return $tanggal.' '.$bulan.' '.$tahun;		 
	}	

	function getBulan($bln){
				switch ($bln){
					case 1: 
						return "Januari";
						break;
					case 2:
						return "Februari";
						break;
					case 3:
						return "Maret";
						break;
					case 4:
						return "April";
						break;
					case 5:
						return "Mei";
						break;
					case 6:
						return "Juni";
						break;
					case 7:
						return "Juli";
						break;
					case 8:
						return "Agustus";
						break;
					case 9:
						return "September";
						break;
					case 10:
						return "Oktober";
						break;
					case 11:
						return "November";
						break;
					case 12:
						return "Desember";
						break;
				}
			} 

function IntervalDays($CheckIn,$CheckOut){
$CheckInX = explode("-", $CheckIn);
$CheckOutX =  explode("-", $CheckOut);
$date1 =  mktime(0, 0, 0, $CheckInX[1],$CheckInX[2],$CheckInX[0]);
$date2 =  mktime(0, 0, 0, $CheckOutX[1],$CheckOutX[2],$CheckOutX[0]);
$interval =($date2 - $date1)/(3600*24);
// returns numberofdays
return  $interval ;
}
	function bln($bln1){
	$bulan = date('m',strtotime($bln1));
			return $bulan;		 
	}
	function thn($thn){
	$tahun = date('Y',strtotime($thn));
			return $tahun;		 
	}
	function bln_romawi($bln){
				switch ($bln){
					case 1: 
						return "I";
						break;
					case 2:
						return "II";
						break;
					case 3:
						return "III";
						break;
					case 4:
						return "IV";
						break;
					case 5:
						return "V";
						break;
					case 6:
						return "VI";
						break;
					case 7:
						return "VII";
						break;
					case 8:
						return "VIII";
						break;
					case 9:
						return "IX";
						break;
					case 10:
						return "X";
						break;
					case 11:
						return "XI";
						break;
					case 12:
						return "XII";
						break;
				}
			} 
function linkify($text) {
 $reg_exUrl = "/((http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?)/";
 if(preg_match($reg_exUrl, $text)) {
  return preg_replace($reg_exUrl, '<a href="${1}" target="”_blank”">${1}</a> ', $text);
 } else {
  return $text;
 }
}
    function Xauto_link($str, $attributes=array()) {
    		$attrs = '';
    		foreach ($attributes as $attribute => $value) {
    			$attrs .= " {$attribute}=\"{$value}\"";
    		}
    		$str = ' ' . $str;
    		$str = preg_replace(
    			'`([^"=\'>])(((http|https|ftp)://|www.)[^\s<]+[^\s<\.)])`i',
    			'$1<a href="$2"'.$attrs.'>$2</a>',
    			$str
    		);
    		$str = substr($str, 1);
    		$str = preg_replace('`href=\"www`','href="http://www',$str);
    		// fÃ¼gt http:// hinzu, wenn nicht vorhanden
    		return $str;
    	}
?>
