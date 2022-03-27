<?php
session_start();
	include "../g-asset/conn_db.php";
	include "../g-asset/web_function.php";
?>
 <table id="test" class="table table-hover">
				  <thead>
                    <tr>
                      <th style='width:1%'>#</th>
                      <th style='width:6%'>Produk</th>
                      <th style='width:6%'>Keterangan</th>
                      <th style='width:6%'>No. Tiket/Voucher</th>
                      <th style='width:4%'>Jml</th>
                      <th style='width:6%'>Harga</th>
                      <th style="width:6%">Diskon</th>
                      <th style='width:6%'>NTA</th>
                      <th style="width:6%">TAX(%)</th>
                      <th style='width:6%'>Profit</th>
                    </tr>
					 <thead>
					  <tbody>
					  <?php
					  $sql = mysql_query("SELECT * from produk,invoice_detail where produk.id_produk=invoice_detail.id_produk AND id_invoice='$_SESSION[id_invoice]'");
					  $no=0;
					  while($row=mysql_fetch_array($sql)){
					  $id_rincian = $row['id_rincianinvoice'];	  
					  ?>
					  <tr>
						<td><a data-href="?panel=konsumen&act=hapus&id=<?=$_SESSION['getid'];?>&inv=<?=$_SESSION['id_invoice'];?>&idprod=<?=$row['id_produk'];?>&iddel=<?=$row['id_rincianinvoice'];?>" data-toggle="modal" data-target="#confirm-delete" href="#" data-toggle="tooltip" title="Hapus Data"><i class="fa fa-trash-o"></i></a>
						</td>
						<td><input type="hidden" name="data[]" id="id_rincian<?=$no;?>" value="<?=$row['id_rincianinvoice'];?>"><a href="edit_produk.php?idetail=<?=$row['id_rincianinvoice'];?>&act=editproduk<?=$row['id_produk'];?>&inv=<?=$id_invoice;?>" data-toggle="modal" data-id="<?=$row['id_produk'];?>" data-target="#editproduk<?=$row['id_produk'];?>"><?=$row['nama_produk'];?></a></td>
						<td><div style="position: relative;"><input type="text" data-type="text" data-status="0" data-min-text-value="1" data-error-message="Harus di isi" name="ket[]" id="ket<?=$no;?>" value="<?=$row['keterangan'];?>" onkeyup="sav()" class="form-control col-xs-10" ></div></td>
						<td><?=kata($row['no_tik_voch'],15);?></td>
						<td><input type="text" name="jml[]" id="jml<?=$no;?>" value="<?=$row['jumlah'];?>" onchange="doMath()" onkeyup="sav()" class="form-control col-xs-9"  ></td>
						<td><input type="text" name="harga[]" id="harga<?=$no;?>" value="<?=$row['harga_jual'];?>" onchange="doMath()" onkeyup="formatNumber(this);sav();" class="form-control col-xs-10" ></td>
						<td><input type="text" name="diskon[]" id="diskon<?=$no;?>" value="<?=$row['diskon'];?>" onchange="doMath()" onkeyup="formatNumber(this);sav();" class="form-control col-xs-10" ></td>
						<td><input type="text" name="nta[]" id="nta<?=$no;?>" value="<?=$row['nta'];?>" onchange="doMath()" onkeyup="formatNumber(this);sav();" class="form-control col-xs-10" required ></td>
						<td><input type="text" name="tax>[]" id="tax<?=$no;?>" value="<?=$row['tax'];?>" onchange="doMath()" onkeyup="sav()" class="form-control col-xs-10"></td>
						<td><input type="text" name="profit[]" id="profitSum<?=$no;?>" class="form-control col-xs-10"></td>
					  </tr>
					  <?php $no++;
					  
					  $_SESSION['bar'] = $no;} 
					  ?>
					 </tbody>
                  </table>
