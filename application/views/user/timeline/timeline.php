<style media="screen">
.message-length >select {
	  float: left;
	  border: 1px solid #ccd0d4;
    background: #fff;
    font-size: 12px;
    padding: 6px 12px;
    line-height: 1.42857143;
    color: #555;
		border-radius: 3px;
		margin-right: 10px;
		font: inherit;
		height: 34px!important;
}
.message-actions > a{

	color:#CCCCCC;
	font-size: 14px;
	margin:0 3px 0 3px;
}
.message-actions > a:hover{
	color:#999;
}
.selected{
	    background-color: rgb(255, 244, 204);
}


</style>
<link rel="stylesheet" href=" https://developers.google.com/maps/documentation/javascript/demos/demos.css">
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA_f0rYEEv6QkghuYbE9XW-R0mqXdU5V60"></script>
<?php //var_dump($messages); ?>


		<div class="p-20">
			<!-- begin row -->
			<div class="row">
			    <!-- begin col-2 -->
			    <?php $this->load->view($tLSidebar); ?>
			    <!-- end col-2 -->
			    <!-- begin col-10 -->
			    <div class="col-md-10" id="timelinecontent1">
						<div class="email-btn-row hidden-xs timelinemenu">
							<a href="<?php echo base_url()?>" class="btn btn-sm btn-inverse"><i class="fa fa-plus m-r-5"></i> New</a>
							<a href="javascript:;" class="btn btn-sm btn-default" data-page="inbox" id="backbtn" style="display:none"><i class="fa fa-arrow-left m-r-5"></i> Back</a>
							<a href="javascript:;" class="btn btn-sm btn-default" data-page="deletemsg" id="dlt-msg-btn">Delete</a>
							<a href="javascript:;" class="btn btn-sm btn-default" data-page="map" id="msgmap" style="display:none">Map</a>
							<a href="javascript:;" class="btn btn-sm btn-default" data-page="edit" id="msgedit" style="display:none">Edit</a>
							<!-- <a href="javascript:;" class="btn btn-sm btn-default disabled">Swwep</a>
							<a href="javascript:;" class="btn btn-sm btn-default disabled">Move to</a>
							<a href="javascript:;" class="btn btn-sm btn-default disabled">Categories</a>
 -->						</div>
						<div class="panel panel-inverse">
								<div class="panel-heading">
										<div class="panel-heading-btn">
												<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
										</div>
										<h4 class="panel-title">DataTable - Fixed Columns</h4>
								</div>
								<div class="panel-body">
									<div id="map" style="display:none;"></div>
									<div id="view_div" style="display:none;">
									</div>
										<div class="table-responsive" id="table_div">
												<table id="message-table" class="table">
														<thead>
																<tr>
																	  <th width="5px"><input type="checkbox" name="select_all" value="1" id="message-table-select-all"></th>
																		<th>Subjects</th>
																		<th>Action</th>
																		<th width="22%"></th>
																		<th>Created Date</th>
																		<th>Start Date</th>
																		<th>End Date</th>
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
///{'page':page}
function addZero(i) {
		if (i < 10) {
				i = "0" + i;
		}
		return i;
}
function gettime(timeseconds){
	if(timeseconds != ''){
		var date = new Date(timeseconds * 1000);
		var year = date.getFullYear();
		var month = addZero(date.getMonth() + 1);
		var day = addZero(date.getDate());
		var hours = addZero(date.getHours());
		var minutes = addZero(date.getMinutes());
		ampm= 'AM';
		if(hours>= 12){
			if(hours>12) hours -= 12;
			ampm= 'PM';
		}
		return (month + "/" + day + "/" + year + " " + hours + ":" + minutes+" "+ampm );
	}else{
		return '';
	}
}

function setTimeInTable(table,column = 4){
	var items=[], options=[];

	$(table+' tbody tr td:nth-child('+column+')').each( function(){
		 //add item to array
		 items.push( $(this).text() );
	});

	$.each( items, function(i, item){

			options.push(gettime(item));
	});

	options = options.reverse();
	$(table+' tbody tr td:nth-child('+column+')').each( function(){
		 $(this).text(options.pop());
	});

}

function dataByFilter(){
	var now = new Date();
	zone = now.getTimezoneOffset();
	fromdate= $('#fromdate').val();
	todate= $('#todate').val();
	messageType= $(".message-length > select").val();
	data ={'fromdate':fromdate,'todate':todate,'zone':zone,'messageType':messageType};
	return data;
}



	function user_filter(data,table)
	{
		$.post('<?=base_url('timeline/search')?>',data,function(){
			// table.ajax.reload( null, false );
			$('#message-table').DataTable().ajax.reload();
		});
	}


	$(document).on("change",".message-length > select",function(){
		data =dataByFilter();
		user_filter(data,$('#message-table').DataTable());
		//postTableData({"page":'inbox','where':messageType},false);
	});
$(document).ready(function(){


	$(document).on("click",".message-delete",function(){
		// $('#message-table').DataTable().row( this ).remove();
		deletedUrl = $(this).attr("data-click");
		data ={'deletedUrl':deletedUrl};
		// console.log(deletedUrl);
		$.post('<?=base_url('message/delete')?>',data,function(data){
			$('#message-table').DataTable().ajax.reload();
		});
		// $('#message-table').DataTable().row(this).remove().draw(false );
		// console.log('asda');
	});

	$(document).on("click",".message-bookmark",function(){
		// $('#message-table').DataTable().row( this ).remove();
		bookmarkUrl = $(this).attr("data-click");
		$(this).toggleClass(' text-danger');
		data ={'bookmarkUrl':bookmarkUrl};
		$.post('<?=base_url('message/setBookmark')?>',data,function(data){
			//$('#message-table').DataTable().ajax.reload();
		});
		// $('#message-table').DataTable().row(this).remove().draw(false );
		// console.log('asda');
	});

	$(document).on("click",".message-restore",function(){
		// $('#message-table').DataTable().row( this ).remove();
		restoreUrl = $(this).attr("data-click");
		data ={'restoreUrl':restoreUrl};
		$.post('<?=base_url('message/restore')?>',data,function(data){
			$('#message-table').DataTable().ajax.reload();
		});
		// $('#message-table').DataTable().row(this).remove().draw(false );
		// console.log('asda');
	});

});
//
// Updates "Select all" control in a data table
//
function updateDataTableSelectAllCtrl(table){
 var $table             = table.table().node();
 var $chkbox_all        = $('tbody input[type="checkbox"]', $table);
 var $chkbox_checked    = $('tbody input[type="checkbox"]:checked', $table);
 var chkbox_select_all  = $('thead input[name="select_all"]', $table).get(0);

 // If none of the checkboxes are checked
 if($chkbox_checked.length === 0){
		chkbox_select_all.checked = false;
		if('indeterminate' in chkbox_select_all){
			 chkbox_select_all.indeterminate = false;
		}

 // If all of the checkboxes are checked
 } else if ($chkbox_checked.length === $chkbox_all.length){
		chkbox_select_all.checked = true;
		if('indeterminate' in chkbox_select_all){
			 chkbox_select_all.indeterminate = false;
		}

 // If some of the checkboxes are checked
 } else {
		chkbox_select_all.checked = true;
		if('indeterminate' in chkbox_select_all){
			 chkbox_select_all.indeterminate = true;
		}
 }
}

$(document).ready(function (){


// sidebar jquery
	$(document).on("click",".timelinesidemenu li",function(e){
		page = $(this).attr('data-link');

		fromdate= $('#fromdate').val('');
		todate= $('#todate').val('');
		messageType= $(".message-length > select").val('');

		$('.timelinesidemenu').find(".active").removeClass('active');
		$(this).addClass("active");
		data={'page':page};
		dInboxEview();
		$.post('<?=base_url('timeline/getPage')?>',data,function(data){
			$('#message-table').DataTable().ajax.reload();
		});
	});



 // Array holding selected row IDs
 var rows_selected = [];
 var table = $('#message-table').dataTable({
	 "bProcessing": true,
	 "oLanguage": {
				"sZeroRecords": "No Message to Display",
				"sProcessing": "DataTables is currently busy"
			},

	 "serverSide": true,
	 "fnDrawCallback": function( oSettings ) {
		 extraTimeSet();
	 },
	 "ajax": "<?=base_url('timeline/datatable_json')?>",
	 "dom": '<"message-length">l <"fromdate"> <"todate">ft r ip',
	 "order": [[4,'desc']],
	 "columnDefs": [
		 { "targets": 0, "name": "", 'searchable':false, 'orderable':false,'width': '1%'},
		 { "targets": 1, "name": "subject", 'searchable':true, 'orderable':true},
		 { "targets": 2, "name": "", 'searchable':false, 'orderable':false},
		 { "targets": 3, "name": "message", 'searchable':false, 'orderable':true},
		 { "targets": 4, "name": "create_date", 'searchable':false, 'orderable':true},
		 { "targets": 5, "name": "starttime", 'searchable':false, 'orderable':true},
		 { "targets": 6, "name": "endtime", 'searchable':false, 'orderable':true}
	 ],
		'rowCallback': function(row, data, dataIndex){
			 // Get row ID
			 var rowId = data[0];

			 // If row ID is in the list of selected row IDs
			 if($.inArray(rowId, rows_selected) !== -1){
					// $(row).find('input[type="checkbox"]').prop('checked', true);
					// $(row).addClass('selected');
			 }
		}
 });
 $(".message-length").html('<select><option value="all">All</option><option value="current">Current</option><option value="expired">Expired</option><option value="pandding">Pending</option></select>');
 $(".fromdate").html('<div class="form-group col-md-3"><input type="text" class="form-control" id="fromdate"></div>');
 $(".todate").html('<div class="form-group col-md-3"><input type="text" class="form-control" id="todate"></div>');

 // Handle click on checkbox
 $('#message-table tbody').on('click', 'input[type="checkbox"]', function(e){
		var $row = $(this).closest('tr');

		// Get row data
		var data = $('#message-table').DataTable().row($row).data();

		// Get row ID
		var rowId = data[0];

		// Determine whether row ID is in the list of selected row IDs
		var index = $.inArray(rowId, rows_selected);

		// If checkbox is checked and row ID is not in list of selected row IDs
		if(this.checked && index === -1){
			 rows_selected.push(rowId);

		// Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
		} else if (!this.checked && index !== -1){
			 rows_selected.splice(index, 1);
		}

		if(this.checked){
			 $row.addClass('selected');
		} else {
			 $row.removeClass('selected');
		}

		// Update state of "Select all" control
		updateDataTableSelectAllCtrl($('#message-table').DataTable());

		// Prevent click event from propagating to parent
		e.stopPropagation();
 });

 // Handle click on table cells with checkboxes
 // $('#message-table').on('click', 'tbody td, thead th:first-child', function(e){
 // 	$(this).parent().find('input[type="checkbox"]').trigger('click');
 // });

 // Handle click on "Select all" control
 $('thead input[name="select_all"]', $('#message-table').DataTable().table().container()).on('click', function(e){
		if(this.checked){
			 $('#message-table tbody input[type="checkbox"]:not(:checked)').trigger('click');
		} else {
			 $('#message-table tbody input[type="checkbox"]:checked').trigger('click');
		}

		// Prevent click event from propagating to parent
		e.stopPropagation();
 });

 $(document).on('click','#dlt-msg-btn', function(e){
	 	var array = [];
			$('#message-table tbody').find('.selected').find('span').find('a.message-delete').each(function(data){
				deletedUrl = $(this).attr("data-click");
				array.push(deletedUrl);
			 });
			 data ={'deletedUrl':array};
			 $.post('<?=base_url('message/delete')?>',data,function(data){

			 });
			 $('#message-table').DataTable().ajax.reload();
		});
 // });

});

</script>



<script type="text/javascript">
function dInboxEview(){
	$('#view_div').html('');
	$('#view_div').fadeOut(200);
	$('#backbtn').fadeOut(200);
	$('#msgmap').fadeOut(200);
	$('#msgedit').fadeOut(200);
	$('#map').fadeOut(200);
	$('#table_div').fadeIn(200);
	$("#dlt-msg-btn").removeAttr("data-click");
}
// toolbar jquery
	 $(document).on('click','.timelinemenu > li,.timelinemenu > a',function(){
		 page = $(this).attr("data-page");
		 data = {'page':page};
		 if(page == 'inbox'){
			dInboxEview();
		}else if(page == 'deletemsg'){
			deletedUrl = $(this).attr("data-click");
	 		data ={'deletedUrl':deletedUrl};
	 		$.post('<?=base_url('message/delete')?>',data,function(data){
	 			$('#message-table').DataTable().ajax.reload();
	 		});
			 dInboxEview();
		 }else if(page == 'map'){
			 $("#view_div").fadeOut(100);
			 $("#map").fadeIn(100);
			 var url = $("#msgmap").attr('data-click');
			 data ={'page':page,"where":url};
			 $.post('<?=base_url('timeline/getPage')?>',data,function(data){
				 var locations = JSON.parse(data);
				//  console.log(locations[0]);
				 var map = new google.maps.Map(document.getElementById('map'), {
 					zoom: 2,
 					center: new google.maps.LatLng(2.010086, 0.878906),
 				});

 				var infowindow = new google.maps.InfoWindow();

 				var marker, i;

 				for (i = 0; i < locations.length; i++) {
 					marker = new google.maps.Marker({
 						position: new google.maps.LatLng(locations[i][1], locations[i][2]),
 						map: map
 					});

 					google.maps.event.addListener(marker, 'click', (function(marker, i) {
 						return function() {
 							infowindow.setContent(locations[i][0]);
 							infowindow.open(map, marker);
 						}
 					})(marker, i));
 				}
 	 		});
		}//google map end
	 });

extraTimeSet();
function extraTimeSet(){
	setTimeInTable('#message-table',7);
	setTimeInTable('#message-table',6);
	setTimeInTable('#message-table',5);
}


</script>

<script type="text/javascript">
	$(document).ready(function(){
		$(function () {
			$('#fromdate').datetimepicker({
				 useCurrent:false,
					sideBySide: true
			});

			$('#todate').datetimepicker({
					useCurrent: false, //Important! See issue #1075
					sideBySide: true
			});

			$("#fromdate").blur(function (e) {
				data =dataByFilter();
					user_filter(data,$('#message-table').DataTable());
			});
			$("#todate").blur(function (e) {
					data =dataByFilter();
					user_filter(data,$('#message-table').DataTable());
			});
		});
	});


	function viewmsg(url){
		$('#backbtn').fadeIn(200);
		$('#msgmap').fadeIn(200);
		$('#msgedit').fadeIn(200);
		data = {'page':'view','where':url};
		$.post('<?=base_url('timeline/getPage')?>',data,function(getdata){
			$("#table_div").fadeOut(200);
			$("#view_div").fadeIn(200);
			$("#view_div").html(getdata);
			$("#dlt-msg-btn").attr("data-click",url);
			$("#msgmap").attr("data-click",url);
			$("#msgedit").attr("href","<?php echo base_url('userpanel/index/')?>"+url);
		});
	}
</script>
