<?php echo form_open('jo/detail_jo/'.$master->no_job_order, array('id' => 'FormDetail')); ?>

<table>
	<tr>
		<td width="100%">No JO</td>
		<td class="text-right">
			<?php echo $master->no_job_order; ?>
		</td>
	</tr>
	<tr>
		<td width="100%">Customer Code</td>
		<td class="text-right">
			<?php echo $master->customer_code; ?>
		</td>
	</tr>
	<tr>
		<td width="100%">No Invoice</td>
		<td class="text-right">
		<?php echo $master->no_invoice; ?>
		</td>
	</tr>
	<tr>
		<td width="100%">No PIB/PEB</td>
		<td class="text-right">
			<?php echo $master->no_pib_peb; ?>
		</td>
	</tr>
	<tr>
		<td width="100%">No B/L</td>
		<td class="text-right">
			<?php echo $master->no_b_l; ?>
		</td>
	</tr>
	<tr>
		<td width="100%">Vessel</td>
		<td class="text-right">
			<?php echo $master->vessel; ?>
		</td>
	</tr>
	<tr>
		<td width="100%">ETA</td>
		<td class="text-right">
			<?php echo $master->eta; ?>
		</td>
	</tr>
	<tr>
		<td width="100%">Port Loading</td>
		<td class="text-right">
			<?php echo $master->port_loading; ?>
		</td>
	</tr>
	<tr>
		<td width="100%">Port Destination</td>
		<td class="text-right">
			<?php echo $master->port_destination; ?>
		</td>
	</tr>
	<tr>
		<td width="100%">TPS Warehouse</td>
		<td class="text-right">
			<?php echo $master->tps_warehouse; ?>
		</td>
	</tr>
	<tr>
		<td width="100%">BC. 1.1 / Tgl</td>
		<td class="text-right">
			<?php echo $master->bc_tgl; ?>
		</td>
	</tr>
	<tr>
		<td width="100%">Party / Volume</td>
		<td class="text-right">
			<?php echo $master->party_volume; ?>
		</td>
	</tr>
	<tr>
		<td width="100%">Description of Goods</td>
		<td class="text-right">
			<?php echo $master->description_of_goods; ?>
		</td>
	</tr>
	<tr>
		<td width="100%">No Container</td>
		<td class="text-right">
			<?php echo $master->no_container; ?>
		</td>
	</tr>
</table>



<?php echo form_close(); ?>
