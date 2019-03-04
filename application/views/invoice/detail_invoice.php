<?php echo form_open('invoice/detail_invoice/'.$master->no_invoice, array('id' => 'FormDetail')); ?>
		<div class="form-group">
				<label for=""> No. Jo</label>
				<input class="form-control" placeholder="Enter email" value="<?php echo $master->no_job_order; ?>" type="text">
		</div>
		<div class="row">
				<div class="col-sm-6">
						<div class="form-group">
								<label for=""> Remarks</label>
								<input class="form-control" placeholder="Remarks" value="<?php echo $master->remarks; ?>" type="text">
						</div>
				</div>
				<div class="col-sm-6">
						<div class="form-group">
								<label for="">Tujuan</label>
								<input class="form-control" placeholder="Tujuan" value="<?php echo $master->tujuan; ?>" type="text">
						</div>
				</div>
		</div>
<?php echo form_close(); ?>
<div class="table-responsive">
		<table class="table table-lightborder">
				<thead>
						<tr>
								<th>Account Code</th>
								<th>Description</th>
								<th class="text-right">Amount</th>
						</tr>
				</thead>
				<tbody>
			<?php foreach($detail->result() as $dt){
					echo"
				<tr>
								<td>$dt->account_code</td>
								<td>$dt->description</td>
								<td class='text-right'>$dt->amount</td>
						</tr>";
				}?>
				</tbody>
				<td ><b>Total</b></td>
				<td ></td>
				<td class='text-right'><b><?php echo "Rp. ".number_format($master->total,2,',','.') ;?></b></td>
		</table>

</div>
