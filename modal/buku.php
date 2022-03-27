<?php
if (($referer==$link) ) {
$warnabar = "#55aa5f";
?>

<script>
$(document).ready(function(){
$("#jmlcetak").focus();
$('.harga').hide();
$('.printpenawaran').hide();
$(".alert").hide();
	$('#print_foot').hide();
    $('.btnon, .btnd, .btnp').prop('disabled',true);
	$('#jmlcetakbu').keypress(validateNumber);
    $('#ketbuku').keyup(function(){
        $('.btnon').prop('disabled', this.value == "" ? true : false);   
    })
});
</script>
<div class="modal-header p-t-5 p-b-5" style="background-color:<?=$warnabar;?>;color:#fff;">
        <h5 class="modal-title text-white" id="exampleModalLabel">Hitung Cetak Buku</h5>
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
			  <input type="text" class="form-control" aria-label="" id="jmlcetakbu" autofocus>
			  <span class="input-group-addon">buku</span>
			</div>
		</div>
	</div>
	<div class="col-md-5">	
		<div class="form-group ukuran">
		<div class="input-group">
			<span class="input-group-addon">Ukuran</span>
			<?php $sql_ukur = $db->query("SELECT * FROM ukuran_kertas where modul like '%buku%' ORDER BY ket_ukuran"); ?>
			<select id="ukuranbu"  class="chosen-select form-control" onchange="cariukuranbu()" data-style="btn-info" data-size="auto" data-placeholder='Pilih Ukuran' required="required">
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
		  <input type="text" class="form-control" aria-label="" id="lbrcetakbu">
		  <span class="input-group-addon">Tinggi</span>
		  <input type="text" class="form-control" aria-label="" id="tgcetakbu" onchange="cekukuranbu()">
		  <span class="input-group-addon">cm</span>
		</div>
	</div>  
	</div>
	<div class="col-md-4">	
	<div class="form-group">
		<div class="input-group">
		  <span class="input-group-addon">Bleed</span>
		  <input type="text" class="form-control" aria-label="" id="bleedbu1" value="0">
		</div>
	</div>
	</div>	
<div class="col-md-12">
	<ul id="accordion" class="accordion">
		<li class="default open">
			<div class="link"><i class="fa fa-edit"></i>Isi Buku 1<i class="fa fa-chevron-down"></i></div>
			<ul class="submenu">
				<li>
<div class="panel-body">
	<div class="col-md-6">
	<div class="form-group">
		<div class="input-group">
			<span class="input-group-addon">Jml Warna</span>
			<input type="text" class="form-control" aria-label="" id="jmlwarnabu1" value="4">
			<span class="input-group-addon">/</span>
			<input type="text" class="form-control" aria-label="" id="jmlwarnabu12" value="4" >
		</div>
		</div>
	</div>
	<div class="col-md-6">	
	<div class="form-group">
		<div class="input-group">
		  <span class="input-group-addon">Jml Halaman</span>
		  <input type="text" class="form-control" aria-label="" id="jmlhalbu1" value="20">
		</div>
	</div>
	</div>											
	<div class="col-md-5">
	<div class="form-group">
			<select id="lambu1" class="selectpicker form-control" data-style="btn-warning">
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
	<div class="col-md-7">
	<div class="form-group">
		<div class="input-group">
		<span class="input-group-addon">Kertas</span>
		<?php $sql_bhn = $db->query("SELECT * FROM kategori_bahan where modul like '%buku%' AND pub='Y' ORDER BY id_kategori"); ?>
		<select id="bahanbu1"  class="chosen-select form-control" data-style="btn-info" data-size="auto" data-placeholder='Pilih Bahan' required="required">
			<?php while($row=$sql_bhn->fetch_array()){
			if($row['id_kategori']==10){ ?>
				<option value="<?=$row['id_kategori'];?>" selected><?=$row['nama_kategori'];?> <?php
			}else{	?>
				<option value="<?=$row['id_kategori'];?>"><?=$row['nama_kategori'];?></option>
			<?php }} ?>
		</select>	
		</div>
	</div>
	</div>

	<div class="col-md-7">	
		<div class="form-group">
			<div class="input-group ">
			<span class="input-group-addon">
				<input type="checkbox" id="isisama1">
			</span>
			<Label class="form-control">Isi Hal. Sama seperti buku tulis</label>
			</div>
		</div>
		</div>											
	<div class="col-md-5">	
			<div class="form-group">
			<div class="input-group">
				<span class="input-group-addon">Mesin Cetak</span>
				<select id="j_mesin" class="selectpicker form-control" data-style="btn-success">
				<option value="Offset" selected>Mesin Offset Besar</option>
				<option value="MiniOffset" >Mesin Offset Kecil</option>
				<option value="PhotoCopy" >Photocopy</option>
				<option value="PrintDigital" >Print A3+</option>
				</select>
			</div>
			</div>
			</div>
											
</div>
				</li>
			</ul>
		</li>
		<li>
<div class="link"><i class="fa fa-edit"></i>Isi Buku 2<i class="fa fa-chevron-down"></i></div>
			<ul class="submenu">
				<li>
<div class="panel-body">
			<div class="col-md-6">	
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">Jml Warna</span>
					<input type="text" class="form-control" aria-label="" id="jmlwarnabu2" value="0">
					<span class="input-group-addon">/</span>
					<input type="text" class="form-control" aria-label="" id="jmlwarnabu22" value="0">
					
				</div>
				</div>
				
			</div>
												
			<div class="col-md-6">	
			<div class="form-group">
				<div class="input-group">
				  <span class="input-group-addon">Jml Halaman</span>
				  <input type="text" class="form-control" aria-label="" id="jmlhalbu2" value="0">
				</div>
			</div>
			</div>
			<div class="col-md-5">
			<div class="form-group">
					<select id="lambu2" class="selectpicker form-control" data-style="btn-warning">
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
			<div class="col-md-7">
			<div class="form-group">
				<div class="input-group">
				<span class="input-group-addon">Kertas</span>
				<?php $sql_bhn = $db->query("SELECT * FROM kategori_bahan where modul like '%buku%' AND pub='Y' ORDER BY id_kategori"); ?>
				<select id="bahanbu2"  class="chosen-select form-control" data-style="btn-info" data-size="auto" data-placeholder='Pilih Bahan' required="required">
					<?php while($row=$sql_bhn->fetch_array()){
					if($row['id_kategori']==10){ ?>
						<option value="<?=$row['id_kategori'];?>" selected><?=$row['nama_kategori'];?> <?php
					}else{	?>
						<option value="<?=$row['id_kategori'];?>"><?=$row['nama_kategori'];?></option>
					<?php }} ?>
				</select>	
				</div>
			</div>
			</div>
			
			<div class="col-md-7">	
				<div class="form-group">
					<div class="input-group ">
					<span class="input-group-addon">
						<input type="checkbox" id="isisama2">
					</span>
					<Label class="form-control">Isi Hal. Sama seperti buku tulis</label>
					</div>
				</div>
				</div>											
				<div class="col-md-5">	
				<div class="form-group">
					<div class="input-group ">
					<span class="input-group-addon">
						<input type="checkbox" id="minioffsetisi2">
					</span>
					<Label class="form-control">Mesin Minioffset</label>
					</div>
				</div>
				</div>
			</div>
				</li>
			</ul>
		</li>
		<li>
			<div class="link"><i class="fa fa-edit"></i>Isi Buku 3<i class="fa fa-chevron-down"></i></div>
			<ul class="submenu">
				<li>
<div class="panel-body">
			<div class="col-md-6">
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">Jml Warna</span>
					<input type="text" class="form-control" aria-label="" id="jmlwarnabu3" value="0">
					<span class="input-group-addon">/</span>
					<input type="text" class="form-control" aria-label="" id="jmlwarnabu32" value="0">
					
				</div>
				</div>
				
			</div>
												
			<div class="col-md-6">	
			<div class="form-group">
				<div class="input-group">
				  <span class="input-group-addon">Jml Halaman</span>
				  <input type="text" class="form-control" aria-label="" id="jmlhalbu3" value="0">
				</div>
			</div>
			</div>
			<div class="col-md-5">
			<div class="form-group">
					<select id="lambu3" class="selectpicker form-control" data-style="btn-warning">
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
			<div class="col-md-7">
			<div class="form-group">
				<div class="input-group">
				<span class="input-group-addon">Kertas</span>
				<?php $sql_bhn = $db->query("SELECT * FROM kategori_bahan where modul like '%buku%' AND pub='Y' ORDER BY id_kategori"); ?>
				<select id="bahanbu3"  class="chosen-select form-control" data-style="btn-info" data-size="auto" data-placeholder='Pilih Bahan' required="required">
					<?php while($row=$sql_bhn->fetch_array()){
					if($row['id_kategori']==10){ ?>
						<option value="<?=$row['id_kategori'];?>" selected><?=$row['nama_kategori'];?> <?php
					}else{	?>
						<option value="<?=$row['id_kategori'];?>"><?=$row['nama_kategori'];?></option>
					<?php }} ?>
				</select>	
				</div>
			</div>
			</div>
			<div class="col-md-7">	
				<div class="form-group">
					<div class="input-group ">
					<span class="input-group-addon">
						<input type="checkbox" id="isisama3">
					</span>
					<Label class="form-control">Isi Hal. Sama seperti buku tulis</label>
					</div>
				</div>
				</div>											
				<div class="col-md-5">	
				<div class="form-group">
					<div class="input-group ">
					<span class="input-group-addon">
						<input type="checkbox" id="minioffsetisi3">
					</span>
					<Label class="form-control">Mesin Minioffset</label>
					</div>
				</div>
				</div>
			</div> 
				</li>
			</ul>
		</li>
		<li><div class="link"><i class="fa fa-edit"></i>Cover Buku<i class="fa fa-chevron-down"></i></div>
			<ul class="submenu">
    			<li>
<div class="panel-body">
			<div class="col-md-6">
				<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon">Jml Warna</span>
					<input type="text" class="form-control" aria-label="" id="jmlwarnacovbu" value="4">
					<span class="input-group-addon">/</span>
					<input type="text" class="form-control" aria-label="" id="jmlwarnacovbu2" value="0">
				</div>
				</div>
			</div>
												
			<div class="col-md-6">	
			<div class="form-group">
				<select id="jenisjilidbu" class="selectpicker form-control" data-style="btn-success">
				<option value="1" selected>Jilid Soft Cover</option>
				<option value="2" >Hard Cover</option>
				</select>
			</div>
			</div>
			<div class="col-md-6">	</div>  
			<div class="col-md-6">	  
			<div class="form-group botbuku">
			<div class="input-group">
				<span class="input-group-addon">Jenis Bot</span>
				<?php $sql_bhn = $db->query("SELECT * FROM kategori_bahan where modul like '%bot%' AND pub='Y' ORDER BY id_kategori"); ?>
				<select id="botbuku"  class="chosen-select form-control" data-style="btn-info" data-size="auto" data-placeholder='Pilih Bahan' required="required">
				<?php while($row=$sql_bhn->fetch_array()){
					if($row['id_kategori']==5){ ?>
						<option value="<?=$row['id_kategori'];?>" selected><?=$row['nama_kategori'];?> <?php
					}else{	?>
						<option value="<?=$row['id_kategori'];?>"><?=$row['nama_kategori'];?></option>
					<?php }} ?>
				</select>	
			</div>
			</div>
			</div>
			
			
			<div class="col-md-12">	
			<div class="form-group">
				<div class="input-group">
				  <span class="input-group-addon">Lebar</span>
				  <input type="text" class="form-control" aria-label="" id="lbrcoverbu">
				  <span class="input-group-addon">Tinggi</span>
				  <input type="text" class="form-control" aria-label="" id="tgcoverbu" >
				  <span class="input-group-addon lbrlembuku">Lebar Lem</span>
				  <input type="text" class="form-control lbrlembuku" aria-label="" id="lbrlembuku" >
				  <span class="input-group-addon">Cm</span>
				  
				</div>
			</div>  
			</div>  
			
			<div class="col-md-6">	
			<div class="form-group">
				<div class="input-group">
				  <span class="input-group-addon">
					<input type="checkbox" id="autopunggung">
				  </span>
				 <Label class="form-control">Lebar Punggung Automatis</label>
				 </div>
			</div>  
			</div> 
			<div class="col-md-6 lebpungbu">	
			<div class="form-group">
				<div class="input-group">
				  <span class="input-group-addon">Lebar Punggung</span>
				  <input type="text" class="form-control" aria-label="" id="lebpungbu" >
				  <span class="input-group-addon">Cm</span>
				  
				</div>
			</div>  
			</div>
			<div class="col-md-5">
			<div class="form-group">
				<div class="input-group">
				<span class="input-group-addon">Kertas</span>
				<?php $sql_bhn = $db->query("SELECT * FROM kategori_bahan where modul like '%buku%' AND pub='Y' ORDER BY id_kategori"); ?>
				<select id="bahancovbu"  class="chosen-select form-control" data-style="btn-info" data-size="auto" data-placeholder='Pilih Bahan' required="required">
					<?php while($row=$sql_bhn->fetch_array()){
					if($row['id_kategori']==5){ ?>
						<option value="<?=$row['id_kategori'];?>" selected><?=$row['nama_kategori'];?> <?php
					}else{	?>
						<option value="<?=$row['id_kategori'];?>"><?=$row['nama_kategori'];?></option>
					<?php }} ?>
				</select>
				</div>
				</div>
			</div>

			<div class="col-md-4">	
			<div class="form-group">
				<select id="jilidbu" class="selectpicker form-control" data-style="btn-success">
				<option value="1" selected>Lem Panas</option>
				<option value="2" >Spiral Kawat</option>
				<option value="3" >Steples</option>
				<option value="4" >Jahit</option>
				</select>
			</div>
			</div>											
			<div class="col-md-3">	
			<div class="form-group">
			<div class="input-group">
				<span class="input-group-addon">Posisi</span>
				<select id="posjilidbu" class="selectpicker form-control" data-style="btn-success">
				<option value="1" selected>Kiri</option>
				<option value="2" >Atas</option>
				</select>
			</div>
			</div>
			</div>
												
			<div class="col-md-4">	
			<div class="form-group">
					<select id="lamcovbu" class="selectpicker form-control" data-style="btn-warning">
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
			<div class="col-md-4">	
			<div class="form-group">
				<div class="input-group ">
				<span class="input-group-addon">
					<input type="checkbox" id="wrappingbuku">
				</span>
				<Label class="form-control">Wrapping</label>
				</div>
			</div>
			</div>
				<div class="col-md-4">	
				<div class="form-group">
					<div class="input-group ">
					<span class="input-group-addon">
						<input type="checkbox" id="minioffsetisi4">
					</span>
					<Label class="form-control">Mesin Minioffset</label>
					</div>
				</div>
				</div>
		<div class="">
			<div class="col-md-5">	
			<div class="form-group">
				<div class="input-group ">
				<span class="input-group-addon">
					<input type="checkbox" id="polybuku">
				</span>
				<Label class="form-control">Poly</label>
				</div>
			</div>
			</div>
			<div class="col-md-7">	
			<div class="form-group">
			   <div class="input-group">
				  <span class="input-group-addon">Lebar</span>
				  <input type="text" class="form-control" aria-label="" id="lbrpolybuk" value="1">
				  <span class="input-group-addon">Tinggi</span>
				  <input type="text" class="form-control" aria-label="" id="tgpolybuk" value="1">
				  <span class="input-group-addon">cm</span>
				</div>
			</div>
			</div>
			<div class="col-md-5">	
			<div class="form-group">
			<div class="input-group ">
				  <span class="input-group-addon">
					<input type="checkbox" id="embosbuku">
				  </span>
				  <Label class="form-control">Embos</label>
				</div><!-- /input-group -->
			</div>
			</div>
			<div class="col-md-7">	
			<div class="form-group">
			   <div class="input-group">
				  <span class="input-group-addon">Lebar</span>
				  <input type="text" class="form-control" aria-label="" id="lbrembosbuk" value="1">
				  <span class="input-group-addon">Tinggi</span>
				  <input type="text" class="form-control" aria-label="" id="tgembosbuk" value="1">
				  <span class="input-group-addon">cm</span>
				</div>
			</div>
			</div>

			<div class="col-md-5">
			<div class="form-group">
			<div class="input-group ">
				  <span class="input-group-addon">
					<input type="checkbox" id="spotuvbuku">
				  </span>
				  <Label class="form-control">SpotUV</label>
				</div><!-- /input-group -->	
			</div>
			</div>
			</div>
			</div>
				</li>
			</ul>
		</li>
	</ul>

</div> 
		<div class="col-md-8">	
			<div class="form-group">
			<div class="input-group">
			<span class="input-group-addon">Keterangan</span>
			<input type="text" class="form-control" aria-label="" id="ketbuku"  placeholder="Isi dulu keterangannya">
			</div>
			</div>
		</div>
		<div class="col-md-4">	
				<button  type="submit" class="btn btn-primary btnon" onclick="hitungbu1()">Hitung</button>
				<button type="button" class="btn btn-primary printpenawaran"><i class="fa fa-external-link" aria-hidden="true"></i></button>
		</div>
		<div class="col-md-12">
		<div class="progress progress-striped active" style="height:5px;">
			<div class="progress-bar"  role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;height:5px;">
			</div>
		</div>	
		</div>	
	<div class="col-md-12">
		<div id="">
			<table id='tablebuku' class='table table-striped table-responsive' >
			<thead >
			<tr style='background-color:<?=$warnabar;?>;color:white' >
			<th class='text-left'>Harga Jual</th><th></th>
			</tr>
			</thead>
			<tr><td class='text-left'> <span id="satuanbukuku"></span></td><td class='text-right' ><button type='submit' name='submit' value='0' class='btn btn-warning btn-sm'><span id="totjualbuku"></span></button></td></tr>
			</table>												
		</div>
	</div>
</div>      
</div>      
</div>      
<script>
$(function() {
    var Accordion = function(el, multiple) {
		this.el = el || {};
		this.multiple = multiple || false;

		// Variables privadas
		var links = this.el.find('.link');
		// Evento
		links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown)
	}

	Accordion.prototype.dropdown = function(e) {
		var $el = e.data.el;
			$this = $(this),
			$next = $this.next();

		$next.slideToggle();
		$this.parent().toggleClass('open');

		if (!e.data.multiple) {
			$el.find('.submenu').not($next).slideUp().parent().removeClass('open');
		};
	}	

	var accordion = new Accordion($('#accordion'), false);
});






$(document).ready(function(){
	
	$('#ukuranbu').val('11');
	$('#lbrcetakbu').val('14.8');
	$('#tgcetakbu').val('21');
	$('#lbrcoverbu').val('14.8');
	$('#tgcoverbu').val('21');
	$('.lbrlembuku').hide();
	$('.botbuku').hide();
	$('#lbrlembuku').val('1.5');
	$('#lebpungbu').prop('readonly', true);
	$('#autopunggung').attr('checked', 'checked');
	$('#tablebuku').hide();
	
	// $('.isi2').hide();
	// $('.isi3').hide();
	// $('.more4').hide();
	
	$('.harga').hide();
	
})

	// $( "#profits"+modulhit).keyup(function() {
		profits = $('#profits').val();
		// tot = angka($('#totdumy'+modulhit).val());
		// jual = parseFloat(profit * tot/100) + parseInt(tot);
		// satuan = jual / $('#jmlcetakbu').val();
		// perrim = satuan * 500;
		// $('#satuan'+modulhit).val(formatMoney(satuan));
		// $('#hargarim'+modulhit).val(formatMoney(perrim));
		// $('#total'+modulhit).val(formatMoney(jual));
	// })	
	
	
	$('#jmlcetakbu').on('change', function() {
			$('#jumlahcetakbuku').val($('#jmlcetakbu').val());
	})
	
	
	
	$('#jenisjilidbu').on('change', function() {
		if( this.value == '2'){
			$('.lbrlembuku').show();
			$('.botbuku').show();
			
		}else{
			$('.lbrlembuku').hide();
			$('.botbuku').hide();
		}
	})
	
	
	$('#autopunggung').click(function(){
		if($('#lebpungbu').is("[readonly]")) 
        {
			$('#lebpungbu').prop('readonly', false);
		}else{
			$('#lebpungbu').prop('readonly', true);
		}			
	});	
	// $('#more1').click(function(){
		// if($('.isi1').is(":visible")){
			// $('.isi1').hide();
			// $("#more1").removeClass("fa-chevron-up").addClass("fa-chevron-down");	
		// }else{
			// $('.isi1').show();
			// $("#more1").removeClass("fa-chevron-down").addClass("fa-chevron-up");	
		// }			
	// });	
	// $('#more2').click(function(){
		// if($('.isi2').is(":visible")) 
        // {
			// $('.isi2').hide();
			// $("#more2").removeClass("fa-chevron-up").addClass("fa-chevron-down");	
		// }else{
			// $('.isi2').show();
			// $("#more2").removeClass("fa-chevron-down").addClass("fa-chevron-up");	
		// }			
	// });		
	// $('#more3').click(function(){
		// if($('.isi3').is(":visible")) {
			// $('.isi3').hide();
			// $("#more3").removeClass("fa-chevron-up").addClass("fa-chevron-down");	
		// }else{
			// $('.isi3').show();
			// $("#more3").removeClass("fa-chevron-down").addClass("fa-chevron-up");	
		// }			
	// });	
	// $('#more4').click(function(){
		// if($('.more4').is(":visible")) {
			// $('.more4').hide();
			// $("#more4").removeClass("fa-chevron-up").addClass("fa-chevron-down");	
		// }else{
			// $('.more4').show();
			// $("#more4").removeClass("fa-chevron-down").addClass("fa-chevron-up");	
		// }			
	// });	
	
	

  
function hitungbu1() {
		// $('#tablebuku').hide();
		// $('.harga').hide();
		// $( "#profits").val();
			
	
		//Isi Warna	
		var bleed = document.getElementById("bleedbu1").value;
		var lbrcetak = document.getElementById("lbrcetakbu").value ;
		var tgcetak = document.getElementById("tgcetakbu").value;
		var jmlcetak = document.getElementById("jmlcetakbu").value;
		var jilidbu = document.getElementById("jilidbu").value;
		var posjilidbu = document.getElementById("posjilidbu").value;
		
	
		
		if(document.getElementById("isisama1").checked == true ){			
			var jmlset = 1;
			var jmlcetak = parseInt(jmlcetak) * parseInt(document.getElementById("jmlhalbu1").value);
		}else{
			var jmlset = document.getElementById("jmlhalbu1").value;
		}
			var j_mesin = document.getElementById("j_mesin").value;
			
		if (jilidbu > 2){
			if(document.getElementById("isisama1").checked == true ){		
				jmlcetak = parseFloat(jmlcetak) / 2;
				lbrcetak = parseFloat(lbrcetak)  + ( 2 * parseFloat(bleed));
				tgcetak = parseFloat(tgcetak) + ( 2 * parseFloat(bleed));
			}else{
				lbrcetak = parseFloat(lbrcetak)  + parseFloat(bleed);
				tgcetak = parseFloat(tgcetak) + ( 2 * parseFloat(bleed));
				//jmlset = jmlset / 2;
			}
		}else{
			lbrcetak = parseFloat(lbrcetak)  + ( 2 * parseFloat(bleed));
			tgcetak = parseFloat(tgcetak) + ( 2 * parseFloat(bleed));
		}
		//		alert("set : " + jmlset + " lbr: " + lbrcetak + " jml: " + jmlcetak);
		
		var bahan = document.getElementById("bahanbu1").value;
		var bb = ""; //document.getElementById("bbbu1").value;
		var jmlwarna = document.getElementById("jmlwarnabu1").value;
		var jmlwarna2 = document.getElementById("jmlwarnabu12").value;
			if (jmlwarna != null && jmlwarna < 1){  
				alert("Jumlah Warna Minimal 1!! " + jmlwarna);
				return;
			}			
		var lam = document.getElementById("lambu1").value;
		var lbrf1= 1;		var tgf1 = 1;		
		var lbrf2= 1;		var tgf2 = 1;		
		var lbrf3= 1;		var tgf3 = 1;		
		var lbrf4= 1;		var tgf4 = 1;		
		var lbrf5= 1;		var tgf5 = 1;
		var lbrf6= 1;		var tgf6 = 1;
		var finishing6 = '0';		
		var finishing1 = 0;
		var finishing2 = 0;
		var finishing3 = 0;
		var finishing4 = 0;
		var finishing5 = 0;
		
		var modul = 'buku';
		var insheet="1";
		var jml_satuan=1;
		var cetak_bagi="Y";
		var ket = document.getElementById("ketbuku").value;
		var ket_satuan = "buku";
		var rim = 500;
		var box = 100;
		var ongpot = 'Y';
		var kethitung = 'Isi_Buku_1';
		var ongkos_lipat = 'Y';
		
		
		
	

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
	//	alert(jmlcetak);
	//Hitung Isinya----------------------------------------	
		var xmlhttp = new XMLHttpRequest();
 xmlhttp.addEventListener("progress", function (evt)
 {if (evt.lengthComputable){var percentComplete = (evt.loaded / evt.total) *100;
 $('.progress').show();
$('#tablebox5').hide();
 $("div.progress > div.progress-bar").css({ "width": percentComplete + "%" }); 
if(percentComplete){setTimeout(function(){$(".progress-bar").css('background','green');$('#tablebox5').show();}, 500);}}},false);
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				
			//	setTimeout(function(){$(".progress-bar").css('width','20%'); }, 1000); 	
				myArr = JSON.parse(xmlhttp.responseText);	
				data = myArr;
				
					// $('#ketbuku').val(JSON.stringify(data[0]['jmlcetak']));					
				var tc = (data[0]['jmlcetak']).split("|"); //Jika ada 2 data 									
				if (tc.length == 2){
						var arr = myArr[0];
						var a= "";
						var aa= "";
						var b = "";
						for (var key in arr) {
							// skip loop if the property is from prototype
							var obj = arr[key];
							if (arr.hasOwnProperty(key)) {
								dat = b + obj;	
								a += '"'+ key + '"' + ':'+ '"' + dat.toString().split("|",1) + '",' ;
								
								var n = dat.toString().indexOf("|");
								var dat2 = dat.substring(n+1,dat.length);
								aa += '"'+ key + '"' + ':'+ '"' + dat2 + '",' ;
							}
						}
						
						var newStr = a.substring(0, a.length-1);
						var newStr2 = aa.substring(0, aa.length-1);
						var data1= JSON.parse("{" + newStr + "}");
						var data2= JSON.parse("{" + newStr2 + "}");
			
						hitungbu2(data1,data2);
					// $('#ketbuku').val(JSON.stringify(data));				
				//	$('#ketbuku').val(JSON.stringify(data1) + " --- " + JSON.stringify(data2) + " ---" + JSON.stringify(myArr));				
					//alert(data[0]['totcetak'].split("|"));
				}else{
					var data1 = myArr[0];
					var data2 = {};
					hitungbu2(data1,data2);
				}
								}
		}	
			isi="lbrcetak="+lbrcetak+"&tgcetak="+tgcetak+"&jmlcetak="+jmlcetak+"&bahan="+bahan+"&bb="+bb+"&jmlwarna="+jmlwarna+"&jmlwarna2="+jmlwarna2+"&lam="+lam+"&finishing1="+finishing1+"&finishing2="+finishing2+"&finishing3="+finishing3+"&finishing4="+finishing4+"&finishing5="+finishing5+"&finishing6="+finishing6+"&lbrf1="+lbrf1+"&tgf1="+tgf1+"&lbrf2="+lbrf2+"&tgf2="+tgf2+"&lbrf3="+lbrf3+"&tgf3="+tgf3+"&lbrf4="+lbrf4+"&tgf4="+tgf4+"&lbrf5="+lbrf5+"&tgf5="+tgf5+"&lbrf6="+lbrf6+"&tgf6="+tgf6+"&jmlset="+jmlset+"&modul="+modul+"&insheet="+insheet+"&jml_satuan="+jml_satuan+"&cetak_bagi="+cetak_bagi+"&ket_satuan="+ket_satuan+"&ongpot="+ongpot+"&j_mesin="+j_mesin+"&kethitung="+kethitung+"&jilid="+posjilidbu+"&ongkos_lipat="+ongkos_lipat;
			
			isi=btoa(isi); //encode			
			xmlhttp.open("GET","/wadah.php?isi="+isi,true);
			xmlhttp.send();

}
		
function hitungbu2(r,s) {
	
	var posjilidbu = document.getElementById("posjilidbu").value;
	data1 = r;
	data2 = s;
		//$('#ketbuku').val(JSON.stringify(data1));	
	jmlwarna = document.getElementById("jmlwarnabu2").value;	
	jmlwarna2 = document.getElementById("jmlwarnabu22").value;	

	if(jmlwarna != null && jmlwarna < 1){
		var data3 = {}; var data4 = {};
		hitungbu3(data1,data2,data3,data4);
		//$('#ketbuku').val(JSON.stringify(data1['totcetak']));	
	}else{
		
		
	
		var bleed = document.getElementById("bleedbu1").value;
		var lbrcetak = document.getElementById("lbrcetakbu").value;
		var tgcetak = document.getElementById("tgcetakbu").value;
		var jmlcetak = document.getElementById("jmlcetakbu").value;
		var jilidbu = document.getElementById("jilidbu").value;
		
		
		if(document.getElementById("isisama2").checked == true ){			
			var jmlset = 1;
			var jmlcetak = parseInt(jmlcetak) * parseInt(document.getElementById("jmlhalbu2").value);
		}else{
			var jmlset = document.getElementById("jmlhalbu2").value;
		}
		if(document.getElementById("minioffsetisi2").checked == true ){		
			var j_mesin = 'MiniOffset';
		}else{
			var j_mesin = '';
		}		
		jmlhal2 = document.getElementById("jmlhalbu2").value;
		if (jmlhal2 < 1 && jmlhal2 != null  ){
			alert(" Isi dahulu jumlah halaman isi buku2!!");
			return;
			}
	

		if (jilidbu > 2){
			if(document.getElementById("isisama1").checked == true ){		
				jmlcetak = parseFloat(jmlcetak) / 2;
				lbrcetak = parseFloat(lbrcetak)  + ( 2 * parseFloat(bleed));
				tgcetak = parseFloat(tgcetak) + ( 2 * parseFloat(bleed));
			}else{
				lbrcetak = parseFloat(lbrcetak)  + parseFloat(bleed);
				tgcetak = parseFloat(tgcetak) + ( 2 * parseFloat(bleed));
				//jmlset = jmlset / 2;
			}
		}else{
			lbrcetak = parseFloat(lbrcetak)  + ( 2 * parseFloat(bleed));
			tgcetak = parseFloat(tgcetak) + ( 2 * parseFloat(bleed));
		}
	

		
		var bahan = document.getElementById("bahanbu2").value;
		var bb = "";//document.getElementById("bbbu2").value;
				
		var lam = document.getElementById("lambu2").value;
		var lbrf1= 1;		var tgf1 = 1;		
		var lbrf2= 1;		var tgf2 = 1;		
		var lbrf3= 1;		var tgf3 = 1;		
		var lbrf4= 1;		var tgf4 = 1;		
		var lbrf5= 1;		var tgf5 = 1;
		var lbrf6= 1;		var tgf6 = 1;
		var finishing6 = '0';		
		var finishing1 = 0;
		var finishing2 = 0;
		var finishing3 = 0;
		var finishing4 = 0;
		var finishing5 = 0;
		
		var modul = 'buku';
		var insheet="1";
		var jml_satuan=1;
		var cetak_bagi="Y";
		var ket = document.getElementById("ketbuku").value;
		var ket_satuan = "buku";
		var rim = 500;
		var box = 100;
		var ongpot = 'Y';
		var kethitung = "Isi_Buku_2";
		
	
	
		if(lbrcetak != null && lbrcetak < 1){
			alert(" Lebar Cetakan Kosong!!");
			return;
		}
		if (tgcetak != null && tgcetak < 1){
			alert("Tinggi Cetakan Kosong!!");
			return;	
		}
	//	alert(j_mesin);
	//Hitung Isinya----------------------------------------	
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				
			//	$(".progress-bar").css('width','40%');  		
				
				myArr = JSON.parse(xmlhttp.responseText);	
				data = myArr;
				// $('#ketbuku').val(JSON.stringify(myArr));				
				
				var tc = (data[0]['jmlcetak']).split("|"); //Jika ada 2 data 									
				if (tc.length == 2){
						var arr = myArr[0];
						var a= "";
						var aa= "";
						var b = "";
						for (var key in arr) {
							// skip loop if the property is from prototype
							var obj = arr[key];
							if (arr.hasOwnProperty(key)) {
								dat = b + obj;	
								a += '"'+ key + '"' + ':'+ '"' + dat.toString().split("|",1) + '",' ;
								
								var n = dat.toString().indexOf("|");
								var dat2 = dat.substring(n+1,dat.length);
								aa += '"'+ key + '"' + ':'+ '"' + dat2 + '",' ;
							}
						}
						
						var newStr = a.substring(0, a.length-1);
						var newStr2 = aa.substring(0, aa.length-1);
						var data3= JSON.parse("{" + newStr + "}");
						var data4= JSON.parse("{" + newStr2 + "}");
			
				//	$('#ketbuku').val(JSON.stringify(data));				
				//	$('#ketbuku').val(JSON.stringify(data1) + " --- " + JSON.stringify(data2) + " ---" + JSON.stringify(myArr));				
					//alert(data[0]['totcetak'].split("|"));
				}else{
					var data3 = myArr[0];
					var data4 = {};
					//$('#ketbuku').val(JSON.stringify(data));				
					//$('#ketbuku').val(data2[0]['jmlcetak']);		
					//alert(data[0]['totcetak']);
				}
				hitungbu3(data1,data2,data3,data4);
			//	$('#ketbuku').val(JSON.stringify(data3['totcetak']));	
				
			}
		}	
			isi="lbrcetak="+lbrcetak+"&tgcetak="+tgcetak+"&jmlcetak="+jmlcetak+"&bahan="+bahan+"&bb="+bb+"&jmlwarna="+jmlwarna+"&jmlwarna2="+jmlwarna2+"&lam="+lam+"&finishing1="+finishing1+"&finishing2="+finishing2+"&finishing3="+finishing3+"&finishing4="+finishing4+"&finishing5="+finishing5+"&finishing6="+finishing6+"&lbrf1="+lbrf1+"&tgf1="+tgf1+"&lbrf2="+lbrf2+"&tgf2="+tgf2+"&lbrf3="+lbrf3+"&tgf3="+tgf3+"&lbrf4="+lbrf4+"&tgf4="+tgf4+"&lbrf5="+lbrf5+"&tgf5="+tgf5+"&lbrf6="+lbrf6+"&tgf6="+tgf6+"&jmlset="+jmlset+"&modul="+modul+"&insheet="+insheet+"&jml_satuan="+jml_satuan+"&cetak_bagi="+cetak_bagi+"&ket_satuan="+ket_satuan+"&ongpot="+ongpot+"&j_mesin="+j_mesin+"&kethitung="+kethitung+"&jilid="+posjilidbu+"&ongkos_lipat=Y";
			
			isi=btoa(isi); //encode			
			xmlhttp.open("GET","/wadah.php?isi="+isi,true);
			xmlhttp.send();
			
	}

}


function hitungbu3(r,s,t,u) {
	
	var posjilidbu = document.getElementById("posjilidbu").value;
	data1 = r;
	data2 = s;
	data3 = t;
	data4 = u;
		// $('#ketbuku').val(JSON.stringify(data1));	
	jmlwarna = document.getElementById("jmlwarnabu3").value;	
	jmlwarna2 = document.getElementById("jmlwarnabu32").value;	
	if(jmlwarna != null && jmlwarna < 1){
		var data5 = {}; var data6 = {};
		hitungcoverbu(data1,data2,data3,data4,data5,data6);
		// $('#ketbuku').val(JSON.stringify(data4['totcetak']));	
	}else{
	
		var bleed = document.getElementById("bleedbu1").value;
		var lbrcetak = document.getElementById("lbrcetakbu").value;
		var tgcetak = document.getElementById("tgcetakbu").value;
		var jmlcetak = document.getElementById("jmlcetakbu").value;
		var jilidbu = document.getElementById("jilidbu").value;
		
		
		if(document.getElementById("isisama3").checked == true ){			
			var jmlset = 1;
			var jmlcetak = parseInt(jmlcetak) * parseInt(document.getElementById("jmlhalbu3").value);
		}else{
			var jmlset = document.getElementById("jmlhalbu3").value;
		}
		if(document.getElementById("minioffsetisi3").checked == true ){		
			var j_mesin = 'MiniOffset';
		}else{
			var j_mesin = '';
		}
		jmlhal3 = document.getElementById("jmlhalbu3").value;
		if (jmlhal3 < 1 && jmlhal3 != null  ){
			alert(" Isi dahulu jumlah halaman isi buku3!!");
			return;
			}		
			

		if (jilidbu > 2){
			if(document.getElementById("isisama1").checked == true ){		
				jmlcetak = parseFloat(jmlcetak) / 2;
				lbrcetak = parseFloat(lbrcetak)  + ( 2 * parseFloat(bleed));
				tgcetak = parseFloat(tgcetak) + ( 2 * parseFloat(bleed));
			}else{
				lbrcetak = parseFloat(lbrcetak)  + parseFloat(bleed);
				tgcetak = parseFloat(tgcetak) + ( 2 * parseFloat(bleed));
				//jmlset = jmlset / 2;
			}
		}else{
			lbrcetak = parseFloat(lbrcetak)  + ( 2 * parseFloat(bleed));
			tgcetak = parseFloat(tgcetak) + ( 2 * parseFloat(bleed));
		}
		
		var bahan = document.getElementById("bahanbu3").value;
		var bb = "";//document.getElementById("bbbu3").value;
				
		var lam = document.getElementById("lambu3").value;
		var lbrf1= 1;		var tgf1 = 1;		
		var lbrf2= 1;		var tgf2 = 1;		
		var lbrf3= 1;		var tgf3 = 1;		
		var lbrf4= 1;		var tgf4 = 1;		
		var lbrf5= 1;		var tgf5 = 1;
		var lbrf6= 1;		var tgf6 = 1;
		var finishing6 = '0';		
		var finishing1 = 0;
		var finishing2 = 0;
		var finishing3 = 0;
		var finishing4 = 0;
		var finishing5 = 0;
		
		var modul = 'buku';
		var insheet="1";
		var jml_satuan=1;
		var cetak_bagi="Y";
		var ket = document.getElementById("ketbuku").value;
		var ket_satuan = "buku";
		var rim = 500;
		var box = 100;
		var ongpot = 'Y';
		var kethitung = "Isi_Buku_3";
		
	

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
	//	alert(j_mesin);
	//Hitung Isinya----------------------------------------	
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			//	$(".progress-bar").css('width','60%'); 
				myArr = JSON.parse(xmlhttp.responseText);	
				data = myArr;
				//$('#ketbuku').val(JSON.stringify(myArr));				
				
				var tc = (data[0]['jmlcetak']).split("|"); //Jika ada 2 data 									
				if (tc.length == 2){
						var arr = myArr[0];
						var a= "";
						var aa= "";
						var b = "";
						for (var key in arr) {
							// skip loop if the property is from prototype
							var obj = arr[key];
							if (arr.hasOwnProperty(key)) {
								dat = b + obj;	
								a += '"'+ key + '"' + ':'+ '"' + dat.toString().split("|",1) + '",' ;
								
								var n = dat.toString().indexOf("|");
								var dat2 = dat.substring(n+1,dat.length);
								aa += '"'+ key + '"' + ':'+ '"' + dat2 + '",' ;
							}
						}
						
						var newStr = a.substring(0, a.length-1);
						var newStr2 = aa.substring(0, aa.length-1);
						var data5= JSON.parse("{" + newStr + "}");
						var data6= JSON.parse("{" + newStr2 + "}");
			
				//	$('#ketbuku').val(JSON.stringify(data));				
				//	$('#ketbuku').val(JSON.stringify(data1) + " --- " + JSON.stringify(data2) + " ---" + JSON.stringify(myArr));				
					//alert(data[0]['totcetak'].split("|"));
				}else{
					var data5 = myArr[0];
					var data6 = {};
					//$('#ketbuku').val(JSON.stringify(data));				
					//$('#ketbuku').val(data2[0]['jmlcetak']);		
					//alert(data[0]['totcetak']);
				}
				hitungcoverbu(data1,data2,data3,data4,data5,data6);
			//	$('#ketbuku').val(JSON.stringify(data5['totcetak']));	
				
			}
		}	
			isi="lbrcetak="+lbrcetak+"&tgcetak="+tgcetak+"&jmlcetak="+jmlcetak+"&bahan="+bahan+"&bb="+bb+"&jmlwarna="+jmlwarna+"&jmlwarna2="+jmlwarna2+"&lam="+lam+"&finishing1="+finishing1+"&finishing2="+finishing2+"&finishing3="+finishing3+"&finishing4="+finishing4+"&finishing5="+finishing5+"&finishing6="+finishing6+"&lbrf1="+lbrf1+"&tgf1="+tgf1+"&lbrf2="+lbrf2+"&tgf2="+tgf2+"&lbrf3="+lbrf3+"&tgf3="+tgf3+"&lbrf4="+lbrf4+"&tgf4="+tgf4+"&lbrf5="+lbrf5+"&tgf5="+tgf5+"&lbrf6="+lbrf6+"&tgf6="+tgf6+"&jmlset="+jmlset+"&modul="+modul+"&insheet="+insheet+"&jml_satuan="+jml_satuan+"&cetak_bagi="+cetak_bagi+"&ket_satuan="+ket_satuan+"&ongpot="+ongpot+"&j_mesin="+j_mesin+"&kethitung="+kethitung+"&jilid="+posjilidbu+"&ongkos_lipat=Y";
			
			isi=btoa(isi); //encode			
			xmlhttp.open("GET","/wadah.php?isi="+isi,true);
			xmlhttp.send();
			
	}

}	
	


function hitungcoverbu(r,s,t,u,v,w) {
		data1 = r;
		data2 = s;
		data3 = t;
		data4 = u;
		data5 = v;
		data6 = w;
		//Isi Warna	
		
		var bleed = document.getElementById("bleedbu1").value;
		var lbrcetak = document.getElementById("lbrcetakbu").value;
		var tgcetak = document.getElementById("tgcetakbu").value;
		var jmlcetak = document.getElementById("jmlcetakbu").value;
		var jilidbu = document.getElementById("jilidbu").value;
		var jmlset = 1;

		//Ketebalan Buku (0.0013 x gramatur kertas) x (jumlah halaman / 2) mm
		//Konvert nama bahan kedalam number untuk mengambil angkanya saja
		
		var txt1 = document.getElementById("bahanbu1").value;
		var gramasi1 = txt1.match(/\d/g);
		gramasi1 = gramasi1.join("");		
		var txt2 = document.getElementById("bahanbu2").value;
		var gramasi2 = txt2.match(/\d/g);
		gramasi2 = gramasi2.join("");		
		var txt3 = document.getElementById("bahanbu3").value;
		var gramasi3 = txt2.match(/\d/g);
		gramasi3 = gramasi3.join("");
		
		var jmlhal1 = document.getElementById("jmlhalbu1").value;
		var jmlhal2 = document.getElementById("jmlhalbu2").value;
		var jmlhal3 = document.getElementById("jmlhalbu3").value;
				
		var tblbuku1 = (0.0013 * gramasi1) * (jmlhal1/2);
		var tblbuku2 = (0.0013 * gramasi2) * (jmlhal2/2);
		var tblbuku3 = (0.0013 * gramasi3) * (jmlhal3/2);
		
		var tebalbuku = $('#lebpungbu').val();
		if(document.getElementById("minioffsetisi4").checked == true ){		
			var j_mesin = 'MiniOffset';
		}else{
			var j_mesin = '';
		}	

		if(document.getElementById("autopunggung").checked == true ){		
			tblbuku = parseFloat(tblbuku1) + parseFloat(tblbuku2)  + parseFloat(tblbuku3);
			$('#lebpungbu').val(tblbuku);
		}else{
			tblbuku = $('#lebpungbu').val();
		}	
		
		
		
				
		if (jilidbu == '1'){
			finishing1 = 23;
			lbrf1 = tgcetak * tblbuku ;
			tgf1 =	1;	
		}else if(jilidbu == '2'){
			finishing1 = 24;
			lbrf1 = 1;
			tgf1 =	tgcetak;	
		}else if(jilidbu == '3'){
			finishing1 = 48;
			lbrf1 = 1;
			tgf1 =	1;	
		}else{
			finishing1 = 47;
			lbrf1 = 1;
			tgf1 =	1;	
		}
		
	
		
		
		
		tgcetak = parseFloat(tgcetak) + ( 2 * parseFloat(bleed));
		lbrcetak = (lbrcetak * 2) + parseInt(Math.ceil(tblbuku)) + ( 2 * parseFloat(bleed));
		//Jilid Hardcover
		jenisjilidbu = document.getElementById("jenisjilidbu").value;
		if (jenisjilidbu=='2'){
			lbrcetak = parseFloat(lbrcetak) + (parseFloat(document.getElementById("lbrlembuku").value) * 2); 
			tgcetak = parseFloat(tgcetak) + (parseFloat(document.getElementById("lbrlembuku").value) * 2); 
		}
		
		var bahan = document.getElementById("bahancovbu").value;
		var bb = "";//document.getElementById("bbcovbu").value;
		var jmlwarna = document.getElementById("jmlwarnacovbu").value;
		var jmlwarna2 = document.getElementById("jmlwarnacovbu2").value;
			
		
		var lam = document.getElementById("lamcovbu").value;
		var lbrf2= 1;		var tgf2 = 1;		
		var lbrf3= 1;		var tgf3 = 1;		
		var lbrf4= 1;		var tgf4 = 1;		
		var lbrf5= 1;		var tgf5 = 1;
		var lbrf6= 1;		var tgf6 = 1;
		var lbrf7= 1;		var tgf7 = 1;
		var finishing2 = 0;
		var finishing3 = 0;
		var finishing4 = 0;
		var finishing5 = 0;
		var finishing6 = '0';		
		var finishing7 = '0';		
		
		var modul = 'poster';
		var insheet="1";
		var jml_satuan=1;
		var cetak_bagi="Y";
		var ket = document.getElementById("ketbuku").value;
		var ket_satuan = "lbr";
		var rim = 500;
		var box = 100;
		var ongpot = 'Y';
		// var j_mesin = '';
		var kethitung = "Cover";
		

	//	alert(jmlset);
		
//Poly
		if(document.getElementById("polybuku").checked == true ){
			finishing2 = '10'; //poly
			lbrf2= 1;
			tgf2 = 1;			
			finishing5 = '11'; //plat
			lbrf5= parseFloat(document.getElementById("lbrpolybuk").value) / jmlcetak;
			tgf5 = document.getElementById("tgpolybuk").value;
			//alert("d");
		}
//Embos		
		if(document.getElementById("embosbuku").checked == true ){
			finishing3 = '14';
			lbrf3= 1;
			tgf3 = 1;
			finishing6 = '15';
			lbrf6= document.getElementById("lbrembosbuk").value / jmlcetak;
			tgf6 = document.getElementById("tgembosbuk").value;
			
		}
//SpotUV		
		if(document.getElementById("spotuvbuku").checked == true ){
			finishing4 = '19';
			lbrf4= lbrcetak / jmlcetak;
			tgf4 = tgcetak;
		}
//wrappingbuku		
		if(document.getElementById("wrappingbuku").checked == true ){
			finishing7 = '3';
		}
		
		//alert(lbrcetak + 'x' + tgcetak);		
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				$(".progress-bar").css('width','80%'); 
				myArr = JSON.parse(xmlhttp.responseText);
				
				var data7 = myArr[0];
				hitungbotbuku(data1,data2,data3,data4,data5,data6,data7);
				
			}
		}	
			isi="lbrcetak="+lbrcetak+"&tgcetak="+tgcetak+"&jmlcetak="+jmlcetak+"&bahan="+bahan+"&bb="+bb+"&jmlwarna="+jmlwarna+"&jmlwarna2="+jmlwarna2+"&lam="+lam+"&finishing1="+finishing1+"&finishing2="+finishing2+"&finishing3="+finishing3+"&finishing4="+finishing4+"&finishing5="+finishing5+"&finishing6="+finishing6+"&finishing7="+finishing7+"&lbrf1="+lbrf1+"&tgf1="+tgf1+"&lbrf2="+lbrf2+"&tgf2="+tgf2+"&lbrf3="+lbrf3+"&tgf3="+tgf3+"&lbrf4="+lbrf4+"&tgf4="+tgf4+"&lbrf5="+lbrf5+"&tgf5="+tgf5+"&lbrf6="+lbrf6+"&tgf6="+tgf6+"&lbrf7="+lbrf7+"&tgf7="+tgf7+"&jmlset="+jmlset+"&modul="+modul+"&insheet="+insheet+"&jml_satuan="+jml_satuan+"&cetak_bagi="+cetak_bagi+"&ket_satuan="+ket_satuan+"&ongpot="+ongpot+"&j_mesin="+j_mesin+"&kethitung="+kethitung;
			
			isi=btoa(isi); //encode			
			xmlhttp.open("GET","/wadah.php?isi="+isi,true);
			xmlhttp.send();	
					

		}		
		
function hitungbotbuku(r,s,t,u,v,w,x){
		data1 = r;
		data2 = s;
		data3 = t;
		data4 = u;
		data5 = v;
		data6 = w;
		data7 = x;
		var jmlcetak = document.getElementById("jmlcetakbu").value;
		var jml_satuan=1;
		var modul = 'kalmej';
		var insheet="1";
		var cetak_bagi="Y";
		var ket = document.getElementById("ketbuku").value;
		var ket_satuan = "lbr";
		var ongpot = 'Y';
		var rim = 500;
		var kethitung = "Bot";
		
		var jenisjilidbu = document.getElementById("jenisjilidbu").value;
		if (jenisjilidbu=='2'){
			var lbrcetak = (parseFloat(document.getElementById("lbrcetakbu").value) * 2) + parseFloat(document.getElementById("lebpungbu").value);
			var tgcetak = document.getElementById("tgcetakbu").value;
			var bahan = document.getElementById("botbuku").value;		
			var jmlwarna = 0;			
			
			var lam = 0;
			var bb = 1;
			var jmlset = 1;
			var lbrf1= 1;		var tgf1 = 1;		
			var lbrf2= 1;		var tgf2 = 1;		
			var lbrf3= 1;		var tgf3 = 1;		
			var lbrf4= 1;		var tgf4 = 1;		
			var lbrf5= 1;		var tgf5 = 1;
			var lbrf6= 1;		var tgf6 = 1;
			var finishing1 = 0; var finishing2 = 0; var finishing3 = 0;var finishing4 = 0; var finishing5 = 0; var finishing6 = '0';	
			
			
			
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					
					myArr = JSON.parse(xmlhttp.responseText);	
					data8 = myArr[0];
					hasilbuku(data1,data2,data3,data4,data5,data6,data7,data8);
				}
			}	
				isi="lbrcetak="+lbrcetak+"&tgcetak="+tgcetak+"&jmlcetak="+jmlcetak+"&bahan="+bahan+"&bb="+bb+"&jmlwarna="+jmlwarna+"&jmlwarna2="+jmlwarna2+"&lam="+lam+"&finishing1="+finishing1+"&finishing2="+finishing2+"&finishing3="+finishing3+"&finishing4="+finishing4+"&finishing5="+finishing5+"&finishing6="+finishing6+"&lbrf1="+lbrf1+"&tgf1="+tgf1+"&lbrf2="+lbrf2+"&tgf2="+tgf2+"&lbrf3="+lbrf3+"&tgf3="+tgf3+"&lbrf4="+lbrf4+"&tgf4="+tgf4+"&lbrf5="+lbrf5+"&tgf5="+tgf5+"&lbrf6="+lbrf6+"&tgf6="+tgf6+"&jmlset="+jmlset+"&modul="+modul+"&insheet="+insheet+"&jml_satuan="+jml_satuan+"&cetak_bagi="+cetak_bagi+"&ket_satuan="+ket_satuan+"&ongpot="+ongpot+"&kethitung="+kethitung;
				
				isi=btoa(isi); //encode			
				xmlhttp.open("GET","/wadah.php?isi="+isi,true);
				xmlhttp.send();
		}else{
			var data8 = {};
			hasilbuku(data1,data2,data3,data4,data5,data6,data7,data8);
		}
		
}		
	
function hasilbuku(data1,data2,data3,data4,data5,data6,data7,data8){
	
		var jmlcetak = document.getElementById("jmlcetakbu").value;
		var ket = document.getElementById("ketbuku").value;
		
		//data1
				if (data1['ongpot'] == 'Y' ){ ongkos_potong = data1['ongkos_potong'];}
				else{ ongkos_potong = 0; }
				
				subtotal1 = parseInt(data1['totcetak']) + parseInt(data1['totbhn']) + parseInt(ongkos_potong) + parseInt(data1['tot_ctp']) + parseInt(data1['totlaminating']) + parseInt(data1['finishing1']) + parseInt(data1['finishing2']) + parseInt(data1['finishing3']) + parseInt(data1['finishing4']) + parseInt(data1['finishing5']) + parseInt(data1['finishing6'])+ parseInt(data1['tot_lipat']);
				var arrStr1 = btoa(encodeURIComponent(JSON.stringify(data1)));
				
		//data2		
				if(!!(data2['hrgbhn'])){ 				
					if (data2['ongpot'] == 'Y' ){ ongkos_potong = data2['ongkos_potong'];} else{ ongkos_potong = 0; }				
					
					subtotal2 = parseInt(data2['totcetak']) + parseInt(data2['totbhn']) + parseInt(ongkos_potong) + parseInt(data2['tot_ctp']) + parseInt(data2['totlaminating']) + parseInt(data2['finishing1']) + parseInt(data2['finishing2']) + parseInt(data2['finishing3']) + parseInt(data2['finishing4']) + parseInt(data2['finishing5']) + parseInt(data2['finishing6'])+ parseInt(data2['tot_lipat']);
					var arrStr2 = btoa(encodeURIComponent(JSON.stringify(data2)));
				}else{
					var subtotal2 = '0';
					var arrStr2 = '';
					//alert('a');
				}
				
		//data3
				if(!!(data3['hrgbhn'])){ 
					if (data3['ongpot'] == 'Y' ){ ongkos_potong = data3['ongkos_potong'];} else{ ongkos_potong = 0; }				
					
					subtotal3 = parseInt(data3['totcetak']) + parseInt(data3['totbhn']) + parseInt(ongkos_potong) + parseInt(data3['tot_ctp']) + parseInt(data3['totlaminating']) + parseInt(data3['finishing1']) + parseInt(data3['finishing2']) + parseInt(data3['finishing3']) + parseInt(data3['finishing4']) + parseInt(data3['finishing5']) + parseInt(data3['finishing6'])+ parseInt(data3['tot_lipat']);
					var arrStr3 = btoa(encodeURIComponent(JSON.stringify(data3)));
				}else{
					var subtotal3 = '0';
					var arrStr3 = '';
					//alert('a');
				}
		//data4		
				if(!!(data4['hrgbhn'])){ 				
					if (data4['ongpot'] == 'Y' ){ ongkos_potong = data4['ongkos_potong'];} else{ ongkos_potong = 0; }				
					
					subtotal4 = parseInt(data4['totcetak']) + parseInt(data4['totbhn']) + parseInt(ongkos_potong) + parseInt(data4['tot_ctp']) + parseInt(data4['totlaminating']) + parseInt(data4['finishing1']) + parseInt(data4['finishing2']) + parseInt(data4['finishing3']) + parseInt(data4['finishing4']) + parseInt(data4['finishing5']) + parseInt(data4['finishing6'])+ parseInt(data4['tot_lipat']);
					var arrStr4 = btoa(encodeURIComponent(JSON.stringify(data4)));
				}else{
					var subtotal4 = '0';
					var arrStr4 = '';
				}
		//data5
			if(!!(data5['hrgbhn'])){
				if (data5['ongpot'] == 'Y' ){ ongkos_potong = data5['ongkos_potong'];} else{ ongkos_potong = 0; }				
				
					subtotal5 = parseInt(data5['totcetak']) + parseInt(data5['totbhn']) + parseInt(ongkos_potong) + parseInt(data5['tot_ctp']) + parseInt(data5['totlaminating']) + parseInt(data5['finishing1']) + parseInt(data5['finishing2']) + parseInt(data5['finishing3']) + parseInt(data5['finishing4']) + parseInt(data5['finishing5']) + parseInt(data5['finishing6'])+ parseInt(data5['tot_lipat']);
					var arrStr5 = btoa(encodeURIComponent(JSON.stringify(data5)));
				}else{
					var subtotal5 = '0';
					var arrStr5 = '';
				}
				
		//data6		
				if(!!(data6['hrgbhn'])){ 				
					if (data6['ongpot'] == 'Y' ){ ongkos_potong = data6['ongkos_potong'];} else{ ongkos_potong = 0; }				
					
					subtotal6 = parseInt(data6['totcetak']) + parseInt(data6['totbhn']) + parseInt(ongkos_potong) + parseInt(data6['tot_ctp']) + parseInt(data6['totlaminating']) + parseInt(data6['finishing1']) + parseInt(data6['finishing2']) + parseInt(data6['finishing3']) + parseInt(data6['finishing4']) + parseInt(data6['finishing5']) + parseInt(data6['finishing6'])+ parseInt(data6['tot_lipat']);
					var arrStr6 = btoa(encodeURIComponent(JSON.stringify(data6)));
				}else{
					var subtotal6 = '0';
					var arrStr6 = '';
				}				

		//data7
		if(!!(data7['hrgbhn'])){ 
			if (data7['ongpot'] == 'Y' ){ ongkos_potong = data7['ongkos_potong'];} else{ ongkos_potong = 0; }				
				
				subtotal7 = parseInt(data7['totcetak']) + parseInt(data7['totbhn']) + parseInt(ongkos_potong) + parseInt(data7['tot_ctp']) + parseInt(data7['totlaminating']) + parseInt(data7['finishing1']) + parseInt(data7['finishing2']) + parseInt(data7['finishing3']) + parseInt(data7['finishing4']) + parseInt(data7['finishing5']) + parseInt(data7['finishing6']);
				var arrStr7 = btoa(encodeURIComponent(JSON.stringify(data7)));
		}else{
					var subtotal7 = '0';
					var arrStr7 = '';
				}		
				
		
		if(!!(data8['hrgbhn'])){ 
			if (data8['ongpot'] == 'Y' ){ ongkos_potong = data8['ongkos_potong'];}
						else{ ongkos_potong = 0; }				
						
						subtotal8 = parseInt(data8['totcetak']) + parseInt(data8['totbhn']) + parseInt(ongkos_potong) + parseInt(data8['tot_ctp']) + parseInt(data8['totlaminating']) + parseInt(data8['finishing1']) + parseInt(data8['finishing2']) + parseInt(data8['finishing3']) + parseInt(data8['finishing4']) + parseInt(data8['finishing5']) + parseInt(data8['finishing6']);
						var arrStr8 = btoa(encodeURIComponent(JSON.stringify(data8)));
			}else{
					var subtotal8 = '0';
					var arrStr8 = '';
				}			
						
						
			total = parseInt(subtotal1) + parseInt(subtotal2) + parseInt(subtotal3) + parseInt(subtotal4) + parseInt(subtotal5) + parseInt(subtotal6) + parseInt(subtotal7) + parseInt(subtotal8);

			// profit = data2['persen'];
			profit = profits;
			// alert(profit);
			jual = (parseInt(total) * parseInt(profit) / 100) + parseInt(total);
			satuan = parseInt(jual / jmlcetak);
			// alert(total);
			
			$(".progress-bar").css('width','100%');
			setTimeout(function(){ $(".progress-bar").css('background','green'); }, 500);  
// $('#ketbuku').val(data1['totcetak']);
			// alert(arrStr1);
			// $('#databuku1').val(arrStr1);
			// $('#databuku2').val(arrStr2);
			// $('#databuku3').val(arrStr3);
			// $('#databuku4').val(arrStr4);
			// $('#databuku5').val(arrStr5);
			// $('#databuku6').val(arrStr6);
			// $('#databuku7').val(arrStr7);
			// $('#databuku8').val(arrStr8);
			// $('#ketbk').val(ket);
			$('#totjualbuku').html("Rp. " + formatMoney(jual));
			$('#satuanbukuku').html("Rp. " + formatMoney(satuan) + "/pcs");	
			
			$('#tablebuku').show(); 
}

		function cariukuranbu(){
			var ukuran = document.getElementById("ukuranbu").value;
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				myArr = JSON.parse(xmlhttp.responseText);
				document.getElementById("lbrcetakbu").value = myArr[0];
				document.getElementById("lbrcoverbu").value = myArr[0];
				document.getElementById("tgcetakbu").value = myArr[1];
				document.getElementById("tgcoverbu").value = myArr[1];
			//alert(myArr[0].toString());
			}
			}
			  xmlhttp.open("GET","/fungsi/cariukuran.php?ukuran="+ukuran,true);
			  xmlhttp.send();	
		}
		
	
		function cekukuranbu(){
			var lbrcetak = document.getElementById("lbrcetakbu").value;
			var tgcetak = document.getElementById("tgcetakbu").value;
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				myArr = JSON.parse(xmlhttp.responseText);
				if (myArr[0].toString()=='N'){
				alert('Ukuran Kebesaran');
				document.getElementById("tgcetakbu").value = 0;
				document.getElementById("lbrcetakbu").value = 0;
				}
			}
			}
			  xmlhttp.open("GET","/fungsi/cekukuran.php?lbrcetak="+lbrcetak+"&tgcetak="+tgcetak,true);
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