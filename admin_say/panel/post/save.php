<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
header('location:../index.php');
}else{
include( '../class/function_crop.php');
	if(isset($_POST['submit'])):
    //membuat session array dengan variabel - variabel POST
    $_SESSION['postnews']=$_POST;
	endif;
	if(isset($_SESSION['postnews'])):
    $judul		= $_SESSION['postnews']['judul'];
    $berita		= $_SESSION['postnews']['postingan'];
    $caption	= $_SESSION['postnews']['caption'];
	else:
    $judul  ='';
    $berita	='';
    $caption	='';
	endif;
	// deklarasikan variabel
	$idb		= filterpint('id');
	$judul		= htmlentities($_POST['judul']);
	$judul_seo1 = cleanString($_POST['judul']);
	$judul_seox = stripinput($judul_seo1);
	$judul_seo  = seo_friendly_url($judul_seox);
	$publish	= filterpost('publish');
	$str		= $_POST['postingan'];
	$isi	 	= str_replace("&nbsp;", ' ', $str);
	$tgl		= $_POST['tanggal'];
	$jam		= $_POST['jam'];
	$alias		= filterpost('admin');
	$caption 	= filterpost('caption');
	$link 		= filterpost('link');
	$acak		= rand(111,999);
	$encode		= base_convert($acak,20,36);
	$tanggal	= $tgl.' '.$jam;
    if(!empty($_POST['data'])){
	$data_cat = $_POST['data'];
    $data=implode(',',$data_cat);
	}else{
    save_alert('error',fill);
	}
	if(!empty($_POST['tag'])){
	$inputtag	= $_POST['tag'];
    $tag		= implode(',',$inputtag); 
	}else{
    $tag='';
	}
	// echo $caption;
	$eror       = false;

$max_file_size = 2024*400; // 200kb
$valid_exts = array('jpeg', 'jpg', 'png', 'gif');
// thumbnail sizes
$sizes = array(200 => 200, 630=>320);
	// validasi agar tidak ada data yang kosong
	if($judul!="" && $isi!="") {
	//Mulai memorises data
	$lokasi_file	= $_FILES['fupload']['tmp_name'];
    $file_name  	= $_FILES['fupload']['name'];
	$type      		= $_FILES['fupload']['type'];
    $file_size  	= $_FILES['fupload']['size'];
	
	$name = basename($_FILES['fupload']['name']); #get filename of files
	$namafilenya = cleanIMG($name); 
	$nama_file_unik = $encode.'_'.$namafilenya;
	$file_asli = "sayuti.com_".$nama_file_unik;
	
    //cari extensi file dengan menggunakan fungsi explode
    $explode    = explode('.',$file_name);
    $extensi    = $explode[count($explode)-1];


    //check ukuran file apakah sudah sesuai
 

	//cek ID 0 = input data
if($idb == 0) {
        //mulai memproses upload file
	if (!empty($lokasi_file)){
	$CEK = $db->query("SELECT judul FROM posting WHERE judul='$judul'");
	$num_rows = $CEK->num_rows; //cek apakah email dan password terdapat pada tabel.
	if ($num_rows > 0 ){
		save_alert('error',duplikat);
		// LongRedirect('?'.$mode.'='.$module.'&act=tambah'.$module);
		} else {
		$tahun = folderthn($tanggal);
		$bulan = folderbln($tanggal);
		$path = "images/post/".$tahun."/".$bulan;
		createDirectory($path);
if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_FILES['fupload'])) {
	if( $_FILES['fupload']['size'] < $max_file_size ){
		// get file extension
		$ext = strtolower(pathinfo($_FILES['fupload']['name'], PATHINFO_EXTENSION));
		if (in_array($ext, $valid_exts)) {
			/* resize image */
			foreach ($sizes as $w => $h) {
				$files[] = resize($tahun, $bulan, $w, $h,$encode);
			}

		} else {
			$msg = 'Unsupported file';
		}
	} else{
		$msg = 'Please upload image smaller than 200KB';
	}
}
watermark_image_thumb($tahun,$bulan,$file_asli);
  $insert = $db->prepare("INSERT INTO posting(judul, judul_seo, id_cat, publish, alias, postingan, tanggal, tag, folder, gambar, caption, link_dl) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
  $insert->bind_param("ssssssssssss",$judul,$judul_seo,$data,$publish,$alias,$isi,$tanggal,$tag,$tanggal,$file_asli,$caption,$link);
if($insert->execute())
{
	save_alert('save',save);
	htmlRedirect('?'.$mode.'='.$module.'&alert=save');
	unset($_SESSION['postnews']);
	
}else{
// save_alert('error',ERROR);
	save_alert('error',$insert->error);
	htmlRedirect('?'.$mode.'='.$module);
}

	   }
        } else{
		save_alert('error',fill);
		htmlRedirect('?'.$mode.'='.$module);
        }
// }
		}//end input
		else {
	if (!empty($lokasi_file)){
		$res = $db->query("SELECT * FROM posting WHERE id_post=".$idb);
		$r=$res->fetch_array();
		$tahun = folderthn($r['folder']);
		$bulan = folderbln($r['folder']);
		$path = "images/post/".$tahun."/".$bulan;
		createDirectory($path);
		$gambar1 = "../images/post/".$tahun."/".$bulan."/".$r['gambar']."";
		$gambar2 = "../images/post/".$tahun."/".$bulan."/thumb_".$r['gambar']."";
		$gambar3 = "../images/post/".$tahun."/".$bulan."/200x200_".$r['gambar']."";
		$new=$path.$nama_file_unik;
		// Cek Gambar 
		if (file_exists($gambar2) AND $r['gambar'] != 'default.jpg'){
		 unlink($gambar1);
		 unlink($gambar2);
		}
if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_FILES['fupload'])) {
	if( $_FILES['fupload']['size'] < $max_file_size ){
		// get file extension
		$ext = strtolower(pathinfo($_FILES['fupload']['name'], PATHINFO_EXTENSION));
		if (in_array($ext, $valid_exts)) {
			/* resize image */
			foreach ($sizes as $w => $h) {
				$files[] = resize($tahun, $bulan, $w, $h,$encode);
			}

		} else {
			$msg = 'Unsupported file';
		}
	} else{
		$msg = 'Please upload image smaller than 200KB';
	}
}
 watermark_image_thumb($tahun,$bulan,$file_asli);
 watermark_image_update($tahun,$bulan,$file_asli);
$edit = $db->prepare("UPDATE posting  SET judul=?, id_cat=?, publish=?, alias=?, postingan=?, tag=?, tanggal=?, gambar=?, caption=?, link_dl=? WHERE id_post=?");
$edit->bind_param("ssssssssssi",$judul,$data,$publish,$alias,$isi,$tag,$tanggal,$file_asli,$caption,$link,$idb);
if($edit->execute())
{
	save_alert('update',update);
	htmlRedirect('?'.$mode.'='.$module.'&alert=update');
}else{
save_alert('error',$edit->error);
	htmlRedirect('?'.$mode.'='.$module.'&alert=update');
}
}//end jika ada gambar
else{
$edit = $db->prepare("UPDATE posting  SET judul=?, id_cat=?, publish=?, alias=?, postingan=?, tag=?, tanggal=?, caption=?, link_dl=? WHERE id_post=?");
$edit->bind_param("sssssssssi",$judul,$data,$publish,$alias,$isi,$tag,$tanggal,$caption,$link,$idb);
if($edit->execute())
{
	save_alert('update',update);
	htmlRedirect('?'.$mode.'='.$module);
}else{
save_alert('error',$edit->error);
	htmlRedirect('?'.$mode.'='.$module);
}
		}//end update
	}//end pudate
}//end cek post judul
else{
		save_alert('error',fill);
		htmlRedirect('?'.$mode.'='.$module.'&act=tambah');
	}
}
 ?>