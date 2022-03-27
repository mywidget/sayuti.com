<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');
switch($act){
  // Tampil List user
  default:

$notab='';	

?>

<style>
#dispidakun{float:right;position:relative;top:-33px;right:5px;z-index:100px;}
#dispnama{float:right;position:relative;top:-33px;right:5px;z-index:100px;}
#result{float:right;position:relative;top:-33px;right:5px;z-index:100px;}
#validate-status{float:right;position:relative;top:-33px;right:5px;z-index:100px;}
.red, .red a {color: #FF0000;font-size:24pt}
.green, .green a {color: #33CC33;font-size:24pt}
.modal-title{color:#000}
.modal-footer{color:#000}
#result{
	margin-left:5px;
}
.tooltip {
    max-width: 350px;
    /* If max-width does not work, try using width instead */
    width: 350px; 
}
.nav > li > a:hover, .nav > li > a:active, .nav > li > a:focus {
    color: #444;
    background: #C0BAB0 none repeat scroll 0% 0%;
}
label {
    display: inline-block;
    width: 90%;
    margin-top: 10px;
    font-weight: 700;
}
th{background-color: #F39C12;height:30px;border: solid 1px #dcdcdc;}
td, th {
  border: 1px solid #ccc;
  text-align: center;
  height:28px;
}
	.style-1 input[type="text"] {
    padding: 4px;
    border: 0px solid #DCDCDC;
    transition: box-shadow 0.3s ease 0s, border 0.3s ease 0s;
	}
.style-1 input[type="text"]:focus,
.style-1 input[type="text"].focus {
  border: solid 1px #707070;
  box-shadow: 0 0 5px 1px #969696;
}
	.form-control {
    height: 28px;
    padding: 6px 6px;
	}
	
	.form-control2 {
    height: 28px;
    padding: 6px 6px;
	width: 50%;
	border: 1px solid #DCDCDC;
	}	
	
	.dropdown-toggle {
    width: 100%;
    padding: 2px;
    height: 28px;
    border-radius: 0px;
	}	
	
.form-group {
    margin-bottom: 7px;
}	

</style>




          <!-- START CUSTOM TABS -->
          <div class="row">
            <div class="col-md-12">
						<div class="box">
						<div class='box-header with-border'>
						<div class="col-md-6">
							<h4 class='box-title'>Info Sayuti.com</h4>
						</div>						
						<div class="col-md-6">
							<div class="pull-right"> <a href="?<?=$mode;?>=<?=$module;?>&act=edit&id_info=0" class="btn btn-danger" title="Tambah Info">Tambah Info</a> 
							</div>
						</div>
						</div>
                               
						  <div class="box-body">
								<table class="table table-bordered table-hover">
									<thead>
										<tr>
											<th class="text-center" style="width:6% !important">ID Info</th>
											<th class="text-center" style="width:15% !important">Judul</th>
											<th class="text-center" style="width:35% !important">Isi</th>
											<th class="text-center" style="width:15% !important">Photo</th>
											<th class="text-center" style="width:5% !important">Publish</th>
										</tr>
									</thead>
									<tbody>
									<?php
									
									$sql = $db->query("SELECT * FROM info order by id_info DESC");
									$nom=1;
									while($row=$sql->fetch_array()){
									?>
										<tr>
											
											<?php if ($_SESSION['leveluser'] == 'admin'){ ?>
											<td >
											<a href="?<?=$mode;?>=<?=$module;?>&act=edit&id=<?=$row['id_info'];?>"><?php echo $row['id_info'];?>
											</a></td>
											<?php }else{ ?>
											<td class="text-center"><?php echo $row['id_info'];?></td>
											<?php } ?>
											<td class="text-left"><?php echo $row['judul'];?></td>
											<td class="text-left"><?php echo $row['isi'];?></td>
											<td ><img width="150px" src="<?php echo $row['photo'];?>"></td>
											<td ><?php echo $row['pub'];?></td>
										</tr>
									<?php $_SESSION['bar'] = $nom; $nom++; }									
									   ?>
									</tbody>
								</table>
							</div><!-- /.box-body -->  
                            </div><!-- /.box -->
                  </div><!-- /.tab-pane -->

          </div> <!-- /.row -->
<?php 
    break;


	case "save":
	include"save_info.php";
    break;
	
	case "edit":
	include"edit_data_info.php";
    break;
	
	}
?>	
	

<script type="text/javascript">

function openKCFinder(textarea) {
    window.KCFinder = {
        callBackMultiple: function(files) {
            window.KCFinder = null;
            textarea.value = "";
            for (var i = 0; i < files.length; i++)
                textarea.value += files[i] + "#\n";
        }
    };
    window.open('../kcfinder/browse.php?type=images&dir=images/produk',
        'kcfinder_multiple', 'status=0, toolbar=0, location=0, menubar=0, ' +
        'directories=0, resizable=1, scrollbars=0, width=800, height=600'
    );
}

</script>
<style type="text/css">
#files {
    height: 100px;
    cursor: pointer
}

</style>
			

 