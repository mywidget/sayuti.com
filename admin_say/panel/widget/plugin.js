$(".timeagent").timepicker({
	showInputs: false,
	showSeconds: false,
	showMeridian: false,
	defaultTime: false
});
var fields = 'field';
function bukaFormn(field,links,id) {
    window.KCFinder = {
        callBack: function(url) {
            window.KCFinder = null;
            field.value = links+url;
            var img = new Image();
            img.src = url;
            img.onload = function() {
				$('#imgnew'+id).attr('src', links+url);
				document.getElementById("imgInp"+id).value=links+url;
            }
        }
    };
    window.open('../kcfinder/browse.php?type=images&dir=images/agen/', 'kcfinder_textbox',
        'status=0, toolbar=0, location=0, menubar=0, directories=0, ' +
        'resizable=1, scrollbars=0, width=800, height=600'
    );
}
function LinkImgn(field,links) {
    window.KCFinder = {
        callBack: function(url) {
            field.value = links+url;
            window.KCFinder = null;
        }
    };
    window.open('../kcfinder/browse.php?type=images&dir=images/agen/', 'kcfinder_textbox',
        'status=0, toolbar=0, location=0, menubar=0, directories=0, ' +
        'resizable=1, scrollbars=0, width=800, height=600'
    );
}
$(".addmore").on('click',function(){
	var dash = '"';
	var hari = ["Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu"];
	i=$('#table tr.rowCountCollapse').length;
	a=$('#table tr.rowCountCollapse').length+1;
		var cols= "<tbody id=rowCount"+i+" class='utama'>";
		cols += '<tr class="rowCountCollapse">';
		cols += '<td style="width:1% !important" align="center"><span data-toggle="collapse" class="chevron_toggleable_'+a+' glyphicon glyphicon-chevron-down" data-target="#group-of-rows-'+a+'" ></span><span class="label label-primary pull-right">'+a+'</span></td>';
        cols += '<td style="width:20% !important"><div class="acf-label"><label for="acf-field_name'+i+'_'+a+'">Nama agen</label><p class="description">Click tanda [+] utk expand/collapse</p></div></td>';
        cols += '<td><input id="acf-field_name'+i+'_'+a+'" class="form-control" name="nama_agent[]" placeholder="Nama agen" type="text" value="Nama agen"></td>';
        cols += '<td style="width:1% !important"><input type="checkbox" class="case" id="case'+i+'"/></td>';
        cols += '</tr>';
		cols += '</tbody>';
		cols += '<tbody id="group-of-rows-'+a+'" class="collapse">';
		cols += '<tr>';
		cols += '<td style="width:1% !important">&nbsp;</td>';
		cols += '<td style="width:20% !important"><div class="acf-label"><label for="acf-field_num'+i+'_'+a+'">Whatsapp Number</label><p class="description">Mulai dengan kode negara sebelum nomor telepon</p></div></td>';
		cols += '<td><div class="acf-input"><div class="acf-input-wrap"><input id="acf-field_num'+i+'_'+a+'" class="form-control" name="number[]" placeholder="62" type="text" value="62"></div></div></td>';
		cols += '</tr>';
		cols += '<tr>';
		cols += '<td>&nbsp;</td>';
		cols += '<td><div class="acf-label"><label for="acf-field_photo">Photo</label><p class="description">Upload/paste link yg tersedia</p></div></td>';
		cols += "<td><img id='imgnew"+i+"' src='icon/100x100.png'  width='100' alt='Gambar agen' /><div class='input-group input-group-sm'><input type='text' readonly='readonly' onclick='bukaFormn("+dash+""+fields+""+dash+","+dash+""+link+""+dash+","+i+")'  name='photo[]' id='imgInp"+i+"' class='form-control' style='cursor:pointer' /><span class='input-group-btn'><button type='button' class='btn btn-danger'>Upload photo</button></span></div></td>";
		cols += '</tr>';
		cols += '<tr>';
		cols += '<td>&nbsp;</td>';
		cols += '<td><div class="acf-label"><label for="acf-field_desc'+i+'_'+a+'">Deskripsi</label><p class="description">Deskripsi singkat pengguna</p></div></td>';
		cols += '<td><div class="acf-input"><div class="acf-input-wrap"><input id="acf-field_desc'+i+'_'+a+'" class="form-control" name="desc[]" placeholder="Deskripsi singkat pengguna" type="text" value=""></div></div></td>';
		cols += '</tr>';
		cols += '<tr>';
		cols += '<td>&nbsp;</td>';
		cols += '<td><div class="acf-label"><label for="acf-field_role'+i+'_'+a+'">Wewenang</label></div></td>';
		cols += '<td><div class="acf-input"><div class="acf-input-wrap"><input id="acf-field_role'+i+'_'+a+'" class="form-control" name="role[]" placeholder="Customer Support" type="text" value=""></div></div></td>';
		cols += '</tr>';
		cols += '<tr>';
		cols += '<td>&nbsp;</td>';
		cols += '<td>';
		cols += '<div class="acf-label"><label for="acf-field_message'+i+'_'+a+'"> Pesan Pengantar </label></div></td>';
		cols += '<td>';
		cols += '<div class="acf-input"><div class="acf-input-wrap"><input id="acf-field_message'+i+'_'+a+'" class="form-control" name="message[]" placeholder="Ada yang bisa dibantu?" type="text" value=""></div></div></td>';
		cols += '</tr>';
		cols += '<tr>';
		cols += '<td>&nbsp;</td>';
		cols += '<td>';
		cols += '<div class="acf-label"><label for="acf-field_link'+i+'_'+a+'">Link Rekomendasi</label><p class="description">Tampilkan tautan dengan gambar dan teks setelah pesan intro.</p></div></td>';
		cols += '<td>';
		cols += '<div class="acf-input"><table class="acf-table" style="width:100%">';
		cols += '<thead>';
		cols += '<tr style="width:100%">';
		cols += '<th style="width:33% !important;margin-right:10px" class="acf-th">';
		cols += '<label for="acf-field_link_url'+i+'_'+a+'">Link URL</label>';
		cols += '<p class="description">Biarkan kosong untuk menonaktifkan</p>';
		cols += '</th>';
		cols += '<th style="width:33% !important" class="acf-th">';
		cols += '<label for="acf-field_link_image'+i+'_'+a+'">Link Image</label>';
		cols += '<p class="description">Terlihat lebih baik dengan rasio aspek gambar 2: 1</p>';
		cols += '</th>';
		cols += '<th style="width:33% !important" class="acf-th">';
		cols += '<label for="acf-field_Text'+i+'_'+a+'">Link Text</label>';
		cols += '<p class="description">Deskripsi tautan singkat</p>';
		cols += '</th>';
		cols += '</tr>';
		cols += '</thead>';
		cols += '<tbody>';
		cols += '<tr class="acf-row">';
		cols += '<td  style="width:30% !important;padding:0 10px 0 0" class="acf-fieldtext">';
		cols += '<div class="acf-input">';
		cols += '<div class="acf-input-wrap">';
		cols += '<input id="field_link_url'+i+'_'+a+'" class="form-control" name="link_url[]" placeholder="http://" type="text" value=""></div></div></td>';
		cols += '<td class="acf-fieldtext">';
		cols += '<div class="input-group input-group-sm">';
		cols += "<input id='acf-field_link_image"+i+"_"+a+"'  type='text' readonly='readonly' onclick='LinkImgn(this,"+dash+""+link+""+dash+")' name='link_image[]' class='form-control' style='cursor:pointer'>";
		cols += '<span class="input-group-btn"><button type="button" class="btn btn-danger">Link Image</button></span></div></td>';
		cols += '<td class="acf-fieldtext"><div class="acf-input"><div class="acf-input-wrap">';
		cols += '<input id="acf-field_Text'+i+'_'+a+'"  class="form-control" maxlength="40" name="link_text[]" type="text">';
		cols += '</div></div></td>';
		cols += '</tr>';
		cols += '</tbody>';
		cols += '</table>';
		cols += '</div>';
		cols += '</td>';  
		cols += '</tr>';
		cols += '<tr>';
		cols += '<td>&nbsp;</td>';
		cols += '<td>';
		cols += '<div class="acf-label">';
		cols += '<label>Ketersediaan pengguna</label>';
		cols += '</div>';
		cols += '</td>';
		cols += '<td>';
		cols += '<div class="acf-input">';
		cols += '<p><strong><span class="dashicons dashicons-lock"></span> PREMIUM</strong> &#8211; Set ketersediaan pengguna berdasarkan hari tertentu &#038; time.</p>';
		cols += '</div>';
		cols += '</td>';  
		cols += '</tr>';

//
for(n=0; n<=6; n++){
cols += '<tr>';
cols += '<td>&nbsp;</td>';
cols += '<td><div class="acf-label"><label>'+hari[n]+'</label></div></td>';
cols += '<td><div class="acf-input"><table class="acf-table"><thead>';
cols += '<tr>';
cols += '<th class="acf-th" style="width: 30%;"><label for="eagent_'+hari[n]+'_'+[n]+'_'+a+'">Online</label></th>';
cols += '<th class="acf-th" style="width: 30%;"><label for="acf-field_sunst'+[n]+'_'+a+'">Start Time</label></th>';
cols += '<th class="acf-th" style="width: 30%;"><label for="acf-field_sunet'+[n]+'_'+a+'">End Time</label></th>';
cols += '</tr>';
cols += '</thead>';
cols += '<tbody>';
cols += '<tr class="acf-row">';
cols += '<td class="acf-fieldcheckbox" >';
cols += '<div class="acf-input">';
cols += '<ul class="acf-checkbox-list acf-bl">';
cols += '<li><label><input id="eagent_'+hari[n]+'_'+[n]+'_'+a+'" name="eagent'+[n]+'[]" type="hidden" value=""><input id="today_'+hari[n]+'_'+[n]+'_'+a+'" type="checkbox">Aktifkan Agen</label></li>';
cols += '</ul>';
cols += '</div>';
cols += '</td>';
cols += '<td class="acf-fieldtime-picker" >';
cols += '<div class="acf-input bootstrap-timepicker">';
cols += '<div class="acf-time-picker acf-input-wrap">';
cols += '<input id="acf-field_sunst'+[n]+'_'+a+'" class="form-control timeagenbaru"  name="day'+[n]+'s[]" type="text" value="" >';
cols += '</div>';
cols += '</div>';
cols += '</td>';
cols += '<td class="acf-fieldtime-picker">';
cols += '<div class="acf-input bootstrap-timepicker"><div class="acf-time-picker acf-input-wrap">';
cols += '<input id="acf-field_sunet'+[n]+'_'+a+'" class="form-control timeagenbaru" name="day'+[n]+'e[]" type="text">';
cols += '</div></div></td></tr>';
cols += '</tbody></table></div></td>';
cols += '</tr>';
cols += '<tr>';
}
//
cols += '</tbody>';
$('#table').append(cols);

$('.chevron_toggleable_'+a).on('click', function() {
    $(this).toggleClass('glyphicon-chevron-down glyphicon-chevron-up');
});
//minggu
$("#today_Minggu_0_"+a).change(function(){
 var dateStr; if (this.checked) {dateStr = 1;}else{dateStr = 0;}
 $("#eagent_Minggu_0_"+a).val(dateStr);
});
//senin
$("#today_Senin_1_"+a).change(function(){
 var dateStr; if (this.checked) {dateStr = 1;}else{dateStr = 0;}
 $("#eagent_Senin_1_"+a).val(dateStr);
});
//selasa
$("#today_Selasa_2_"+a).change(function(){
 var dateStr; if (this.checked) {dateStr = 1;}else{dateStr = 0;}
 $("#eagent_Selasa_2_"+a).val(dateStr);
});
//rabu
$("#today_Rabu_3_"+a).change(function(){
 var dateStr; if (this.checked) {dateStr = 1;}else{dateStr = 0;}
 $("#eagent_Rabu_3_"+a).val(dateStr);
});
//kamis
$("#today_Kamis_4_"+a).change(function(){
 var dateStr; if (this.checked) {dateStr = 1;}else{dateStr = 0;}
 $("#eagent_Kamis_4_"+a).val(dateStr);
});
//jumat
$("#today_Jumat_5_"+a).change(function(){
 var dateStr; if (this.checked) {dateStr = 1;}else{dateStr = 0;}
 $("#eagent_Jumat_5_"+a).val(dateStr);
});
//sabtu
$("#today_Sabtu_6_"+a).change(function(){
 var dateStr; if (this.checked) {dateStr = 1;}else{dateStr = "0";}
 $("#eagent_Sabtu_6_"+a).val(dateStr);
});

$(".timeagenbaru").timepicker({
	showInputs: false,
	showSeconds: false,
	showMeridian: false,
	defaultTime: false
});
$('#table tr.rowCountCollapse input[type="checkbox"]').click(function(){
	var rowCount = $('#table tr.rowCountCollapse').length-1;
    var countcheck = $('#table tr.rowCountCollapse input[type="checkbox"]:checked').length;
		// alert(countcheck);

    if(countcheck ==0) {
		$(".delete").attr("disabled", true);
		$(".addmore").attr("disabled", false);
    }
    if(countcheck > 0) {
		$(".delete").attr("disabled", false);
		$(".addmore").attr("disabled", true);
    }
	if(countcheck >= rowCount) {
        $("table input:checkbox:not(:checked)").attr("disabled", true);
    }else{
        $("#table tr.rowCountCollapse input:checkbox").attr("disabled", false);
	}
});
$(".delete").on('click', function() {
b = $("#table > tbody.utama").children().length;
	for (var aa = 0; aa < b; aa++) {
		if ($('#case'+aa).length){ 
		if(document.getElementById("case" + aa.toString()).checked == true){
			jQuery('#rowCount'+aa.toString()).remove();
			jQuery('#group-of-rows-'+aa.toString()).remove();
		} }	}
$(".addmore").attr("disabled", false);
$(".delete").attr("disabled", true);

});
}); //--end function--------------------------
$('#table tr.rowCountCollapse input[type="checkbox"]').click(function(){
	var rowCount = $('#table tr.rowCountCollapse').length-1;
    var countcheck = $('#table tr.rowCountCollapse input[type="checkbox"]:checked').length;
    if(countcheck ==0) {
		$(".delete").attr("disabled", true);
		$(".addmore").attr("disabled", false);
    }
    if(countcheck > 0) {
		$(".delete").attr("disabled", false);
		$(".addmore").attr("disabled", true);
    }
	if(countcheck >= rowCount) {
        $("table input:checkbox:not(:checked)").attr("disabled", true);
    }else{
        $("#table tr.rowCountCollapse input:checkbox").attr("disabled", false);
	}
});
$(".delete").on('click', function() {

b = $("#table > tbody.utama").children().length;
	for (var aa = 0; aa < b; aa++) {
		
		if ($('#case'+aa).length){ 
		if(document.getElementById("case" + aa.toString()).checked == true){
			jQuery('#rowCount'+aa.toString()).remove();
			jQuery('#group-of-rows-'+aa.toString()).remove();
		} }	}
        $.ajax({
            url: "panel/widget/save.php",
            type: "POST",
            data: $("#simpanForm").serialize(),
			beforeSend: function(){	 
				$("#load").show();
			},
            success: function(data, textStatus, jqXHR) {
				myArr = JSON.parse(data);
				if(myArr.ok=='update'){
					notif('Pengguna sudah di hapus','success');
					$(".addmore").attr("disabled", false);
					$(".delete").attr("disabled", true);
				}else{
					notif('Data GAGAL di simpan','danger');
				}
				$("#load").hide();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                notif('Data GAGAL di simpan','danger');
            }
        });
});



$(document).ready(function() {
$(".select2").select2({
	templateResult: function (idioma) {
  	var $span = $("<span><img src='icon/icon-" + idioma.id + ".png' height='20' class='img-icon'/> " + idioma.text + "</span>");
  	return $span;
  },
	templateSelection: function (idioma) {
  	var $span = $("<span><img src='icon/icon-" + idioma.id + ".png' height='20' class='img-icon'/> " + idioma.text + "</span>");
  	return $span;
  }
});
$("#kolapse").hide();
		// Javascript to enable link to tab
		var hash = document.location.hash;
		var prefix = "tab_";
		if (hash) {
			$('.nav-tabs a[href='+hash.replace(prefix,"")+']').tab('show');
		} 
		if (hash=='#tab_tab_3') {
			$("#kolapse").show();
		}

		// Change hash for page-reload
		$('.nav-tabs a').on('shown.bs.tab', function (e) {
			window.location.hash = e.target.hash.replace("#", "#" + prefix);
			var target = e.target.hash.replace("#", "#" + prefix);
			if(target=='#tab_tab_3'){
			$("#kolapse").show();
			}else{
			$("#kolapse").hide();
			}
		});
				
	});
$(document).ready(function () {
var mode = $("#w_replay").val();
if(mode==''){
$(".replay").hide();
}
var myRadio = $("input[name=aowon]");
var checkedValue = myRadio.filter(":checked").val();
if(checkedValue==1){
  $(".delay").hide('slow');
  $(".gulir").hide('slow');
}else if(checkedValue==2){
  $(".delay").show('slow');
  $(".gulir").hide('slow');
}else{
  $(".delay").hide('slow');
  $(".gulir").show('slow');
}
	$("#aowon1").on('ifChecked', function(event) {
	$(".delay").hide('slow');
	$(".gulir").hide('slow');
	});
	$("#aowon2").on('ifChecked', function(event) {
	$(".delay").show('slow');
	$(".gulir").hide('slow');
	});
	$("#aowon3").on('ifChecked', function(event) {
	$(".delay").hide('slow');
	$(".gulir").show('slow');
	});

	$("#w_mode1").on('ifChecked', function(event) {
	$(".replay").hide('slow');
	});
	$("#w_mode2").on('ifChecked', function(event) {
	$(".replay").show('slow');
	});
if(document.getElementById('w_style3').checked) {
    $(".style_3").show('slow');
} else {
   $(".style_3").hide('slow');
}

$('#w_style1,#w_style2').click(function() {
   $(".style_3").hide('slow');
});
$('#w_style3').click(function() {
   $(".style_3").show('slow');
});
	
    $('input[type="checkbox"].minimal,input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
	  
    });
	
    //Colorpicker
    $('.my-colorpicker1').colorpicker();
});
function ChangeUrl(title, url) {
    if (typeof (history.pushState) != "undefined") {
        var obj = { Title: title, Url: url };
        history.pushState(obj, obj.Title, obj.Url);
    } else {
        alert("Browser does not support HTML5.");
    }
}

$(document).ready(function() {
	$("#ngumpet").hide();
	$("#load").hide();
    $("#simpanForm").on("submit", function(e) {
        e.preventDefault();
		var site_url = $("#site_url").val();
		if(site_url != ''){
        $.ajax({
            url: "panel/widget/save.php",
            type: "POST",
            data: $("#simpanForm").serialize(),
			beforeSend: function(){	 
				$("#load").show();
			},
            success: function(data, textStatus, jqXHR) {
				myArr = JSON.parse(data);
				if(myArr.ok=='update'){
					notif(myArr.msg,'info');
					$(".addmore").attr("disabled", false);
					$(".delete").attr("disabled", true);
				}else if(myArr.ok=='save'){
					notif(myArr.msg,'info');
					$(".addmore").attr("disabled", false);
					$(".delete").attr("disabled", true);
					$("#ngumpet").show();
					$(".urlnya").html(myArr.url);
					$("#tambah").val(myArr.id);
					ChangeUrl('Widget Wa edit', 'read.php?panel=widget&act=edit&id='+myArr.id);
				}else{
					notif('Data GAGAL di simpan','danger');
				}
				$("#load").hide();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                notif('Data GAGAL di simpan','danger');
            }
        });
		}else{
			notif('Alamat URL harus di isi','danger');
		}
    })
});
var mybutton = document.getElementById("myBtns");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};
function scrollFunction() {
// var tx = document.body.clientHeight * 50 / 100;
  if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}
function copy() {
  /* Get the text field */
  var copyText = document.getElementById("salinKode");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /*For mobile devices*/

  /* Copy the text inside the text field */
  document.execCommand("copy");
  notif("Kode semat telah di salin:","success");
} 

var click = false;
  function callFunction(el) {
    if (!click) {
     $('#kolapse').html('<i class="fa fa-minus"></i> Collapse');
     $('#kolapse').addClass('btn-info');
	 $('#singlek').addClass('not-active');
	 
      click = true;
		// $('.collapse').collapse('toggle');
    } else {
     $('#kolapse').removeClass('btn-info');
     $('#singlek').removeClass('not-active');
     $('#kolapse').addClass('btn-success');
     $('#kolapse').html('<i class="fa fa-plus"></i> Expand');
      click = false;
	 // $('.collapse').collapse('toggle');
    }
  }
  
$('#kolapse').click(function(){
  $('.collapse').toggle('1000');
  $('.checkall').toggleClass('glyphicon-chevron-down glyphicon-chevron-up');
});
var toggle = $("#table > tbody.utama").children().length;
for (var i = 0; i < toggle; i++) {
$('.chevron_toggleable_'+i).on('click', function() {
    $(this).toggleClass('glyphicon-chevron-down glyphicon-chevron-up');
});
}


  // var klick = false;
  function callFunc(i) {
 if($('#checklist'+i).not(':checked').length){
	   $(".chk"+i).prop("checked", true);
    }else{
	 $('.chk'+i).attr('checked', false);
    } 
var rowCount = $('#table tr.rowCountCollapse input[type="checkbox"]:checked').length;
if(rowCount ==0) {
	$("#kolapse").attr("disabled", false);
}else{
	$("#kolapse").attr("disabled", true);
}
  }
// $('#table tr.rowCountCollapse input[type="checkbox"]').click(function(){