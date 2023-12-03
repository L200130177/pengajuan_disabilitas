<link rel="stylesheet" href="<?=base_url();?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/backend/css/plugin/screen.css">
<?= $this->session->flashdata('message');?>
<div class="box">
	<div class="box-header">
		<div class="pull-right">
			<button class="btn btn-primary btn-flat" data-toggle="modal" data-target="#createModal">
				<i class="fa fa-user-plus"></i> Create
			</button>
		</div>	
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<table id="list_pengajuan" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>No</th>
					<th>Nama</th>
					<th>NIK</th>
					<th>Status</th>
					<th>Download</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
			<tfoot>
				<tr>
					<th>No</th>
					<th>Nama</th>
					<th>NIK</th>
					<th>Status</th>
					<th>Download</th>
				</tr>
			</tfoot>
		</table>
	</div>
	<!-- /.box-body -->
</div>

<script src="<?php echo base_url();?>/assets/backend/js/plugin/jquery.validate.js"></script>
<script src="<?php echo base_url();?>/assets/backend/js/plugin/additional-methods.min.js"></script>
<script>
	$(document).ready(function () {
		$('#list_pengajuan').DataTable({
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "<?=site_url('dashboard/list_data')?>",
				"type": "POST"
			},
			"columnDefs": [{
					"targets": [0, 3, 4],
					"orderable": false
				}

			],
			"order": []

		})
	})

	function download(download_map) {

		$.ajax({
			type: "POST",
			url: "<?=base_url('dashboard/download_folder')?>",
			data: {
				download_map: download_map
			},
			dataType: "JSON",
			success: function (data) {
				console.log('BERHASIL');
			}
		});
	}

	// $(document).ready(function(){
	// 	jQuery.validator.addMethod("password", function( value, element ) {
	// 	var result = this.optional(element) || value.length >= 6 && /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[`~!@#$%^&*?])[A-Za-z\d`~!@#$%^&*?]{6,15}$/.test(value);
	// 	if (!result) {
	// 		element.value = "";
	// 		var validator = this;
	// 		setTimeout(function() {
	// 			validator.blockFocusCleanup = true;
	// 			element.focus();
	// 			validator.blockFocusCleanup = false;
	// 		}, 1);
	// 	}
	// 	return result;
	// }, "Kata sandi harus mengandung setidaknya satu angka, satu huruf, satu huruf besar, satu karakter khusus dan antara 6 - 15 karakter.");

	// $("#form-register").validate({
	// 	onkeyup: false,
	// 	})
	// })

	// $(document).ready(function(){
	// 	jQuery.validator.addMethod("curl", function( value, element ) {
	// 	var result = this.optional(element) || value.length >= 6 && /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[`~!@#$%^&*?])[A-Za-z\d`~!@#$%^&*?]{6,15}$/.test(value);
	// 	if (!result) {
	// 		element.value = "";
	// 		var validator = this;
	// 		setTimeout(function() {
	// 			validator.blockFocusCleanup = true;
	// 			element.focus();
	// 			validator.blockFocusCleanup = false;
	// 		}, 1);
	// 	}
	// 	return result;
	// }, "Kata sandi harus mengandung setidaknya satu angka, satu huruf, satu huruf besar, satu karakter khusus dan antara 6 - 15 karakter.");

	// $("#form-edit").validate({
	// 	onkeyup: false,
	// 	})
	// })
</script>
