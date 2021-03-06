<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Undangan</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap.css'?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/jquery.dataTables.css'?>">
</head>
<body>
<div class="container">
	<!-- Page Heading -->
        <div class="row">
            <h1 class="page-header">Data
                <small>Undangan</small>
				<div class="pull-right"><a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#ModalKu"><span class="fa fa-plus"></span> Multi Upload</a> | <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#ModalaAdd"><span class="fa fa-plus"></span> Tambah Data Undangan</a></div>
            </h1>
        </div>
	<div class="row">
		<div id="reload">
		<table class="table table-striped" id="mydata">
			<thead>
				<tr>
					<th>Nama Calon Mempelai Pria</th>
					<th>Nama Calon Mempelai Wanita</th>
					<th style="text-align: right;">Aksi</th>
				</tr>
			</thead>
			<tbody id="show_data">
				
			</tbody>
		</table>
		</div>
	</div>
</div>

		<!-- MODAL ADD -->
        <div class="modal fade" id="ModalKu" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Multi Upload</h3>
            </div>
            <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>index.php/undangan/upload_image">
                <div class="modal-body">
				 <?php 
        if(isset($error))
        {
            echo "ERROR UPLOAD : <br/>";
            print_r($error);
            echo "<hr/>";
        }
        ?>
            <div>Berkas   1: </div>
        	<div><input type="file" name="berkas[]"></div>
            <hr/>
            <div>Berkas   2: </div>
        	<div><input type="file" name="berkas[]"></div>
            <hr/>
            <div>Berkas   3: </div>
        	<div><input type="file" name="berkas[]"></div>
            <hr/>
            <div><input type="submit" value="Simpan"/></div>
                </div>

            </form>
            </div>
            </div>
        </div>
        <!--END MODAL ADD-->

		<!-- MODAL ADD -->
        <div class="modal fade" id="ModalaAdd" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Tambah Data Undangan</h3>
            </div>
            <form class="form-horizontal">
                <div class="modal-body">
				
                            <input name="id" id="id" class="form-control" type="text" readonly value="<?php echo $id; ?>" required>
                
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nama Calon Mempelai Pria</label>
                        <div class="col-xs-9">
                            <input name="ncp" id="ncp" class="form-control" type="text" placeholder="Nama Calon Mempelai Pria" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nama Calon Mempelai Wanita</label>
                        <div class="col-xs-9">
                            <input name="ncw" id="ncw" class="form-control" type="text" placeholder="Nama Calon Mempelai Wanita" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nama Ibu Mempelai Pria</label>
                        <div class="col-xs-9">
                            <input name="icp" id="icp" class="form-control" type="text" placeholder="Nama Ibu Mempelai Pria" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nama Ibu Mempelai Wanita</label>
                        <div class="col-xs-9">
                            <input name="icw" id="icw" class="form-control" type="text" placeholder="Nama Ibu Mempelai Wanita" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nama Ayah Mempelai Pria</label>
                        <div class="col-xs-9">
                            <input name="acp" id="acp" class="form-control" type="text" placeholder="Nama Ayah Mempelai Pria" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nama Ayah Mempelai Wanita</label>
                        <div class="col-xs-9">
                            <input name="acw" id="acw" class="form-control" type="text" placeholder="Nama Ayah Mempelai Wanita" required>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info" id="btn_simpan">Simpan</button>
                </div>
            </form>
            </div>
            </div>
        </div>
        <!--END MODAL ADD-->

        <!-- MODAL EDIT -->
        <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title" id="myModalLabel">Detail Undangan</h3>
            </div>
            <form class="form-horizontal">
                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nama Calon Mempelai Pria</label>
                        <div class="col-xs-9">
                            <input name="ncp" id="ncp" class="form-control" type="text" disabled required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nama Calon Mempelai Wanita</label>
                        <div class="col-xs-9">
                            <input name="ncw" id="ncw" class="form-control" type="text" disabled required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nama Ibu Mempelai Pria</label>
                        <div class="col-xs-9">
                            <input name="icp" id="icp" class="form-control" type="text" disabled required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nama Ibu Mempelai Wanita</label>
                        <div class="col-xs-9">
                            <input name="icw" id="icw" class="form-control" type="text" disabled required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nama Ayah Mempelai Pria</label>
                        <div class="col-xs-9">
                            <input name="acp" id="acp" class="form-control" type="text" disabled required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nama Ayah Mempelai Wanita</label>
                        <div class="col-xs-9">
                            <input name="acw" id="acw" class="form-control" type="text" disabled required>
                        </div>
                    </div>

                </div>

            </form>
            </div>
            </div>
        </div>
        <!--END MODAL EDIT-->

<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/js/bootstrap.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery.dataTables.js'?>"></script>
<script type="text/javascript">
	$(document).ready(function(){
		tampil_data_undangan();	//pemanggilan fungsi tampil undangan.
		
		$('#mydata').dataTable();
		 
		//fungsi tampil undangan
		function tampil_data_undangan(){
		    $.ajax({
		        type  : 'GET',
		        url   : '<?php echo base_url()?>index.php/undangan/data_undangan',
		        async : true,
		        dataType : 'json',
		        success : function(data){
		            var html = '';
		            var i;
		            for(i=0; i<data.length; i++){
		                html += '<tr>'+
		                  		'<td>'+data[i].ncp+'</td>'+
		                        '<td>'+data[i].ncw+'</td>'+
		                        '<td style="text-align:right;">'+
                                    '<a href="javascript:;" class="btn btn-info btn-xs item_detail" data="'+data[i].id+'">Detail</a>'+' '+
                                '</td>'+
		                        '</tr>';
		            }
		            $('#show_data').html(html);
		        }

		    });
		}


		//GET UPDATE
		$('#show_data').on('click','.item_detail',function(){
            var id=$(this).attr('data');
            $.ajax({
                type : "GET",
                url  : "<?php echo base_url('index.php/undangan/get_undangan')?>",
                dataType : "JSON",
                data : {id:id},
                success: function(data){
                	$.each(data,function(ncp, ncw){
                    	$('#ModalEdit').modal('show');
            			$('[name="ncp"]').val(data.ncp);
            			$('[name="ncw"]').val(data.ncw);
            			$('[name="icp"]').val(data.icp);
            			$('[name="icw"]').val(data.icw);
            			$('[name="acp"]').val(data.acp);
            			$('[name="acw"]').val(data.acw);
            		});
                }
            });
            return false;
        });
		//Simpan undangan
		$('#btn_simpan').on('click',function(){
            var id=$('#id').val();
            var ncp=$('#ncp').val();
            var ncw=$('#ncw').val();
            var icp=$('#icp').val();
            var icw=$('#icw').val();
            var acp=$('#acp').val();
            var acw=$('#acw').val();
            $.ajax({
                type : "POST",
                url  : "<?php echo base_url('index.php/undangan/simpan_undangan')?>",
                dataType : "JSON",
                data : {id:id , ncp:ncp, ncw:ncw, icp:icp, icw:icw, acp:acp, acw:acw},
                success: function(data){
                    $('[name="ncp"]').val("");
                    $('[name="ncw"]').val("");
                    $('[name="icp"]').val("");
                    $('[name="icw"]').val("");
                    $('[name="acp"]').val("");
                    $('[name="acw"]').val("");
                    $('#ModalaAdd').modal('hide');
                    tampil_data_undangan();
                }
            });
            return false;
        });


	});

</script>
</body>
</html>