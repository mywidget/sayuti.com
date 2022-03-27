<body onload="window.print();">
<style>

.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
    border-top: 1px solid #F4F4F4;
    padding: 2px;

}
.h1, .h2, .h3, h1, h2, h3 {
    margin-top: 2px;
    margin-bottom: 2px;
}

</style>

<div class="row">
<div class="col-md-12">
          <div class="row">
            <div class="col-xs-12" style="height:60px">
              <h3 style="margin-top: 0px">Daftar Produk
				<span class="pull-right" >Nibras Fashion</span></h2>
			  </h3>
			  <span style="font-size:12px" class="pull-right">Tanggal : <?=date('d/m/Y');?></span>
            </div><!-- /.col -->
          </div>

				<table id="" class="table table-bordered table-hover">
					<thead>
						<tr>
							<th style="width:2% !important;font-size:11px" class="text-center" >No</th>
							<th class="text-center" style="width:6% !important;font-size:11px">Kode Produk</th>
							<th class="text-center" style="width:35% !important;font-size:11px">Keterangan</th>
							<th class="text-center" style="width:15% !important;font-size:11px">Harga Beli</th>
							<th class="text-center" style="width:15% !important;font-size:11px">Harga Jual</th>
							<th style="width:3% !important;font-size:11px" class="text-center" >Stok In</th>
							<th style="width:3% !important;font-size:11px" class="text-center" >Stok Out</th>
							<th style="width:3% !important;font-size:11px" class="text-center" >Stok</th>
						</tr>
					</thead>
					<tbody>
<?php

 $sqlakuninduk = mysql_query("SELECT * FROM kategori_produk where publish = 'Y' order by nama_kategori");

$no=1;  
while($rowakuninduk=mysql_fetch_array($sqlakuninduk)){
?>	
		<tr>
			<td colspan="8" style="font-size:12px"><i><?php echo $rowakuninduk['nama_kategori'];?>	<i></td>
		</tr>

<?php
									$sql = mysql_query("SELECT * FROM produk where id_kategoriproduk= '$rowakuninduk[id_kategoriproduk]' order by id_kategoriproduk");
									$stok = 0;
									while($row=mysql_fetch_array($sql)){
									$stok = $row['stokin'] - $row['stokout'];	
									?>
										<tr  style="font-size:11px;">
											
											<td ><?php echo $row['id_produk'];?></td>
											<td ><?php echo $row['kode_produk'];?></td>
											<td class="text-left"><?php echo $row['keterangan'];?></td>
											<td class="text-right"><?php echo rp($row['hargabeli']);?></td>
											<td class="text-right"><?php echo rp($row['hargajual']);?></td>
											<td ><?php echo $row['stokin'];?></td>
											<td ><?php echo $row['stokout'];?></td>
											<td ><?php echo $stok;?></td>
										</tr>
<?php		
$no++;
} 
} ?>


                                        </tbody>
                                    </table>
									
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
               
            </div><!-- /.col -->

          </div> <!-- /.row -->


