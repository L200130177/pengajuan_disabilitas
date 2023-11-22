<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Pengajuan Bantuan</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="<?=base_url();?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?=base_url();?>assets/bower_components/font-awesome/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="<?=base_url();?>assets/bower_components/Ionicons/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?=base_url();?>assets/dist/css/adminlte.min.css">
	<link rel="stylesheet" href="<?=base_url();?>assets/dist/css/skins/_all-skins.min.css">
	<!-- Google Font -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	<link rel="stylesheet" href="<?=base_url();?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
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
</head>

<body class="hold-transition skin-blue layout-top-nav">
	<div class="wrapper">

		<header class="main-header">
			<nav class="navbar navbar-static-top">
				<div class="container">
					<div class="navbar-header">
						<a href="#" class="navbar-brand"><b>Pengajuan Bantuan</b></a>
					</div>

				</div>
				<!-- /.container-fluid -->
			</nav>
		</header>
		<!-- Full Width Column -->
		<div class="content-wrapper">
			<div class="container">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>
						Pengajuan Bantuan
						<small>Dinas Sosial</small>
					</h1>
				</section>

				<!-- Main content -->
				<section class="content">
				
					<form method="post" id="form-pengajuan" name="form-pengajuan" action="<?=site_url('pengajuan/submit')?>" enctype="multipart/form-data">
						<div class="box box-default">
							<div class="box-header with-border">
							<h3 class="box-title">Identitas Penerima Manfaat</h3>

							<!-- <div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
							</div> -->
							</div>
							<!-- /.box-header -->
							<div class="box-body">
							<div class="row">
								<div class="col-md-12">
								<div class="form-group">
									<label>Email</label>
									<input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Masukkan Email" data-rule-required="true" data-rule-email="true" data-msg-required="Email masih kosong, silakan isi" data-msg-email="Email tidak valid">
								</div>
								<div class="form-group">
									<label>Nama</label>
									<input type="text" class="form-control form-control-user" id="nama" name="nama" placeholder="Masukkan Nama" data-rule-required="true" data-rule-minlength="4" data-rule-maxlength="100" data-msg-required="Nama masih kosong, silakan isi" data-msg-minlength="Nama minimal 4 karakter" data-msg-maxlength="Nama maksimal 100 karakter">
								</div>
								<div class="form-group">
									<label>NIK</label>
									<input type="number" class="form-control form-control-user" id="nik" name="nik" placeholder="Masukkan NIK" data-rule-required="true" data-rule-minlength="4" data-rule-maxlength="20" data-msg-required="NIK masih kosong, silakan isi" data-msg-minlength="NIK minimal 4 karakter" data-msg-maxlength="NIK maksimal 20 karakter">
								</div>
								<div class="form-group">
									<label>Umur</label>
									<input type="number" class="form-control form-control-user" id="umur" name="umur" placeholder="Masukkan Umur" data-rule-required="true" data-rule-maxlength="100" data-msg-required="Umur masih kosong, silakan isi" data-msg-maxlength="Umur maksimal 20 karakter">
								</div>
								<div class="form-group">
									<label>Jenis Kelamin</label>
									<select name="jenis_kelamin" id="jenis_kelamin" class="form-control" data-rule-required="true" data-msg-required="Jenis Kelamin belum dipilih, pilih salah satu">
										<option value="">- Pilih -</option>
										<option value="Laki - laki">Laki - laki</option>
										<option value="Perempuan">Perempuan</option>
									</select>
								</div>
								<div class="form-group">
									<label>Alamat Lengkap</label>
									<input type="text" class="form-control form-control-user" id="alamat" name="alamat" placeholder="Masukkan Alamat" data-rule-required="true" data-rule-minlength="4" data-rule-maxlength="100" data-msg-required="Alamat masih kosong, silakan isi" data-msg-minlength="Alamat minimal 4 karakter" data-msg-maxlength="Alamat maksimal 100 karakter">
								</div>
								<div class="form-group">
									<label>Agama</label>
									<input type="text" class="form-control form-control-user" id="agama" name="agama" placeholder="Masukkan Agama" data-rule-required="true" data-rule-minlength="4" data-rule-maxlength="100" data-msg-required="Agama masih kosong, silakan isi" data-msg-minlength="Agama minimal 4 karakter">
								</div>
								<div class="form-group">
									<label>Anak ke (Jumlah Saudara)</label>
									<input type="number" class="form-control form-control-user" id="anak_ke" name="anak_ke" placeholder="Masukkan Status anak" data-rule-required="true" data-rule-maxlength="20" data-msg-required="Status anak masih kosong, silakan isi" data-msg-maxlength="Status anak maksimal 20 karakter">
								</div>
								<div class="form-group">
									<label>Pendidikan Terakhir</label>
									<input type="text" class="form-control form-control-user" id="pendidikan_terakhir" name="pendidikan_terakhir" placeholder="Masukkan Pendidikan terakhir" data-rule-required="true" data-rule-maxlength="100" data-msg-required="Pendidikan terakhir masih kosong, silakan isi" data-msg-maxlength="Pendidikan terakhir maksimal 100 karakter">
								</div>
								<div class="form-group">
									<label>Status Pernikahan</label>
									<input type="text" class="form-control form-control-user" id="status_pernikahan" name="status_pernikahan" placeholder="Masukkan Status pernikahan" data-rule-required="true" data-rule-minlength="4" data-rule-maxlength="20" data-msg-required="Status pernikahan masih kosong, silakan isi" data-msg-minlength="Status pernikahan minimal 4 karakter" data-msg-maxlength="Status pernikahan maksimal 20 karakter">
								</div>
								<div class="form-group">
									<label>Pekerjaan</label>
									<input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Masukkan Username" data-rule-required="true" data-rule-minlength="4" data-rule-maxlength="20" data-msg-required="Username masih kosong, silakan isi" data-msg-minlength="Username minimal 4 karakter" data-msg-maxlength="Username maksimal 20 karakter">
								</div>
								<div class="form-group">
									<label>Jaminan Sosial (BPJS / KIS / Jamkesda)</label>
									<input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Masukkan Username" data-rule-required="true" data-rule-minlength="4" data-rule-maxlength="20" data-msg-required="Username masih kosong, silakan isi" data-msg-minlength="Username minimal 4 karakter" data-msg-maxlength="Username maksimal 20 karakter">
								</div>
								<div class="form-group">
									<label>Jenis Kedisabilitasan</label>
									<input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Masukkan Username" data-rule-required="true" data-rule-minlength="4" data-rule-maxlength="20" data-msg-required="Username masih kosong, silakan isi" data-msg-minlength="Username minimal 4 karakter" data-msg-maxlength="Username maksimal 20 karakter">
								</div>
								<div class="form-group">
									<label>No Telepon / HP</label>
									<input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Masukkan Username" data-rule-required="true" data-rule-minlength="4" data-rule-maxlength="20" data-msg-required="Username masih kosong, silakan isi" data-msg-minlength="Username minimal 4 karakter" data-msg-maxlength="Username maksimal 20 karakter">
								</div>
								<div class="form-group">
									<label>Program Rehabilitasi / Pelatihan (yang pernah diikuti)</label>
									<input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Masukkan Username" data-rule-required="true" data-rule-minlength="4" data-rule-maxlength="20" data-msg-required="Username masih kosong, silakan isi" data-msg-minlength="Username minimal 4 karakter" data-msg-maxlength="Username maksimal 20 karakter">
								</div>
								</div>
							</div>
							</div>
						</div>

						<div class="box box-default">
							<div class="box-header with-border">
							<h3 class="box-title">Identitas Keluarga (Orang tua / Wali)</h3>

							<!-- <div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
							</div> -->
							</div>
							<!-- /.box-header -->
							<div class="box-body">
							<div class="row">
								<div class="col-md-12">
								<div class="form-group">
									<label>Nama Wali</label>
									<input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Masukkan Username" data-rule-required="true" data-rule-minlength="4" data-rule-maxlength="20" data-msg-required="Username masih kosong, silakan isi" data-msg-minlength="Username minimal 4 karakter" data-msg-maxlength="Username maksimal 20 karakter">
								</div>
								<div class="form-group">
									<label>Alamat Wali</label>
									<input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Masukkan Username" data-rule-required="true" data-rule-minlength="4" data-rule-maxlength="20" data-msg-required="Username masih kosong, silakan isi" data-msg-minlength="Username minimal 4 karakter" data-msg-maxlength="Username maksimal 20 karakter">
								</div>
								<div class="form-group">
									<label>Pekerjaan</label>
									<input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Masukkan Username" data-rule-required="true" data-rule-minlength="4" data-rule-maxlength="20" data-msg-required="Username masih kosong, silakan isi" data-msg-minlength="Username minimal 4 karakter" data-msg-maxlength="Username maksimal 20 karakter">
								</div>
								<div class="form-group">
									<label>Penghasilan</label>
									<input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Masukkan Username" data-rule-required="true" data-rule-minlength="4" data-rule-maxlength="20" data-msg-required="Username masih kosong, silakan isi" data-msg-minlength="Username minimal 4 karakter" data-msg-maxlength="Username maksimal 20 karakter">
								</div>
								<div class="form-group">
									<label>Agama</label>
									<input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Masukkan Username" data-rule-required="true" data-rule-minlength="4" data-rule-maxlength="20" data-msg-required="Username masih kosong, silakan isi" data-msg-minlength="Username minimal 4 karakter" data-msg-maxlength="Username maksimal 20 karakter">
								</div>
								<div class="form-group">
									<label>Jml Tanggungan Anak / Keluarga</label>
									<input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Masukkan Username" data-rule-required="true" data-rule-minlength="4" data-rule-maxlength="20" data-msg-required="Username masih kosong, silakan isi" data-msg-minlength="Username minimal 4 karakter" data-msg-maxlength="Username maksimal 20 karakter">
								</div>
								<div class="form-group">
									<label>Nomor HP Ayah / Ibu</label>
									<input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Masukkan Username" data-rule-required="true" data-rule-minlength="4" data-rule-maxlength="20" data-msg-required="Username masih kosong, silakan isi" data-msg-minlength="Username minimal 4 karakter" data-msg-maxlength="Username maksimal 20 karakter">
								</div>
								<div class="form-group">
									<label>Hubungan dengan PPKS</label>
									<input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Masukkan Username" data-rule-required="true" data-rule-minlength="4" data-rule-maxlength="20" data-msg-required="Username masih kosong, silakan isi" data-msg-minlength="Username minimal 4 karakter" data-msg-maxlength="Username maksimal 20 karakter">
								</div>
								</div>
							</div>
							</div>
						</div>

						<div class="box box-default">
							<div class="box-header with-border">
							<h3 class="box-title">Jenis Layanan</h3>

							<!-- <div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
							</div> -->
							</div>
							<!-- /.box-header -->
							<div class="box-body">
							<div class="row">
								<div class="col-md-12">
								<div class="form-group">
									<label></label>
									<select name="jenis_layanan" id="jenis_layanan" class="form-control" data-rule-required="true" data-msg-required="Jenis Layanan belum dipilih, pilih salah satu">
										<option value="">- Pilih -</option>
										<option value="kursi roda biasa">Kursi Roda Biasa / CP</option>
										<option value="kaki / tangan palsu">Kaki / Tangan Palsu</option>
										<option value="alat bantu dengar">Alat Bantu Dengar</option>
										<option value="sepatu avo">Sepatu AVO</option>
										<option value="wolker">Wolker</option>
										<option value="tongkat putih">Tongkat Putih</option>
										<option value="permakanan / nutrisi kebutuhan pokok">Permakanan / Nutrisi Kebutuhan Pokok</option>
										<option value="bimbingan pelatihan ketrampilan">Bimbingan Pelatihan Ketrampilan</option>
										<option value="rujukan ke balai rehsos / panti">Rujukan ke Balai Rehsos / Panti</option>
									</select>
								</div>
								<div class="form-group file1_type">
									<label>File 1</label>
									<input type="file" class="form-control" id="ref_file1" name="ref_file1">
								</div>
								<div class="form-group file2_type">
									<label>File 2</label>
									<input type="file" class="form-control" id="ref_file2" name="ref_file2">
								</div>
								<div class="form-group file3_type">
									<label>File 3</label>
									<input type="file" class="form-control" id="ref_file3" name="ref_file3">
								</div>
								</div>
							</div>
							</div>
						</div>
						<button type="submit" class="btn btn-primary btn-block btn-flat">Simpan Data</button>

					</form>

				</section>
				<!-- /.content -->
			</div>
			<!-- /.container -->
		</div>
		<!-- /.content-wrapper -->
		<footer class="main-footer">
			<div class="container">
				<div class="pull-right hidden-xs">
					<b>Version</b> 2.4.0
				</div>
				<strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
				reserved.
			</div>
			<!-- /.container -->
		</footer>
	</div>
	<!-- ./wrapper -->

	<!-- jQuery 3 -->
	<script src="<?=base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>
	<!-- Bootstrap 3.3.7 -->
	<script src="<?=base_url();?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- SlimScroll -->
	<script src="<?=base_url();?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<!-- FastClick -->
	<script src="<?=base_url();?>assets/bower_components/fastclick/lib/fastclick.js"></script>
	<!-- AdminLTE App -->
	<script src="<?=base_url();?>assets/dist/js/adminlte.min.js"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="<?=base_url();?>assets/dist/js/demo.js"></script>
	<script src="<?php echo base_url();?>/assets/backend/js/plugin/jquery.validate.js"></script>
	<script src="<?php echo base_url();?>/assets/backend/js/plugin/additional-methods.min.js"></script>
	<script>
		$(document).ready(function () {
			$('.file1_type').hide();
			$('.file2_type').hide();
			$('.file3_type').hide();
			$('select[name=jenis_layanan]').change(function () {
				$("select[name=jenis_layanan] option:selected").each(function () {
				var value = $(this).val();
				if(value == "kursi roda biasa" || value == "kaki / tangan palsu" || value == "alat bantu dengar") {
					$('.file2_type').hide();
					$('.file3_type').hide();
					$('.file1_type').show();
				
				} else if(value == "sepatu avo") {
					$('.file1_type').hide();
					$('.file3_type').hide();
					$('.file2_type').show();
				
				} else if(value == "wolker") {
					$('.file1_type').hide();
					$('.file2_type').hide();
					$('.file3_type').show();
				
				} else if(value == "tongkat putih") {
					$('.file1_type').show();
					$('.file2_type').show();
					$('.file3_type').show();
				}

			})
			
		})
		$("#form-pengajuan").validate({
		onkeyup: false,
		})
	})
	</script>
</body>

</html>
