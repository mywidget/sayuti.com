/**
 * Site : http:www.smarttutorials.net
 * @author muni
 */

function select_all() {
	$('input[class=case]:checkbox').each(function(){ 
		if($('input[class=check_all]:checkbox:checked').length == 0){ 
			$(this).prop("checked", false); 
		} else {
			$(this).prop("checked", true); 
		} 
	});
}

function check(){
	obj=$('#tableinvoice tr').find('span');
	$.each( obj, function( key, value ) {
		id=value.id;
		$('#'+id).html(key+1);
	});
}	
 
 
 $(".delete").on('click', function() {
b=document.getElementById("baris").value;
 
//alert(document.getElementById("case5").checked);

	for (var aa = 0; aa < b; aa++) {

		if ($("#tableinvoice > tbody").children().length == 2){
			alert('Sisain satu sih jangan di hapus semua');
		return;
		} 
		
		if ($('#case'+aa).length){ 
		if(document.getElementById("case" + aa.toString()).checked == true){
			//alert(aa);
			kodeinvo = document.getElementById("id_rincianinvoice_" + aa.toString()).value;
			delete_invoice_detail(kodeinvo);
			jQuery('#rowCount'+aa.toString()).remove();
		} }	}
		
	doMath();
});
	
	
	function delete_invoice_detail(c){
	//Simpan Data Invoicedetail
	var str = c;
	//alert(str);
		$.ajax({
			type: "POST",
			url: "panel/invoice/delete_invoice_detail.php",//you can get this values from php using $_POST['n1'], $_POST['n2'] and $_POST['add']
			data: { id_rincianinvoice: str}
		})	
	}
var rowCount = 0;
$(".addmore").on('click',function(){
			
	
	i = $("#tableinvoice > tbody").children().length - 1;
	count=$('#tableinvoice tr').length;

    var data="<tr id=rowCount"+i+"><input type='hidden' id='id_rincianinvoice_"+i+"' value=''/><td><input type='checkbox' class='case' id='case"+i+"' onclick='pilih("+i+")'/></td>";
    data +="<td><input class='form-control' type='text' id='kodeproduk_"+i+"' onchange='sav();doMath()'/></td> <td><input class='form-control text-center' type='text' id='jumlah_"+i+"' value='0'  onchange='sav();doMath()' onkeyup='formatNumber(this)' /></td><td><input class='form-control text-right' type='text' id='hargajual_"+i+"'  onchange='sav();doMath()' onkeyup='formatNumber(this)'/></td><td><input class='form-control text-right' type='text' id='diskon_"+i+"' value='0' onchange='sav();doMath()' onkeyup='formatNumber(this)'/></td><td><input class='form-control text-right' type='text' id='total_"+i+"'/></td></tr>";
	$('#tableinvoice').append(data);
	row = i ;
	

	$('#kodeproduk_'+i).autocomplete({
  	source: function( request, response ) {
  		$.ajax({
  			url : 'ajax.php',
  			dataType: "json",
  			method: 'post',
			data: {
			   name_startsWith: request.term,
			   type: 'produk_table',
			   row_num : row
			},
			 success: function( data ) {
				 response( $.map( data, function( item ) {
				 	var code = item.split("|");
					return {
						label: code[0],
						value: code[0],
						data : item
					}
				}));
			}
  		});
  	},
  	autoFocus: true,	      	
  	minLength: 0,
  	select: function( event, ui ) {
		var names = ui.item.data.split("|");
		id_arr = $(this).attr('id');
  		id = id_arr.split("_");					
		$('#hargajual_'+id[1]).val(names[1]);
		$('#diskon_'+id[1]).val(names[2]);
	}		      	
  });
  
	document.getElementById("baris").value = parseInt(document.getElementById("baris").value) + 1 ;
	
	//simpan dan cari id_rincianinvoice
	var str = document.getElementById("id_invoice").value;
	var myArr;
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			myArr = JSON.parse(xmlhttp.responseText);
			document.getElementById("id_rincianinvoice_"+i.toString()).value = parseInt(myArr[0].toString());
		}

		}
		  xmlhttp.open("GET","panel/invoice/save_invoice_detail.php?id_invoice="+str,true);
		  xmlhttp.send();
		  
	
	//i++;
	
});
				
var b = document.getElementById("baris").value;	
for (var a = 0; a < b; a++) {

$('#kodeproduk_'+a).autocomplete({
	source: function( request, response ) {
		$.ajax({
			url : 'ajax.php',
			dataType: "json",
			method: 'post',
			data: {
			   name_startsWith: request.term,
			   type: 'produk_table',
			   row_num : 1
			},
			 success: function( data ) {
				 response( $.map( data, function( item ) {
				 	var code = item.split("|");
					return {
						label: code[0],
						value: code[0],
						data : item
					}
				}));
			}
		});
	},
	autoFocus: true,	      	
	minLength: 0,
	select: function( event, ui ) {
		var names = ui.item.data.split("|");
		id_arr = $(this).attr('id');
  		id = id_arr.split("_");					
		$('#hargajual_'+id[1]).val(names[1]);
		$('#diskon_'+id[1]).val(names[2]);	
	}	
	
});
}	

		      

 