<link rel="stylesheet" href="<?php echo base_url();?>assets/backend/css/plugin/screen.css">
<link rel="stylesheet" href="<?=base_url();?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="<?=base_url()?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<style>
.modal-dialog,
.modal-content {
    /* 80% of window height */
    height: 80%;
}

.modal-body {
    /* 100% = dialog height, 120px = header + footer */
    max-height: calc(100% - 120px);
    overflow-y: scroll;
}

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
        <div class="col-md-4 col-md-offset-4">
            <!-- <form method="post" id="manage" name="manage" enctype="multipart/form-data"> -->
                <div class="form-group">
                    <label for="nik_manage">Cari Data NIK</label>
                    <input type="number" class="form-control no-arrow" id="nik_manage" name="nik_manage" placeholder="Masukkan NIK" data-rule-required="true" data-rule-minlength="16" data-rule-maxlength="20" data-msg-required="NIK masih kosong, silakan isi" data-msg-minlength="NIK minimal 16 karakter" data-msg-maxlength="NIK maksimal 20 karakter">
                </div>
                    
                <div class="form-group">
                    <button onclick="tampil_data()" class="btn btn-success btn-flat"> 
                    <i class="fa fa-eye"></i> Cari Data 
                    </button> 
                    
                </div>
            </form>
        </div>
		</div>
	</div>


    <div class="box-body table-responsive">
        <table id="mydata" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Edit</th>
                    <th>Hapus</th>
                    <th>Nomor Kartu Keluarga</th>
                    <th>NIK</th>
                    <th>Nama Lengkap</th>
                    <th>Hubungan Keluarga</th>    
                    <th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>Status Perkawinan</th>
                    <th>Alamat</th>
                    <th>RT</th>
                    <th>RW</th>
                    <th>nama Kecamatan</th>
                    <th>Nama Desa</th>
                </tr>
            </thead>
            <tbody id="result">
            </tbody>
        </table>
    </div>

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="editModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
      <form id="editForm">
        <div class="form-group">
            <input type="hidden" id="edit_id_laporan" name="id_laporan">
            <input type="hidden" id="edit_jenis_laporan" name="jenis_laporan">
            <input type="hidden" id="edit_skor" name="skor">
            <label for="edit_nomor_kk">Nomor Kartu Keluarga</label>
            <input type="text" class="form-control form-control-user" id="edit_nomor_kk" name="no_kk">
        </div>
        <div class="form-group">
            <label for="edit_nik">Name</label>
            <input type="text" class="form-control form-control-user" id="edit_nik" name="nik" readonly>
        </div>
        <div class="form-group">
            <label for="edit_nama_lengkap">Nama Lengkap</label>
            <input type="text" class="form-control form-control-user" id="edit_nama_lengkap" name="nama">
        </div>
        <div class="form-group">
            <label for="edit_hubkel">Hubungan Keluarga</label>
            <select name="hubkel" id="edit_hubkel" class="form-control">
                <option value="1">Peserta</option>
                <option value="2">Suami</option>
                <option value="3">Istri</option>
                <option value="4">Anak</option>
                <option value="5">Tambahan</option>
            </select>
        </div>
        <div class="form-group">
            <label for="edit_tmpt_lahir">Tempat Lahir</label>
            <input type="text" class="form-control form-control-user" id="edit_tmpt_lahir" name="tmpt_lahir">
        </div>
        <div class="form-group">
            <label for="edit_tgl_lahir">Tanggal Lahir <small>(Biarkan kosong bila tidak diganti)</small></label>
                <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" name="tgl_lahir" class="form-control" id="edit_tgl_lahir">
                </div>
        </div>
        <div class="form-group">
            <label for="edit_jenis_kelamin">Jenis Kelamin</label>
            <select name="jenis_kelamin" id="edit_jenis_kelamin" class="form-control">
                <option value="1">Laki - laki</option>
                <option value="2">Perempuan</option>
            </select>
        </div>
        <div class="form-group">
            <label for="edit_status_kawin">Status Kawin</label>
            <select name="status_kawin" id="edit_status_kawin" class="form-control">
                <option value="1">Belum Kawin</option>
                <option value="2">Kawin</option>
                <option value="3">Cerai Hidup</option>
                <option value="4">Cerai Mati</option>
                <option value="5">Tidak Tahu</option>
            </select>
        </div>
        <div class="form-group">
            <label for="edit_alamat">Address</label>
            <textarea class="form-control" id="edit_alamat" name="alamat"></textarea>
        </div>
        <div class="form-group">
            <label for="edit_rt">RT</label>
            <input type="text" class="form-control form-control-user" id="edit_rt" name="rt">
        </div>
        <div class="form-group">
            <label for="edit_rw">RW</label>
            <input type="text" class="form-control form-control-user" id="edit_rw" name="rw">
        </div>
        <div class="form-group">
            <label for="edit_kecamatan_id">Nama Kecamatan</label>
            <select class="form-control" name="kecamatan_id" id="edit_kecamatan_id">
                <option value="">- Biarkan kosong bila tidak diganti -</option>
                <?php foreach($kecdesa as $row):?>
                <option value="<?php echo $row->id_kecamatan;?>"><?php echo $row->nama_kecamatan;?></option>
                <?php endforeach;?>
            </select>
        </div>
        <div class="form-group">
            <label for="edit_desa_id">Nama Desa</label>
            <select class="form-control" name="desa_id" id="edit_desa_id">
                <option value="">- Biarkan kosong bila tidak diganti -</option>
            </select>
        </div>
      </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
		    <button type="button" onclick="update_data()" class="btn btn-primary">Save changes</button>
        </div>
    </form>
    </div>
  </div>
</div>

</div>

<script src="<?php echo base_url();?>/assets/backend/js/plugin/jquery.validate.js"></script>
<script src="<?=base_url()?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script>
 
        function tampil_data(){

            var nik_manage = $("#nik_manage").val();

            $.ajax({
                type  : "post",
                url   : "<?php echo base_url()?>manage/get_data",
                async : false,
                dataType : 'json',
                data : {nik_manage : nik_manage},
                success : function(response){
                    if(response){
                        $("#result").html(`
                        <tr>
                            <td><button type="button" title="edit" class="btn btn-primary btn-xs" onclick="edit_data(${response.nik})" ><i class="fa fa-pencil"></i> Edit</button></td><td><button type="button" title="hapus" class="btn btn-danger btn-xs" onclick="delete_data(${response.nik})"><i class="fa fa-trash"></i> Hapus</button></td>
                            <td>${response.nomor_kk}</td>
                            <td>${response.nik}</td>
                            <td>${response.nama_lengkap}</td>
                            <td>${response.hubkel}</td>
                            <td>${response.tmpt_lahir}</td>
                            <td>${response.tgl_lahir}</td>
                            <td>${response.jenis_kelamin}</td>
                            <td>${response.status_kawin}</td>
                            <td>${response.alamat}</td>
                            <td>${response.rt}</td>
                            <td>${response.rw}</td>'+
                            <td>${response.nama_kecamatan}</td>
                            <td>${response.nama_desa}</td>
                        </tr>
                        `)
                    }else{
                        $("#result").html("<tr><td colspan='15' align='center'><strong>Data Tidak Ditemukan.</strong></td></tr>");
                    }
                }
            });
        }

        function edit_data(nik) {
            $.ajax({
                url: "<?php echo base_url()?>manage/get_data",
                method: "POST",
                data: { nik_manage : nik },
                dataType: 'json',
                success: function(response) {
                    $("#edit_id_laporan").val(response.id_laporan);
                    $("#edit_jenis_laporan").val(response.jenis_laporan);
                    $("#edit_skor").val(response.skor);
                    $("#edit_nomor_kk").val(response.nomor_kk);
                    $("#edit_nik").val(response.nik);
                    $("#edit_nama_lengkap").val(response.nama_lengkap);
                    $("#edit_hubkel").val(response.hubkel);
                    $("#edit_tmpt_lahir").val(response.tmpt_lahir);
                    $("#edit_tgl_lahir").val(response.tgl_lahir);
                    $("#edit_jenis_kelamin").val(response.jenis_kelamin);
                    $("#edit_status_kawin").val(response.status_kawin);
                    $("#edit_alamat").val(response.alamat);
                    $("#edit_rt").val(response.rt);
                    $("#edit_rw").val(response.rw);
                    $("#edit_kecamatan_id").val(response.kecamatan_id);
                    $("#edit_desa_id").val(response.desa_id);
                    $("#editModal").modal({
                        'show': true,
						'keyboard': false,
						'backdrop': 'static'
                    });
                },
                error: function() {
                    console.log("Error fetching data.");
                }
            });
        }

        function update_data() {
            var formData = $("#editForm").serialize();
            $.ajax({
                url: "<?php echo base_url('manage/update_data'); ?>",
                method: "POST",
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.status) {
                        $("#editModal").modal('hide');
                        // Reload or update the data table
                        location.reload();
                    } else {
                        console.log("Error updating data.");
                    }
                },
                error: function() {
                    console.log("Error updating data.");
                }
            });
        }

        function delete_data(nik) {
            if (confirm('Are you sure you want to delete this user?')) {
                $.ajax({
                    url: "<?php echo base_url('manage/delete_data'); ?>",
                    method: "POST",
                    data: { nik: nik },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status) {
                            // Reload or update the data table
                            loadData();
                        } else {
                            console.log("Error deleting data.");
                        }
                    },
                    error: function() {
                        console.log("Error deleting data.");
                    }
                });
            }
        }

        $(function () {

            //Datepicker
            $('#edit_tgl_lahir').datepicker({
                    autoclose: true,
                    format: 'dd/mm/yyyy'
                });

        });

        $('#edit_kecamatan_id').change(function(){ 
            var kecamatan_id=$(this).val();
            $.ajax({
                url : "<?php echo site_url('manage/get_desa');?>",
                method : "POST",
                data : {kecamatan_id: kecamatan_id},
                async : true,
                dataType : 'json',
                success: function(data){
                        
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        html += '<option value='+data[i].id_desa+'>'+data[i].nama_desa+'</option>';
                    }
                    $('#edit_desa_id').html(html);

                }
            });
            return false;
        }); 


    // function loadkec(callback) {
    // $.ajax({
    //     url: "<?php echo base_url('manage/get_kecamatan'); ?>",
    //     method: "GET",
    //     dataType: 'json',
    //     success: function(response) {
    //         console.log(response);
    //         var kecmtSelect = $("#edit_kec");
    //         kecmtSelect.empty();

    //         $.each(response, function(index, kec) {
    //             kecmtSelect.append('<option value="' + kec.id_kecamatan + '">' + kec.nama_kecamatan + '</option>');
    //         });

    //         // Execute the callback function if provided
    //         if (callback && typeof callback === 'function') {
    //             callback();
    //         }
    //     },
    //     error: function() {
    //         console.log("Error fetching roles.");
    //     }
    // });
    // }
</script>