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
		<table id="list_user" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>No</th>
					<th>Username</th>
					<th>Name</th>
					<th>Address</th>
					<th>Level</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
			<tfoot>
				<tr>
					<th>No</th>
					<th>Username</th>
					<th>Name</th>
					<th>Address</th>
					<th>Level</th>
					<th>Action</th>
				</tr>
			</tfoot>
		</table>
	</div>
	<!-- /.box-body -->
</div>

<div class="modal fade" id="createModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Tambah User</h4>
			</div>
			<form method="post" id="form-register" name="form-register" action="<?=site_url('user/submit')?>" enctype="multipart/form-data">
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6 has-feedback">
						<div class="form-group">
							<label>Username *</label>
							<input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Masukkan Username" data-rule-required="true" data-rule-minlength="4" data-rule-maxlength="20" data-msg-required="Username masih kosong, silakan isi" data-msg-minlength="Username minimal 4 karakter" data-msg-maxlength="Username maksimal 20 karakter">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Name *</label>
							<input type="text" class="form-control form-control-user" id="name" name="name" placeholder="Masukkan Nama" data-rule-required="true" data-rule-minlength="4" data-rule-maxlength="20" data-msg-required="Nama masih kosong, silakan isi" data-msg-minlength="Username minimal 4 karakter" data-msg-maxlength="Username maksimal 20 karakter">
						</div>
					</div>
						<div class="col-md-12">
						<div class="form-group">
							<label>Password *</label>
							<input type="password" class="form-control form-control-user password" maxlength="15" id="password" name="password" placeholder="Masukkan Password" data-rule-required="true" data-msg-required="Password masih kosong, silakan isi">
						</div>
						<div class="form-group">
							<label>Konfirmasi Password *</label>
							<input type="password" class="form-control form-control-user" maxlength="15" equalTo="#password" id="passconf" name="passconf" placeholder="Ulangi Password" data-rule-required="true" data-msg-required="Konfirmasi password masih kosong, silakan isi" data-msg-equalTo="Konfirmasi Password tidak sesuai dengan password.">
						</div>
						<div class="form-group">
							<label>Address</label>
							<textarea class="form-control" id="address" name="address"></textarea>
						</div>
						<div class="form-group">
							<label>Level *</label>
							<select name="level" id="level" class="form-control" data-rule-required="true" data-msg-required="Level belum dipilih, pilih salah satu">
								<option value="">- Pilih -</option>
								<option value="1">Admin</option>
								<option value="2">User</option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Save changes</button>
			</div>
			</form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- EDIT MODAL -->
<div class="modal fade" id="editModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Edit User</h4>
			</div>
			<form method="post" id="form-edit" name="form-edit" action="<?=site_url('user/edit')?>" enctype="multipart/form-data">
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Username</label>
							<input type="hidden" id="user_id-edit" name="user_id-edit">
							<input type="text" class="form-control form-control-user" id="username-edit" name="username-edit" placeholder="Masukkan Username" data-rule-required="true" data-rule-minlength="4" data-rule-maxlength="20" data-msg-required="Username masih kosong, silakan isi" data-msg-minlength="Username minimal 4 karakter" data-msg-maxlength="Username maksimal 20 karakter">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Name</label>
							<input type="text" class="form-control form-control-user" id="name-edit" name="name-edit" placeholder="Masukkan Nama" data-rule-required="true" data-rule-minlength="4" data-rule-maxlength="20" data-msg-required="Nama masih kosong, silakan isi" data-msg-minlength="Username minimal 4 karakter" data-msg-maxlength="Username maksimal 20 karakter">
						</div>
					</div>
						<div class="col-md-12">
						<div class="form-group">
							<label>Password</label><small> (Biarkan kosong bila tidak diganti)</small>
							<input type="password" class="form-control form-control-user" id="curl" name="password-edit" placeholder="Masukkan Password">
						</div>
						<div class="form-group">
							<label>Address</label>
							<textarea class="form-control" id="address-edit" name="address-edit"></textarea>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Save changes</button>
			</div>
			</form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- DELETE MODAL -->
<div class="modal modal-danger fade" id="deleteModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Delete User</h4>
			</div>
			<form method="post" id="form-delete" name="form-delete" action="<?=site_url('user/del')?>" enctype="multipart/form-data">
			<div class="modal-body">
			<p>Apakah anda yakin ingin menghapus ?</p>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<input type="hidden" id="user_id_delete" name="user_id_delete">
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-outline">Save changes</button>
			</div>
			</form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- SESSION MODAL -->
<div class="modal modal-warning fade" id="sessionModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Reset Session</h4>
			</div>
			<form method="post" id="form-delete" name="form-delete" action="<?=site_url('user/del_session')?>" enctype="multipart/form-data">
			<div class="modal-body">
			<p>Apakah anda yakin ingin mereset session ?</p>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<input type="hidden" id="id-session" name="id-session">
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-outline">Save changes</button>
			</div>
			</form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script src="<?php echo base_url();?>/assets/backend/js/plugin/jquery.validate.js"></script>
<script src="<?php echo base_url();?>/assets/backend/js/plugin/additional-methods.min.js"></script>
<script>
	$(document).ready(function () {
		$('#list_user').DataTable({
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "<?=site_url('user/list_data')?>",
				"type": "POST"
			},
			"columnDefs": [{
					"targets": [0, 4, 5],
					"orderable": false
				}

			],
			"order": []

		})
	})

	function byid(id, type) {

		$.ajax({
			type: "GET",
			url: "<?=base_url('user/byid/')?>" + id,
			dataType: "JSON",
			success: function (response) {
				if (type == 'edit') {
					$('[name="user_id-edit"]').val(response.query.data.user_id);
					$('[name="username-edit"]').val(response.query.data.username);
					$('[name="name-edit"]').val(response.query.data.name);
					$('[name="address-edit"]').val(response.query.data.address);
					$('#editModal').modal({
						'show': true,
						'keyboard': false,
						'backdrop': 'static'
					});
				}else if(type == 'session'){
					$('[name="id-session"]').val(response.query.data.user_id);
					$('#sessionModal').modal({
					'show': true,
					'keyboard': false,
					'backdrop': 'static'
					});
				}else{
					$('[name="user_id_delete"]').val(response.query.data.user_id);
					$('#deleteModal').modal({
					'show': true,
					'keyboard': false,
					'backdrop': 'static'
					});
				}
			}
		});
	}

	$(document).ready(function(){
		jQuery.validator.addMethod("password", function( value, element ) {
		var result = this.optional(element) || value.length >= 6 && /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[`~!@#$%^&*?])[A-Za-z\d`~!@#$%^&*?]{6,15}$/.test(value);
		if (!result) {
			element.value = "";
			var validator = this;
			setTimeout(function() {
				validator.blockFocusCleanup = true;
				element.focus();
				validator.blockFocusCleanup = false;
			}, 1);
		}
		return result;
	}, "Kata sandi harus mengandung setidaknya satu angka, satu huruf, satu huruf besar, satu karakter khusus dan antara 6 - 15 karakter.");

	$("#form-register").validate({
		onkeyup: false,
		})
	})

	$(document).ready(function(){
		jQuery.validator.addMethod("curl", function( value, element ) {
		var result = this.optional(element) || value.length >= 6 && /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[`~!@#$%^&*?])[A-Za-z\d`~!@#$%^&*?]{6,15}$/.test(value);
		if (!result) {
			element.value = "";
			var validator = this;
			setTimeout(function() {
				validator.blockFocusCleanup = true;
				element.focus();
				validator.blockFocusCleanup = false;
			}, 1);
		}
		return result;
	}, "Kata sandi harus mengandung setidaknya satu angka, satu huruf, satu huruf besar, satu karakter khusus dan antara 6 - 15 karakter.");

	$("#form-edit").validate({
		onkeyup: false,
		})
	})
</script>
