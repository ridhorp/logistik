<?php $this->load->view('include/header');?>
<?php $this->load->view('include/navbar');?>

<div class="row">

	<div class="element-wrapper col-lg-12">
		<h6 class="element-header">Kas Bon</h6>
		<div class="element-box">
			<h5 class="form-header">List Surat Jalan</h5>
			<div class="table-responsive">
				<table id="my-table" width="100%" class="table table-striped table-lightfont">
					<thead>
						<tr> 
							<th>No. Surat</th>
							<th>tujuan</th>
							<th>asal</th>
							<th>no_polisi</th>
							<th>pemilik_angkutan</th>
							<th>no_do</th>
							<th>emkl</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
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
			"aLengthMenu": [[10, 20, 50, 100, 150], [10, 20, 50, 100, 150]],
			"ajax":{
				url :"<?php echo site_url('surat_jalan/data_surat_jalan'); ?>",
				type: "post",
				error: function(){ 
					$(".my-table-error").html("");
					$("#my-table").append('<tbody class="my-table-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
					$("#my-table_processing").css("display","none");
				}
			}
		} );
	});
	
</script>