<?php $this->load->view('include/header');?>
<?php $this->load->view('include/navbar');?>

<div class="row">
	<div class="col-lg-12">
		<div class="element-wrapper">
			<h6 class="element-header">Invoice</h6>
			<div class="element-box">
			<?php echo form_open('invoice/create_invoice/'.$data->no_job_order, array('id' => 'FormInvoice')); ?>
					<h5 class="form-header">Input Invoice</h5>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label for=""> No Invoice</label>
								<input class="form-control" placeholder="No Invoice" id="invoice" name="invoice" type="text">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="">No Job Order</label>
								<input class="form-control" placeholder="No Job Order" value="<?php echo $data->no_job_order;?>" type="text" disabled>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for=""> Tujuan</label>
						<input class="form-control" placeholder="Tujuan" id="tujuan" name="tujuan" type="text">
					</div>
					<table class="table table-border" id="TabelInvoice">
						<thead>
							<tr>
								<th>Account Code</th>
								<th>Description</th>
								<th>Amount</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
						<button id='BarisBaru' type="button" class="btn btn-info waves-effect"> Baris Baru (F7)
						</button>
					</div>
					<div class="form-buttons-w">
						<button class="btn btn-primary" type="button" id='createInvoice'> Save</button>
					</div>
					<?php echo form_close(); ?>
			</div>
		</div>
	</div>
	<?php //$this->load->view('include/rightbar');?>
	<?php $this->load->view('include/costumizer');?>
	<?php $this->load->view('include/footer');?>
	<script src="<?php echo site_url('assets')?>/js/sweetalert.js"></script>
	<script>
		$(document).ready(function () {

			for (B = 1; B <= 1; B++) {
				BarisBaru();
			}

			$('#BarisBaru').click(function () {
				BarisBaru();
			});

			$("#TabelInvoice tbody").find('input[type=text],textarea,select').filter(':visible:first').focus();
		});

		function BarisBaru() {

			var Baris = "<tr>";
			Baris += "<td><div class='form-group'>" +
				"<input type='text' class='form-control' name='account[]' id='description'>" +
				"</div></td>";
			Baris += "<td><div class='form-group'>" +
				"<input type='text' class='form-control' name='description[]' id='description'>" +
				"</div></td>";
			Baris += "<td><div class='form-group'>" +
				"<input type='text' class='form-control' name='amount[]' id='description'>" +
				"</div></td>";
			Baris +=
				"<td><button type='button' class='btn bg-pink btn-block btn-sm ' id='HapusBaris'>delete</button></td>";

			Baris += "</tr>";

			$('#TabelInvoice tbody').append(Baris);

		}

		$(document).on('click', '#HapusBaris', function (e) {
			e.preventDefault();
			$(this).parent().parent().remove();
		});

$(document).on('click', 'button#createInvoice', function(){
	SaveData();
});
function SaveData()
{
	var FormData = "invoice="+encodeURI($('#invoice').val());
	FormData += "&tujuan="+encodeURI($('#tujuan').val());
	FormData += "&" + $('#TabelInvoice tbody input').serialize();
	
		if($('#invoice').val() !==''){
			$.ajax({
				url: "<?php echo site_url('invoice/create_invoice/').$data->no_job_order; ?>",
				type: "POST",
				cache: false,
				data: FormData,
				dataType:'json',
				success: function(json){
					if(json.status == 1){ 
					swal("Good job!", json.pesan, "success");
				}
				else {
					swal("Sorry!", json.pesan, "error");
				}
				}
			});
		}else{

			swal("Sorry!", "NO. Invoice Isi terlebih Dahulu", "error");
		}
}

	</script>
