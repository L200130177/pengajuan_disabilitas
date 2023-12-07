<link rel="stylesheet"
	href="<?=base_url();?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet"
	href="<?=base_url()?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/backend/css/plugin/screen.css">
<div class="box">
	<div class="box-header">

		<div class="pull-right">
			<input type="hidden" id="jenis_laporan" value="<?=$jenis_laporan?>">
			<!-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#bulan">
				<i class="fa fa-file-excel-o"></i> Export Excel
			</button>
		</div> -->

	</div>
	<div class="box-body table-responsive">
		<table class="table table-bordered table-striped" id="datatable">
		<thead>
				<tr>
					<th>No</th>
					<th>Nama</th>
					<th>NIK</th>
					<th>Status</th>
					<th>Aksi</th>
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
					<th>Aksi</th>
				</tr>
			</tfoot>
		</table>
	</div>
</div>

<!-- The Edit Modal -->
<div class="modal fade" id="editModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Record</h4>
                </div>
                <div class="modal-body">
                    <!-- Your edit form goes here -->
                    <form id="editForm">
                        <input type="hidden" name="nik" id="editNik">
                        <label for="editStatus">Status</label>
                        <!-- <input type="text" id="editStatus" name="status" class="form-control" required> -->
						<select name="status" id="editStatus" class="form-control"
							data-rule-required="true"
							data-msg-required="status belum dipilih, pilih salah satu">
							<option value="PENDING">PENDING</option>
							<option value="REVIEW">REVIEW</option>
							<option value="LAYAK">LAYAK</option>
							<option value="TIDAK LAYAK">TIDAK LAYAK</option>
						</select></br>
                </div>
                <div class="modal-footer">
					<button class="btn btn-success" type="submit"> Simpan&nbsp;</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"> Batal</button>
                </div>
				</form>
            </div>
        </div>
    </div>
</div>

<!-- <form action="<?=site_url('laporan/export')?>" method="post" name="form-laporan" id="form-laporan">
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


				</div> -->
				<!-- /.input group -->

				<!-- <div class="modal-footer">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
					<button type="submit" class="btn btn-success" data-toggle="modal" data-target="">
						<i class="fa fa-file-excel-o"></i> Export Excel
					</button>
				</div>
			</div> -->
			<!-- /.modal-content -->
		<!-- </div> -->
		<!-- /.modal-dialog -->
	<!-- </div>
</form> -->
<!-- /.modal -->

<!-- bootstrap datepicker -->
<script src="<?=base_url()?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url();?>/assets/backend/js/plugin/jquery.validate.js"></script>

<script>
	$(document).ready(function () {
		var jenis_laporan = $('#jenis_laporan').val();
		// console.log(jenis_laporan);
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
					"targets": 0,
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

	$(document).ready(function () {
        // Open the edit modal when the edit button is clicked
        $(document).on('click', ".open-editModal",function() {
            var nik = $(this).data('id');
			console.log(nik); 
            $.ajax({
                url: "<?php echo base_url('laporan/get_status/'); ?>" + nik,
                type: "GET",
                dataType: "json",
                success: function (data) {
                    // Populate the edit form with data
                    $("#editNik").val(data.nik);
                    // $("#editStatus").val(data.status);
					$("#editStatus option").each(function () {
                    if ($(this).val() == data.status) {
                        $(this).prop("selected", true);
                    	}
					});
                    // Open the edit modal
                    $("#editModal").modal();
                },
                error: function () {
                    alert('Error loading data');
                }
            });
        });

        // Handle edit form submission
        $("#editForm").submit(function (e) {
            e.preventDefault();

            // Perform AJAX submission
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('laporan/update_status'); ?>",
                data: $("#editForm").serialize(),
                dataType: "json",
                success: function (response) {
                    // Handle the response
                    alert("Data Berhasil Diubah");
                    // You can close the edit modal if needed
                    $("#editModal").modal("hide");
					location.reload();
                },
                error: function () {
                    alert("Error updating record");
                }
            });
        });
    });

</script>
