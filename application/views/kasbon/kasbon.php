<?php $this->load->view('include/header');?>
<?php $this->load->view('include/navbar');?>

<div class="row">
	<div class="col-lg-12">
		<div class="element-wrapper">
			<h6 class="element-header">Kas Bon</h6>
			<div class="element-box">
				<form>
					<h5 class="form-header">Input Kas Bon</h5>
					<div class="row">
						<div class="col-sm-8"></div>
						<div class="col-sm-4">
							<label for=""> Tanggal</label>
							<div class="form-group text-left">
								<input class="single-daterange form-control" placeholder="Untuk" name="tanggal" id="tanggal" type="text">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label for=""> Untuk</label>
								<input class="form-control" placeholder="Untuk" name="untuk" id="untuk" type="text">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="">No Kasbon</label>
								<input class="form-control" placeholder="No Kabon" name="no_kasbon" id="no_kasbon" type="text">
							</div>
						</div>
					</div>
					<table class="table table-border" id="TabelKasbon">
						<thead>
							<tr>
								<th>No</th>
								<th>Uraian Pengeluaran</th>
								<th>Kode Rek.</th>
								<th>Jumlah</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
					<div class="text-right">
						<div class="text">TOTAL</div>
						<div class="number" id='Total'>Rp. 0</div>
						<input type="hidden" id='TotalHidden' name='total'>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
						<button id='BarisBaru' type="button" class="btn btn-info waves-effect"> Baris Baru (F7)</button>
					</div>
					<div class="form-buttons-w">
						<button class="btn btn-primary" type="button" id="btn_save">Save</button>
					</div>
				</form>
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

			$("#TabelKasbon tbody").find('input[type=text],textarea,select').filter(':visible:first').focus();
		});

		function BarisBaru() {
			var Nomor = $('#TabelKasbon tbody tr').length + 1;
			var Baris = "<tr>";
			Baris += "<td>" + Nomor + "</td>";
			Baris += "<td><div class='form-group'>" +
				"<input type='text' class='form-control' name='uraian[]' id='uraian'>" +
				"</div></td>";
			Baris += "<td><div class='form-group'>" +
				"<input type='text' class='form-control' name='kode_rek[]' id='kode_rek' >" +
				"</div></td>";
			Baris += "<td><div class='form-group'>" +
				"<input type='text' class='form-control' name='jumlah[]' id='jumlah' onkeypress='return check_int(event)'>" +
				"</div></td>";
			Baris +=
				"<td><button type='button' class='btn bg-pink btn-block btn-sm waves-effect' id='HapusBaris'> <i class='material-icons'>delete</i></button></td>";

			Baris += "</tr>";

			$('#TabelKasbon tbody').append(Baris);

			HitungTotal();
		}

		$(document).on('click', '#HapusBaris', function (e) {
			e.preventDefault();
			$(this).parent().parent().remove();

			var Nomor = 1;

			$('#TabelKasbon tbody tr').each(function () {
				$(this).find('td:nth-child(1)').html(Nomor);
				Nomor++;
			});

			HitungTotal();
		});

		function HitungTotal() {
			var Total = 0;
			$('#TabelKasbon tbody tr').each(function () {

				if ($(this).find('td:nth-child(4) input').val() > 0) {
					var SubTotal = $(this).find('td:nth-child(4) input').val();
					Total = parseInt(Total) + parseInt(SubTotal);
				}

			});
			//var Total = Math.round(Total / 100) * 100;

			$('#Total').html(to_rupiah(Total));
			$('#TotalHidden').val(Total);
		}

		function to_rupiah(angka) {
			var rev = parseInt(angka, 10).toString().split('').reverse().join('');
			var rev2 = '';
			for (var i = 0; i < rev.length; i++) {
				rev2 += rev[i];
				if ((i + 1) % 3 === 0 && i !== (rev.length - 1)) {
					rev2 += '.';
				}
			}
			return 'Rp. ' + rev2.split('').reverse().join('');
		}

		$(document).on('keydown', '#jumlah', function (e) {
			var charCode = e.which || e.keyCode;
			if (charCode == 9) {
				var Indexnya = $(this).parent().parent().parent().index() + 1;
				var TotalIndex = $('#TabelKasbon tbody tr').length;
				if (Indexnya == TotalIndex) {
					BarisBaru();
					return false;
				}
			}

			HitungTotal();
		});

		function check_int(evt) {
			var charCode = (evt.which) ? evt.which : event.keyCode;
			return (charCode >= 48 && charCode <= 57 || charCode == 8);
		}
		$(document).on('click', 'button#btn_save', function () {
			SaveData()
		});

		function SaveData() {
			var FormData = "no_kasbon=" + encodeURI($('#no_kasbon').val());
			FormData += "&untuk=" + encodeURI($('#untuk').val());
			FormData += "&tanggal=" + encodeURI($('#tanggal').val());
			FormData += "&total=" + encodeURI($('#TotalHidden').val());

			FormData += "&" + $('#TabelKasbon tbody input').serialize();

			if ($('#no_surat').val() !== '') {
				$.ajax({
					url: "<?php echo site_url('kasbon'); ?>",
					type: "POST",
					cache: false,
					data: FormData,
					dataType: 'json',
					success: function (json) {
						if (json.status == 1) {
							swal("Good job!", json.pesan, "success")
							.then((value) => {
								window.location.href="<?php echo site_url('kasbon'); ?>"; 
							});
							
						} else {
							swal("Sorry!", json.pesan, "error");
						}
					}
				});
			}
		}

	</script>
