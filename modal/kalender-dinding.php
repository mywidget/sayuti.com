<?php
if (($referer==$link) ) {
$warnabar = "#0cada5";
?>

<script>
$(document).ready(function(){
$("#jmlcetak").focus();
$('.harga').hide();
$('.printpenawaran').hide();
$(".alert").hide();
        $('.btnon, .btnd, .btnp').prop('disabled',true);
	$('#jmlcetakk').keypress(validateNumber);
    $('#ketkk').keyup(function(){
        $('.btnon').prop('disabled', this.value == "" ? true : false);     
    })
}); 
$('.modal').on('hidden.bs.modal', function(){
	$(this).removeData('bs.modal');
});
</script>
<div class="modal-header p-t-5 p-b-5" style="background-color:<?=$warnabar;?>;color:#fff;">
        <h5 class="modal-title text-white" id="exampleModalLabel">Cetak Kalender Dinding</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
</div>
<div class="modal-body">
<div class="row p-0">
<div class="col-md-12 p-0">
									<div class="col-md-12">
                                        <div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">Jumlah Cetak</span>
											<input type="text" class="form-control" id="jmlcetakk" placeholder="Jumlah Cetak" autofocus>
                                        </div>
                                        </div>
                                    </div>
									<div class="col-md-12">
                                        <div class="form-group ukuran">
										<div class="input-group">
											<span class="input-group-addon">Ukuran</span>
											<?php $sql_ukur = $db->query("SELECT * FROM ukuran_kertas where modul like '%kalding%' ORDER BY ket_ukuran"); ?>
											<select id="ukurank"  class="chosen-select form-control" onchange="cariukurank()" data-style="btn-info" data-size="auto" data-placeholder='Pilih Ukuran' required="required" >
												<?php while($row=$sql_ukur->fetch_array()){ ?>
												<option value="<?=$row['id'];?>"><?=$row['ket_ukuran'];?></option>
												<?php } ?>
											</select>	
                                        </div> 
                                        </div> 
                                        </div> 
										<div class="col-md-12">
										<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">Lebar</span>
                                            <input type="text" class="form-control" id="lbrcetakk" placeholder="Lebar">
											<span class="input-group-addon">Tinggi</span>
                                            <input type="text" class="form-control"  onchange="cekukurank()" id="tgcetakk" placeholder="Tinggi" >
											<span class="input-group-addon">cm</span>
                                        </div>  
                                        </div> 
                                        </div> 
										<div class="col-md-6">
										<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">Jumlah Warna</span>
                                            <input type="text" class="form-control" id="jmlwarnak1" value="4" >
											<span class="input-group-addon">/</span>
                                            <input type="text" class="form-control" id="jmlwarnak2" value="0" >
                                        </div>
                                        </div>
                                        </div>
										<div class="col-md-6">
										<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">Jumlah Lembaran</span>
                                            <input type="text" class="form-control" id="jmlsetk" value="1" >
											<span class="input-group-addon">Lembar</span>
                                        </div>
                                        </div>
                                        </div>
                                        </div>
										<div class="col-md-12 p-0">
										<!-- Tarikan -->
                                            <input type="hidden" id="tarikank" value="1" >
										<div class="col-md-6">
										<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">Jenis Kertas</span>
											<?php $sql_bhn = $db->query("SELECT * FROM kategori_bahan where modul like '%kalding%' AND pub='Y' ORDER BY id_kategori"); ?>
											<select id="bahank"  class="chosen-select form-control" data-style="btn-info" data-size="auto" data-placeholder='Pilih Bahan' required="required">
												<?php while($row=$sql_bhn->fetch_array()){ ?>
												<option value="<?=$row['id_kategori'];?>"><?=$row['nama_kategori'];?></option>
												<?php } ?>
											</select>	
                                        </div>
                                        </div>
                                        </div>

										<div class="col-md-6">
										<div class="form-group">
											<select id="lamk" class="selectpicker form-control" data-style="btn-warning">
											<option value="0" selected>Tanpa Laminasi</option>
											<option value="1">Varnish Satu Muka</option>
											<option value="2">Varnish Bolak-balik</option>
											<option value="3">Laminating Glosy Satu Muka</option>
											<option value="4">Laminating Glosy BB</option>
											<option value="5">Laminating DOP Satu Muka</option>
											<option value="6">Laminating DOP BB</option>
											</select>
										</div>
										</div>
										<div class="col-md-6">
										<div class="form-group">
											<?php $sql_kal = $db->query("SELECT * FROM tbl_biaya WHERE tbl_biaya.Groups LIKE '%kalender%' ORDER BY Nama_Biaya"); ?>
											<select id="finishing1k"  class="chosen-select form-control" required="required">
												<?php while($rowf=$sql_kal->fetch_array()){ ?>
												<option value="<?=$rowf['KdBiaya'];?>"><?=$rowf['Nama_Biaya'];?></option>
												<?php } ?>
												<option value="0" selected>Tanpa Kaleng</option>
											</select>
										</div>
										</div>
										<div class="col-md-6">
                                        <div class="form-group">
											<div class="input-group ">
											  <span class="input-group-addon">
												<input type="checkbox" id="finishing4k">
											  </span>
											  <Label class="form-control">SpotUv</label>
											</div>
										</div>
										</div>
										<div class="col-md-12">
										<div class="form-group">
											<div class="input-group ">
											  <span class="input-group-addon">
												<input type="checkbox" id="covkal">
											  </span>
											  <Label class="form-control" >Cover Depan</label>
											</div>
										</div>
										</div>
										</div>
										<div class="col-md-12 p-0">
										<div class="col-md-6">
										<div class="form-group warnacovkal">
										<div class="input-group">
											<span class="input-group-addon">Jumlah Warna</span>
                                            <input type="text" class="form-control" id="warnacovkal1" value="1" >
											<span class="input-group-addon">/</span>
                                            <input type="text" class="form-control" id="warnacovkal2" value="0" >
                                        </div>
                                        </div>
										</div>
										<div class="col-md-6">
										<div class="form-group bahancovkal">
										<div class="col-md-12">
										<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">Jenis Kertas</span>
											<?php $sql_bhn = $db->query("SELECT * FROM kategori_bahan where pub='Y' ORDER BY id_kategori"); ?>
											<select id="bahancovkal"  class="chosen-select form-control" data-style="btn-info" data-size="auto" data-placeholder='Pilih Bahan' required="required">
												<?php while($row=$sql_bhn->fetch_array()){ ?>
												<option value="<?=$row['id_kategori'];?>"><?=$row['nama_kategori'];?></option>
												<?php } ?>
											</select>	
                                        </div>
                                        </div>
                                        </div>
                                        </div>
                                        </div>
                                        </div>
										<div class="col-md-12 p-0">
										<div class="col-md-8">	
                                        <div class="form-group">
										<div class="input-group">
										<span class="input-group-addon">Keterangan</span>
										<input type="text" class="form-control" aria-label="" id="ketkk"  placeholder="Isi dulu keterangannya">
										</div>
										</div>
									</div>		
                                    <div class="col-md-4">	
										<div class="form-group">
											<button  type="submit" class="btn btn-primary btnon" onclick="hitungisikal()">Hitung</button>
											<button type="button" class="btn btn-primary printpenawaran"><i class="fa fa-external-link" aria-hidden="true"></i></button>	
                                        </div>
                                    </div>
                                    </div>
									
	<div class="col-md-12">
	  <div class="w3-light-grey">
		<div id="myBar" class="w3-teal" style="height:5px;width:0"></div>
	  </div>
	</div>
      <div class="col-md-12">	
			<!--div id="tablekalding"></div-->
			<form action="/" method="post" target="_blank">
			<input type="hidden" id="token" name="token">
			<input type="hidden" id="user"  name="user">	
			<input type="hidden" id="modul" name="modul">
				<input type="hidden" name="data1[]" id="data1"  value="">
				<input type="hidden" name="data2[]" id="data2" value="">
				<input type="hidden" name="ket" id="ket" value="">
				<input type="hidden" name="jumlahcetak" id="jumlahcetak" value="">
				
				<div class='small'>
				<table id='tablkk' class='table table-striped table-responsive' >
				<thead >
				<tr style='background-color:<?=$warnabar;?>;color:white' >
				<th class='text-left'>Harga Jual</th><th></th>
				</tr>
				</thead>
				
				<tr><td class='text-left'> <span id="satuan"></span></td><td class='text-right' ><button type='submit' name='submit' value='0' class='btn btn-sm' style='background-color:<?=$warnabar;?>;color:white;width:120px' onclick="this.form.submit()"><span id="totjual"></span></button></td></tr>
				</table>												
				</div>
			</form> 
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
	  $("#tablkk").show();
    } else {
      width++; 
      elem.style.width = width + '%'; 
	  $("#tablkk").hide();
    }
  }
}
$(document).ready(function(){
	$('#ukurank').val('16');
	$('#lbrcetakk').val('38');
	$('#tgcetakk').val('52');
	$('#bbk').val('1');
	$('.bahancovkal').hide();
	$('.warnacovkal').hide();
	$('.harga').hide();	
	$('#tablkk').hide();	
})

	$( "#profits"+modulhit).keyup(function() {
		profit = $('#profits'+modulhit).val();
		tot = angka($('#totdumy'+modulhit).val());
		jual = parseFloat(profit * tot/100) + parseInt(tot);
		satuan = jual / $('#jmlcetakk').val();
		perrim = satuan * 500;
		$('#satuan'+modulhit).val(formatMoney(satuan));
		$('#hargarim'+modulhit).val(formatMoney(perrim));
		$('#total'+modulhit).val(formatMoney(jual));
	})		
	  $('#covkal').click(function() {
        if($(this).is(":checked"))
        {
			$('.bahancovkal').show();
			$('.warnacovkal').show();
			$('#warnacovkal').val('1');
        } else {
			$('.bahancovkal').hide();
			$('.warnacovkal').hide();
			$('#warnacovkal').val('0');
        }
    });
	

	
	$('#k').click(function(){	
	if( $('#detailkalding').length ){
		$('#detailkalding').remove();
	}	
	if( $('#detailcovkalding').length ){
		$('#detailcovkalding').remove();
	}		
	
	});	
	
var totalisi = 0;
var totalcover = 0;
	
	
function hitungisikal() {
		$(".progress-bar").css('background','red'); 
		$(".progress-bar").css('width','5%');
		$(".harga").hide();
		$('#profits'+modulhit).val('0');
		$('.btnd, .btnp').prop('disabled', this.value == "" ? true : false);  
		
		var lbrcetak = document.getElementById("lbrcetakk").value;
		var tgcetak = document.getElementById("tgcetakk").value;
		var jmlcetak = document.getElementById("jmlcetakk").value;
		var bahan = document.getElementById("bahank").value;
		var jmlwarna = document.getElementById("jmlwarnak1").value;
		var jmlwarna2 = document.getElementById("jmlwarnak2").value;

			if (jmlwarna != null && jmlwarna < 1){  
				alert("Jumlah Warna Minimal 1!!");
				return;
			}	
		
		var lam = document.getElementById("lamk").value;
		var jmlset = document.getElementById("jmlsetk").value;
		var lbrf1= 1;		var tgf1 = 1;		
		var lbrf2= 1;		var tgf2 = 1;		
		var lbrf3= 1;		var tgf3 = 1;		
		var lbrf4= 1;		var tgf4 = 1;		
		var lbrf5= 1;		var tgf5 = 1;
		var lbrf6= 1;						var tgf6 = 1;
		var finishing6 = '0';		
		var finishing1 = 0;
		var finishing2 = 0;
		var finishing3 = 0;
		var finishing4 = 0;
		var finishing5 = 0;
		
		var modul = 'kalding';
		var insheet="1";
		var jml_satuan=1;
		var cetak_bagi="Y";
		var ket = document.getElementById("ketkk").value;
		var ket_satuan = "lbr";
		var rim = 500;
		var box = 100;
		var ongpot = 'Y';
		var kethitung = "Isi_Kalender"
		
		//ongkos komplit
				if(document.getElementById("covkal").checked == true ){
					var jmllembar = parseInt(jmlset) + 1;
				}else{
					var jmllembar = jmlset;
				}
				
				if(jmllembar > 1){
					finishing5 = '100';
					lbrf5= jmllembar;	
				}
				
//jika spiral
		if(document.getElementById("finishing1k").value == '24'){
			finishing1 = document.getElementById("finishing1k").value;
			finishing2 = '75';//Besi Hanger kalender untuk spiral
			lbrf1= lbrcetak;	
		}else if(document.getElementById("finishing1k").value == '45'){
			finishing1 = document.getElementById("finishing1k").value;
			finishing2 = '26';//Besi Hanger kalender untuk spiral
			lbrf1= 1;	
		}else{
			finishing2 = '26';//BIaya ngejepitnya
			finishing1 = document.getElementById("finishing1k").value;
			lbrf1= lbrcetak;
		}
		
	//SPOT UV
		if(document.getElementById("finishing4k").checked == true ){
			finishing4 = '19';
			lbrf4= lbrcetak;
			tgf4 = tgcetak;
		}

		if (jmlcetak != null && jmlcetak < 1){  
			alert("Jumlah Cetakan Kosong!!");
			return;
		}	
		if(lbrcetak != null && lbrcetak < 1){
			alert(" Lebar Cetakan Kosong!!");
			return;
		}
		if (tgcetak != null && tgcetak < 1){
			alert("Tinggi Cetakan Kosong!!");
			return;	
		}
		
	//Hitung Isinya----------------------------------------	
		var xmlhttp = new XMLHttpRequest();
		move();
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				myArr = JSON.parse(xmlhttp.responseText);
					data1 = myArr[0];
					hitcoverkal(data1);
			}
			}
			isi="lbrcetak="+lbrcetak+"&tgcetak="+tgcetak+"&jmlcetak="+jmlcetak+"&bahan="+bahan+"&jmlwarna="+jmlwarna+"&jmlwarna2="+jmlwarna2+"&lam="+lam+"&finishing1="+finishing1+"&finishing2="+finishing2+"&finishing3="+finishing3+"&finishing4="+finishing4+"&finishing5="+finishing5+"&finishing6="+finishing6+"&lbrf1="+lbrf1+"&tgf1="+tgf1+"&lbrf2="+lbrf2+"&tgf2="+tgf2+"&lbrf3="+lbrf3+"&tgf3="+tgf3+"&lbrf4="+lbrf4+"&tgf4="+tgf4+"&lbrf5="+lbrf5+"&tgf5="+tgf5+"&lbrf6="+lbrf6+"&tgf6="+tgf6+"&jmlset="+jmlset+"&modul="+modul+"&insheet="+insheet+"&jml_satuan="+jml_satuan+"&cetak_bagi="+cetak_bagi+"&ket_satuan="+ket_satuan+"&ongpot="+ongpot+"&kethitung="+kethitung;
			
			isi=btoa(isi); //encode			
			xmlhttp.open("GET","/wadah.php?isi="+isi,true);
			xmlhttp.send();	
			
}


		
		//Hitung Covernya
	function hitcoverkal(x){	

			var data1 = x;
			var lbrcetak = document.getElementById("lbrcetakk").value;
			var tgcetak = document.getElementById("tgcetakk").value;
			var jmlcetak = document.getElementById("jmlcetakk").value;
			var bahan = document.getElementById("bahancovkal").value;
			var lam = 0;
			var lbrf1= 1;		var tgf1 = 1;		
			var lbrf2= 1;		var tgf2 = 1;		
			var lbrf3= 1;		var tgf3 = 1;		
			var lbrf4= 1;		var tgf4 = 1;		
			var lbrf5= 1;		var tgf5 = 1;
			var lbrf6= 1;						var tgf6 = 1;
			var finishing6 = '0';			
			var	finishing1 = 0;
			var finishing2 = 0;
			var finishing3 = 0;
			var finishing4 = 0;
			var finishing5 = 0;
			
			var modul = 'kalding';
			var insheet="1";
			var jml_satuan=1;
			var cetak_bagi="Y";
			var ket = document.getElementById("ketkk").value;
			var ket_satuan = "lbr";
			var rim = 500;
			var box = 100;
			var ongpot = 'Y';
			var kethitung = "Cover_Kalender";
		
			var	jmlwarna = document.getElementById("warnacovkal1").value;
			var	jmlwarna2 = document.getElementById("warnacovkal2").value;
			var	jmlset = 1;
			
			if(document.getElementById("covkal").checked == true ){
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					myArr = JSON.parse(xmlhttp.responseText);
					var data2 = myArr[0];
					hasilkalding(data1,data2);
					}
				}
				
				isi="lbrcetak="+lbrcetak+"&tgcetak="+tgcetak+"&jmlcetak="+jmlcetak+"&bahan="+bahan+"&jmlwarna="+jmlwarna+"&jmlwarna2="+jmlwarna2+"&lam="+lam+"&finishing1="+finishing1+"&finishing2="+finishing2+"&finishing3="+finishing3+"&finishing4="+finishing4+"&finishing5="+finishing5+"&finishing6="+finishing6+"&lbrf1="+lbrf1+"&tgf1="+tgf1+"&lbrf2="+lbrf2+"&tgf2="+tgf2+"&lbrf3="+lbrf3+"&tgf3="+tgf3+"&lbrf4="+lbrf4+"&tgf4="+tgf4+"&lbrf5="+lbrf5+"&tgf5="+tgf5+"&lbrf6="+lbrf6+"&tgf6="+tgf6+"&jmlset="+jmlset+"&modul="+modul+"&insheet="+insheet+"&jml_satuan="+jml_satuan+"&cetak_bagi="+cetak_bagi+"&ket_satuan="+ket_satuan+"&ongpot="+ongpot+"&kethitung="+kethitung;
				
				isi=btoa(isi); //encode			
				xmlhttp.open("GET","/wadah.php?isi="+isi,true);
				xmlhttp.send();	
			}else{
				var data2 = {};
				hasilkalding(data1,data2);
			}
		}
		
function hasilkalding(data1,data2){
	

	
		if (data1['ongpot'] == 'Y' ){ ongkos_potong = data1['ongkos_potong'];}else{ ongkos_potong = 0; }				
		subtotal1 = parseInt(data1['totcetak']) + parseInt(data1['totbhn']) + parseInt(ongkos_potong) + parseInt(data1['tot_ctp']) + parseInt(data1['totlaminating']) + parseInt(data1['finishing1']) + parseInt(data1['finishing2']) + parseInt(data1['finishing3']) + parseInt(data1['finishing4']) + parseInt(data1['finishing1']) + parseInt(data1['finishing6']);
		var arrStr1 = btoa(encodeURIComponent(JSON.stringify(data1)));
		
//data2
		if(!!(data2['hrgbhn'])){
				if (data2['ongpot'] == 'Y' ){ ongkos_potong = data2['ongkos_potong'];} else{ ongkos_potong = 0; }				
				subtotal2 = parseInt(data2['totcetak']) + parseInt(data2['totbhn']) + parseInt(ongkos_potong) + parseInt(data2['tot_ctp']) + parseInt(data2['totlaminating']) + parseInt(data2['finishing1']) + parseInt(data2['finishing2']) + parseInt(data2['finishing3']) + parseInt(data2['finishing4']) + parseInt(data2['finishing2']) + parseInt(data2['finishing6']);
				var arrStr2 = btoa(encodeURIComponent(JSON.stringify(data2)));
			}else{
				var subtotal2 = '0';
				var arrStr2 = '';
			}	
	
		total  = parseInt(subtotal1)+ parseInt(subtotal2);  		
		profit = data1['persen'];
		jual = (parseInt(total) * profit / 100) + parseInt(total);
		satuan = jual / parseInt($('#jmlcetakk').val());
		perrim = satuan *  500;
		
	
			//	alert(arrStr1);
				$('#data1').val(arrStr1);
				$('#data2').val(arrStr2);
				$('#jumlahcetak').val($('#jmlcetakk').val());
				$('#ket').val(ket);
				$('#totjual').html("Rp. " + formatMoney(jual));
				$('#satuan').html("Rp. " + formatMoney(satuan) + "/pcs");
				
				setTimeout(function(){ $('#tablkk').show(); }, 500); 
			// if( level == 'admin' || level == 'member' ){
			// }else{
				// $('.harga').show();
				// $('#satuan'+modulhit).val(formatMoney(satuan));
				// $('#hargarim'+modulhit).val(formatMoney(perrim));
				// $('#total'+modulhit).val(formatMoney(jual));
				// $('#totdumy'+modulhit).val(formatMoney(jual));
				// $('#data'+modulhit).val(arrStr);
				// $('#modul').val(modul);
				
			// }
}	

		function cariukurank(){
			var ukuran = document.getElementById("ukurank").value;
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				myArr = JSON.parse(xmlhttp.responseText);
				document.getElementById("lbrcetakk").value = myArr[0];
				document.getElementById("tgcetakk").value = myArr[1];
			//alert(myArr[0].toString());
			}
			}
			  xmlhttp.open("GET","/fungsi/cariukuran.php?ukuran="+ukuran,true);
			  xmlhttp.send();	  
			  
		}




	
$('.printpenawaran').click(function() {
var value = $("#token").val();
var urlencode = btoa(value);
window.open('/penawaran-harga/' + urlencode, '_blank');
});	
</script>      
<style>
 th {
font-weight: bold;
text-align: center; }

.table > thead > tr > th {
    vertical-align: middle;
}

</style>
<?php
}
?>