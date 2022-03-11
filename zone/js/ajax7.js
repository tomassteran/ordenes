$(document).ready(function(){	
	
	var dataRecords = $('#recordListing').DataTable({
		"lengthChange": false,
		"processing":true,
		"serverSide":true,
		'processing': true,
		'serverSide': true,
		'serverMethod': 'post',		
		"order":[],
		"ajax":{
			url:"class/ajax_action7.php",
			type:"POST",
			data:{action:'listRecords'},
			dataType:"json"
		},
		"columnDefs":[
			{
				"targets":[7,8],
				"orderable":false,
			},
		],
		"pageLength": 35
	});	
	
	$('#addRecord').click(function(){
		$('#recordModal').modal('show');
		//$('#recordForm')[0].reset();
		$('.modal-title').html("<i class='fa fa-plus'></i>Agregar registro");
		$('#action').val('addRecord');
		$('#save').val('Agregar');
	});		
	$("#recordListing").on('click', '.update', function(){
		var id = $(this).attr("id");
		var action = 'getRecord';
		$.ajax({
			url:'class/ajax_action7.php',
			method:"POST",
			data:{id:id, action:action},
			dataType:"json",
			success:function(data){
				$('#recordModal').modal('show');
				$('#id').val(data.id);
				$('#ordenp').val(data.ordenp);
				$('#name').val(data.name);
				$('#age').val(data.age);
				$('#skills').val(data.skills);				
				$('#address').val(data.address);
				$('#designation').val(data.designation);
				$('#categoria').val(data.categoria);
				$('.modal-title').html("<i class='fa fa-plus'></i> Editar registro");
				$('#action').val('updateRecord');
				$('#save').val('Guardar');
			}
		})
	});
	$("#recordModal").on('submit','#recordForm', function(event){
		event.preventDefault();
		$('#save').attr('disabled','disabled');
		var formData = $(this).serialize();
		$.ajax({
			url:"class/ajax_action7.php",
			method:"POST",
			data:formData,
			success:function(data){				
				$('#recordForm')[0].reset();
				$('#recordModal').modal('hide');				
				$('#save').attr('disabled', false);
				dataRecords.ajax.reload();
			}
		})
	});		
	$("#recordListing").on('click', '.delete', function(){
		var id = $(this).attr("id");		
		var action = "deleteRecord";
		if(confirm("Estas seguro de eliminar el registro?")) {
			$.ajax({
				url:"class/ajax_action7.php",
				method:"POST",
				data:{id:id, action:action},
				success:function(data) {					
					dataRecords.ajax.reload();
				}
			})
		} else {
			return false;
		}
	});	
});