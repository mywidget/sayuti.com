<?php
define("BASEPATH", gethostbyaddr($_SERVER['REMOTE_ADDR']));
session_start();
if (isset($_SESSION['namauser'])){
if(isset($_POST['page'])){
require_once '../../../class/conn_db.php';
require_once "../../../class/web_function.php";
require_once "../../../class/filter.inc.php";
require_once "../../../class/Pagination.php";
$iduser = $_SESSION['iduser'];
$level = $_SESSION['leveluser'];

	$start = !empty($_POST['page'])?$_POST['page']:0;
	$limit = 5;
    $keywords = filterpost('keywords');
	if ($level== "admin" ){
	if ($keywords!= "" ){
	// echo 1;
		$whereSQL = "WHERE `judul` LIKE '%".filterpost('keywords')."%'";
	}else{
	$whereSQL =  '';
	// echo 2;
	}
	}else{
	if ($keywords!= "" ){
		$whereSQL = "WHERE id_user = '$iduser' AND judul LIKE '%".filterpost('keywords')."%'";
	}else{
		$whereSQL = "WHERE id_user = '$iduser'";
	}
	}
    $queryNum = $db->query("SELECT COUNT(*) as postNum FROM widget_wa ".$whereSQL."");
    $resultNum = $queryNum->fetch_assoc();
    $rowCount = $resultNum['postNum'];
    //initialize pagination class
    $pagConfig = array(
        'currentPage' => $start,
        'totalRows' => $rowCount,
        'perPage' => $limit,
        'link_func' => 'cariWidget'
    );
    $pagination =  new Pagination($pagConfig);
    $query = $db->query("SELECT * FROM `widget_wa` ".$whereSQL." ORDER BY id DESC LIMIT $start,$limit");
if($query->num_rows > 0){ ?>
<table class="wp-list-table widefat fixed striped posts">
	<thead>
		<tr>
			<th style="width:30% !important">Nama widget</th>
			<th class="manage-column column-embed_code" id="embed_code" scope="col">Kode Embed</th>
		</tr>
	</thead>
	<tbody id="the-list">
<?php
$no=0;
$nom=1;
while($row=$query->fetch_array()){
	if($row['pub'] == 0){
	$titles	= "unpublish";
	$links 	= "?panel=plugin&act=publish&status=$titles&id=$row[xcode]";
	$gbrs	= '<img src="img/yes.png" alt="" />';
	}
	if($row['pub'] == 1){
	$titles	= "publish";
	$links 	= "?panel=plugin&act=publish&status=$titles&id=$row[xcode]";
	$gbrs	= '<img src="img/no.png" alt="" />';
	}
?>
		<tr class="iedit author-self level-0 post-<?=$row['xcode'];?> type-widget status-publish hentry" id="post-<?=$row['xcode'];?>">
			<td class="new-title column-new-title has-row-actions column-primary" data-colname="New Title">
				Website:<strong> <?php echo geturl($row['judul']);?></strong>
				<div class="row-actions">
					<span class="edit"><a  href="?panel=plugin&act=edit&id=<?=$row['xcode'];?>">Edit</a> |</span> <span class="view"><a class="submitdelete" href="<?php echo geturl($row['judul']);?>" target="_blank">Visit</a> |</span> <span class="delete"><a class="submitdelete" data-href="?panel=plugin&act=delete&id=<?=$row['id'];?>" data-toggle="modal" data-target="#confirm-delete" href="#" data-toggle="tooltip" title="Hapus Data">Hapus</a> |</span> <span class="view"><a href="<?=$link;?>/widget/<?=$row['xcode'];?>" rel="bookmark" target="_blank">View Json</a></span>
				</div><button class="toggle-row" type="button"><span class="screen-reader-text">Show more details</span></button>
			</td>
			<td class="embed_code column-embed_code">Kode Embed: <span id="alert<?=$no;?>"></span>
			<div class="input-group input-group-sm">
                <textarea id="salinKode" name="kode" class="form-control" rows="1" style="background:#fff;width:100%;" readonly="readonly">&lt;script async data-id="<?=$row['xcode'];?>" src="<?=$link;?>/widget.script.min.js"&gt;&lt;/script&gt;</textarea>
                    <span class="input-group-btn">
                      <button type="button" id="btn-copy" class="btn btn-danger copybtn">Salin Kode</button>
                    </span>
</div>
			</td>
		</tr>
<?php
$no++;
}
?>
	</tbody>
	<tfoot>
		<tr>
			<th class="manage-column column-new-title column-primary" scope="col">Nama widget</th>
			<th class="manage-column column-embed_code" scope="col">Kode Embed</th>
		</tr>
	</tfoot>
</table>
<script>
window.onload = function () {
  // Get all the elements that match the selector as arrays
  var copyTextareaBtn = Array.prototype.slice.call(document.querySelectorAll('.copybtn'));
  var copyTextarea = Array.prototype.slice.call(document.querySelectorAll('#salinKode'));

  // Loop through the button array and set up event handlers for each element
  copyTextareaBtn.forEach(function(btn, idx){
  
    btn.addEventListener("click", function(){
    
      // Get the textarea who's index matches the index of the button
      copyTextarea[idx].select();
      try {
        var msg = document.execCommand('copy') ? 'salin kode semat berhasil' : 'salin kode semat tidak berhasil';
		$("#alert"+idx).html(msg);
		 $("#alert"+idx).fadeIn(3000).delay(1000).fadeOut("slow");
        // console.log('Copying text command was ' + msg);
      } catch (err) {
        console.log('Whoops, unable to copy');
      } 
      
    });
    
  });
}
</script>
		<div style="float:right">
        <?php echo $pagination->createLinks(); ?>
        </div>
 <?php }else{echo"Data tidak ditemukan";}
}else{echo "error";}
}else{echo "error";}
 ?>