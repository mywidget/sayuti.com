<?php
if (($referer==$link) ) {
$warnabar = "#07470f";
?>
<script>
$(document).ready(function(){
$("#jmlcetak").focus();
$('.harga').hide();
$('.printpenawaran').hide();
$(".alert").hide();
	$('#print_foot').hide();
    $('.btnon, .btnd, .btnp').prop('disabled',true);
	$('#jmlcetaknot, #profits'+modulhit).keypress(validateNumber);
	// $().keypress(validateNumber);
    $('#ketnota').keyup(function(){
        $('.btnon').prop('disabled', this.value == "" ? true : false);     
    })
}); 

</script>
<div class="modal-header p-t-5 p-b-5" style="background-color:<?=$warnabar;?>;color:#fff;">
        <h5 class="modal-title text-white" id="exampleModalLabel">Cetak Nota</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
</div>
<div class="modal-body">
  <div class="row p-0">
    <div class="col-md-12 p-0">
										<div class="col-md-7">	
											<div class="form-group">
												<div class="input-group">
												  <span class="input-group-addon">Jml Cetak</span>
												  <input type="text" class="form-control" aria-label="" id="jmlcetaknot" autofocus>
												  <span class="input-group-addon">buku</span>
												</div>
											</div>
											</div>
											<div class="col-md-5">	
												<div class="form-group ukuran">
												<div class="input-group">
													<span class="input-group-addon">Ukuran</span>
			<?php 
			$sql_ukur = $db->query("SELECT * FROM ukuran_kertas where modul like '%buku%' ORDER BY ket_ukuran"); 
			 ?>
													<select id="ukurannot"  class="chosen-select form-control" onchange="cariukurannot()" data-style="btn-info" data-size="auto" data-placeholder='Pilih Ukuran' required="required">
													<?php while($row=$sql_ukur->fetch_array()){
														if($row['id']==11){ ?>
															<option value="<?=$row['id'];?>" selected><?=$row['ket_ukuran'];?> <?php
														}else{	?>
															<option value="<?=$row['id'];?>"><?=$row['ket_ukuran'];?></option>
														<?php }} ?>
													</select>	
												</div>
												</div> 
											</div> 
											<div class="col-md-8">	
											<div class="form-group">
												<div class="input-group">
												  <span class="input-group-addon">Lebar</span>
												  <input type="text" class="form-control" aria-label="" id="lbrcetaknot">
												  <span class="input-group-addon">Tinggi</span>
												  <input type="text" class="form-control" aria-label="" id="tgcetaknot" onchange="cekukurannot()">
												  <span class="input-group-addon">cm</span>
												</div>
											</div>  
											</div>
											<div class="col-md-4">	
											<div class="form-group">
												<div class="input-group">
												  <span class="input-group-addon">Bleed</span>
												  <input type="text" class="form-control" aria-label="" id="bleednot" value="0">
												</div>
											</div>
											</div>	
											<div class="col-md-6">
											<div class="form-group">
												<div class="input-group">
													<span class="input-group-addon">Jml Warna</span>
													<input type="text" class="form-control" aria-label="" id="jmlwarnanot1" value="2">
													<span class="input-group-addon">/</span>
													<input type="text" class="form-control" aria-label="" id="jmlwarnanot2" value="0" >
												</div>
												</div>
											</div>
																				
											<div class="col-md-6">	
											<div class="form-group">
												<div class="input-group">
												  <span class="input-group-addon">Jml Set Perbuku</span>
												  <input type="text" class="form-control" aria-label="" id="jmlsetnot" value="50">
												</div>
											</div>
											</div>												
												
											<div class="col-md-4">
											<div class="form-group">		
												<div class="input-group">
												<?php $sql_bhn = $db->query("SELECT * FROM kategori_bahan where modul like '%top%' AND pub='Y' ORDER BY id_kategori"); 
												$row=$sql_bhn->fetch_array();
												?>
												  <input type="hidden" class="form-control" aria-label="" id="bahantop" value="<?=$row['id_kategori'];?>">
												  <span class="input-group-addon">Jml <?=$row['nama_kategori'];?></span>
												  <input type="text" class="form-control" aria-label="" id="jmltop" value="1">
												</div>
											</div>
											</div>												
											<div class="col-md-4">
											<div class="form-group">		
												<div class="input-group">
												<?php $sql_bhn = $db->query("SELECT * FROM kategori_bahan where modul like '%middle%' AND pub='Y' ORDER BY id_kategori"); 
												$row=$sql_bhn->fetch_array();
												?>
												  <input type="hidden" class="form-control" aria-label="" id="bahanmiddle" value="<?=$row['id_kategori'];?>">
												  <span class="input-group-addon">Jml <?=$row['nama_kategori'];?></span>
												  <input type="text" class="form-control" aria-label="" id="jmlmiddle" value="0">
												</div>
											</div>
											</div>												
											<div class="col-md-4">
											<div class="form-group">		
												<div class="input-group">
												<?php $sql_bhn = $db->query("SELECT * FROM kategori_bahan where modul like '%bottom%' AND pub='Y' ORDER BY id_kategori"); 
												$row=$sql_bhn->fetch_array();
												?>
												  <input type="hidden" class="form-control" aria-label="" id="bahanbottom" value="<?=$row['id_kategori'];?>">
												  <span class="input-group-addon">Jml <?=$row['nama_kategori'];?></span>
												  <input type="text" class="form-control" aria-label="" id="jmlbottom" value="1">
												</div>
											</div>
											</div>										
										<div class="col-md-6">	
										<div class="form-group">
                                           <div class="input-group">
											<span class="input-group-addon">Kertas</span>
											 <input type="text" class="form-control" aria-label="" value="NCR" readonly="readonly">
											</div>
                                        </div>
                                        </div>										
										<div class="col-md-6">	
										<div class="form-group">
                                           <div class="input-group">
											<span class="input-group-addon">Cover</span>
											 <input type="text" class="form-control" aria-label="" value="Samson" readonly="readonly">
											</div>
                                        </div>
                                        </div>
										
										<div class="col-md-6">	
										<div class="form-group">
											<div class="input-group ">
											  <span class="input-group-addon">
												<input type="checkbox" id="nomoratornot">
											  </span>
											  <Label class="form-control">Nomorator</label>											 
											</div><!-- /input-group -->
											</div>
										</div>
										<div class="col-md-6">	
										<div class="form-group">
                                           <div class="input-group">
											  <span class="input-group-addon">Jml Titik</span>
											  <input type="text" class="form-control" aria-label="" id="jmlnomnot" value="1">
											</div>
                                        </div>
                                        </div>


										<div class="col-md-6">
										<div class="form-group">
											<div class="input-group ">
											  <span class="input-group-addon">
												<input type="checkbox" id="porporasinot">
											  </span>
											  <Label class="form-control">Porporasi</label>											 
											</div><!-- /input-group -->
										</div>
										</div>
										<div class="col-md-6">	
										<div class="form-group">
                                           <div class="input-group">
											  <span class="input-group-addon">Jumlah</span>
											  <input type="text" class="form-control" aria-label="" id="jmlpornot" value="1">
											</div>
                                        </div>
                                        </div>

                                  
									<div class="col-md-8">	
                                        <div class="form-group">
										<div class="input-group">
										<span class="input-group-addon">Keterangan</span>
										<input type="text" class="form-control" aria-label="" id="ketnota"  placeholder="Isi dulu keterangannya">
										</div>
										</div>
									</div>			
                                    <div class="col-md-4">				
                                        <div class="form-group">
											<button type="submit" class="btn btn-primary btnon" onclick="hitungnot()">Hitung</button>
											<button type="button" class="btn btn-primary printpenawaran"><i class="fa fa-external-link" aria-hidden="true"></i></button>
                                        </div>
                                    </div>
		<div class="col-md-12">
		  <div class="w3-light-grey">
			<div id="myBar" class="w3-green" style="height:5px;width:0"></div>
		  </div>
		</div>
	   <div class="col-md-12">
	  <div class="col-md-6 harga">	
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon">Harga Satuan</span>
            <input type="text" class="form-control" aria-label="" id="satuan<?=$modul;?>"  value="">
          </div>
        </div>
      </div>	  
	  <div class="col-md-6 harga">	
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon">Harga PerBuku</span>
            <input type="text" class="form-control" aria-label="" id="hargarim<?=$modul;?>"  value="">
          </div>
        </div>
      </div>
	  <div class="col-md-4 harga">	
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon">Profit
            </span>
            <input type="text" class="form-control" aria-label="" id="profits<?=$modul;?>"  value="0">
			<span class="input-group-addon">%
            </span>
          </div>
        </div>
      </div>
	  <div class="col-md-4 harga">	
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon">Total Jual</span>
            <input type="text" class="form-control" aria-label="" id="total<?=$modul;?>"  value="">
			<input type="hidden" id="totdumy<?=$modul;?>">
			<input type="hidden" id="data<?=$modul;?>">
          </div>
        </div>
      </div>
	   <div class="col-md-4 harga">	
        <div class="form-group">
         <button type="button" class="btn btn-info simpan" onclick="simpan('<?=$modul;?>')" >Simpan</button>
        </div>
      </div>
      </div>
<div class="col-md-12">
<div id="hasilhota">
		 <form action="detail-hitung/" method="post" target="_blank">
		 <input type="hidden" id="token" name="token" value="<?=$ssid;?>">
		 <input type="hidden" id="user"  value="<?=$_SESSION['mailuser'];?>">	
		<input type="hidden" id="modul">
			<input type="hidden" name="data1[]" id="datanota1"  value="">
			<input type="hidden" name="data2[]" id="datanota2" value="">
			<input type="hidden" name="data3[]" id="datanota3" value="">
			<input type="hidden" name="ket" id="ketnota" value="">
			<input type="hidden" name="jumlahcetak" id="jumlahcetaknota" value="">
			
			<table id='tablenota' class='table table-striped table-responsive' >
			<thead >
			<tr style='background-color:<?=$warnabar;?>;color:white' >
			<th class='text-left'>Harga Jual</th><th></th>
			</tr>
			</thead>
			
			<tr><td class='text-left'>Harga Satuan <span id="satuanota"></span></td><td class='text-right' ><button type='submit' name='submit' value='0' class='btn btn-warning btn-sm' style='background-color:<?=$warnabar;?>;color:white;width:120px' onclick="this.form.submit()"><span id="totjualnota"></span></button></td></tr>
			</table>												
		</form> 
		</div>
</div>
</div>      
</div>      
</div>           
<script>
function move() {
  var elem = document.getElementById("myBar");   
  var width = 1;
  var id = setInterval(frame, 20);
  function frame() {
    if (width >= 100) {
      clearInterval(id);
	  $("#tablenota").show();
    } else {
      width++; 
      elem.style.width = width + '%'; 
	  $("#tablenota").hide();
    }
  }
}
$(document).ready(function(){

	$("#profits"+modulhit).keyup(function() {
		profit = $('#profits'+modulhit).val();
		tot = angka($('#totdumy'+modulhit).val());
		jual = parseFloat(profit * tot/100) + parseInt(tot);
		satuan = jual / $('#jmlcetaknot').val();
		perrim = satuan * 500;

		$('#satuan'+modulhit).val(formatMoney(satuan));
		$('#hargarim'+modulhit).val(formatMoney(perrim));
		$('#total'+modulhit).val(formatMoney(jual));
	})
	
	$('#ukurannot').val('24');
	$('#lbrcetaknot').val('16.5');
	$('#tgcetaknot').val('21.5');
	$('#bahannot').val('20');
	$('#tablenota').hide();

	$('#not').click(function(){	
	if( $('#detailnot').length ){
		$('#detailnot').remove();
	}	
	});		
	
	
})


function hitungnot() {
move();
		$("#profits"+modulhit).val('0');
		$(".simpan").html('Simpan'); 
		$('.simpan, .btnd, .btnp').prop('disabled', this.value == "" ? true : false);  
		var bleed = document.getElementById("bleednot").value;
		var lbrcetak = parseFloat(document.getElementById("lbrcetaknot").value) + parseFloat(bleed);
		var tgcetak = parseFloat(document.getElementById("tgcetaknot").value) + parseFloat(bleed);
		var jmltop = document.getElementById("jmltop").value;
		var jmlsetnot = document.getElementById("jmlsetnot").value;
		if (jmlsetnot != null && jmlsetnot < 10){  
			alert("Jumlah adalah jumlah set antara top, middle dan bottom dalam satu buku, biasanya isinya 50 set!!");
			return;
		}
		var jmlcetak = document.getElementById("jmlcetaknot").value;
		
		var jmlmiddle = document.getElementById("jmlmiddle").value;
		var jmlbottom = document.getElementById("jmlbottom").value;
		
		jmlcetak = jmlsetnot * jmlcetak * (parseInt(jmltop));
		
		var bahan = document.getElementById("bahantop").value;
		var bb = '1';
		var jmlwarna = document.getElementById("jmlwarnanot1").value;
		var jmlwarna2 = document.getElementById("jmlwarnanot2").value;
			if (jmlwarna != null && jmlwarna < 1){  
				alert("Jumlah Warna Minimal 1!!");
				return;
			}	
		//alert(jmlcetak);	

		
		var tarikan = 0;
		var lam = '0';
		var jmlset = 1;
		var lbrf1= 1;		var tgf1 = 1/500;//1 rim jadi 10 buku		
		var lbrf2= 1;		var tgf2 = 1;		
		var lbrf3= 1;		var tgf3 = 1;		
		var lbrf4= 1;		var tgf4 = 1;		
		var lbrf5= 1;		var tgf5 = 1;
		var lbrf6= 1;		var tgf6 = 1;
		var finishing1 = '58';
		var finishing2 = 0;
		var finishing3 = 0;
		var finishing4 = 0;
		var finishing5 = 0;
		var finishing6 = '0';
		
		var cetak_bagi='Y';
		var jml_satuan = 1;
		var modul = 'nota';
		var insheet = "1";
		var ket = document.getElementById("ketnota").value;
		var ket_satuan = "buku";
		var rim = 500;
		var ongpot = 'N';
		var j_mesin = '';
		var kethitung = 'TOP';
		

		if(document.getElementById("nomoratornot").checked == true ){
			finishing2 = '22';
			var lbrf2= document.getElementById("jmlnomnot").value;
		}
		if(document.getElementById("porporasinot").checked == true ){
			finishing3 = '21';
			var lbrf3= document.getElementById("jmlpornot").value/500;
		}

		if (jmlcetak != null && jmlcetak < 1){  
			alert("Jumlah Cetakan Kosong!!");
			return;
		}	

		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				myArr = JSON.parse(xmlhttp.responseText);
				
				data1 = myArr[0];				
				hitungmiddle(data1);
				
			}
			}
			isi="lbrcetak="+lbrcetak+"&tgcetak="+tgcetak+"&jmlcetak="+jmlcetak+"&bahan="+bahan+"&bb="+bb+"&jmlwarna="+jmlwarna+"&jmlwarna2="+jmlwarna2+"&lam="+lam+"&finishing1="+finishing1+"&finishing2="+finishing2+"&finishing3="+finishing3+"&finishing4="+finishing4+"&finishing5="+finishing5+"&finishing6="+finishing6+"&lbrf1="+lbrf1+"&tgf1="+tgf1+"&lbrf2="+lbrf2+"&tgf2="+tgf2+"&lbrf3="+lbrf3+"&tgf3="+tgf3+"&lbrf4="+lbrf4+"&tgf4="+tgf4+"&lbrf5="+lbrf5+"&tgf5="+tgf5+"&lbrf6="+lbrf6+"&tgf6="+tgf6+"&jmlset="+jmlset+"&modul="+modul+"&insheet="+insheet+"&jml_satuan="+jml_satuan+"&cetak_bagi="+cetak_bagi+"&ket_satuan="+ket_satuan+"&ongpot="+ongpot+"&j_mesin="+j_mesin+"&kethitung="+kethitung;
			//alert(isi);
			isi=btoa(isi); //encode			
			xmlhttp.open("GET","/wadah.php?isi="+isi,true);
			xmlhttp.send();		

		}
		
		
function hitungmiddle(data1) {
		var jmlmiddle = document.getElementById("jmlmiddle").value;
		if (jmlmiddle != null && jmlmiddle < 1){  
			data2={};
			hitungbottom(data1,data2);
		}else{
	
			var bleed = document.getElementById("bleednot").value;
			var lbrcetak = parseFloat(document.getElementById("lbrcetaknot").value) + parseFloat(bleed);
			var tgcetak = parseFloat(document.getElementById("tgcetaknot").value) + parseFloat(bleed);
			var jmlsetnot = document.getElementById("jmlsetnot").value;
			var jmlcetak = document.getElementById("jmlcetaknot").value;
			jmlcetak = jmlsetnot * jmlcetak * jmlmiddle;
			
			//Hitung NCR middel
			var bahan = document.getElementById("bahanmiddle").value;
			var bb = '1';
			var jmlwarna = document.getElementById("jmlwarnanot1").value;
			var jmlwarna2 = document.getElementById("jmlwarnanot2").value;
			//alert(jmlcetak);	
			
			var tarikan = 0;
		var lam = '0';
		var jmlset = 1;
		var lbrf1= 1;		var tgf1 = 1/500;//1 rim jadi 10 buku		
		var lbrf2= 1;		var tgf2 = 1;		
		var lbrf3= 1;		var tgf3 = 1;		
		var lbrf4= 1;		var tgf4 = 1;		
		var lbrf5= 1;		var tgf5 = 1;
		var lbrf6= 1;		var tgf6 = 1;
		var finishing1 = '58';
		var finishing2 = 0;
		var finishing3 = 0;
		var finishing4 = 0;
		var finishing5 = 0;
		var finishing6 = '0';
		
		var cetak_bagi='Y';
		var jml_satuan = 1;
		var modul = 'nota';
		var insheet = "1";
		var ket = document.getElementById("ketnota").value;
		var ket_satuan = "buku";
		var rim = 500;
		var ongpot = 'N';
		var j_mesin = '';
		var kethitung = 'MIDDLE';
		var pakeplat ='N';
		

		if(document.getElementById("nomoratornot").checked == true ){
			finishing2 = '22';
			var lbrf2= document.getElementById("jmlnomnot").value;
		}
		if(document.getElementById("porporasinot").checked == true ){
			finishing3 = '21';
			var lbrf3= document.getElementById("jmlpornot").value/500;
		}
			
			
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					myArr = JSON.parse(xmlhttp.responseText);
					
					data2 = myArr[0];
					//alert (JSON.stringify(data2));
					hitungbottom(data1,data2);
					
				}
				}
				isi="lbrcetak="+lbrcetak+"&tgcetak="+tgcetak+"&jmlcetak="+jmlcetak+"&bahan="+bahan+"&bb="+bb+"&jmlwarna="+jmlwarna+"&jmlwarna2="+jmlwarna2+"&lam="+lam+"&finishing1="+finishing1+"&finishing2="+finishing2+"&finishing3="+finishing3+"&finishing4="+finishing4+"&finishing5="+finishing5+"&finishing6="+finishing6+"&lbrf1="+lbrf1+"&tgf1="+tgf1+"&lbrf2="+lbrf2+"&tgf2="+tgf2+"&lbrf3="+lbrf3+"&tgf3="+tgf3+"&lbrf4="+lbrf4+"&tgf4="+tgf4+"&lbrf5="+lbrf5+"&tgf5="+tgf5+"&lbrf6="+lbrf6+"&tgf6="+tgf6+"&jmlset="+jmlset+"&modul="+modul+"&insheet="+insheet+"&jml_satuan="+jml_satuan+"&cetak_bagi="+cetak_bagi+"&ket_satuan="+ket_satuan+"&ongpot="+ongpot+"&j_mesin="+j_mesin+"&kethitung="+kethitung+"&pakeplat=" + pakeplat;
				//alert(isi);
				isi=btoa(isi); //encode			
				xmlhttp.open("GET","/wadah.php?isi="+isi,true);
				xmlhttp.send();		
		}
}	
		
function hitungbottom(data1,data2) {
		var jmlbottom = document.getElementById("jmlbottom").value;
		if (jmlbottom != null && jmlbottom < 1){  
			data3={};
			hasilhitung(data1,data2,data3);
		}else{
	
	
			var bleed = document.getElementById("bleednot").value;
			var lbrcetak = parseFloat(document.getElementById("lbrcetaknot").value) + parseFloat(bleed);
			var tgcetak = parseFloat(document.getElementById("tgcetaknot").value) + parseFloat(bleed);
			var jmlsetnot = document.getElementById("jmlsetnot").value;
			var jmlcetak = document.getElementById("jmlcetaknot").value;
			jmlcetak = jmlsetnot * jmlcetak * jmlbottom;
			
			//Hitung NCR bottom
			var bahan = document.getElementById("bahanbottom").value;
			var bb = '1';
			var jmlwarna = document.getElementById("jmlwarnanot1").value;
			var jmlwarna2 = document.getElementById("jmlwarnanot2").value;
			//alert(jmlcetak);	
			
			var tarikan = 0;
		var lam = '0';
		var jmlset = 1;
		var lbrf1= 1;		var tgf1 = 1/500;//1 rim jadi 10 buku		
		var lbrf2= 1;		var tgf2 = 1;		
		var lbrf3= 1;		var tgf3 = 1;		
		var lbrf4= 1;		var tgf4 = 1;		
		var lbrf5= 1;		var tgf5 = 1;
		var lbrf6= 1;		var tgf6 = 1;
		var finishing1 = '58';
		var finishing2 = 0;
		var finishing3 = 0;
		var finishing4 = 0;
		var finishing5 = 0;
		var finishing6 = '0';
		
		var cetak_bagi='Y';
		var jml_satuan = 1;
		var modul = 'nota';
		var insheet = "1";
		var ket = document.getElementById("ketnota").value;
		var ket_satuan = "buku";
		var rim = 500;
		var ongpot = 'N';
		var j_mesin = '';
		var pakeplat ='N';
		var kethitung = 'BOTTOM';
		

		if(document.getElementById("nomoratornot").checked == true ){
			finishing2 = '22';
			var lbrf2= document.getElementById("jmlnomnot").value;
		}
		if(document.getElementById("porporasinot").checked == true ){
			finishing3 = '21';
			var lbrf3= document.getElementById("jmlpornot").value/500;
		}
			
			
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					myArr = JSON.parse(xmlhttp.responseText);
					
					data3 = myArr[0];
					//alert (JSON.stringify(data3));
					hasilhitung(data1,data2,data3);
					
				}
				}
				isi="lbrcetak="+lbrcetak+"&tgcetak="+tgcetak+"&jmlcetak="+jmlcetak+"&bahan="+bahan+"&bb="+bb+"&jmlwarna="+jmlwarna+"&jmlwarna2="+jmlwarna2+"&lam="+lam+"&finishing1="+finishing1+"&finishing2="+finishing2+"&finishing3="+finishing3+"&finishing4="+finishing4+"&finishing5="+finishing5+"&finishing6="+finishing6+"&lbrf1="+lbrf1+"&tgf1="+tgf1+"&lbrf2="+lbrf2+"&tgf2="+tgf2+"&lbrf3="+lbrf3+"&tgf3="+tgf3+"&lbrf4="+lbrf4+"&tgf4="+tgf4+"&lbrf5="+lbrf5+"&tgf5="+tgf5+"&lbrf6="+lbrf6+"&tgf6="+tgf6+"&jmlset="+jmlset+"&modul="+modul+"&insheet="+insheet+"&jml_satuan="+jml_satuan+"&cetak_bagi="+cetak_bagi+"&ket_satuan="+ket_satuan+"&ongpot="+ongpot+"&j_mesin="+j_mesin+"&kethitung="+kethitung+"&pakeplat=" + pakeplat;
				//alert(isi);
				isi=btoa(isi); //encode			
				xmlhttp.open("GET","/wadah.php?isi="+isi,true);
				xmlhttp.send();		
		}
}			
		
function hasilhitung(data1,data2,data3){
		var jmlcetak = document.getElementById("jmlcetaknot").value;
		var ket = document.getElementById("ketnota").value;
		
		
		
		//data1
		if(!!(data1['hrgbhn'])){ 
				if (data1['ongpot'] == 'Y' ){ ongkos_potong = data1['ongkos_potong'];}
				else{ ongkos_potong = 0; }				
				
				subtotal1 = parseInt(data1['totcetak']) + parseInt(data1['totbhn']) + parseInt(ongkos_potong) + parseInt(data1['tot_ctp']) + parseInt(data1['totlaminating']) + parseInt(data1['finishing1']) + parseInt(data1['finishing2']) + parseInt(data1['finishing3']) + parseInt(data1['finishing4']) + parseInt(data1['finishing5']) + parseInt(data1['finishing6']);
				var arrStr1 = btoa(encodeURIComponent(JSON.stringify(data1)));
		}else{
				var subtotal1 = '0';
				var arrStr1 = '';
		}		
		//data2		
		if(!!(data2['hrgbhn'])){ 				
				if (data2['ongpot'] == 'Y' ){ ongkos_potong = data2['ongkos_potong'];} else{ ongkos_potong = 0; }				
				
				subtotal2 = parseInt(data2['totcetak']) + parseInt(data2['totbhn']) + parseInt(ongkos_potong) + parseInt(data2['tot_ctp']) + parseInt(data2['totlaminating']) + parseInt(data2['finishing1']) + parseInt(data2['finishing2']) + parseInt(data2['finishing3']) + parseInt(data2['finishing4']) + parseInt(data2['finishing5']) + parseInt(data2['finishing6']);
				var arrStr2 = btoa(encodeURIComponent(JSON.stringify(data2)));
		}else{
				var subtotal2 = '0';
				var arrStr2 = '';
		}
				
		//data3
		if(!!(data3['hrgbhn'])){ 
				if (data3['ongpot'] == 'Y' ){ ongkos_potong = data3['ongkos_potong'];} else{ ongkos_potong = 0; }				
				
				subtotal3 = parseInt(data3['totcetak']) + parseInt(data3['totbhn']) + parseInt(ongkos_potong) + parseInt(data3['tot_ctp']) + parseInt(data3['totlaminating']) + parseInt(data3['finishing1']) + parseInt(data3['finishing2']) + parseInt(data3['finishing3']) + parseInt(data3['finishing4']) + parseInt(data3['finishing5']) + parseInt(data3['finishing6'])+ parseInt(data3['tot_lipat']);
				var arrStr3 = btoa(encodeURIComponent(JSON.stringify(data3)));
		}else{
				var subtotal3 = '0';
				var arrStr3 = '';
		}
						
			total = parseInt(subtotal1) + parseInt(subtotal2) + parseInt(subtotal3);

			profit = data1['persen'];
			jual = (parseInt(total) * parseInt(profit) / 100) + parseInt(total);
			satuan = parseInt(jual / jmlcetak);
			//alert(satuan);
			
			move();
								
		//	alert(arrStr1);
			$('#datanota1').val(arrStr1);
			$('#datanota2').val(arrStr2);
			$('#datanota3').val(arrStr3);
			$('#ketnota').val(ket);
			$('#jumlahcetaknota').val(jmlcetak);
			$('#totjualnota').html("Rp. " + formatMoney(jual));
			$('#satuanota').html("Rp. " + formatMoney(satuan) + "/pcs");	
			

			if( level == 'admin' || level == 'member' ){
				$('#tablenota').show(); 
			}else{
				$('.harga').show();
				$('#satuan'+modulhit).val(formatMoney(satuan));
				$('#hargarim'+modulhit).val(formatMoney(perrim));
				$('#total'+modulhit).val(formatMoney(jual));
				$('#totdumy'+modulhit).val(formatMoney(jual));
				$('#data'+modulhit).val(arrStr);
				$('#modul').val(modul);
			}			

}		

function cariukurannot(){
			var ukuran = document.getElementById("ukurannot").value;
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				myArr = JSON.parse(xmlhttp.responseText);
				document.getElementById("lbrcetaknot").value = myArr[0];
				document.getElementById("tgcetaknot").value = myArr[1];
			//alert(myArr[0].toString());
			}
			}
			  xmlhttp.open("GET","/fungsi/cariukuran.php?ukuran="+ukuran,true);
			  xmlhttp.send();	
		}
		
		
	// $('.printpenawaran').click(function() {
// var value = $("#token").val();
// var urlencode = btoa(value);
// window.open('/penawaran-harga/' + urlencode, '_blank');
// });
</script>      
<style>th {font-weight: bold;text-align: center;}.table > thead > tr > th {vertical-align: middle;}</style>
<?php
	}//end token
	else{
echo json_encode(array(404 => "error"));
	}
?>