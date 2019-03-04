<?php $this->load->view('include/header');?>
<?php $this->load->view('include/navbar');?>

<div class="row">
	<div class="col-lg-12">
		<div class="element-wrapper">
			<h6 class="element-header">Job Order</h6>
			<div id="ResponseInput"></div>
			<div class="element-box">
			<?php echo form_open('jo', array('id' => 'FormJo')); ?>
						<h5 class="form-header">Input Job Order</h5>
						
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label for=""> No Job Order</label>
									<input class="form-control" placeholder="No Job Order" name="no_job" type="text">
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for=""> Customer Code</label>
							<input class="form-control" placeholder="Customer Code" name="customer_code" type="text">
						</div>
						<div class="form-group">
							<label for=""> PIB / PEB No.</label>
							<input class="form-control" placeholder="No PIB / PEB" name="pib" type="text">
						</div>
						<div class="form-group">
							<label for=""> B/L No</label>
							<input class="form-control" placeholder="B/L No" name="bl_no" type="text">
						</div>
						<div class="form-group">
							<label for=""> Vessel</label>
							<input class="form-control" placeholder="Vessel" name="vessel" type="text">
						</div>
						<div class="form-group">
							<label for=""> ETA</label>
							<input class="form-control" placeholder="ETA" name="eta" type="date">
						</div>
						<div class="form-group">
							<label for=""> Port Loading</label>
							<input class="form-control" placeholder="Port Loading" name="p_load" type="text">
						</div>
						<div class="form-group">
							<label for=""> Port Destination</label>
							<input class="form-control" placeholder="Port Destination" name="p_dest" type="text">
						</div>
						<div class="form-group">
							<label for=""> TPS / Warehouse</label>
							<input class="form-control" placeholder="TPS / Warehouse" name="tps" type="text">
						</div>
						<div class="form-group">
							<label for=""> BC 1.1 / Tgl</label>
							<input class="form-control" placeholder="BC 1.1 / Tgl" name="bc_tgl" type="text">
						</div>
						<div class="form-group">
							<label for=""> Party / Volume</label>
							<input class="form-control" placeholder="Party / Volume" name="volume" type="text">
						</div>
						<div class="form-group">
							<label for=""> Description of Goods</label>
							<input class="form-control" placeholder="Description of Goods" name="desc" type="text">
						</div>
						<div class="form-group">
							<label for=""> Container No.</label>
							<input class="form-control" placeholder="Container No." name="container" type="text">
						</div>
						<div class="form-buttons-w">
						<button type='button' class='btn btn-primary' id='SaveAddJo'>Save</button>
						</div>
					<?php echo form_close(); ?>
			</div>
			
		</div>
	</div>
</div>

<?php $this->load->view('include/costumizer');?>
<?php $this->load->view('include/footer');?>
<script src="<?php echo site_url('assets')?>/js/sweetalert.js"></script>
<script>
$(document).ready(function(){

	$('#SaveAddJo').click(function(){
		$.ajax({
			url: $('#FormJo').attr('action'),
			type: "POST",
			cache: false,
			data: $('#FormJo').serialize(),
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
	});
});

</script>