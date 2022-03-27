<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');
function createDirectory($path,$include_filename=false,$mode = 0777){
    $dir = explode('/',$path); // Array direktori
    $total = (int) count($dir); // Total array
    if($include_filename == true){
    unset($dir[($total - 1)]); // Unset array terakhir (filename)
    }
    $cur_dir = '../';
    foreach($dir as $key){ // Membuat direktori
    if(!is_dir($cur_dir.$key)){
    @mkdir($cur_dir.$key, $mode);
    }
    $cur_dir .= $key.'/';
    }
    }
function recursive_mkdir($path, $mode = 0777) {
    $dirs = explode(DIRECTORY_SEPARATOR , $path);
    $count = count($dirs);
    $path = '.';
    for ($i = 0; $i < $count; ++$i) {
        $path .= DIRECTORY_SEPARATOR . $dirs[$i];
        if (!is_dir($path) && !mkdir($path, $mode)) {
            return false;
        }
    }
    return true;
}
//Fungsi Upload Postingan
function UploadPost($fupload_name){
  $date_time 	  = date("Y-m-d");
  $vdir_upload = 'images/post/'.$date_time;
  $path_dir = $vdir_upload;
  createDirectory($path_dir);
  $vfile_upload = '../'.$path_dir .'/'. $fupload_name;

  //Simpan gambar dalam ukuran sebenarnya
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);
}


function watermark_image_thumb($tahun,$bulan,$fupload_name){
  //direktori gambar
	//$date_time 	  = foldertgl($tahun);
	$vdir_upload = 'images/post/'.$tahun.'/'.$bulan;
	$path_dir = $vdir_upload;
	//membuat folder berdasarkan THN-BLN-TGL : 2014-10-10
	createDirectory($path_dir);
	$vfile_upload = '../'.$path_dir .'/';
    // folder upload gambar setelah proses watermark
	move_uploaded_file($_FILES['fupload']['tmp_name'], $vfile_upload.$_FILES['fupload']['name']);
	$oldimage_name=$vfile_upload.$_FILES['fupload']['name'];
	$imageType = $_FILES["fupload"]["type"];
	$new_image_name = $fupload_name;
  switch($imageType) {
  case "image/gif":
  $im_src=imagecreatefromgif($oldimage_name); 
  break;
  case "image/pjpeg":
  case "image/jpeg":
  case "image/jpg":
  $im_src=imagecreatefromjpeg($oldimage_name); 
  break;
  case "image/png":
  case "image/x-png":
  $im_src=imagecreatefrompng($oldimage_name); 
  break;}
  //identitas file asli
  //$im_src = imagecreatefromjpeg($oldimage_name);
  $src_width = imageSX($im_src);
  $src_height = imageSY($im_src);

  //Set ukuran gambar hasil perubahan
  $dst_width = 760;
  $dst_height = ($dst_width/$src_width)*$src_height;

  //proses perubahan ukuran
  $im = imagecreatetruecolor($dst_width,$dst_height);
  imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

  //Simpan gambar
  imagejpeg($im,$vfile_upload . $fupload_name);
  //Simpan dalam versi medium 360 pixel
  //Set ukuran gambar hasil perubahan
  $dst_width2 = 200;
  $dst_height2 = ($dst_width2/$src_width)*$src_height;

  //proses perubahan ukuran
  $im2 = imagecreatetruecolor($dst_width2,$dst_height2);
  imagecopyresampled($im2, $im_src, 0, 0, 0, 0, $dst_width2, $dst_height2, $src_width, $src_height);

  //Simpan gambar
  imagejpeg($im2,$vfile_upload . "thumb_" . $fupload_name);
  //Hapus gambar di memori komputer
  imagedestroy($im_src);
  imagedestroy($im);
  imagedestroy($im2);
  unlink($oldimage_name);
}
function watermark_image($tahun,$bulan,$fupload_name2){
	//$date_time 	  = foldertgl($tahun);
	$vdir_upload = 'images/post/'.$tahun.'/'.$bulan;
	$path_dir = $vdir_upload;
	//membuat folder berdasarkan THN-BLN-TGL : 2014-10-10
	createDirectory($path_dir);
	$vfile_upload = '../'.$path_dir .'/';
	$image_show = "../images/logo.png";   // watermark image logo
	$image_path = $image_show; 
    // folder upload gambar setelah proses watermark
	move_uploaded_file($_FILES['fupload']['tmp_name'], $vfile_upload.$_FILES['fupload']['name']);
	$oldimage_name=$vfile_upload.$_FILES['fupload']['name'];
	$new_image_name = $fupload_name2;
   
    list($owidth,$oheight) = getimagesize($oldimage_name);
    $width = 760;
	$height = ($width/$owidth)*$oheight;    // tentukan ukuran gambar akhir, contoh: 300 x 300
    $im = imagecreatetruecolor($width, $height);
    $img_src = imagecreatefromjpeg($oldimage_name);
    imagecopyresampled($im, $img_src, 0, 0, 0, 0, $width, $height, $owidth, $oheight);
    $watermark = imagecreatefrompng($image_path);
    list($w_width, $w_height) = getimagesize($image_path);        
    $pos_x = $width - $w_width; 
    $pos_y = $height - $w_height;
    imagecopy($im, $watermark, $pos_x, $pos_y, 0, 0, $w_width, $w_height);
    imagejpeg($im, $new_image_name, 100); 
    imagedestroy($im);
    unlink($oldimage_name);
    return $new_image_name;
}
function watermark_image_update($tahun,$bulan,$fupload_name){
	$vdir_upload = 'images/post/'.$tahun.'/'.$bulan;
	//$vdir_upload = 'images/post/2014/11';
	//$vdir_upload = "images/post/".$vdir_upload."";
	//$path_dir = $vdir_upload;
	//membuat folder berdasarkan THN-BLN-TGL : 2014-10-10
	$vfile_upload = '../'.$vdir_upload .'/';
	$image_show = "../images/logo.png";   // watermark image logo
	$image_path = $image_show; 
    // folder upload gambar setelah proses watermark
	move_uploaded_file($_FILES['fupload']['tmp_name'], $vfile_upload.$_FILES['fupload']['name']);
	// $oldimage_name=$vfile_upload.$_FILES['fupload']['name'];
	$oldimage_name=$vfile_upload.$fupload_name;
	$new_image_name = $fupload_name;
   
    list($owidth,$oheight) = getimagesize($oldimage_name);
    $width = 760;
	$height = ($width/$owidth)*$oheight;    // tentukan ukuran gambar akhir, contoh: 300 x 300
    $im = imagecreatetruecolor($width, $height);
    $img_src = imagecreatefromjpeg($oldimage_name);
    imagecopyresampled($im, $img_src, 0, 0, 0, 0, $width, $height, $owidth, $oheight);
    $watermark = imagecreatefrompng($image_path);
    list($w_width, $w_height) = getimagesize($image_path);        
    $pos_x = $width - $w_width; 
    $pos_y = $height - $w_height;
    imagecopy($im, $watermark, $pos_x, $pos_y, 0, 0, $w_width, $w_height);
    imagejpeg($im, $new_image_name, 100); 
    imagedestroy($im);
    // unlink($oldimage_name);
    return $new_image_name;
}

?>