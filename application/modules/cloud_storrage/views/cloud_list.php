<link rel="stylesheet" href="<?=base_url();?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/backend/css/plugin/screen.css">
<?= $this->session->flashdata('message');?>
<div class="box">
	<!-- /.box-header -->
	<div class="box-body">
		<table id="list_minio" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>No</th>
					<th>Name</th>
                    <th>Link</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
			<tfoot>
				<tr>
					<th>No</th>
					<th>Name</th>
                    <th>Link</th>
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
		$('#list_minio').DataTable({
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "<?=site_url('cloud_storrage/list_minio_new')?>",
				"type": "POST"
			},
			"columnDefs": [{
					"targets": [0],
					"orderable": false
				}

			],
			"order": []

		})
	})

    function byid(file_download) {

$.ajax({
    type: "GET",
    url: "<?=base_url('cloud_storrage/download_minio/')?>" + file_download,
    dataType: "JSON",
});
}
</script>