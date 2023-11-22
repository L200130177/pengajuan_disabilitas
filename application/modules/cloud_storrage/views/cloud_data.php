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
<?= $this->session->flashdata('message');?>
<div class="box">
	<div class="box-header">
		<!-- <h3 class="boc-title">Cek NIK</h3> -->
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-green">
					<div class="inner">
						<h3>KIS-PBI</h3>

						<p>Rekomendasi Kis</p>
					</div>
					<div class="icon">
						<i class="fa fa-credit-card"></i>
					</div>
					<a href="#" class="small-box-footer"  data-toggle="modal" data-target="#pbiModal">Klik disini <i
							class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-aqua">
					<div class="inner">
						<h3>PPKS</h3>

						<p>Disabilitas</p>
					</div>
					<div class="icon">
						<i class="fa fa-wheelchair"></i>
					</div>
					<a href="#" class="small-box-footer"  data-toggle="modal" data-target="#ppksModal">Klik disini <i
							class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
            <form method="post" id="form-nik-pbi" name="form-nik-pbi" action="<?=site_url('cloud_storrage/upload_old')?>" enctype="multipart/form-data">
            <div class="form-group">
                  <label for="exampleInputFile">File input</label>
                  <input type="text" id="nama_lengkap" name="nama_lengkap">
                  <input type="file" id="ref_file1" name="ref_file1">
				  <input type="file" id="ref_file2" name="ref_file2">
                  <p class="help-block">Example block-level help text here.</p>
                </div>
                <button type="submit" id="uploadfile" class="btn btn-primary">Cek Data</button>
				<a href="http://103.169.233.45:9000/dinsos/November-2023/6554e455cd55e_nathan/6554e455cd56c_wallpaperflare.com_wallpaper (1).jpg">download file </a>
</form>
		</div>
	</div>
</div>


<!-- -- PBI MODAL -- -->
<div class="modal fade" id="pbiModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Cek NIK yang diusulkan</h4>
			</div>
			<form method="post" id="form-nik-pbi" name="form-nik-pbi" action="<?=site_url('dashboard/cek_nik_pbi')?>" enctype="multipart/form-data">
			<div class="modal-body">
				<div class="row">
						<div class="col-md-12">
						<div class="form-group">
							<label>NIK KIS PBI</label>
							<input type="number" class="form-control no-arrow" id="nik_pbi" name="nik_pbi" placeholder="Masukkan NIK" data-rule-required="true" data-rule-minlength="16" data-rule-maxlength="20" data-msg-required="NIK masih kosong, silakan isi" data-msg-minlength="NIK minimal 16 karakter" data-msg-maxlength="NIK maksimal 20 karakter">
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
				<button type="submit" id="kispbi" class="btn btn-primary">Cek Data</button>
			</div>
			</form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!-- -- PPKS MODAL -- -->
<div class="modal fade" id="ppksModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Cek NIK yang diusulkan</h4>
			</div>
			<form method="post" id="form-nik-ppks" name="form-nik-ppks" action="<?=site_url('dashboard/cek_nik_ppks')?>" enctype="multipart/form-data">
			<div class="modal-body">
				<div class="row">
						<div class="col-md-12">
						<div class="form-group">
							<label>NIK PPKS</label>
							<input type="number" class="form-control no-arrow" id="nik_ppks" name="nik_ppks"  placeholder="Masukkan NIK" data-rule-required="true" data-rule-minlength="16" data-rule-maxlength="20" data-msg-required="NIK masih kosong, silakan isi" data-msg-minlength="NIK minimal 16 karakter" data-msg-maxlength="NIK maksimal 20 karakter">
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Cek Data</button>
			</div>
			</form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- <div id="result" class="warning">Please login!</div> -->

<script src="<?php echo base_url();?>/assets/backend/js/plugin/jquery.validate.js"></script>
<script>
	$("#form-nik-pbi").validate({
		onkeyup: false,
	})

	$("#form-nik-ppks").validate({
		onkeyup: false,
	})
</script>