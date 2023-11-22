<link rel="stylesheet"
	href="<?=base_url();?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet"
	href="<?=base_url()?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/backend/css/plugin/screen.css">
<div class="box">
	<div class="box-header">

		<div class="pull-right">
			<input type="hidden" id="jenis_laporan" value="<?=$jenis_laporan?>">
			<button type="button" class="btn btn-success" data-toggle="modal" data-target="#bulan">
				<i class="fa fa-file-excel-o"></i> Export Excel
			</button>
		</div>

	</div>
	<div class="box-body table-responsive">
		<table class="table table-bordered table-striped" id="datatable">
			<thead>
				<tr>
					<th>#</th>
					<th></th>
					<th>Nomor Kartu Keluarga</th>
					<th>NIK</th>
					<th>Nama Lengkap</th>
					<th>Hubungan Keluarga</th>
					<th>Tempat Lahir</th>
					<th>Tanggal Lahir</th>
					<th>Jenis Kelamin</th>
					<th>Status Kawin</th>
					<th>Alamat Tempat Tinggal</th>
					<th>RT</th>
					<th>RW</th>
					<th>Kode Pos</th>
					<th>Kode Kecamatan</th>
					<th>nama Kecamatan</th>
					<th>Kode Desa</th>
					<th>Nama Desa</th>
					<th>Nama Faskes</th>
					<th>Nama Faskes Dokter Gigi</th>
					<th>Nomor Telepon Peserta</th>
					<th>Email</th>
					<th>Npp</th>
					<th>Jabatan</th>
					<th>Status</th>
					<th>Kelas Rawat</th>
					<th>TMT Kerja</th>
					<th>Gaji Pokok + Tunjangan Tetap</th>
					<th>Kewarganegaraan</th>
					<th>No. Polis</th>
					<th>Nama Asuransi</th>
					<th>No. NPWP</th>
					<th>No. Passport</th>
				</tr>
			</thead>
			<tbody>

			</tbody>
		</table>
	</div>
</div>

<form action="<?=site_url('laporan/export')?>" method="post" name="form-laporan" id="form-laporan">
	<div class="modal fade" id="bulan">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Default Modal</h4>
				</div>
				<div class="modal-body">

					<div class="form-group">
						<label>Tanggal Awal</label>
						<input type="text" id="datepicker-awal" name="awal" class="form-control" data-rule-required="true"
							data-msg-required="Tanggal awal masih kosong, silakan isi">
						<span cass="help-block"></span>
						<input type="hidden" name="export_laporan" id="export_laporan" value="<?=$jenis_laporan?>">
					</div>

					<div class="form-group">
						<label>Tanggal Akhir</label>
						<input type="text" id="datepicker-akhir" name="akhir" class="form-control" data-rule-required="true"
							data-msg-required="Tanggal akhir masih kosong, silakan isi">
						<span cass="help-block"></span>
					</div>


				</div>
				<!-- /.input group -->

				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
					<button type="submit" class="btn btn-success" data-toggle="modal" data-target="">
						<i class="fa fa-file-excel-o"></i> Export Excel
					</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
</form>
<!-- /.modal -->

<!-- bootstrap datepicker -->
<script src="<?=base_url()?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url();?>/assets/backend/js/plugin/jquery.validate.js"></script>

<script>
	$(document).ready(function () {
		var jenis_laporan = $('#jenis_laporan').val();
		$('#datatable').DataTable({
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "<?=site_url('laporan/list_data')?>",
				"type": "POST",
				data: {
					jenis_laporan: jenis_laporan
				},
			},
			"columnDefs": [{
					"targets": [0, 1, 5, 8, 9, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31,
						32
					],
					"orderable": false
				}

			],
			"order": []

		})
	})

	$(function () {
		//Date picker
		$('#datepicker-awal').datepicker({
			autoclose: true,
			format: 'yyyy/mm/dd'
		})
		$('#datepicker-akhir').datepicker({
			autoclose: true,
			format: 'yyyy/mm/dd'
		})
	})

	$("#form-laporan").validate({
		onkeyup: false,
	})

</script>
