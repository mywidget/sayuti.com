$(document).ready(function() {
  $('.hide-txt').hide();
  $(".tax-wrap input").focus(function() {
      $('.hide-txt').show('slow');       
      //return false;
    });
    
 $('.tax-wrap input').blur(function(){
    if(!$(this).val()) {
       $('.hide-txt').hide('slow');
    }else{
       $('.hide-txt').show('slow');
	}
});

  
  
});//end

var click = false;
  function callFunction(el) {
    if (!click) {
     $('#kolapse').addClass('btn-info');
     $('.dd').nestable('expandAll');
     // $('#kolapse').addClass('fa fa-minus');
     $('#kolapse').html('<i class="fa fa-minus"></i> Collapse');
     // console.log('expandAll');
      click = true;
    } else {
      $('.dd').nestable('collapseAll');
     $('#kolapse').removeClass('btn-info');
     $('#kolapse').addClass('btn-success');
     $('#kolapse').html('<i class="fa fa-plus"></i> Expand');
      click = false;
      console.log('collapseAll');
    }
  }
$(document).ready(function(){

    // $('#parentc').keyup(function(){
	// $('.eclasse').show('slow');
    // })
	$('#kolapse').html('<i class="fa fa-plus"></i> Expand');
    var updateOutput = function(e){
        var list   = e.length ? e : $(e.target),
            output = list.data('output');
        if (window.JSON) {
            output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
        } else {
            output.val('JSON browser support required for this demo.');
        }
    };

    // activate Nestable for list 1
    $('#nestable').nestable({
        group: 1
    }).on('change', updateOutput);
    // output initial serialised data
    updateOutput($('#nestable').data('output', $('#nestable-output')));
    // $('#nestable-menu').on('click', function(e)
    // {
        // var target = $(e.target),
            // action = target.data('action');
        // if (action === 'expand-all') {
            // $('.dd').nestable('expandAll');
        // }
        // if (action === 'collapse-all') {
            // $('.dd').nestable('collapseAll');
        // }
    // });
   $("#nestable").nestable({
      maxDepth: 10,
      collapsedClass:'dd-collapsed',
   }).nestable('collapseAll');//Add this line

});
  $(document).ready(function(){
    $("#load").hide();
	$('#save').prop('disabled',true);
	 $("#submit-form").validate({
      rules:
	  {
			// label: {
			// required: false,
			// },
			link: {
            required: true,
            },
	   },
	   submitHandler: CekForm	
       });  
/* login submit */

function CekForm(){
var label = $("#label").val();
var aktif = $("#aktif").val();
var parentc = $("#parentc").val();
var eclass = $("#eclass").val();
if (label == ""){
notif('Nama menu harus diisi','warning');
$("#label").focus();
}else if (aktif == ""){
notif('Aktif harus dipilih','warning');
$("#aktif").focus();
}else{
if (parentc == ""){
SubmitForm();
return true;
}else{
if (label == ""){
notif('CLASS ICON harus di isi','warning');
$("#eclass").focus();
return false; 
}else{
SubmitForm();
return true;
	
}
}
}
}
	   function SubmitForm()
	   {
			var dataString = {
              type : $("#type").val(),
              label : $("#label").val(),
              link : $("#link").val(),
              eclass : $("#eclass").val(),
              parentc : $("#parentc").val(),
              aktif : $("#aktif").val(),
              submenu : $("#submenu").val(),
              id : $("#id").val()
            };
			$.ajax({
			type : 'GET',
			url: "panel/menuadmin/save_menu.php",
			data : dataString,
			beforeSend: function(){	 
				$("#load").show();
				$("#submits").html('Proses...');
			},
            dataType: "json",
            cache : false,
            success: function(data){
              if(data.type == 'add'){
				  if(data.ok == 'ok'){
                 $("#menu-id").append(data.menu);
				 $("#submits").html('Submit');
				 notif('Data di simpan','info');
				 // clearForm();
				  }else{
				 notif('Data GAGAL di simpan','danger');
				 $("#submits").html('Submit');
				  }
              }else if(data.type == 'edit'){
				 $("#submits").html('Submit');
                 $('#label_show'+data.id).html(data.label);
                 $('#link_show'+data.id).html(data.link);
                 $('#eclass_show'+data.id).html(data.eclass);
				 notif('Data di Updated','success');
				 $("#showicon").removeClass(data.eclass);
				 $("#showicon").addClass('fa-bars');
				 // clearForm();
              }
              $('#label').val('');
              $('#link').val('');
              $('#eclass').val('');
              $('#parentc').val('');
              $('#aktif').val('');
              $('#submenu').val('N');
              $('#id').val('');
              $("#load").hide();
            } ,error: function(xhr, status, error) {
              alert(error);
            },
			});
				return false;
		}
    $('.dd').on('change', function() {
	$('#save').prop('disabled', this.value == "" ? true : false);  
	});
    $("#save").click(function(){
         $("#load").show();
          // var dataString = {
              // data : $("#nestable-output").val(),
            // };
			var dataString = {
              type : $("#type").val(),
             data : $("#nestable-output").val()
            };
        $.ajax({
            type: "GET",
            url: "panel/menuadmin/crud.php",
            data: dataString,
            cache : false,
            success: function(data){
              $("#load").hide();
			  $('#save').prop('disabled',true);
			  $("#showicon").removeClass(eclass);
			  $("#showicon").addClass('fa-bars');
			  $('.hide-txt').hide('slow');
              notif('Data di update','success');
            } ,error: function(xhr, status, error) {
              alert(error);
            },
        });
    });

 
    // $(document).on("click",".del-button",function() {
        // var x = confirm('Delete this menu?');
        // var id = $(this).attr('id');
        // if(x){
            // $("#load").show();
             // $.ajax({
                // type: "GET",
                // url: "panel/menuadmin/crud.php",
                // data: {type:"hapus",id:id},
                // cache : false,
				// dataType: 'json',
                // success: function(data){
				// if(data[0]=='ok'){
				  // notif('Data di hapus','info');
                  // $("li[data-id='" + id +"']").remove();
				// }else{
				  // notif('Data gagal di hapus','danger');
				// }
                  // $("#load").hide();
                // } ,error: function(xhr, status, error) {
                  // alert(error);
                // },
            // });
        // }
    // });
    $(document).on("click",".edit-button",function() {
        var id = $(this).attr('id');
             $.ajax({
                type: "GET",
                url: "panel/menuadmin/crud.php",
				dataType: 'json',
                data: {id:id,type:"get"},
                cache : false,
                success: function(data){
				$("#load").hide();
				$("#submits").html('Update');
				$("#showicon").addClass(data.eclass);
				$("#showicon").removeClass('fa-bars');
				$("#id").val(data.id);
				$("#label").val(data.label).focus();
				$("#link").val(data.link);
				$("#eclass").val(data.eclass);
				$("#parentc").val(data.parentc);
				$("#aktif").val(data.aktif);
				$("#submenu").val(data.submenu);

   if ($("#parentc").val() != ""){
       $('.hide-txt').show('slow');
    }else{
       $('.hide-txt').hide('slow');
	}
				
                } ,error: function(xhr, status, error) {
                  alert(error);
                },
            });

    });

    $(document).on("click","#reset",function() {
		var eclass = $("#eclass").val();
        $('#label').val('');
        $('#link').val('');
        $('#eclass').val('');
        $('#parentc').val('');
		$("#showicon").removeClass(eclass);
		$("#showicon").addClass('fa-bars');
        $('#aktif').val('');
        $('#submenu').val('N');
        $('#id').val('');
		$('.hide-txt').hide('slow');
    });

  });
function show_selected() {
    var selector = document.getElementById('icon');
    var values = selector[selector.selectedIndex].value;
	document.getElementById("eclass").value=values;
	$("#showicon").addClass(values);
	$('#myModal').modal('hide');
}
$('#myModalDelMM').on('show', function() {
    var id = $(this).data('id'),
        removeBtn = $(this).find('.danger');
		
})

$('.confirm-deletem').on('click', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    $('#myModalDelM').data('id', id).modal('show');
	// $('.debug-url').html(id);
});
function clearForm(){
	  $('#label').val('');
	  $('#link').val('');
	  $('#eclass').val('');
	  $('#parentc').val('');
	  $('#aktif').val('');
	  $('#submenu').val('N');
	  $('#id').val('');
}
$(document).on("click","#btnYes",function() {
  	var id = $('#myModalDelM').data('id');
            $("#load").show();
             $.ajax({
                type: "GET",
				url: "panel/menuadmin/crud.php",
                data: {type:"hapus",id:id},
                cache : false,
				dataType: 'json',
                success: function(data){
				if(data[0]=='ok'){
				  notif('Data di hapus','info');
                  $("li[data-id='" + id +"']").remove();
				}else{
				  notif('Data gagal di hapus','danger');
				}
				 $('#myModalDelM').modal('hide');
				$("#load").hide();
                } ,error: function(xhr, status, error) {
                  alert(error);
                },
	});
});