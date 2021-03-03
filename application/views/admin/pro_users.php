



		<div >
			<!-- begin row -->
			<div class="row">
			    <!-- begin col-2 -->
			    <!-- end col-2 -->
			    <!-- begin col-10 -->
			    <div id="timelinecontent1">
						<div class="panel panel-inverse">
								<div class="panel-heading">
										<div class="panel-heading-btn">
												<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
										</div>
										<h4 class="panel-title">Basic Users</h4>
								</div>
								<div class="panel-body">
									<div class="table-responsive" id="table_div">
										<table id="message-table" class="table">
											<thead>
												<tr>
													  <th width="5px">No#</th>
														<th>Name</th>
														<th>Action</th>
														<th width="22%">Username</th>
														<th>Email</th>
														<th>Created Date</th>
												</tr>
											</thead>
											<tbody></tbody>
										</table>
									</div>
								</div>
						</div>
			    </div>

			    <!-- end col-10 -->
			</div>
			<!-- end row -->
		</div>
		<!-- end #content -->
		<script src="<?php echo base_url();?>assets/plugins/DataTables/js/jquery.dataTables.js"></script>
		<script src="<?php echo base_url();?>assets/plugins/DataTables/js/dataTables.fixedHeader.js"></script>
<script type="text/javascript">
	
$(document).ready(function(){


	 var table = $('#message-table').dataTable({
		"processing": true,
		"serverSide": true,
		"ajax": "<?=base_url('admin/get_pro_users')?>",
		"order": [[5,'desc']],
		"dom": 'ftl',
	 "columnDefs": [
		 { "targets": 0, "name": "", 'searchable':false, 'orderable':false,'width': '1%'},
		 { "targets": 1, "name": "name", 'searchable':true, 'orderable':true},
		 { "targets": 2, "name": "", 'searchable':false, 'orderable':false},
		 { "targets": 3, "name": "username", 'searchable':false, 'orderable':true},
		 { "targets": 4, "name": "email", 'searchable':false, 'orderable':true},
		 { "targets": 5, "name": "date_reg", 'searchable':false, 'orderable':true}
	 ],

 	});
});



$(document).on("click",".message-delete",function(){
	// $('#message-table').DataTable().row( this ).remove();
	deletedId = $(this).attr("data-click");
	data ={'deletedId':deletedId};
	// console.log(deletedId);
	$.post('<?=base_url('admin/deleteUser')?>',data,function(data){
		$('#message-table').DataTable().ajax.reload();
	});
	// $('#message-table').DataTable().row(this).remove().draw(false );
	// console.log('asda');
});
</script>