<link rel="stylesheet" href="<?php echo base_url();?>assets/backend/css/plugin/screen.css">
<div class="box">         
	<div class="box-body">

		<div class="container">
			<div class="container-page">
				<div class="row form-kuisioner">
					<hr>
					<form method="POST" id="form-kuesioner" action="<?=site_url('kuesioner/submit')?>" role="form">

						<!-- <label for="1">NIK </label>  -->
						<!-- <table class="table table-striped" border="0"> -->
						<tr>
							<td width="200px"><label><input type="text" name="nik"
										value="<?= $nik; ?>" readonly>
								</label></td>
						</tr>
						<!-- </table> -->
						<div class="col-md-5">
							<h4 for="1"><span class="label label-default kuesioner">1. Jumlah KK dalam 1 (satu) Rumah</span>
							</h4>
							<table class="table table-striped" border="0">
								<tr>
									<td width="200px">
										<label>
											<input type="radio" name="k1" value="1"> >3 KK
											&nbsp
										</label>
									</td>
									<td width="200px"><label><input type="radio" name="k1" value="2"> 3
											KK</label></td>
								</tr>
								<tr>
									<td width="200px"><label><input type="radio" name="k1" value="3"> 2
											KK</label></td>
									<td width="200px"><label><input type="radio" name="k1" value="4"> 1
											KK</label></td>
								</tr>
							</table>
							<h4 for="2"><span class="label label-default kuesioner">2. Jumlah Anggota Keluarga dalam 1 (satu)
									Rumah</span></h4>
							<table class="table table-striped" border="0">
								<tr>
									<td width="200px"><label><input type="radio" name="k2" value="1" > => 6
											Orang &nbsp</label></td>
									<td width="200px"><label><input type="radio" name="k2" value="2" > 5 Orang
										</label></td>
								</tr>
								<tr>
									<td width="200px"><label><input type="radio" name="k2" value="3" > 4
											Orang</label></td>
									<td width="200px"><label><input type="radio" name="k2" value="4" > 1 - 3
											Orang</label></td>
								</tr>
							</table>
							<h4 for="3"><span class="label label-default kuesioner">3. Pendidikan Kepala Keluarga (KK) </span>
							</h4>
							<table class="table table-striped" border="0">
								<tr>
									<td width="200px"><label><input type="radio" name="k3" value="1" > Tidak
											Sekolah / Tidak Tamat SD</label></td>
									<td width="200px"><label><input type="radio" name="k3" value="2" >
											SD</label></td>
								</tr>
								<tr>
									<td width="200px"><label><input type="radio" name="k3" value="3" >
											SMP</label></td>
									<td width="200px"><label><input type="radio" name="k3" value="4" >
											SMA/SMK/PT</label></td>
								</tr>
							</table>
							<h4 for="4"><span class="label label-default kuesioner">4. Jumlah Anggota Keluarga Masih Sekolah
									</span></h4>
							<table class="table table-striped" border="0">
								<tr>
									<td width="200px"><label><input type="radio" name="k4" value="1" > Tidak
											Ada</label></td>
									<td width="200px"><label><input type="radio" name="k4" value="2" > 1
											Orang</label></td>
								</tr>
								<tr>
									<td width="200px"><label><input type="radio" name="k4" value="3" > 2 - 3
											Orang</label></td>
									<td width="200px"><label><input type="radio" name="k4" value="4" > >3
											Orang</label></td>
								</tr>
							</table>
							<h4 for="5"><span class="label label-default kuesioner">5. Jumlah Anggota Keluarga Bekerja (termasuk
									KK) </span></h4>
							<table class="table table-striped" border="0">
								<tr>
									<td width="200px"><label><input type="radio" name="k5" value="1" > Tidak
											Ada</label></td>
									<td width="200px"><label><input type="radio" name="k5" value="2" > 1
											Orang</label></td>
								</tr>
								<tr>
									<td width="200px"><label><input type="radio" name="k5" value="3" > 2 - 3
											Orang</label></td>
									<td width="200px"><label><input type="radio" name="k5" value="4" > >3
											Orang</label></td>
								</tr>
							</table>
							<h4 for="6"><span class="label label-default kuesioner">6. Jenis Pekerjaan Tertinggi dalam
									Keluarga</span></h4>
							<table class="table table-striped" border="0">
								<tr>
									<td width="200px"><label><input type="radio" name="k6" value="1" > Buruh
											Serabutan</label></td>
									<td width="200px"><label><input type="radio" name="k6" value="2" > Petani
											Swasta / Pedagang</label></td>
								</tr>
								<tr>
									<td width="200px"><label><input type="radio" name="k6" value="3" > Karyawan
											/ Buruh tetap / Tukang</label></td>
									<td width="200px"><label><input type="radio" name="k6" value="4" > Pedagang
											Besar</label></td>
								</tr>
							</table>
							<h4 for="7"><span class="label label-default kuesioner">7. Pengeluaran satu Jiwa dalam Keluarga
									per-bulan</span></h4>
							<table class="table table-striped" border="0">
								<tr>
									<td width="200px"><label><input type="radio" name="k7" value="1" >
											< 400 ribu</label> </td> <td width="200px"><label><input type="radio"
														name="k7" value="2" > 400 - 700 ribu</label></td>
								</tr>
								<tr>
									<td width="200px"><label><input type="radio" name="k7" value="3" > 700 ribu
											- 1 Juta</label></td>
									<td width="200px"><label><input type="radio" name="k7" value="4" > > 1
											Juta</label></td>
								</tr>
							</table>
							<h4 for="8"><span class="label label-default kuesioner">8. Penghasilan satu Jiwa dalam Keluarga
									per-bulan</span></h4>
							<table class="table table-striped" border="0">
								<tr>
									<td width="200px"><label><input type="radio" name="k8" value="1" >
											< 400 ribu</label> </td> <td width="200px"><label><input type="radio"
														name="k8" value="2" > 400 - 700 ribu</label></td>
								</tr>
								<tr>
									<td width="200px"><label><input type="radio" name="k8" value="3" > 700 ribu
											- 1 Juta</label></td>
									<td width="200px"><label><input type="radio" name="k8" value="4" > > 1
											Juta</label></td>
								</tr>
							</table>
							<h4 for="9"><span class="label label-default kuesioner">9. Status Kepemilikan Rumah </span></h4>
							<table class="table table-striped" border="0">
								<tr>
									<td width="200px"><label><input type="radio" name="k9" value="1" > Magersari
											/ Pakai Gratis</label></td>
									<td width="200px"><label><input type="radio" name="k9" value="2" > Sewa < 1
												Juta</label> </td> </tr> <tr>
									<td width="200px"><label><input type="radio" name="k9" value="3" > Milik
											Orangtua / Warisan</label></td>
									<td width="200px"><label><input type="radio" name="k9" value="4" > Milik
											sendiri / sewa</label></td>
								</tr>
							</table>
							<h4 for="10"><span class="label label-default kuesioner">10. Luas Bangunan Rumah</span></h4>
							<table class="table table-striped" border="0">
								<tr>
									<td width="200px"><label><input type="radio" name="k10" value="1" >
											< 50 M2</label> </td> <td width="200px"><label><input type="radio"
														name="k10" value="2" > 50 - 75 M2</label></td>
								</tr>
								<tr>
									<td width="200px"><label><input type="radio" name="k10" value="3" > 75 - 100
											M2</label></td>
									<td width="200px"><label><input type="radio" name="k10" value="4" > > 100
											M2</label></td>
								</tr>
							</table>
							<h4 for="11"><span class="label label-default kuesioner">11. Pondasi Bangunan </span></h4>
							<table class="table table-striped" border="0">
								<tr>
									<td width="200px"><label><input type="radio" name="k11" value="1" > Tanpa
											Pondasi</label></td>
									<td width="200px"><label><input type="radio" name="k11" value="2" > Pondasi
											Tidak permanen</label></td>
								</tr>
								<tr>
									<td width="200px"><label><input type="radio" name="k11" value="3" > Batu
											Bata</label></td>
									<td width="200px"><label><input type="radio" name="k11" value="4" > Batu
											Kali / Gunung</label></td>
								</tr>
							</table>
							<h4 for="12"><span class="label label-default kuesioner">12. Bahan Rangka Atap Terluas</span></h4>
							<table class="table table-striped" border="0">
								<tr>
									<td width="200px"><label><input type="radio" name="k12" value="1" >
											Bambu</label></td>
									<td width="200px"><label><input type="radio" name="k12" value="2" > Kayu
											Tahun</label></td>
								</tr>
								<tr>
									<td width="200px"><label><input type="radio" name="k12" value="3" > Kayu
											Kalimantan</label></td>
									<td width="200px"><label><input type="radio" name="k12" value="4" > Kayu
											Jati / Baja Ringan</label></td>
								</tr>
							</table>
							<h4 for="13"><span class="label label-default kuesioner">13. Kondisi Atap</span></h4>
							<table class="table table-striped" border="0">
								<tr>
									<td width="200px"><label><input type="radio" name="k13" value="1" >
											Rusak</label></td>
									<td width="200px"><label><input type="radio" name="k13" value="2" >
											Sedang</label></td>
								</tr>
								<tr>
									<td width="200px"><label><input type="radio" name="k13" value="3" >
											Baik</label></td>
									<td width="200px"><label><input type="radio" name="k13" value="4" > Baik
											Sekali</label></td>
								</tr>
							</table>
							<h4 for="14"><span class="label label-default kuesioner">14. Penutup Atap Terluas</span></h4>
							<table class="table table-striped" border="0">
								<tr>
									<td width="200px"><label><input type="radio" name="k14" value="1" > Asbes /
											seng</label></td>
									<td width="200px"><label><input type="radio" name="k14" value="2" > Genteng
											Biasa</label></td>
								</tr>
								<tr>
									<td width="200px"><label><input type="radio" name="k14" value="3" > Genteng
											Pres</label></td>
									<td width="200px"><label><input type="radio" name="k14" value="4" >
											Beton</label></td>
								</tr>
							</table>
							<h4 for="15"><span class="label label-default kuesioner">15. Kondisi Penutup atap</span></h4>
							<table class="table table-striped" border="0">
								<tr>
									<td width="200px"><label><input type="radio" name="k15" value="1" >
											Rusak</label></td>
									<td width="200px"><label><input type="radio" name="k15" value="2" >
											Sedang</label></td>
								</tr>
								<tr>
									<td width="200px"><label><input type="radio" name="k15" value="3" >
											Baik</label></td>
									<td width="200px"><label><input type="radio" name="k15" value="4" > Baik
											Sekali</label></td>
								</tr>
							</table>

						</div>


						<div class="col-md-6">

							<h4 for="16"><span class="label label-default kuesioner">16. Lantai Terluas </span></h4>
							<table class="table table-striped" border="0">
								<tr>
									<td width="200px"><label><input type="radio" name="k16" value="1" >
											Tanah</label></td>
									<td width="200px"><label><input type="radio" name="k16" value="2" >
											Rabat</label></td>
								</tr>
								<tr>
									<td width="200px"><label><input type="radio" name="k16" value="3" >
											Tegel</label></td>
									<td width="200px"><label><input type="radio" name="k16" value="4" >
											Keramik</label></td>
								</tr>
							</table>
							<h4 for="17"><span class="label label-default kuesioner">17. Kondisi Lantai </span></h4>
							<table class="table table-striped" border="0">
								<tr>
									<td width="200px"><label><input type="radio" name="k17" value="1" >
											Rusak</label></td>
									<td width="200px"><label><input type="radio" name="k17" value="2" > Sedang
										</label></td>
								</tr>
								<tr>
									<td width="200px"><label><input type="radio" name="k17" value="3" >
											Baik</label></td>
									<td width="200px"><label><input type="radio" name="k17" value="4" > Baik
											Sekali</label></td>
								</tr>
							</table>
							<h4 for="18"><span class="label label-default kuesioner">18. Bahan Dinding Terluas </span></h4>
							<table class="table table-striped" border="0">
								<tr>
									<td width="200px"><label><input type="radio" name="k18" value="1" >
											Bambu</label></td>
									<td width="200px"><label><input type="radio" name="k18" value="2" > Papan
											Kayu Biasa / seng</label></td>
								</tr>
								<tr>
									<td width="200px"><label><input type="radio" name="k18" value="3" > Tembok
											biasa / bata</label></td>
									<td width="200px"><label><input type="radio" name="k18" value="4" > Tembok
											Kwalitas Baik / Kayu Jati</label></td>
								</tr>
							</table>
							<h4 for="19"><span class="label label-default kuesioner">19. Kondisi Dinding </span></h4>
							<table class="table table-striped" border="0">
								<tr>
									<td width="200px"><label><input type="radio" name="k19" value="1" >
											Rusak</label></td>
									<td width="200px"><label><input type="radio" name="k19" value="2" >
											Sedang</label></td>
								</tr>
								<tr>
									<td width="200px"><label><input type="radio" name="k19" value="3" >
											Baik</label></td>
									<td width="200px"><label><input type="radio" name="k19" value="4" > >Baik
											Sekali</label></td>
								</tr>
							</table>
							<h4 for="20"><span class="label label-default kuesioner">20. Sumber Air Bersih </span></h4>
							<table class="table table-striped" border="0">
								<tr>
									<td width="200px"><label><input type="radio" name="k20" value="1" > Sumur
											Milik Tetangga</label></td>
									<td width="200px"><label><input type="radio" name="k20" value="2" > Sumur
											Milik Sendiri</label></td>
								</tr>
								<tr>
									<td width="200px"><label><input type="radio" name="k20" value="3" > PDAM
											Terbatas</label></td>
									<td width="200px"><label><input type="radio" name="k20" value="4" > PDAM
											Bebas / Air Kemasan</label></td>
								</tr>
							</table>
							<h4 for="21"><span class="label label-default kuesioner">21. Toilet / Jamban</span></h4>
							<table class="table table-striped" border="0">
								<tr>
									<td width="200px"><label><input type="radio" name="k21" value="1" > Umum /
											Milik Orang lain</label></td>
									<td width="200px"><label><input type="radio" name="k21" value="2" > Milik
											sendiri kondisi Jelek</label></td>
								</tr>
								<tr>
									<td width="200px"><label><input type="radio" name="k21" value="3" > Milik
											sendiri kondisi Sedang</label></td>
									<td width="200px"><label><input type="radio" name="k21" value="4" > Milik
											sendiri kondisi Baik</label></td>
								</tr>
							</table>
							<h4 for="22"><span class="label label-default kuesioner">22. Penerangan Rumah</span></h4>
							<table class="table table-striped" border="0">
								<tr>
									<td width="200px"><label><input type="radio" name="k22" value="1" > Listrik
											Numpang</label></td>
									<td width="200px"><label><input type="radio" name="k22" value="2" > Listrik
											450 watt</label></td>
								</tr>
								<tr>
									<td width="200px"><label><input type="radio" name="k22" value="3" > Listrik
											900 watt</label></td>
									<td width="200px"><label><input type="radio" name="k22" value="4" > Listrik
											> 900 watt</label></td>
								</tr>
							</table>
							<h4 for="23"><span class="label label-default kuesioner">23. Bahan Bakar Dapur </span></h4>
							<table class="table table-striped" border="0">
								<tr>
									<td width="200px"><label><input type="radio" name="k23" value="1" > Kayu
											Bakar</label></td>
									<td width="200px"><label><input type="radio" name="k23" value="2" > Minyak
											Tanah</label></td>
								</tr>
								<tr>
									<td width="200px"><label><input type="radio" name="k23" value="3" > Gas 3
											Kg</label></td>
									<td width="200px"><label><input type="radio" name="k23" value="4" > Gas > 3
											Kg</label></td>
								</tr>
							</table>
							<h4 for="24"><span class="label label-default kuesioner">24. Perabot Rumah </span></h4>
							<table class="table table-striped" border="0">
								<tr>
									<td width="200px"><label><input type="radio" name="k24" value="1" >
											Sederhana</label></td>
									<td width="200px"><label><input type="radio" name="k24" value="2" > TV >
											21"</label></td>
								</tr>
								<tr>
									<td width="200px"><label><input type="radio" name="k24" value="3" >
											Kulkas</label></td>
									<td width="200px"><label><input type="radio" name="k24" value="4" > Mesin
											cuci</label></td>
								</tr>
							</table>
							<h4 for="25"><span class="label label-default kuesioner">25. Transportasi </span></h4>
							<table class="table table-striped" border="0">
								<tr>
									<td width="200px"><label><input type="radio" name="k25" value="1" > Jalan
											Kaki/ Sepeda / Sepeda Motor seadanya</label></td>
									<td width="200px"><label><input type="radio" name="k25" value="2" > Sepeda
											Motor 1 buah, dalam kondisi baik</label></td>
								</tr>
								<tr>
									<td width="200px"><label><input type="radio" name="k25" value="3" > Sepeda
											Motor > 1 buah, dalam kondisi baik</label></td>
									<td width="200px"><label><input type="radio" name="k25" value="4" >
											Mobil</label></td>
								</tr>
							</table>
							<h4 for="26"><span class="label label-default kuesioner">26. Keluarga yang sakit kronis / menahun dan
									lansia </span></h4>
							<table class="table table-striped" border="0">
								<tr>
									<td width="200px"><label><input type="radio" name="k26" value="1" > 1
											Orang</label></td>
									<td width="200px"><label><input type="radio" name="k26" value="2" > > 1
											Orang</label></td>
								</tr>
								<tr>
									<td width="200px"><label><input type="radio" name="k26" value="3" > 1 Orang
											(Bukan KK)</label></td>
									<td width="200px"><label><input type="radio" name="k26" value="4" > Tidak
											Ada</label></td>
								</tr>
							</table>
							<h4 for="27"><span class="label label-default kuesioner">27. Aset yang dimiliki dan bisa dijual dalam
									waktu cepat </span></h4>
							<table class="table table-striped" border="0">
								<tr>
									<td width="200px"><label><input type="radio" name="k27" value="1" >
											< 1 Juta</label> </td> <td width="200px"><label><input type="radio"
														name="k27" value="2" > 1 - 5 Juta</label></td>
								</tr>
								<tr>
									<td width="200px"><label><input type="radio" name="k27" value="3" > 5 - 10
											Juta</label></td>
									<td width="200px"><label><input type="radio" name="k27" value="4" > > 10
											juta</label></td>
								</tr>
							</table>
							<h4 for="28"><span class="label label-default kuesioner">28. Faskes Tingkat 1</span></h4>
							<table class="table table-striped" border="0">
								<tr>
									<td width="200px"><label><input type="radio" name="k28" value="1" >
											Puskesmas</label></td>
									<td width="200px"><label><input type="radio" name="k28" value="2" > Dokter
											pribadi</label></td>
								</tr>
								<tr>
									<td width="200px"><label><input type="radio" name="k28" value="3" >
											RSUD</label></td>
									<td width="200px"><label><input type="radio" name="k28" value="4" > RS
											Rujukan Tipe A</label></td>
								</tr>
							</table>
							<table class="table table-striped" border="0">
							<h4 for="29"><span class="label label-default kuesioner">29. Pakaian baru dalam satu tahun / anggota
									keluarga</span></h4>
								<tr>
									<td width="200px"><label><input type="radio" name="k29" value="1" > 1
											stel</label></td>
									<td width="200px"><label><input type="radio" name="k29" value="2" > 2
											stel</label></td>
								</tr>
								<tr>
									<td width="200px"><label><input type="radio" name="k29" value="3" > 3
											stel</label></td>
									<td width="200px"><label><input type="radio" name="k29" value="4" > > 3
											stel</label></td>
								</tr>
							</table>
						</div>
						<div class="col-md-5">
							<br>
							<br>
							<hr>
							<p align="right"><button class="btn btn-lg btn-success btn-block btn-custom" type="submit"
									name="submit" style="width: 120px;">Register</button></p><br>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="<?php echo base_url();?>/assets/backend/js/plugin/jquery.validate.js"></script>
<script>
	$(document).ready(function () {
		var appended = false;
		$("#form-kuesioner").validate({
			rules: {
				k1: "required",
				k2: "required",
				k3: "required",
				k4: "required",
				k5: "required",
				k6: "required",
				k7: "required",
				k8: "required",
				k9: "required",
				k10: "required",
				k11: "required",
				k12: "required",
				k13: "required",
				k14: "required",
				k15: "required",
				k16: "required",
				k17: "required",
				k18: "required",
				k19: "required",
				k20: "required",
				k21: "required",
				k22: "required",
				k23: "required",
				k24: "required",
				k25: "required",
				k26: "required",
				k27: "required",
				k28: "required",
				k29: "required"
				
			},
			messages: {
				k1: "*Silakan pilih salah satu",
				k2: "*Silakan pilih salah satu",
				k3: "*Silakan pilih salah satu",
				k4: "*Silakan pilih salah satu",
				k5: "*Silakan pilih salah satu",
				k6: "*Silakan pilih salah satu",
				k7: "*Silakan pilih salah satu",
				k8: "*Silakan pilih salah satu",
				k9: "*Silakan pilih salah satu",
				k10: "*Silakan pilih salah satu",
				k11: "*Silakan pilih salah satu",
				k12: "*Silakan pilih salah satu",
				k13: "*Silakan pilih salah satu",
				k14: "*Silakan pilih salah satu",
				k15: "*Silakan pilih salah satu",
				k16: "*Silakan pilih salah satu",
				k17: "*Silakan pilih salah satu",
				k18: "*Silakan pilih salah satu",
				k19: "*Silakan pilih salah satu",
				k20: "*Silakan pilih salah satu",
				k21: "*Silakan pilih salah satu",
				k22: "*Silakan pilih salah satu",
				k23: "*Silakan pilih salah satu",
				k24: "*Silakan pilih salah satu",
				k25: "*Silakan pilih salah satu",
				k26: "*Silakan pilih salah satu",
				k27: "*Silakan pilih salah satu",
				k28: "*Silakan pilih salah satu",
				k29: "*Silakan pilih salah satu"
			},
			// the errorPlacement has to take the table layout into account
			errorPlacement: function (error, element) {
				if (element.is(":radio")){
					error.appendTo( element.parent().parent().parent().parent());
				}
			},
		});
	});
</script>