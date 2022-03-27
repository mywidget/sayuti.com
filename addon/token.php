<?php 
define("BASEPATH", gethostbyaddr($_SERVER['REMOTE_ADDR']));
include "../class/conn_db.php";
include "../class/filter.inc.php";
include "../class/referer.php";
$modul = filterpost('modul');
$Cekref = refer($referer,$host,'index.php');
if($Cekref==0){
	goto modul;
}elseif($Cekref==1){
	goto modul;
}else{
echo json_encode(array(401 => "Akses ditolak"));
}
modul:
if($modul){
$sql = $db->query("select * from info_service where id='$modul'");
$row = $sql->fetch_array();
?>
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?=$row['judul'];?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?=$row['sub_judul'];?>
		<?=$row['isi'];?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
<?php }else{ echo json_encode(array(401 => "Akses ditolak")); } ?>