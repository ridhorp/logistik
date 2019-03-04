<?php $this->load->view('include/header');?>
<?php $this->load->view('include/navbar');?>

<div class="row">
	<div class="col-lg-12">
		<div class="element-wrapper">
			<h6 class="element-header">Surat Jalan</h6>
			<div class="element-box">
				<form>
					<h5 class="form-header">Input Surat Jalan</h5>
					<div class="row">
						<div class="col-sm-3">

							<div class="form-group">
								<label for=""> NO. Surat Jalan</label>
								<input class="form-control" placeholder="No Surat" name="no_surat" id="no_surat" type="text">
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label for=""> Tujuan</label>
								<textarea class="form-control" placeholder="Tujuan" name="tujuan" id="tujuan" type="text"></textarea>
							</div>
						</div>
						<div class="col-sm-12">

							<div class="form-group">
								<label for=""> Dari Lap / Gudang</label>
								<input class="form-control" placeholder="Dari Lap / Gudang" name="asal" id="asal" type="text">
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label for=""> Truck No. Polisi</label>
								<input class="form-control" placeholder="Truck No. Polisi" name="no_polisi" id="no_polisi" type="text">
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label for=""> Pemilik Angkutan</label>
								<input class="form-control" placeholder="Pemilik Angkutan" name="pemilik_angkutan" id="pemilik_angkutan" type="text">
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label for=""> No. DO</label>
								<input class="form-control" placeholder="No. DO" name="no_do" id="no_do" type="text">
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label for=""> EMKL Pers. Pel Stev</label>
								<input class="form-control" placeholder="EMKL Pers. Pel Stev" name="emkl" id="emkl" type="text">
							</div>
						</div>

					</div>

					<table class="table table-border" id="TabelSuratJalan">
						<thead>
							<tr>
								<th>Merk No.</th>
								<th>Jenis Barang</th>
								<th>Jumlah Barang</th>
								<th>Keterangan</th>
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
						<button class="btn btn-primary" type="button" id="SaveData"> Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php //$this->load->view('include/rightbar');?>
	<?php $this->load->view('include/costumizer');?>
	<?php $this->load->view('include/footer');?>
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
				"<input type='text' class='form-control' name='no_merk[]' id='no_merk'>" +
				"</div></td>";
			Baris += "<td><div class='form-group'>" +
				"<input type='text' class='form-control' name='jenis[]' id='jenis'>" +
				"</div></td>";
			Baris += "<td><div class='form-group'>" +
				"<input type='text' class='form-control' name='jumlah[]' id='jumlah'>" +
				"</div></td>";
			Baris += "<td><div class='form-group'>" +
				"<input type='text' class='form-control' name='keterangan[]' id='keterangan'>" +
				"</div></td>";
			Baris +=
				"<td><button type='button' class='btn bg-pink btn-block btn-sm waves-effect' id='HapusBaris'> <i class='material-icons'>delete</i></button></td>";

			Baris += "</tr>";

			$('#TabelSuratJalan tbody').append(Baris);
		}

		$(document).on('click', '#HapusBaris', function (e) {
			e.preventDefault();
			$(this).parent().parent().remove();
		});
		
$(document).on('click', 'button#SaveData', function(){
	SaveData()
});

function SaveData()
{
	var FormData = "no_surat="+encodeURI($('#no_surat').val());
	FormData += "&tujuan="+encodeURI($('#tujuan').val());
	FormData += "&asal="+encodeURI($('#asal').val());
	FormData += "&no_polisi="+encodeURI($('#no_polisi').val());
	FormData += "&pemilik_angkutan="+encodeURI($('#pemilik_angkutan').val());
	FormData += "&no_do="+encodeURI($('#no_do').val());
	FormData += "&emkl="+encodeURI($('#emkl').val());
	FormData += "&" + $('#TabelSuratJalan tbody input').serialize();
	
		if($('#no_surat').val() !==''){
			$.ajax({
				url: "<?php echo site_url('surat_jalan'); ?>",
				type: "POST",
				cache: false,
				data: FormData,
				dataType:'json',
				success: function(data){
					if(data.status == 1)
					{
						alert(data.pesan);
						window.location.href="<?php echo site_url('surat_jalan'); ?>";
					}
					else 
					{
						$('.modal-dialog').removeClass('modal-lg');
						$('.modal-dialog').addClass('modal-sm');
						$('#ModalHeader').html('Oops !');
						$('#ModalContent').html(data.pesan);
						$('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal' autofocus>Ok</button>");
						$('#ModalGue').modal('show');
					}	
				}
			});
		}
}
	</script>
