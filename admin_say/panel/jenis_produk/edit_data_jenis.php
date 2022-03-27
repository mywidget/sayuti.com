<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
	if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
		header('location:../index.php');
		}else{
		$result=$db->query("select * from jenis_produk where id_jenis_produk='$GETID'");
		$data = $result->fetch_array();
		$jumlah = $result->num_rows;
		if ($jumlah > 0){
			$id_jenis_produk = $data['id_jenis_produk'];
			$produk = $data['produk'];
			$keterangan = $data['keterangan'];
			$photo = $data['photo'];
			$pub = $data['pub'];
			//form tambah data
			}else{
			$id_jenis_produk = "";
			$produk = "";
			$keterangan = "";
			$photo = "";
			$pub = "";
		}
		$site_urlimg = 'https://sayuti.com';
		echo IMGopen('openimgKCFinder','images','images/jenis_produk/');
		echo LinkImg('LinkImg','images','images/jenis_produk/');
		
	?>
	<div class="row">
		<form role="form" method="POST" action="?<?=$mode;?>=<?=$module;?>&act=save">
			<div class="col-md-6">
				<div class="box">
					<div class="box-header">								
						<h3 class="box-title">Edit Produk</h3>
					</div><!-- /.box-header -->
					<!-- form start -->
					<input type="hidden" name="id_jenis_produk" value="<?=$id_jenis_produk;?>">
					<input type="hidden" name="save" value="update">
					<div class="box-body">
						<div class="form-group">
							<label for="username">Nama Produk</label>
							<input type="text" name="produk" class="form-control" id="produk" placeholder="Kode Produk" value="<?php echo $produk; ?>">
						</div>
						<div class="form-group">
							<label for="username">Keterangan</label>
							<textarea type="text" name="keterangan" class="form-control" id="keterangan" placeholder="Keterangan" required><?php echo $keterangan; ?></textarea>
						</div>
						
						<div class="form-group">
							<div class="form-group">
								<label for="email">Publish</label>
								<input type="text" name="pub" value="<?php echo $pub; ?>" class="form-control" id="stokin" placeholder="Publish" required>
							</div>	
						</div>	
						
					</div><!-- /.box-body -->
				</div>	
			</div>	
			<div class="col-md-6">
				<div class="box">
					<div class="box-body">
						<div class="form-group">
							<label for="files">Thumb Images</label>
							<input type="text" id="files" name="photo" readonly="readonly" onclick="LinkImg(this,'<?=$site_urlimg;?>')" value="<?=$photo;?>" class="form-control" style="cursor:pointer" />
						</div>
					</div>
					
				</div>	
				
				<div class="box-footer">
					<?php if($jumlah > 0) { ?>
						<button type="submit" name="update" class="btn btn-primary">Update</button>
						<?php }else{ ?>
						<button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
					<?php } ?>
					<a href="?<?=$mode;?>=<?=$module;?>" class="btn btn-danger">Batal</a>
				</div>
				
			</div>
			</div>
		</div>
	</div><!-- /.col -->
	
</form>
</div><!-- /.col (left) -->
<?php 
	} ?>		