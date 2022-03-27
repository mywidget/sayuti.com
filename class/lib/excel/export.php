<?php
error_reporting(0);
  require_once('Worksheet.php');
  require_once('Workbook.php');

  // koneksi ke mysql
  mysql_connect('localhost', 'root', '');
  mysql_select_db('test');

  // function untuk membuat header file excel
  function HeaderingExcel($filename) {
      header("Content-type: application/vnd.ms-excel");
      header("Content-Disposition: attachment; filename=$filename" );
      header("Expires: 0");
      header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
      header("Pragma: public");
      }

  // membuat header file excel dan nama filenya
  HeaderingExcel('mhs.xls');

  // membuat workbook baru
  $workbook = new Workbook("");
  // membuat worksheet ke-1 (data laki-laki)
  $worksheet1 =& $workbook->add_worksheet('Laki-laki');

  // setting format header tabel data
  $format =& $workbook->add_format();
  $format->set_align('vcenter');
  $format->set_align('center');
  $format->set_color('white');
  $format->set_bold();
  $format->set_italic();
  $format->set_pattern();
  $format->set_fg_color('red');

  // membuat header tabel dengan format
  $worksheet1->set_row(0, 15);
  $worksheet1->set_column(0, 0, 10);
  $worksheet1->write_string(0, 0, "NIM", $format);
  $worksheet1->set_column(0, 1, 30);
  $worksheet1->write_string(0, 1, "NAMA", $format);
  $worksheet1->set_column(0, 2, 20);
  $worksheet1->write_string(0, 2, "TINGGI BADAN (cm)", $format);

  // menampilkan data mhasiswa laki-laki

  $query = "SELECT * FROM mhs WHERE jns_kelamin = 'L'";
  $hasil = mysql_query($query);
  $baris = 1;
  while ($data = mysql_fetch_array($hasil))
  {
        $worksheet1->write_string($baris, 0, $data['nim']);
        $worksheet1->write_string($baris, 1, $data['nama']);
        $worksheet1->write_number($baris, 2, $data['tinggi']);
        $baris++;
  }

  // membuat worksheet ke-2 untuk data mhs perempuan
  $worksheet2 =& $workbook->add_worksheet('Perempuan');

  // membuat header tabel
  $worksheet2->set_row(0, 15);
  $worksheet2->set_column(0, 0, 10);
  $worksheet2->write_string(0, 0, "NIM", $format);
  $worksheet2->set_column(0, 1, 30);
  $worksheet2->write_string(0, 1, "NAMA", $format);
  $worksheet2->set_column(0, 2, 20);
  $worksheet2->write_string(0, 2, "TINGGI BADAN (cm)", $format);

  // menampilkan data mhasiswa perempuan

  $query = "SELECT * FROM mhs WHERE jns_kelamin = 'P'";
  $hasil = mysql_query($query);
  $baris = 1;
  while ($data = mysql_fetch_array($hasil))
  {
        $worksheet2->write_string($baris, 0, $data['nim']);
        $worksheet2->write_string($baris, 1, $data['nama']);
        $worksheet2->write_number($baris, 2, $data['tinggi']);
        $baris++;
  }

  $workbook->close();
?>
