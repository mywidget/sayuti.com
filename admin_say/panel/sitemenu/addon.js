$(document).ready(function(){
  $('.link').show();
  $('.page').hide();
  $('.kategori').hide();
  $('.kategorip').hide();
  $('#radio1').change(function(){
    if(this.checked)
      $('.link').fadeIn('slow');
      $('.page').fadeOut('slow').val("");
      $('.kategori').fadeOut('slow').val("");
      $('.kategorip').fadeOut('slow').val("");
  });

  $('#radio2').change(function(){
    if(this.checked)
      $('.page').fadeIn('slow');
      $('.link').fadeOut('slow').val("");
      $('.kategori').fadeOut('slow').val("");
      $('.kategorip').fadeOut('slow').val("");
  });

  $('#radio3').change(function(){
    if(this.checked)
      $('.kategori').fadeIn('slow');
      $('.page').fadeOut('slow').val("");
      $('.link').fadeOut('slow').val("");
      $('.kategorip').fadeOut('slow').val("");
  });
  $('#radio4').change(function(){
    if(this.checked)
      $('.kategorip').fadeIn('slow');
      $('.kategori').fadeOut('slow').val("");
      $('.page').fadeOut('slow').val("");
      $('.link').fadeOut('slow').val("");
  });
});

var click = false;
  function callFunction(el) {
    if (!click) {
     $('#kolapse').addClass('btn-info');
     $('.dd').nestable('expandAll');
     $('#kolapse').html('<i class="fa fa-minus"></i> Collapse');
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
var eclass = $("#eclass").val();
if (label == ""){
notif('Nama menu harus diisi','warning');
$("#label").focus();
}else if (aktif == ""){
notif('Aktif harus dipilih','warning');
$("#aktif").focus();
}else{
SubmitForm();
return true;
	}
}
	   function SubmitForm()
	   {
			var dataString = {
              label : $("#label").val(),
              link : $("#link").val(),
              page : $("#page").val(),
              kategori : $("#kategori").val(),
              kategorip : $("#kategorip").val(),
              eclass : $("#eclass").val(),
              aktif : $("#aktif").val(),
              id : $("#id").val()
            };
			$.ajax({
			type : 'GET',
			url: "panel/sitemenu/save_menu.php",
			data : dataString,
			beforeSend: function(){	 
				$("#load").show();
				$("#submits").html('Proses...');
			},
            dataType: "json",
            cache : false,
            success: function(data){
              if(data.type == 'add'){
                 $("#menu-id").append(data.menu);
				 $("#submits").html('Submit');
				 notif('Data di simpan','info');
              } else if(data.type == 'edit'){
				 $("#submits").html('Submit');
                 $('#label_show'+data.id).html(data.label);
                 $('#link_show'+data.id).html(data.link);
                 $('#eclass_show'+data.id).html(data.eclass);
				 notif('Data di Updated','success');
				 $("#showicon").removeClass(data.eclass);
				 $("#showicon").addClass('fa-bars');
              }
              $('#label').val('');
              $('#link').val('');
              $('#eclass').val('');
              $('#aktif').val('');
              $('#page').val('');
              $('#kategori').val('');
              $('#kategorip').val('');
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
          var dataString = {
              data : $("#nestable-output").val(),
            };
        $.ajax({
            type: "GET",
            url: "panel/sitemenu/save_data.php",
            data: dataString,
            cache : false,
            success: function(data){
              $("#load").hide();
			  $('#save').prop('disabled',true);
              notif('Data di update','success');
            } ,error: function(xhr, status, error) {
              alert(error);
            },
        });
    });

 
    $(document).on("click",".del-button",function() {
        var x = confirm('Delete this menu?');
        var id = $(this).attr('id');
        if(x){
            $("#load").show();
             $.ajax({
                type: "GET",
                url: "panel/sitemenu/delete.php",
                data: { id : id },
                cache : false,
                success: function(data){
                  $("#load").hide();
                  $("li[data-id='" + id +"']").remove();
				  notif('Data di hapus','danger');
				$('#label').val('');
				$('#link').val('');
				$('#eclass').val('');
				$("#showicon").removeClass(eclass);
				$("#showicon").addClass('fa-bars');
				$('#aktif').val('');
				$('#page').val('');
				$('#kategori').val('');
				$('#kategorip').val('');
				$('#id').val('');
                } ,error: function(xhr, status, error) {
                  alert(error);
                },
            });
        }
    });

    $(document).on("click",".edit-button",function() {
        var id = $(this).attr('id');
             $.ajax({
                type: "GET",
                url: "panel/sitemenu/crud.php",
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
				$("#aktif").val(data.aktif);
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
		$("#showicon").removeClass(eclass);
		$("#showicon").addClass('fa-bars');
        $('#aktif').val('');
        $('#page').val('');
        $('#kategori').val('');
        $('#kategorip').val('');
        $('#id').val('');
    });

  });
function show_selected() {
    var selector = document.getElementById('icon');
    var values = selector[selector.selectedIndex].value;
	document.getElementById("eclass").value=values;
	$("#showicon").addClass(values);
	$('#myModal').modal('hide');
}
$('#myModalDel').on('show', function() {
    var id = $(this).data('id'),
        removeBtn = $(this).find('.danger');
		
})

$('.confirm-delete').on('click', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    $('#myModalDel').data('id', id).modal('show');
	// $('.debug-url').html(id);
});

$(document).on("click","#btnYes",function() {
  	var id = $('#myModalDel').data('id');
            $("#load").show();
             $.ajax({
                type: "GET",
                url: "panel/sitemenu/delete.php",
                data: { id : id },
                cache : false,
                success: function(data){
                  $("#load").hide();
                  $("li[data-id='" + id +"']").remove();
				  notif('Data di hapus','danger');
				 $('#myModalDel').modal('hide');
                } ,error: function(xhr, status, error) {
                  alert(error);
                },
            });
});