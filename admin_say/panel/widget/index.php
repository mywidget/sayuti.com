<?php 
// if (! defined('BASEPATH')) exit('No direct script access allowed');
switch($act){
  default:
  $limit = 5;
	if ($level== "admin" ){
    $queryNum = $db->query("SELECT COUNT(*) as postNum FROM widget_wa");
	}else{
    $queryNum = $db->query("SELECT COUNT(*) as postNum FROM widget_wa WHERE id_user = '$iduser'");
	}
    $resultNum = $queryNum->fetch_assoc();
    $rowCount = $resultNum['postNum'];
    
    //initialize pagination class
    $pagConfig = array(
        'totalRows' => $rowCount,
        'perPage' => $limit,
        'link_func' => 'cariWidget'
    );
    $pagination =  new Pagination($pagConfig);
	if ($level== "admin" ){
    $query = $db->query("SELECT * FROM widget_wa ORDER BY id DESC LIMIT $limit");
	}else{
    $query = $db->query("SELECT * FROM widget_wa WHERE id_user = '$iduser' ORDER BY id DESC LIMIT $limit");
	}
?>
<link href="dist/css/table.css" rel="stylesheet">
			<div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Data widget</h3>     
									<div class="box-tools pull-right">
									<a href="?<?=$mode;?>=widget&act=edit" class="btn btn-default pull-left"><i class="fa fa-plus"></i> Tambah</a>
									</div>
                                </div><!-- /.box-header table-responsive-->
<div class="box-body">
<div class="row">
<div class="col-md-6" style="margin-bottom:10px">
<div class="input-group">
<input type="text" id="cariData" class="form-control" placeholder="Cari : judul"/>
<div class="input-group-btn ">
<button type="submit" class="btn btn-success" id='btnCari'/>Cari</button>
</div>
</div>
</div><!-- ./col -->
</div><!-- ./col -->
<?php if($query->num_rows > 0){ ?>
<div id="data-widget">
<table class="wp-list-table widefat fixed striped posts">
	<thead>
		<tr>
			<th style="width:30% !important">Nama widget</th>
			<th class="manage-column column-embed_code" id="embed_code" scope="col">Kode Embed</th>
			<th class="manage-column column-embed_code"  scope="col">
			<a data-toggle="modal" data-target="#embed-help" href="#" data-toggle="tooltip" title="Cara Embed"><i class="fa fa-life-bouy pull-right"></i></a>
			</th>
		</tr>
	</thead>
	<tbody id="the-list">
<?php
$no=0;
$nom=1;
while($row=$query->fetch_array()){
?>
		<tr class="iedit author-self level-0 post-<?=$row['xcode'];?> type-widget status-publish hentry" id="post-<?=$row['xcode'];?>">
			<td class="new-title column-new-title has-row-actions column-primary" data-colname="New Title">
				Website:<strong> <?php echo geturl($row['judul']);?></strong>
				<div class="row-actions">
					<span class="edit"><a  href="?<?=$mode;?>=widget&act=edit&id=<?=$row['xcode'];?>">Edit</a> |</span> <span class="view"><a class="submitdelete" href="<?php echo geturl($row['judul']);?>" target="_blank">Visit</a> |</span> <span class="delete"> <a href="#" class="confirm-delete submitdelete" data-id="<?=$row['id'];?>" data-code="<?=$row['xcode'];?>">Hapus</a>|</span> <span class="view"><a href="<?=$link;?>widget/<?=$row['xcode'];?>" rel="bookmark" target="_blank">View Json</a></span>
				</div><button class="toggle-row" type="button"><span class="screen-reader-text">Show more details</span></button>
			</td>
			<td class="embed_code column-embed_code" colspan="2">Kode Embed: <span id="alert<?=$no;?>"></span>
			<div class="input-group input-group-sm">
                <textarea id="salinKode" name="kode" class="form-control" rows="1" style="background:#fff;width:100%;" readonly="readonly">&lt;script async data-id="<?=$row['xcode'];?>" src="<?=$link.$pathnya.$nama_js;?>.js"&gt;&lt;/script&gt;</textarea>
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
			<th class="manage-column column-embed_code"  scope="col"><a data-toggle="modal" data-target="#embed-help" href="#" data-toggle="tooltip" title="Cara Embed"><i class="fa fa-life-bouy pull-right"></i></a></th>
		</tr>
	</tfoot>
</table>
		<div style="float:right">
        <?php echo $pagination->createLinks(); ?>
        </div>
 <?php } ?>
</div><!-- /.post-list -->
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                        </div>
     <div class="modal fade" id="myModalDel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content modal-md">
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
                </div>
            
                <div class="modal-body">
                    <p>Anda akan menghapus satu data, prosedur ini tidak dapat diubah.</p>
                    <p>Apakah Anda ingin melanjutkan?</p>
                    <p class="debug-url"></p>
                </div>
                <div class="modal-footer">
                    <a href="#" id="btnYes" class="btn btn-danger danger">Ya</a>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                </div>
            </div>
        </div>
    </div>
<script>
$("#btnCari").click(function(){
 cariWidget();
});
function cariWidget(page_num) {
    page_num = page_num?page_num:0;
    var keywords = $('#cariData').val();
    $.ajaxQueue({
        type: 'POST',
        url: 'panel/widget/getData.php',
        data:'page='+page_num+'&keywords='+keywords,
        beforeSend: function () {
            $('.loading-overlay').show();
			$('#btnCari').html('<i class="fa fa-circle-o-notch fa-spin"></i>');
        },
        success: function (html) {
            $('#data-widget').html(html);
            $('.loading-overlay').fadeOut("slow");
			$('#btnCari').html('Cari');
        }
    });

}
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
$('#myModalDel').on('show', function() {
    var id = $(this).data('id'),
        removeBtn = $(this).find('.danger');
		
});
$('.confirm-delete').on('click', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    var code = $(this).data('code');
    $('#myModalDel').data('id', id).modal('show');
    $('#myModalDel').data('code', code);
});
$(document).on("click","#btnYes",function() {
  	var id = $('#myModalDel').data('id');
  	var code = $('#myModalDel').data('code');
             $.ajax({
                type: "GET",
				url: "panel/widget/crud.php",
                data: {type:"hapus",id:id,code:code},
                cache : false,
				dataType: 'json',
                success: function(data){
				if(data[0]=='ok'){
                  $("#post-" + code).remove();
				  notif('Data di hapus','info');
				}else{
				  notif('Data gagal di hapus','danger');
				}
				 $('#myModalDel').modal('hide');
				// $("#load").hide();
                } ,error: function(xhr, status, error) {
                  alert(error);
                },
	});
});
</script>
    <div class="modal fade" id="embed-help" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Cara Embed Kode</h4>
                </div>
            
                <div class="modal-body">
           &#x3C;head&#x3E;<br/>
&#x3C;!--start--&#x3E;<br/>
&#x3C;script async data-id=&#x22;109129&#x22; src=&#x22;https://m.titiknol.co.id//widget/script.widget.js&#x22;&#x3E;&#x3C;/script&#x3E;<br/>
&#x3C;!--end--&#x3E;<br/>
&#x3C;/head&#x3E;
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
<?php 
    break;
	
	case "edit":
	include __DIR__ . '/form_edit.php';
    break;
	}
 ?>