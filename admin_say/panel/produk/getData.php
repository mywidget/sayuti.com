<?php
define("BASEPATH", gethostbyaddr($_SERVER['REMOTE_ADDR']));
session_start();
if(isset($_GET['page'])){
	include "../../../class/conn_db.php";
	include "../../../class/pagination.php";
    
    $page = !empty($_GET['page'])?$_GET['page']:0;
	
	$i = 1;
    $limit = 10;
    //set conditions for search
    $whereSQL = $orderSQL = '';
    $keywords = $_GET['keywords'];
	if ($keywords){
		$whereSQL = "WHERE nama_produk LIKE '%$keywords%'";
	}else{
		$whereSQL = "";
	}

    
    //get rows
    $query = $db->query("SELECT * FROM produk $whereSQL LIMIT $page,$limit");
    
    if($query->num_rows > 0){ ?>
        <div class="posts_list">
<table class="table table-bordered table-striped">  
<thead>  
	<tr>
		<th style="width:2% !important" class="text-center">No</th>
		<th class="text-center" style="width:15% !important">Nama Produk</th>
		<th class="text-center" style="width:6% !important">Harga</th>
		<th class="text-center" style="width:5% !important">Featured</th>
		<th class="text-center" style="width:5% !important">Publish</th>
		<th class="text-center" style="width:5% !important">Hapus</th>
	</tr>
</thead>  
<tbody> 
        <?php
	$i = $page + 1;
	while($row = $query->fetch_assoc()){ 
$full_path = $_SERVER["DOCUMENT_ROOT"] . '/'.$row['photo'];
$size = @getimagesize($full_path);
if($size !== false){
$gambar = $row['photo'];
}else{
$gambar = '../images/blank.jpg';
}
if($row['pub']=='Y'){
$aktif = '<span class="label label-success"><span class="glyphicon glyphicon-check"></span></span>';
$title = 'unPublish';
$link = "?panel=produk&act=publish&status=$title&id=$row[id_produk]&page=$page";
}else{
$aktif = '<span class="label label-danger"><span class="glyphicon glyphicon-minus"></span></span>';
$title = 'Publish';
$link = "?panel=produk&act=publish&status=$title&id=$row[id_produk]&page=$page";
}
if($row['featured']=='Y'){
$aktif1 = '<span class="label label-success"><span class="glyphicon glyphicon-check"></span></span>';
$title1 = 'unfeatured';
$link1 = "?panel=produk&act=featured&status=$title1&id=$row[id_produk]&page=$page";
}else{
$aktif1 = '<span class="label label-danger"><span class="glyphicon glyphicon-minus"></span></span>';
$title1 = 'featured';
$link1 = "?panel=produk&act=featured&status=$title1&id=$row[id_produk]&page=$page";
}
        ?>
										<tr>
											
											<td ><?php echo $i;?></td>
											<td class="text-left">
											<a href="?panel=produk&act=edit&id_produk=<?=$row['id_produk'];?>&page=<?=$page;?>" title="Rubah Produk">	<?php echo $row['nama_produk'];?>
											</a></td>
											<td class="text-left"><?php echo $row['harga'];?></td>
											<td><a href="<?=$link1;?>" data-toggle="tooltip" title="<?=$title1;?>"><?=$aktif1;?></a></td>
											<td><a href="<?=$link;?>" data-toggle="tooltip" title="<?=$title;?>"><?=$aktif;?></a></td>
											<td><a data-href="?panel=produk&act=hapus&id=<?=$row['id_produk'];?>" data-toggle="modal" data-target="#confirm-delete" href="#" data-toggle="tooltip" title="Hapus Data"><i class="fa fa-trash-o"></i></a></td>
										</tr>
        <?php $i ++; } ?>
</tbody>  
</table>  
        </div>
<ul class="pagination">
				<!-- LINK FIRST AND PREV -->
				<?php
				if($page == 1){ // Jika page adalah page ke 1, maka disable link PREV
				?>
					<li class="disabled"><a href="#">First</a></li>
					<li class="disabled"><a href="#">&laquo;</a></li>
				<?php
				}else{ // Jika page bukan page ke 1
					$link_prev = ($page > 1)? $page - 1 : 1;
				?>
					<li><a href="?panel=produk&page=1">First</a></li>
					<li><a href="?panel=produk&page=<?php echo $link_prev; ?>">&laquo;</a></li>
				<?php
				}
				?>
				
				<!-- LINK NUMBER -->
				<?php
				// Buat query untuk menghitung semua jumlah data
				$queryNum = $db->query("SELECT COUNT(*) as postNum FROM produk ".$whereSQL);
				$resultNum = $queryNum->fetch_assoc();
				$rowCount = $resultNum['postNum'];
				
				$jumlah_page = ceil($rowCount / $limit); // Hitung jumlah halamannya
				$jumlah_number = 3; // Tentukan jumlah link number sebelum dan sesudah page yang aktif
				$start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1; // Untuk awal link number
				$end_number = ($page < ($jumlah_page - $jumlah_number))? $page + $jumlah_number : $jumlah_page; // Untuk akhir link number
				
				for($i = $start_number; $i <= $end_number; $i++){
					$link_active = ($page == $i)? ' class="active"' : '';
				?>
					<li <?php echo $link_active; ?>><a href="?panel=produk&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
				<?php
				}
				?>
				
				<!-- LINK NEXT AND LAST -->
				<?php
				// Jika page sama dengan jumlah page, maka disable link NEXT nya
				// Artinya page tersebut adalah page terakhir 
				if($page == $jumlah_page){ // Jika page terakhir
				?>
					<li class="disabled"><a href="#">&raquo;</a></li>
					<li class="disabled"><a href="#">Last</a></li>
				<?php
				}else{ // Jika Bukan page terakhir
					$link_next = ($page < $jumlah_page)? $page + 1 : $jumlah_page;
				?>
					<li><a href="?panel=produk&page=<?php echo $link_next; ?>">&raquo;</a></li>
					<li><a href="?panel=produk&page=<?php echo $jumlah_page; ?>">Last</a></li>
				<?php
				}
				?>
			</ul>
<?php } } ?>