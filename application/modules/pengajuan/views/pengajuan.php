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
	<link rel="stylesheet"
		href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	<link rel="stylesheet"
		href="<?=base_url();?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
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

					<div class="collapse navbar-collapse pull-left" id="navbar-collapse">
						<!-- <ul class="nav navbar-nav">
							<li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
							<li><a href="#">Link</a></li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span
										class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="#">Action</a></li>
									<li><a href="#">Another action</a></li>
									<li><a href="#">Something else here</a></li>
									<li class="divider"></li>
									<li><a href="#">Separated link</a></li>
									<li class="divider"></li>
									<li><a href="#">One more separated link</a></li>
								</ul>
							</li>
						</ul> -->
						<form method="post" action="<?=base_url('pengajuan/search');?>" class="navbar-form navbar-left" role="search">
							<div class="form-group">
							<input type="text" class="form-control form-control-user" id="search_nik"
												name="search_nik" placeholder="Cek NIK" minlength="3" maxlength="18">
							</div>
						</form>
					</div>

					<div class="navbar-custom-menu">
						<ul class="nav navbar-nav">
							<!-- User Account Menu -->
							<li class="dropdown user user-menu">
								<!-- Menu Toggle Button -->
								<a href="<?=base_url('auth');?>">
									<!-- The user image in the navbar-->
									<img src="<?=base_url();?>assets/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
									<!-- hidden-xs hides the username on small devices so only the image appears. -->
									<span class="hidden-xs">Dashboard</span>
								</a>
							</li>
						</ul>
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
					<?= $this->session->flashdata('message');?>
				</section>

				<!-- Main content -->
				<section class="content">

					<form method="post" id="form-pengajuan" name="form-pengajuan"
						action="<?=site_url('pengajuan/submit')?>" enctype="multipart/form-data">
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
											<input type="text" class="form-control form-control-user" id="email"
												name="email" placeholder="Masukkan Email" data-rule-required="true"
												data-rule-email="true"
												data-msg-required="Email masih kosong, silakan isi"
												data-msg-email="Email tidak valid">
										</div>
										<div class="form-group">
											<label>Nama</label>
											<input type="text" class="form-control form-control-user" id="nama"
												name="nama" placeholder="Masukkan Nama" data-rule-required="true"
												data-rule-minlength="4" data-rule-maxlength="100"
												data-msg-required="Nama masih kosong, silakan isi"
												data-msg-minlength="Nama minimal 4 karakter"
												data-msg-maxlength="Nama maksimal 100 karakter">
										</div>
										<div class="form-group">
											<label>NIK</label>
											<input type="number" class="form-control form-control-user" id="nik"
												name="nik" placeholder="Masukkan NIK" data-rule-required="true"
												data-rule-minlength="4" data-rule-maxlength="20"
												data-msg-required="NIK masih kosong, silakan isi"
												data-msg-minlength="NIK minimal 4 karakter"
												data-msg-maxlength="NIK maksimal 20 karakter">
										</div>
										<div class="form-group">
											<label>Umur</label>
											<input type="number" class="form-control form-control-user" id="umur"
												name="umur" placeholder="Masukkan Umur" data-rule-required="true"
												data-rule-maxlength="100"
												data-msg-required="Umur masih kosong, silakan isi"
												data-msg-maxlength="Umur maksimal 20 karakter">
										</div>
										<div class="form-group">
											<label>Jenis Kelamin</label>
											<select name="jenis_kelamin" id="jenis_kelamin" class="form-control"
												data-rule-required="true"
												data-msg-required="Jenis Kelamin belum dipilih, pilih salah satu">
												<option value="">- Pilih -</option>
												<option value="Laki - laki">Laki - laki</option>
												<option value="Perempuan">Perempuan</option>
											</select>
										</div>
										<div class="form-group">
											<label>Alamat Lengkap</label>
											<input type="text" class="form-control form-control-user" id="alamat"
												name="alamat" placeholder="Masukkan Alamat" data-rule-required="true"
												data-rule-minlength="4" data-rule-maxlength="100"
												data-msg-required="Alamat masih kosong, silakan isi"
												data-msg-minlength="Alamat minimal 4 karakter"
												data-msg-maxlength="Alamat maksimal 100 karakter">
										</div>
										<div class="form-group">
											<label>Agama</label>
											<select name="agama" id="agama" class="form-control"
												data-rule-required="true"
												data-msg-required="Agama belum dipilih, pilih salah satu">
												<option value="">- Pilih -</option>
												<option value="ISLAM">ISLAM</option>
												<option value="KRISTEN">KRISTEN</option>
												<option value="KATHOLIK">KATHOLIK</option>
												<option value="HINDU">HINDU</option>
												<option value="BUDDHA">BUDDHA</option>
												<option value="KHONGHUCHU">KHONGHUCHU</option>
											</select>
										</div>
										<div class="form-group">
											<label>Anak ke (Jumlah Saudara)</label>
											<input type="number" class="form-control form-control-user" id="anak_ke"
												name="anak_ke" placeholder="Masukkan Status anak"
												data-rule-required="true" data-rule-maxlength="20"
												data-msg-required="Status anak masih kosong, silakan isi"
												data-msg-maxlength="Status anak maksimal 20 karakter">
										</div>
										<div class="form-group">
											<label>Pendidikan Terakhir</label>
											<select name="pendidikan_terakhir" id="pendidikan_terakhir"
												class="form-control" data-rule-required="true"
												data-msg-required="Pendidikan Terakhir belum dipilih, pilih salah satu">
												<option value="">- Pilih -</option>
												<option value="SD">SD</option>
												<option value="SMP">SMP</option>
												<option value="SMA">SMA</option>
												<option value="D3">D3</option>
												<option value="S1/D4">S1/D4</option>
												<option value="S2">S2</option>
												<option value="S3">S3</option>
											</select>
										</div>
										<div class="form-group">
											<label>Status Pernikahan</label>
											<select name="status_pernikahan" id="status_pernikahan" class="form-control"
												data-rule-required="true"
												data-msg-required="Status Pernikahan belum dipilih, pilih salah satu">
												<option value="">- Pilih -</option>
												<option value="kawin">kawin</option>
												<option value="belum kawin">belum kawin</option>
												<option value="cerai hidup">cerai hidup</option>
												<option value="cerai mati">cerai mati</option>
											</select>
										</div>
										<div class="form-group">
											<label>Pekerjaan</label>
											<select name="pekerjaan" id="pekerjaan" class="form-control"
												data-rule-required="true"
												data-msg-required="Pekerjaan belum dipilih, pilih salah satu">
												<option value="">- Pilih -</option>
												<option value="PEGAWAI NEGERI">PEGAWAI NEGERI</option>
												<option value="PEGAWAI SWASTA">PEGAWAI SWASTA</option>
												<option value="BURUH / TANI">BURUH / TANI</option>
												<option value="MAHASISWA / PELAJAR">MAHASISWA / PELAJAR</option>
												<option value="TNI / POLRI">TNI / POLRI</option>
												<option value="IBU RUMAH TANGGA">IBU RUMAH TANGGA</option>
												<option value="LAINNYA">LAINNYA</option>
											</select>
										</div>
										<div class="form-group">
											<label>Jenis layanan yang pernah diterima</label>
											<select name="jenis_layanan_diterima" id="jenis_layanan_diterima"
												class="form-control" data-rule-required="true"
												data-msg-required="Jenis layanan belum dipilih, pilih salah satu">
												<option value="">- Pilih -</option>
												<option value="PKH">PKH</option>
												<option value="KIS">KIS</option>
												<option value="ALAT BANTU">ALAT BANTU</option>
												<option value="BPNT">BPNT</option>
												<option value="KIP">KIP</option>
												<option value="DTKS">DTKS</option>
												<option value="LAINNYA">LAINNYA</option>
											</select>
										</div>
										<div class="form-group jenis_layanan_lainnya">
											<input type="text" class="form-control form-control-user"
												id="jenis_layanan_lainnya" name="jenis_layanan_lainnya"
												placeholder="Masukkan Jenis layanan" data-rule-required="true"
												data-rule-minlength="4" data-rule-maxlength="100"
												data-msg-required="Jenis layanan masih kosong, silakan isi"
												data-msg-minlength="Jenis layanan minimal 4 karakter"
												data-msg-maxlength="Jenis layanan maksimal 100 karakter">
										</div>
										<div class="form-group">
											<label>Jenis kedisabilitasan</label>
											<select name="jenis_kedisabilitasan" id="jenis_kedisabilitasan"
												class="form-control" data-rule-required="true"
												data-msg-required="Jenis kedisabilitasan belum dipilih, pilih salah satu">
												<option value="">- Pilih -</option>
												<option value="Disabilitas Sensorik">Disabilitas Sensorik</option>
												<option value="Disabilitas Fisik">Disabilitas Fisik</option>
												<option value="Disabilitas INtelektual">Disabilitas INtelektual</option>
												<option value="Disabilitas Mental">Disabilitas Mental</option>
											</select>
										</div>
										<div class="form-group">
											<label>No Telepon / HP</label>
											<input type="number" class="form-control form-control-user" id="no_telepon"
												name="no_telepon" placeholder="Masukkan No telepon / HP"
												data-rule-required="true" data-rule-minlength="9"
												data-rule-maxlength="20"
												data-msg-required="No telepon / HP masih kosong, silakan isi"
												data-msg-minlength="No telepon / HP minimal 9 karakter"
												data-msg-maxlength="No telepon / HP maksimal 20 karakter">
										</div>
										<div class="form-group">
											<label>Program Rehabilitasi / Pelatihan (yang pernah diikuti)</label>
											<input type="text" class="form-control form-control-user"
												id="program_rehabilitasi" name="program_rehabilitasi"
												placeholder="Masukkan Program Rehabilitasi" data-rule-required="true"
												data-rule-minlength="4" data-rule-maxlength="20"
												data-msg-required="Program Rehabilitasi masih kosong, silakan isi"
												data-msg-minlength="Program Rehabilitasi minimal 4 karakter"
												data-msg-maxlength="Program Rehabilitasi maksimal 20 karakter">
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
											<input type="text" class="form-control form-control-user" id="nama_wali"
												name="nama_wali" placeholder="Masukkan Nama Wali"
												data-rule-required="true" data-rule-minlength="4"
												data-rule-maxlength="100"
												data-msg-required="Nama Wali masih kosong, silakan isi"
												data-msg-minlength="Nama Wali minimal 4 karakter"
												data-msg-maxlength="Nama Wali maksimal 100 karakter">
										</div>
										<div class="form-group">
											<label>Alamat Wali</label>
											<input type="text" class="form-control form-control-user" id="alamat_wali"
												name="alamat_wali" placeholder="Masukkan Alamat Wali"
												data-rule-required="true" data-rule-minlength="4"
												data-rule-maxlength="100"
												data-msg-required="Alamat Wali masih kosong, silakan isi"
												data-msg-minlength="Alamat Wali minimal 4 karakter"
												data-msg-maxlength="Alamat Wali maksimal 100 karakter">
										</div>
										<div class="form-group">
											<label>Pekerjaan</label>
											<select name="pekerjaan_wali" id="pekerjaan_wali" class="form-control"
												data-rule-required="true"
												data-msg-required="Pekerjaan belum dipilih, pilih salah satu">
												<option value="">- Pilih -</option>
												<option value="PEGAWAI NEGERI">PEGAWAI NEGERI</option>
												<option value="PEGAWAI SWASTA">PEGAWAI SWASTA</option>
												<option value="BURUH / TANI">BURUH / TANI</option>
												<option value="MAHASISWA / PELAJAR">MAHASISWA / PELAJAR</option>
												<option value="TNI / POLRI">TNI / POLRI</option>
												<option value="IBU RUMAH TANGGA">IBU RUMAH TANGGA</option>
												<option value="LAINNYA">LAINNYA</option>
											</select>
										</div>
										<div class="form-group">
											<label>Penghasilan</label>
											<input type="number" class="form-control form-control-user" id="penghasilan"
												name="penghasilan" placeholder="Masukkan Penghasilan"
												data-rule-required="true" data-rule-minlength="4"
												data-rule-maxlength="20"
												data-msg-required="Penghasilan masih kosong, silakan isi"
												data-msg-minlength="Penghasilan minimal 4 karakter"
												data-msg-maxlength="Penghasilan maksimal 20 karakter">
										</div>
										<div class="form-group">
											<label>Agama</label>
											<select name="agama_wali" id="agama_wali" class="form-control"
												data-rule-required="true"
												data-msg-required="Agama belum dipilih, pilih salah satu">
												<option value="">- Pilih -</option>
												<option value="ISLAM">ISLAM</option>
												<option value="KRISTEN">KRISTEN</option>
												<option value="KATHOLIK">KATHOLIK</option>
												<option value="HINDU">HINDU</option>
												<option value="BUDDHA">BUDDHA</option>
												<option value="KHONGHUCHU">KHONGHUCHU</option>
											</select>
										</div>
										<div class="form-group">
											<label>Jumlah Tanggungan Anak / Keluarga</label>
											<input type="number" class="form-control form-control-user" id="jumlah_anak"
												name="jumlah_anak" placeholder="Masukkan Jumlah tanggungan anak"
												data-rule-required="true" data-rule-maxlength="20"
												data-msg-required="Jumlah tanggungan anak masih kosong, silakan isi"
												data-msg-maxlength="Jumlah tanggungan anak maksimal 20 karakter">
										</div>
										<div class="form-group">
											<label>Nomor HP Ayah / Ibu</label>
											<input type="number" class="form-control form-control-user" id="nohp_wali"
												name="nohp_wali" placeholder="Masukkan Nomor HP"
												data-rule-required="true" data-rule-maxlength="20"
												data-msg-required="Nomor HP masih kosong, silakan isi"
												data-msg-maxlength="Nomor HP maksimal 20 karakter">
										</div>
										<div class="form-group">
											<label>Hubungan dengan PPKS</label>
											<input type="text" class="form-control form-control-user" id="hubungan_ppks"
												name="hubungan_ppks" placeholder="Masukkan Hubungan dengan ppks"
												data-rule-required="true" data-rule-minlength="4"
												data-rule-maxlength="20"
												data-msg-required="Hubungan dengan ppks masih kosong, silakan isi"
												data-msg-minlength="Hubungan dengan ppks minimal 4 karakter"
												data-msg-maxlength="Hubungan dengan ppks maksimal 20 karakter">
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
											<select name="jenis_layanan" id="jenis_layanan" class="form-control"
												data-rule-required="true"
												data-msg-required="Jenis Layanan belum dipilih, pilih salah satu">
												<option value="">- Pilih -</option>
												<option value="kursi roda biasa">Kursi Roda Biasa / CP</option>
												<option value="kaki / tangan palsu">Kaki / Tangan Palsu</option>
												<option value="alat bantu dengar">Alat Bantu Dengar</option>
												<option value="sepatu avo">Sepatu AVO</option>
												<option value="wolker">Wolker</option>
												<option value="tongkat putih">Tongkat Putih</option>
												<option value="permakanan / nutrisi kebutuhan pokok">Permakanan /
													Nutrisi Kebutuhan Pokok</option>
												<option value="bimbingan pelatihan ketrampilan">Bimbingan Pelatihan
													Ketrampilan</option>
												<option value="rujukan ke balai rehsos / panti">Rujukan ke Balai Rehsos
													/ Panti</option>
											</select>
										</div>
										<div class="form-group file1_type">
											<label>File 1</label>
											<input type="file" class="form-control" id="ref_file1" name="ref_file1"
												data-rule-required="true"
												data-msg-required="Belum ada file untuk di upload">
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
				<strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All
				rights
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
					if (value == "kursi roda biasa" || value == "kaki / tangan palsu" || value ==
						"alat bantu dengar") {
						$('.file2_type').hide();
						$('.file3_type').hide();
						$('.file1_type').show();

					} else if (value == "sepatu avo") {
						$('.file1_type').hide();
						$('.file3_type').hide();
						$('.file2_type').show();

					} else if (value == "wolker") {
						$('.file1_type').hide();
						$('.file2_type').hide();
						$('.file3_type').show();

					} else if (value == "tongkat putih") {
						$('.file1_type').show();
						$('.file2_type').show();
						$('.file3_type').show();
					}

				})
			})

			$('.jenis_layanan_lainnya').hide();
			$('select[name=jenis_layanan_diterima]').change(function () {
				$("select[name=jenis_layanan_diterima] option:selected").each(function () {
					var value = $(this).val();
					if (value == "LAINNYA") {
						$('.jenis_layanan_lainnya').show();

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
