</div>
</div>
</div>
<div class="display-type"></div>
</div>
<script src="<?php echo site_url('assets')?>/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo site_url('assets')?>/bower_components/popper.js/dist/umd/popper.min.js"></script>
<script src="<?php echo site_url('assets')?>/bower_components/moment/moment.js"></script>
<script src="<?php echo site_url('assets')?>/bower_components/chart.js/dist/Chart.min.js"></script>
<script src="<?php echo site_url('assets')?>/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="<?php echo site_url('assets')?>/bower_components/jquery-bar-rating/dist/jquery.barrating.min.js"></script>
<script src="<?php echo site_url('assets')?>/bower_components/ckeditor/ckeditor.js"></script>
<script src="<?php echo site_url('assets')?>/bower_components/bootstrap-validator/dist/validator.min.js"></script>
<script src="<?php echo site_url('assets')?>/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="<?php echo site_url('assets')?>/bower_components/ion.rangeSlider/js/ion.rangeSlider.min.js"></script>
<script src="<?php echo site_url('assets')?>/bower_components/dropzone/dist/dropzone.js"></script>
<script src="<?php echo site_url('assets')?>/bower_components/editable-table/mindmup-editabletable.js"></script>
<script src="<?php echo site_url('assets')?>/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo site_url('assets')?>/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo site_url('assets')?>/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
<script src="<?php echo site_url('assets')?>/bower_components/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js"></script>
<script src="<?php echo site_url('assets')?>/bower_components/tether/dist/js/tether.min.js"></script>
<script src="<?php echo site_url('assets')?>/bower_components/slick-carousel/slick/slick.min.js"></script>
<script src="<?php echo site_url('assets')?>/bower_components/bootstrap/js/dist/util.js"></script>
<script src="<?php echo site_url('assets')?>/bower_components/bootstrap/js/dist/alert.js"></script>
<script src="<?php echo site_url('assets')?>/bower_components/bootstrap/js/dist/button.js"></script>
<script src="<?php echo site_url('assets')?>/bower_components/bootstrap/js/dist/carousel.js"></script>
<script src="<?php echo site_url('assets')?>/bower_components/bootstrap/js/dist/collapse.js"></script>
<script src="<?php echo site_url('assets')?>/bower_components/bootstrap/js/dist/dropdown.js"></script>
<script src="<?php echo site_url('assets')?>/bower_components/bootstrap/js/dist/modal.js"></script>
<script src="<?php echo site_url('assets')?>/bower_components/bootstrap/js/dist/tab.js"></script>
<script src="<?php echo site_url('assets')?>/bower_components/bootstrap/js/dist/tooltip.js"></script>
<script src="<?php echo site_url('assets')?>/bower_components/bootstrap/js/dist/popover.js"></script>

<script src="<?php echo site_url('assets')?>/js/main.js?version=4.4.1"></script>
<script src="<?php echo site_url('assets')?>/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="ModalGue" role="dialog" tabindex="-1">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="ModalHeader">Modal title</h5>
				<button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true"> &times;</span></button>
			</div>
			<div class="modal-body" id="ModalContent"></div>
			<div class="modal-footer" id="ModalFooter"></div>
		</div>
	</div>
</div>

<script>
	$('#ModalGue').on('hide.bs.modal', function () {
		setTimeout(function () {
			$('#ModalHeader, #ModalContent, #ModalFooter').html('');
		}, 500);
	});

</script>

</body>

</html>
