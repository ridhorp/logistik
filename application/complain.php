<?php
$controller = $this->router->class;
$method = $this->router->method;
$level = $this->session->userdata('ap_level');

if($level == 'admin'){
$this->load->view('include/admin/header');
$this->load->view('include/admin/navbar');
}elseif($level == 'user'){
$this->load->view('include/user/header');
$this->load->view('include/user/navbar');
}
?>
<div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Support Ticket</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Ticket</li>
                        </ol>
                    </div>
                    <?php $this->load->view('include/month'); ?>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Support Ticket List</h4>
                                <h6 class="card-subtitle">List of ticket opend by users</h6>
                                <div class="table-responsive m-t-40">
                                    <table id="my-table" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Subject</th>
                                                <th>Description</th>
                                                <th>Status</th>
                                                <th>Sifat</th>
                                                <th>Date</th>
												<?php if($level == 'admin') { ?>
												<th class='no-sort'>Action</th>
												
												<?php } ?>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php if($level == 'admin'){
 $this->load->view('include/admin/footer');
}elseif($level == 'user'){
 $this->load->view('include/user/footer');
}
?>
<script src="<?php echo config_item('plugins'); ?>datatables/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
<script type="text/javascript" language="javascript" >
	
    $(document).ready(function() {
		var dataTable = $('#my-table').DataTable( {
            dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
			"serverSide": true,
			"stateSave" : false,
			"bAutoWidth": true,
			language: {
                url: "<?php echo config_item('plugins'); ?>datatables-plugins/i18n/English.lang"
            },
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
				url :"<?php echo site_url('complain/data_complain'); ?>",
				type: "post",
				error: function(){ 
					$(".my-table-error").html("");
					$("#my-table").append('<tbody class="my-table-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
					$("#my-table_processing").css("display","none");
				}
			}
		} );
	});
	$(document).on('click', '#AddResponse', function(e){
		e.preventDefault();
		if($(this).attr('id') == 'AddResponse')
		{
			$('.modal-dialog').removeClass('modal-lg');
			$('.modal-dialog').removeClass('modal-sm');
			$('#ModalHeader').html('Response');
		}
		$('#ModalContent').load($(this).attr('href'));
		$('#ModalGue').modal('show');
	});
	
	$(document).on('click', '#DelComplain', function(e){
		e.preventDefault();
		var Link = $(this).attr('href');

		$('.modal-dialog').removeClass('modal-lg');
		$('.modal-dialog').addClass('modal-sm');
		$('#ModalHeader').html('Konfirmasi');
		$('#ModalContent').html('Apakah anda yakin ingin menghapus complain dari <br /><b>'+$(this).parent().parent().find('td:nth-child(2)').html()+'</b> ?');
		$('#ModalFooter').html("<button type='button' class='btn btn-primary' id='YesDelete' data-url='"+Link+"'>Ya, saya yakin</button><button type='button' class='btn btn-default' data-dismiss='modal'>Batal</button>");
		$('#ModalGue').modal('show');
	});
	
	$(document).on('click', '#YesDelete', function(e){
		e.preventDefault();
		$('#ModalGue').modal('hide');

		$.ajax({
			url: $(this).data('url'),
			type: "POST",
			cache: false,
			dataType:'json',
			success: function(data){
			$.toast({
						heading: 'Thanks',
						text: data.pesan,
						position: 'top-right',
						loaderBg:'#ff6849',
						icon: 'error',
						hideAfter: 3500
						
					 });
				$('#my-table').DataTable().ajax.reload( null, false );
			}
		});
	});
</script>
<script src="<?php echo config_item('plugins'); ?>toast-master/js/jquery.toast.js"></script>
<script src="<?php echo config_item('jsuser'); ?>toastr.js"></script>
