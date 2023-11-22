<!-- Select2 -->
<link rel="stylesheet" href="<?=base_url()?>assets/bower_components/select2/dist/css/select2.min.css">
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?=base_url()?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/backend/css/plugin/screen.css">
<style>
/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
	-webkit-appearance: none;
	margin: 0;
}

/* Firefox */
input[type=number] {
	-moz-appearance: textfield;
}
</style>

<div class="box">
	<div class="box-header">
		<!-- <div class="col-md-4 col-md-offset-4"> -->
		<!-- <h3 class="boc-title">Hasil Kuesioner</h3> -->
		<!-- </div> -->
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<form action="" method="post">
					<div class="form-group">
						<label>NIK</label>
						<input type="text" name="nik" class="form-control"
							value="<?php echo $this->session->userdata('cek_nik'); ?>" readonly>
						<span cass="help-block"></span>
						<label>Skor</label>
						<input type="text" name="nilai" class="form-control"
							value="<?php echo $nilai ?>" readonly>
						<span cass="help-block"></span>
					</div>
					<div class="form-group">
						<button type="button" class="btn btn-primary btn-flat" data-toggle="modal"
							data-target="#create">
							<i class="fa fa-eye"></i> Isi Data
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- CREATE MODAL -->
<div class="modal fade" id="create">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Isikan Data</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" action="<?=base_url('laporan/submit');?>" id="data-diri" name="data-diri" method="post">
					<div class="box-body">

						<div class="form-group">
							<div class="col-sm-12">
								<label>Nomor Kartu Keluarga *</label>
								<input type="number" id="no_kk" name="no_kk" class="form-control"
								data-rule-required="true" data-rule-minlength="16" data-rule-maxlength="20" data-msg-required="Nomor kartu keluarga masih kosong, silakan isi" data-msg-minlength="Nomor kartu keluarga minimal 16 karakter" data-msg-maxlength="Nomor kartu keluarga maksimal 20 karakter">
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-12">
								<label>NIK *</label>
								<input type="text" name="nik" class="form-control"
									value="<?php echo $this->session->userdata('cek_nik'); ?>" readonly>
								<input type="text" name="jenis_laporan" class="form-control"
									value="<?php echo $jenis ?>" readonly>
								<input type="text" name="nilai" class="form-control"
									value="<?php echo $nilai ?>" readonly>
								<input type="text" name="created" class="form-control"
									value="<?php echo $this->session->userdata('name'); ?>" readonly>

							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-12">
								<label>Nama Lengkap *</label>
								<input type="text" name="nama" class="form-control"
								maxlength="4" data-rule-required="true" data-msg-required="Nama masih kosong, silakan isi">
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-12">
								<label>Hubungan Keluarga *</label>
								<select name="hubungan" class="form-control" data-rule-required="true" data-msg-required="Hubungan keluarga belum dipilih, pilih salah satu">
									<option value="">-- Pilih --</option>
									<option value="1">Peserta
									</option>
									<option value="2">Suami</option>
									<option value="3">Istri</option>
									<option value="4">Anak</option>
									<option value="5">Tambahan
									</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-12">
								<label>Tempat Lahir *</label>
								<input type="text" name="tempat" class="form-control"
									maxlength="100" data-rule-required="true" data-msg-required="Tempat lahir masih kosong, silakan isi">
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-12">
								<label>Tanggal Lahir *</label>
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" name="tanggal" class="form-control"
										id="datepicker" data-rule-required="true" data-msg-required="Tanggal lahir masih kosong, silakan isi">
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-12">
								<label>Jenis Kelamin *</label>
								<select name="jk" class="form-control" data-rule-required="true" data-msg-required="Jenis kelamin belum dipilih, pilih salah satu">
									<option value="">-- Pilih --</option>
									<option value="1">Laki - laki</option>
									<option value="2">Perempuan</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-12">
								<label>Status Perkawinan *</label>
								<select name="status" class="form-control" data-rule-required="true" data-msg-required="Status perkawinan belum dipilih, pilih salah satu">
									<option value="">-- Pilih --</option>
									<option value="1">Belum Kawin
									</option>
									<option value="2">Kawin</option>
									<option value="3">Cerai Hidup
									</option>
									<option value="4">Cerai Mati
									</option>
									<option value="5">Tidak Tahu
									</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-12">
								<label>Alamat *</label>
								<input type="text" name="alamat" class="form-control"
									maxlength="100" data-rule-required="true" data-msg-required="Alamat masih kosong, silakan isi">
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-12">
								<label>Rt *</label>
								<input type="text" name="rt" class="form-control"
									maxlength="11" data-rule-required="true" data-msg-required="RT masih kosong, silakan isi">
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-12">
								<label>Rw *</label>
								<input type="text" name="rw" class="form-control"
									maxlength="11" data-rule-required="true" data-msg-required="RW masih kosong, silakan isi">
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-12">
								<label>Nama Kecamatan *</label>
								<select class="form-control" name="kecamatan" id="kecamatan" data-rule-required="true" data-msg-required="Kecamatan belum dipilih, pilih salah satu">
									<option value="">- Pilih -</option>
									<?php foreach($kecamatan as $row):?>
									<option value="<?php echo $row->id_kecamatan;?>"><?php echo $row->nama_kecamatan;?>
									</option>
									<?php endforeach;?>
								</select>
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-12">
								<label>Nama Desa *</label>
								<select class="form-control" id="desa" name="desa" data-rule-required="true" data-msg-required="Desa belum dipilih, pilih salah satu">
									<option>- Pilih -</option>

								</select>
							</div>
						</div>


					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Save changes</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Select2 -->
<script src="<?=base_url()?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- bootstrap datepicker -->
<script src="<?=base_url()?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url();?>/assets/backend/js/plugin/jquery.validate.js"></script>

<script>
$(function () {

	//Date picker
	$('#datepicker').datepicker({
		autoclose: true,
		format: 'dd/mm/yyyy'
	})

	$(function () {
		//Initialize Select2 Elements
		$('.select2').select2()
	})

	$('#kecamatan').change(function () {
		var id = $(this).val();
		$.ajax({
			url: "<?php echo site_url('Usulan/get_desa');?>",
			method: "POST",
			data: {
				id: id
			},
			async: true,
			dataType: 'json',
			success: function (data) {

				var html = '';
				var i;
				for (i = 0; i < data.length; i++) {
					html += '<option value=' + data[i].id_desa + '>' + data[i]
						.nama_desa + '</option>';
				}
				$('#desa').html(html);

			}
		});
		return false;
	});
})

$("#data-diri").validate({
	onkeyup: false,
})

</script>