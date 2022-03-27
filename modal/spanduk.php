<?php
if (($referer==$link) ) {
$warnabar = "#55aa5f";
?>
<style>

._flash {background-color: #fc1144 !important;}
</style>
<script>
$('.modal').on('hidden.bs.modal', function(){
	$(this).removeData('bs.modal');
});
function flashIt(element, times, klass, delay) {
    for (var i = 0; i < times; i++) {
        setTimeout(function () {
            $(element).toggleClass(klass);
        }, delay + (300 * i));
    };
};
</script>

<style>
.modal-dialog{
    width: 60%; /* respsonsive width */
    
}
.form-group {
    margin-bottom: 2px;
}

.input-group-addon {
    font-size: 12px;
}

col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7,  .col-md-8, .col-md-9,.col-md-10,.col-md-11, .col-md-12 {
    padding: 2px;
}
.morecontent span {
    display: none;
}
.morelink {
    display: block;
}
a {color:#fff}
</style>

<div class="modal-header p-t-5 p-b-5" style="background-color:<?=$warnabar;?>;color:#fff;">
        <h5 class="modal-title text-white" id="exampleModalLabel">Spanduk Flexi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
</div>
<div class="modal-body">
  <div class="row p-0">
    <div class="col-md-12 p-0">
                                    
                                    <div class="col-md-12">
									<div class="alert2" style="padding:5px; margin-bottom:0px;color:#fff;font-weight:bold"></div>
									<div class="form-group">
											<div class="input-group">
											  <span class="input-group-addon">Jumlah Cetak</span>
											  <input type="text" class="form-control" aria-label="" id="jumlah" value="1">
											  <span class="input-group-addon">lbr</span>
											</div>
                                        </div>
									<div class="form-group">
										<div class="input-group">
										<span class="input-group-addon">Bahan</span>
										<?php $sql_bhn = $db->query("SELECT * FROM kategori_bahan where modul like '%flexi%' AND pub='Y' ORDER BY id_kategori"); ?>
										<select id="bahanflexi"  class="chosen-select form-control" data-style="btn-info" data-size="auto" data-placeholder='Pilih Bahan' required="required">
											 <?php while($row=$sql_bhn->fetch_array()){ ?>
												<option value="<?=$row['modul'] . "," . $row['hrg_a3+'];?>"><?=$row['nama_kategori'];?></option>
											<?php } ?>
										</select>	
										</div>
									</div>
										<input type="hidden" class="form-control" aria-label="" id="hargaflexi" value="20000" readonly="readonly">
									
										<div class="form-group">
											<div class="input-group">
											  <span class="input-group-addon">Lebar</span>
											  <input type="text" class="form-control" aria-label="" id="lbrbh" >
											  <span class="input-group-addon">Tinggi / Panjang</span>
											  <input type="text" class="form-control" aria-label="" id="tgbh"  >
											  <span class="input-group-addon">meter</span>
											</div>
                                        </div>
										

                                    		
                                        <div class="form-group">
											<button  type="submit" class="btn btn-primary" onclick="hitflexi()">Hitung</button>
                                        </div>                                        
                                    </div>


									<div class="col-md-12">
									<h4 style="color: #2E9598;margin-bottom:0px;margin-left:10px" id="hasilhitung"></h4>
									</div>		
					</div>		

</div>
</div>
<script>
$(document).ready(function() {
    // Configure/customize these variables.
    var showChar = 200;  // How many characters are shown by default
    var ellipsestext = "...";
    var moretext = "Show more >";
    var lesstext = "Show less";
    

    $('.more').each(function() {
        var content = $(this).html();
 
        if(content.length > showChar) {
 
            var c = content.substr(0, showChar);
            var h = content.substr(showChar, content.length - showChar);
 
            var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
 
            $(this).html(html);
        }
 
    });
 
    $(".morelink").click(function(){
        if($(this).hasClass("less")) {
            $(this).removeClass("less");
            $(this).html(moretext);
        } else {
            $(this).addClass("less");
            $(this).html(lesstext);
        }
        $(this).parent().prev().toggle();
        $(this).prev().toggle();
        return false;
    });
});
</script>
 <script type="text/javascript">
$(document).ready(function(){
	$('#myCanvas').hide();
	$('.muat').hide();
	$('.alert2').hide();
	
});


	$('#bahanflexi').on('change', function() {
		var pecah =  $('#bahanflexi').val().split(",");
		$('#hargaflexi').val(pecah[1]);
	});



function hitflexi(){
		
		var jml = document.getElementById("jumlah").value;
		var l = document.getElementById("lbrbh").value;
		var p = document.getElementById("tgbh").value;	
		var h =  document.getElementById("hargaflexi").value;
			l = l.replace(',', '.');
			p = p.replace(',', '.');
			
			if(l == "" || p == "") {
				//alert("kosong");
				
				$('.alert2').html('Isi dulu datanya!');
				flashIt('.alert2', 10, '_flash', 500)
				$('.alert2').show('slow').delay(2000).hide('slow');
				// return;
			}

		var hasil = (p) * roundToHalf(l);
				
		if(hasil<1){
			var totalharga  = 1 * (h) * jml;
		}else{
			var totalharga  = ((p) * (roundToHalf(l) * (h))) * jml;
		}

		$('#hasilhitung').html("Harga Rp. " + h + " x " + roundToHalf(l) + "x" + (p) + " x " + jml + " = Rp. " + formatMoney(totalharga));	
						
		
}


		
function roundToHalf(value) {
   var converted = parseFloat(value); // Make sure we have a number
   var decimal = (converted - parseInt(converted, 10));
   decimal = Math.round(decimal * 10);
   if(converted > 2 && converted < 3){
      return (parseInt(converted, 10)+1);
   }
   if(converted > 0 && converted < 1){
      return (1);
   }
   if (decimal == 5) { return (parseInt(converted, 10)+0.5); }
   if ( (decimal < 1) || (decimal > 5) ) {
      return Math.round(converted);
   } else {
      return (parseInt(converted, 10)+0.5);
   }
} 	

</script>  
<?php
	}//end token
	else{
echo json_encode(array(404 => "error"));
	}
?>