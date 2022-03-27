			var pTable;
			// #Example adalah id pada table
			$(document).ready(function(){
			pTable = $('#jsonplano').DataTable({
			"bProcessing": true,
			"bServerSide": true,
			"sAjaxSource": "pages/bahan/data_plano.php",
			"order": [[ 0, "desc" ]]
			});
			});
			//Tampilkan Modal 
			function showModalsk(id)
			{
				waitingDialog.show();
				clearModalsk();
				
				// Untuk Eksekusi Data Yang Ingin di Edit atau Di Hapus 
				if(id)
				{
					$.ajax({
						type: "POST",
						url: "pages/bahan/crud.php",
						dataType: 'json',
						data: {id:id,type:"get"},
						success: function(res) {
							waitingDialog.hide();
							setModalDatak( res );
						}
					});
				}
				// Untuk Tambahkan Data
				else
				{
					// $('#nomor').keypress(validateNumber);
					$("#myModalsK").modal("show");
					$("#myModalLabel").html("Data Baru");
					$("#type").val("new"); 
					waitingDialog.hide();
				}
			}
			
			//Data Yang Ingin Di Tampilkan Pada Modal Ketika Di Edit 
			function setModalDatak( data )
			{
				// $('#nomor').keypress(validateNumber);
				$("#myModalLabel").html("EDIT Data");
				$("#id").val(data.id);
				$("#type").val("edit");
				$("#cat").val(data.cat);
				$("#nama").val(data.nama);
				$("#harga").val(data.harga);
				$("#tinggi").val(data.tinggi);
				$("#lebar").val(data.lebar);
				$("#tebal").val(data.tebal);
				$("#pub").val(data.pub);
				$("#myModalsK").modal("show");
				
			}
			
			//Submit Untuk Eksekusi Tambah/Edit/Hapus Data 
			function submitUserk()
			{
			var nama = $("#nama").val();
			var harga = $("#harga").val();
			var cat = $("#cat").val();
			if(nama==''){
			$('.errorn').html('Masih kosong').delay(200).fadeIn().delay(3000).fadeOut();
			}else if(cat==''){
			$('.errorc').html('Belum dipilih').delay(200).fadeIn().delay(3000).fadeOut();
			}else if(harga==''){
			$('.errorh').html('Masih kosong').delay(200).fadeIn().delay(3000).fadeOut();
			}else{
				var formData = $("#formUserK").serialize();
				waitingDialog.show();
				$.ajax({
					type: "POST",
					url: "pages/bahan/crud.php",
					dataType: 'json',
					data: formData,
					success: function(data) {
						// bTable.draw();
						cariFilter(); // Untuk Reload Tables secara otomatis
						waitingDialog.hide();	
						$('#myModalsK').modal('hide');
					}
				});
			}
			}
			
			//Hapus Data
			function deleteUserk(id)
			{
				clearModalsk();
				$.ajax({
					type: "POST",
					url: "pages/bahan/crud.php",
					dataType: 'json',
					data: {id:id,type:"get"},
					success: function(data) {
						$(".hidex").hide();
						$("#removeWarning").show();
						$("#myModalLabel").html("Hapus Data");
						$("#id").val(data.id);
						$("#cat").val(data.cat).attr("disabled","true");
						$("#nama").val(data.nama).attr("disabled","true");
						$("#harga").val(data.harga).attr("disabled","true");
						$("#tinggi").val(data.tinggi).attr("disabled","true");
						$("#lebar").val(data.lebar).attr("disabled","true");
						$("#tebal").val(data.tebal).attr("disabled","true");
						$("#pub").val(data.pub).attr("disabled","true");
						$("#type").val("delete");
						$("#myModalsK").modal("show");
						waitingDialog.hide();			
					}
				});
			}
			
			//Clear Modal atau menutup modal supaya tidak terjadi duplikat modal
			function clearModalsk()
			{
				$("#removeWarning").hide();
				$(".hidex").show();
				$("#id").val("").removeAttr( "disabled" );
				$("#cat").val("").removeAttr( "disabled" );
				$("#nama").val("").removeAttr( "disabled" );
				$("#harga").val("").removeAttr( "disabled" );
				$("#tinggi").val("").removeAttr( "disabled" );
				$("#lebar").val("").removeAttr( "disabled" );
				$("#tebal").val("").removeAttr( "disabled" );
				$("#pub").val("").removeAttr( "disabled" );
				$("#type").val("");
			}
		    //Tampilkan Modal  plano
			function showPlano(id)
			{
				waitingDialog.show();
				clearPlano();
				
				// Untuk Eksekusi Data Yang Ingin di Edit atau Di Hapus 
				if(id)
				{
					$.ajax({
						type: "POST",
						url: "pages/bahan/crud.plano.php",
						dataType: 'json',
						data: {idp:id,typep:"get"},
						success: function(res) {
							waitingDialog.hide();
							setModalPlano( res );
						}
					});
				}
				// Untuk Tambahkan Data
				else
				{
					// $('#nomor').keypress(validateNumber);
					$("#myModalsPlano").modal("show");
					$("#myModalLabelp").html("Data Baru");
					$("#typep").val("new"); 
					waitingDialog.hide();
				}
			}
			
			//Data Yang Ingin Di Tampilkan Pada Modal Ketika Di Edit 
			function setModalPlano( data )
			{
				// $('#nomor').keypress(validateNumber);
				$("#myModalLabelp").html("EDIT Data");
				$("#idp").val(data.id);
				$("#typep").val("edit");
				$("#namap").val(data.nama);
				$("#panjangp").val(data.panjang);
				$("#lebarp").val(data.lebar);
				$("#myModalsPlano").modal("show");
				
			}
			
			//Submit Untuk Eksekusi Tambah/Edit/Hapus Data 
			function submitPlano()
			{
			var nama = $("#namap").val();
			var panjang = $("#panjangp").val();
			var lebar = $("#lebarp").val();
			if(nama==''){
			$('.errorp').html('Masih kosong').delay(200).fadeIn().delay(3000).fadeOut();
			}else if(panjang==''){
			$('.errorw').html('Panjang Masih kosong').delay(200).fadeIn().delay(3000).fadeOut();
			}else if(lebar==''){
			$('.errorl').html('Lebar Masih kosong').delay(200).fadeIn().delay(3000).fadeOut();
			}else{
				var formData = $("#formPlano").serialize();
				waitingDialog.show();
				$.ajax({
					type: "POST",
					url: "pages/bahan/crud.plano.php",
					dataType: 'json',
					data: formData,
					success: function(data) {
						pTable.ajax.reload(); // Untuk Reload Tables secara otomatis
						waitingDialog.hide();	
						$('#myModalsPlano').modal('hide');
					}
				});
			}
			}
			
			//Hapus Data
			function deletePlano(id)
			{
				clearPlano();
				$.ajax({
					type: "POST",
					url: "pages/bahan/crud.plano.php",
					dataType: 'json',
					data: {idp:id,typep:"get"},
					success: function(data) {
						$(".hidex").hide();
						$("#removeWarningp").show();
						$("#myModalLabelp").html("Hapus Data");
						$("#idp").val(data.id);
						$("#namap").val(data.nama).attr("disabled","true");
						$("#panjangp").val(data.panjang).attr("disabled","true");
						$("#lebarp").val(data.lebar).attr("disabled","true");
						$("#typep").val("delete");
						$("#myModalsPlano").modal("show");
						waitingDialog.hide();			
					}
				});
			}
			
			//Clear Modal atau menutup modal supaya tidak terjadi duplikat modal
			function clearPlano()
			{
				$("#removeWarningp").hide();
				$(".hidex").show();
				$("#idp").val("").removeAttr( "disabled" );
				$("#namap").val("").removeAttr( "disabled" );
				$("#panjangp").val("").removeAttr( "disabled" );
				$("#lebarp").val("").removeAttr( "disabled" );
				$("#typep").val("");
			}

function validateNumber(event) {
    var key = window.event ? event.keyCode : event.which;

    if (event.keyCode === 8 || event.keyCode === 9 || event.keyCode === 46
        || event.keyCode === 37 || event.keyCode === 39) {
        return true;
    }
    else if ( key < 48 || key > 57 ) {
        return false;
    }
    else return true;
};
