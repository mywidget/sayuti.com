<?php
/**
 * Image resize while uploading
 * @author Resalat Haque
 * @link http://www.w3bees.com/2013/03/resize-image-while-upload-using-php.html
 */
 
/**
 * Image resize
 * @param int $width
 * @param int $height
 */
function resize($tahun, $bulan, $width, $height,$encode){
	/* Get original image x y*/
	list($w, $h) = getimagesize($_FILES['fupload']['tmp_name']);
	/* calculate new image size with ratio */
	$ratio = max($width/$w, $height/$h);
	$h = ceil($height / $ratio);
	$x = ($w - $width / $ratio) / 2;
	$w = ceil($width / $ratio);
	/* new file name */
	$name = basename($_FILES['fupload']['name']); #get filename of files
	// $namafilenya = strtolower($name); 
	// $file_asliX = cleanIMG($namafilenya);
	// $explode    = explode('.',$namafilenya);
    // $extensi    = $explode[count($explode)-1];
	// $file_asli = time() . '_'.$file_asliX.'.'.$extensi;
	// $namafilenya = str_replace(' ','_',$namafilenya);
	$namafilenya = cleanIMG($name); 
	// $namafilenya = str_replace(' ','_',$namafilenya);
	$nama_file_unik = $encode.'_'.$namafilenya;
	
	$vdir_upload = 'images/post/'.$tahun.'/'.$bulan;
	$path = '../'.$vdir_upload.'/'.$width.'x'.$height.'_sayuti.com_'.$nama_file_unik;
	/* read binary data from image file */
	$imgString = file_get_contents($_FILES['fupload']['tmp_name']);
	/* create image from string */
	$image = imagecreatefromstring($imgString);
	$tmp = imagecreatetruecolor($width, $height);
	imagecopyresampled($tmp, $image,
  	0, 0,
  	$x, 0,
  	$width, $height,
  	$w, $h);
	/* Save image */
	switch ($_FILES['fupload']['type']) {
		case 'image/jpeg':
			imagejpeg($tmp, $path, 100);
			break;
		case 'image/png':
			imagepng($tmp, $path, 0);
			break;
		case 'image/gif':
			imagegif($tmp, $path);
			break;
		default:
			exit;
			break;
	}
	return $path;
	/* cleanup memory */
	imagedestroy($image);
	imagedestroy($tmp);
}
?>