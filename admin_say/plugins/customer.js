var dTable;
$(document).ready( function (){
      // $('#data_grid').DataTable({
dTable = $('#data_grid').DataTable( {
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": false,
        "responsive": true,
        "autoWidth": false,
        "pageLength": 10,
        "ajax": {
          "url": "panel/und/data_und.php",
          "type": "POST"
        },
        "columns": [
        { "data": "urutan" },
        { "data": "kode" },
        { "data": "merk" },
        { "data": "harga" },
        { "data": "ukuran" },
        { "data": "oc" },
        { "data": "master" },
        { "data": "lebar_plastik" },
        { "data": "harga_plastik" },
        { "data": "stokmasuk" },
        { "data": "stokkeluar" },
        { "data": "button" },
        ]
      });

    });

 $(document).on("click","#btnadd",function(){
        $("#modalcust").modal("show");
        $("#kode").focus();
        $("#kode").val("");
        $("#merk").val("");
        $("#harga").val("0");
        $("#uk").val("");
        $("#oc").val("");
        $("#master").val("");
        $("#lp").val("");
        $("#hp").val("");
        $("#sm").val("");
        $("#sk").val("");
		$("#crudmethod").val("N");
		$("#txtid").val("0");
    });
    $(document).on( "click",".btnhapus", function() {
      var id_cust = $(this).attr("id_cust");
      var name = $(this).attr("name_cust");
      swal({   
        title: "Delete Cust?",   
        text: "Delete Cust : "+name+" ?",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "Delete",   
        closeOnConfirm: true }, 
        function(){   
          var value = {
            id_cust: id_cust
          };
          $.ajax(
          {
            url : "panel/und/delete.php",
            type: "POST",
            data : value,
            success: function(data, textStatus, jqXHR)
            {
              var data = jQuery.parseJSON(data);
              if(data.result ==1){
                $.notify('Successfull delete customer');
                // var table = $('#data_grid').DataTable(); 
                dTable.ajax.reload( null, false );
				// dTable.draw();
              }else{
                swal("Error","Can't delete customer data, error : "+data.error,"error");
              }

            },
            error: function(jqXHR, textStatus, errorThrown)
            {
             swal("Error!", textStatus, "error");
            }
          });
        });
    });
    $(document).on("click","#btnsave",function(){

	var id_und = $("#txtid").val();
    var kode = $("#kode").val();
    var merk = $("#merk").val();
    var harga = $("#harga").val();
    var uk = $("#uk").val();
    var oc = $("#oc").val();
    var master = $("#master").val();
    var lp = $("#lp").val();
    var hp = $("#hp").val();
    var sm = $("#sm").val();
    var sk = $("#sk").val();
	var crud =$("#crudmethod").val();
	  
	  
      if(kode == '' || kode == null ){
        swal("Warning","Please fill customer kode","warning");
        $("#txtname").focus();
        return;
      }
      var value = {
        id_und: id_und,
        kode: kode,
        merk:merk,
        harga:harga,
        uk:uk,
        oc:oc,
        master:master,
        lp:lp,
        hp:hp,
        sm:sm,
        sk:sk,
        crud:crud
      };
      $.ajax(
      {
        url : "panel/und/save.php",
        type: "POST",
        data : value,
        success: function(data, textStatus, jqXHR)
        {
          var data = jQuery.parseJSON(data);
          if(data.crud == 'N'){
            if(data.result == 1){
              $.notify('Successfull save data');
              
              dTable.ajax.reload( null, false );
			  // dTable.draw();
        $("#kode").focus();
        $("#kode").val("");
        $("#merk").val("");
        $("#harga").val("0");
        $("#uk").val("");
        $("#oc").val("");
        $("#master").val("");
        $("#lp").val("");
        $("#hp").val("");
        $("#sm").val("");
        $("#sk").val("");
		$("#crudmethod").val("N");
		$("#txtid").val("0");
            }else{
              swal("Error","Can't save customer data, error : "+data.error,"error");
            }
          }else if(data.crud == 'E'){
            if(data.result == 1){
              // var table = $('#data_grid').DataTable(); 
              dTable.ajax.reload( null, false );
			  $("#modalcust").modal("hide");
              $.notify('Successfull update data');
			  // dTable.draw();
            }else{
             swal("Error","Can't update customer data, error : "+data.error,"error");
            }
          }else{
            swal("Error","invalid order","error");
          }
        },
        error: function(jqXHR, textStatus, errorThrown)
        {
           swal("Error!", textStatus, "error");
        }
      });
    });
    $(document).on("click",".btnedit",function(){
      var id_und=$(this).attr("id_und");
      var value = {
        id_und: id_und
      };
      $.ajax(
      {
        url : "panel/und/get_cust.php",
        type: "POST",
        data : value,
        success: function(data, textStatus, jqXHR)
        {
		var data = jQuery.parseJSON(data);
		$("#crudmethod").val("E");
		$("#txtid").val(data.id_und);
        $("#kode").val(data.kode);
        $("#merk").val(data.merk);
        $("#harga").val(data.harga);
        $("#uk").val(data.uk);
        $("#oc").val(data.oc);
        $("#master").val(data.master);
        $("#lp").val(data.lp);
        $("#hp").val(data.hp);
        $("#sm").val(data.sm);
        $("#sk").val(data.sk);
		$("#txtname").focus();
		 $("#modalcust").modal('show');
        },
        error: function(jqXHR, textStatus, errorThrown)
        {
          swal("Error!", textStatus, "error");
        }
      });
    });
    $.notifyDefaults({
      type: 'success',
      delay: 500
    });