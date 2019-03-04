<?php $this->load->view('include/header');?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css" rel="stylesheet">

<?php $this->load->view('include/navbar');?>
<div class="element-wrapper">
	<h6 class="element-header">Job Order</h6>
	<div class="element-box">
			<h5 class="form-header">List Job Order</h5>
			<div class="table-responsive">
					<table id="my-table" width="100%" class="table table-striped table-lightfont dt-responsive nowrap">
							<thead>
							<tr>
							<th>No. JO</th>
							<th>Customer Code</th>
							
							<th>No BL</th>
							<th>Vessel</th>
							<th>Eta</th>
							<th>Port Loading</th>
							<th>Port Destination</th>
							<th>Volume</th>
							<th>Action</th>
						</tr>
							</thead>
							
					</table>
			</div>
	</div>
											

<?php //$this->load->view('include/rightbar');?>
<?php $this->load->view('include/costumizer');?>
<?php $this->load->view('include/footer');?>

<script type="text/javascript" language="javascript" >
	
    $(document).ready(function() {
		var dataTable = $('#my-table').DataTable( {
          
			"serverSide": true,
			"stateSave" : false,
			"bAutoWidth": true,
			
			"aaSorting": [[ 0, "desc" ]],
			"columnDefs": [ 
				{
					"targets": 'no-sort',
					"orderable": false,
				}
	        ],
			"sPaginationType": "simple_numbers", 
			"iDisplayLength": 10,
			
			"ajax":{
				url :"<?php echo site_url('jo/data_jo'); ?>",
				type: "post",
				error: function(){ 
					$(".my-table-error").html("");
					$("#my-table").append('<tbody class="my-table-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
					$("#my-table_processing").css("display","none");
				}
			}
		} );
	});

	$(document).on('click', '#detailJo', function(e){
		e.preventDefault();
		if($(this).attr('id') == 'detailJo')
		{
			$('.modal-dialog').removeClass('modal-lg');
			$('.modal-dialog').removeClass('modal-sm');
			$('#ModalHeader').html('Detail Job Order');
		}
		$('#ModalContent').load($(this).attr('href'));
		$('#ModalGue').modal('show');
	});
	
</script>