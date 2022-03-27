<?php
//Deteksi hanya bisa diinclude, tidak bisa langsung dibuka (direct open)
if(count(get_included_files())==1)
{
	echo "<meta http-equiv='refresh' content='0; url=http://$_SERVER[HTTP_HOST]'>";
	exit("Direct access not permitted.");
}
// error_reporting(0);
//session_start();
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
header('location:../index.php');
}else{
// $id= ->real_escape_string($_GET["id_produk"]);
// $_SESSION['id'] = $id;
// echo $notab;
$result=$db->query("select * from produk where id_produk='$GETIDP'");
$data = $result->fetch_array();
$jumlah = $result->num_rows;
if ($jumlah > 0){
	$id_produk = $data['id_produk'];
	$nama_produk = $data['nama_produk'];
	$produk_seo = $data['produk_seo'];
	$keterangan = $data['keterangan'];
	$keyword = $data['keyword'];
	$harga = $data['harga'];
	$photo = $data['photo'];

	$photo2 = $data['photo2'];
	$pub = $data['pub'];
	$hitung = $data['hitung'];
	$kategori_produk = $data['kategori_produk'];
	$status = $data['status'];
	$btnimg = '<img id="img" src="'.$photo.'" style="width: 200px; height: 200px; margin-left: 0px; margin-top: 0px; visibility: visible;">';
 $dir = "/".$produk_seo;
 bdir($dir);
 echo IMGopen('openimgKCFinder','images','images/produk/'.$produk_seo); 
 echo imgMulti('multiIMG','images','images/produk/'.$produk_seo);
}else{
	$id_produk = "";
	$nama_produk = "";
	$produk_seo = "";
	$keterangan = "";
	$keyword = "";
	$harga = "";
	$photo = "";
	$photo2 = "";
	$pub = "";
	$hitung = "";
	$kategori_produk = "";
	$status = "";
	$btnimg = '<div style="margin:5px">Klik to Upload</div>';
echo IMGopen('openimgKCFinder','images','images/produk/');
echo imgMulti('multiIMG','images','images/produk/');
	}

?>

                        <div class="row">
                                <form role="form" id="myform" method="POST" action="?<?=$mode;?>=<?=$module;?>&act=save">
                        <div class="col-md-6">
                            <div class="box">
								<div class="box-header">								
                                    <h3 class="box-title">Edit Produk</h3>									
                                </div><!-- /.box-header -->
                                <!-- form start -->
								<input type="hidden" name="idp" value="<?=$id_produk;?>">
								<input type="hidden"  name="page" value="<?=$_GET['page'];?>">
								<input type="hidden"  name="notab" value="<?=$notab;?>">
								<input type="hidden"  id="imgs" name="photo" value="<?=$photo;?>">
								<input type="hidden"  name="tab" value="">
                                    <div class="box-body">
									<div class="form-group">
                                            <label for="email">Jenis Produk</label>
											<select name="id_jenis_produk" class="form-control">
											<?php
											$sql_cat = $db->query("SELECT * from jenis_produk order by produk");
											while($row_cat=$sql_cat->fetch_array()){
											if ($row_cat['id_jenis_produk']==$kategori_produk){
												$selected = "selected";
												}else{
												$selected = "";
											 } ?>
											<option value="<?=$row_cat['id_jenis_produk'];?>" <?=$selected;?>><?=$row_cat['produk'];?></option>
											<?php } ?>
											
											</select>
                                        </div>				
                                        <div class="form-group">
                                            <label for="username">Nama Produk</label>
                                            <input type="text" name="nama_produk" class="form-control" id="nama_produk" placeholder="Kode Produk" value="<?php echo $nama_produk; ?>">
                                        </div>
										<div class="form-group">
                                            <label for="username">Keterangan</label>
											<textarea id="compose-textarea"  name="keterangan" class="form-control" style="height: 200px">
											<?=$keterangan;?>
											</textarea>
										</div>
										<div class="col-md-6">
										<div class="form-group">
                                            <label for="username">Harga</label>
                                            <input type="text" name="harga_produk" class="form-control" id="harga" placeholder="Harga Produk" value="<?php echo $harga; ?>">
                                        </div>
                                        </div>
										<div class="col-md-6">
										<div class="form-group">
                                            <label for="status">Status</label>
                                            <input type="text" name="status" class="form-control" id="status" placeholder="status Produk" value="<?php echo $status; ?>">
                                        </div>
                                        </div>

<div class="col-md-6">
									 <div class="form-group">
										<div class="form-group">
                                            <label for="hitung">Hitung</label>
                                            <input type="text" name="hitung" value="<?php echo $hitung; ?>" class="form-control" id="hitung" placeholder="Publish" >
                                        </div>	
                                    </div>
                                    </div>
<div class="col-md-6">
									<div class="form-group">
										<div class="form-group">
                                            <label for="email">Publish</label>
                                            <input type="text" name="pub" value="<?php echo $pub; ?>" class="form-control" id="stokin" placeholder="Publish" >
                                        </div>	
                                    </div>										 	
                                    </div>										 	
																		
                                    </div><!-- /.box-body -->
                                    </div>	
                                    </div>	
									<div class="col-md-6">
									<div class="box">
									<div class="box-body">
										<div class="form-group">
										 <label for="email">Photo Utama <code>uk-max : 500x500 px</code></label>
										 <div id="image" onclick="openimgKCFinder(this)"><?=$btnimg;?></div>
										</div>
										<div class="form-group">
										 <label for="email2">Photo Tambahan<code>uk-min : 800x950 px</code></label>
										</div>
										<div class="form-group">
										 <textarea id="files" name="photo2" readonly="readonly" onclick="multiIMG(this)"><?=$photo2;?></textarea>
										</div>
										<div class="form-group">
                                            <label for="username">Keyword</label>
											<textarea id="key-textarea"  name="keyword" class="form-control" style="height: 100px">
											<?=$keyword;?>
											</textarea>
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