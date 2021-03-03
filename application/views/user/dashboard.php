<?php if(!empty($message)){
	$message['message'] = textDecrypt($message['message']);
	$message['msgpassword'] = textDecrypt($message['msgpassword']);
	set_data($message);
	// var_dump($message);
} ?>


<style type="text/css">
	.form-horizontal  .control-label {
		text-align: left;
	}
</style>
			<div class="row">
				<!-- begin col-8 -->
				<div class="col-md-9">
          <form class="form-horizontal" action="<?php echo base_url();?>message/save" method="post" enctype="multipart/form-data" id="messageform">
          				<?php if(!empty(get_data('update'))){ ?>
							<input type="hidden" name="url" value="<?php echo get_data('url')?>">
          				<?php } ?>
						<input type="hidden" name="user_time" value="">
						<input type="hidden" name="user_zone" value="">
						<div class="form-group">
							<h4  class="m-t-0">Subject</h4>
								<input type="text" name="subject" class="form-control" value="<?php echo get_data('subject')?>">
								<?php echo form_error('subject'); ?>
						</div>
						<div class="form-group">
            	<h4  class="m-t-0">Write Your Message Here...</h4>
            	<?php
            		$this->ckeditor->config['width'] = '100%';
					$this->ckeditor->config['height'] = '300px';
            	?>
            	<?php echo form_error('message'); ?>
            	<?php echo $this->ckeditor->editor('message',htmlspecialchars_decode(get_data('message')));?>
            </div>
						<div class="form-group">
                <label class="col-md-3 control-label">Set Password</label>
                <div class="col-md-7" data-toggle="tooltip" data-placement="right" title="Set Password for the message. Enter the password Before viewing the message">
                    <input type="password" name="msgpassword" value="<?php echo get_data('msgpassword')?>" class="form-control" placeholder="Enter Password">
                </div>
            </div>
            <div class="form-group">
				<label class="control-label col-md-3">Block Countries</label>
				<div class="col-md-7" data-toggle="tooltip" data-placement="right" title="In Which country You don't wanna to show the message">
					<div class="input-group bootstrap-timepicker">
						<?php $countries = get_country();
						if(!empty(get_data('country[]'))){
							$bCountry = get_data('country[]');
						}else{
							$bCountry = explode(',',get_data('block_countries'));
						}
						// var_dump($bCountry);
						?>
						<select name="country[]" class="selectpicker" data-live-search="true" multiple data-actions-box="true" data-selected-text-format="count">
							<?php foreach ($countries as $abb => $country) {
								echo '<option value="'.$abb.'"  '.((in_array($abb,$bCountry))?"selected":"").'>'.$country.'</option>';
							} ?>
						</select>
					</div>
				</div>
				<?php echo form_error('country'); ?>
			</div>
            <div class="form-group">
                <label class="col-md-3 control-label">Select Date & Time Range</label>
                <div class="col-md-7" data-toggle="tooltip" data-placement="right" title="The Start Up Time of the Message. Message Will Displayable after this time.">
					<div class='input-group date' id='datetimepicker6'>
							<input name="fromdate" type='text' class="form-control" />
							<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
							</span>
					</div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 "></label>
					<div class='col-md-7' data-toggle="tooltip" data-placement="right" title="Expirey Time of the message . Message will not Displayable After this time.">
						<div class='input-group date' id='datetimepicker7'>
							<input name="todate" type='text' class="form-control" />
							<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
							</span>
						</div>
					</div>
            </div>
            <?php if(!userExist($this->userId)): ?>
            	<div class="form-group">
	                <label class="col-md-3 "></label>
					<div class='col-md-7' data-toggle="tooltip" data-placement="right" title="Premium And Registered users Can get Extra Functionalities">
						<span class="text-danger">Some Functionalities Only Access By Registered And Premium Users</span> <a href="<?php echo base_url('userpanel/register')?>">Register Here </a>
					</div>
	            </div>
            <?php endif; ?>
            	<div class="form-group">
	                <label class="col-md-3 ">No of Viewers</label>
					<div class='col-md-7' data-toggle="tooltip" data-placement="right" title="Through this you will fix how many people can see the message">
						<input type="number" min="0" name="no_of_views" value="<?php echo (get_data('no_of_views')!='-1')?get_data('no_of_views'):''?>" class="form-control" placeholder="Enter No of Views" <?php echo (!userExist($this->userId))?'disabled':'' ?> >
					</div>
	            </div>
            	<div class="form-group">
	                <label class="col-md-3 ">No of Per Viewer Count</label>
					<div class='col-md-7' data-toggle="tooltip" data-placement="right" title="How many time one person can see the message">
						<input type="number" min="0" name="no_of_per_views" value="<?php echo (get_data('no_of_per_views')!='-1')?get_data('no_of_per_views'):''?>" class="form-control" placeholder="Enter No of Per Views Count" <?php echo (!userExist($this->userId))?'disabled':'' ?>>
					</div>
	            </div>
	            <div class="form-group">
	                <label class="col-md-3 ">Message Access Type</label>
					<div class='col-md-7' data-toggle="tooltip" data-placement="right" title="Message Access Able By Registered Users Or Non-Registered Users">
						<div class='input-group'>
							<select class="selectpicker" name="msgaccess" <?php echo (!userExist($this->userId))?'disabled':'' ?>>
								<option disabled selected value="">Select Message Access Type</option>
								<option <?php echo (get_data('msgaccess')=='global')?'selected':'' ?> value="global">Public</option>
								<option <?php echo (get_data('msgaccess')=='local')?'selected':'' ?> value="local">Private</option>
							</select>
						</div>
					</div>
	            </div>
	        
           	
	            <div class="form-group">
	                <label class="col-md-3 ">COMMENT ALLOWED:</label>
					<div class='col-md-4' data-toggle="tooltip" data-placement="right" title="Allow the comments on the message from the viewers">
						<input name="allowcomment" type='checkbox'  class="form-control" <?php echo (!userExist($this->userId))?'disabled':'' ?> />
					</div>
					<div class='col-md-3' style="display:none" id="commentstatediv" data-toggle="tooltip" data-placement="right" title="Comment Seen by everyone or only by pear to pear">
						<input name="commentstate" type='checkbox' value="global" class="form-control" <?php echo (!userExist($this->userId))?'disabled':'' ?> />
						<!-- <input name="commentstate" type='radio' class="form-control" /> -->
					</div>
	            </div>
        	
			<div class="form-group">
				<?php if(!empty(get_data('update'))){ ?>
                	<input type="submit" name="update" value="Update" class="btn btn-primary pull-right">
				<?php }else{ ?>
                	<input type="submit" name="submit" class="btn btn-primary pull-right">
            	<?php } ?>
            </div>
					</form>
				</div>
				<!-- end col-8 -->
				<!-- begin col-4 -->
				<div class="col-md-3">

					<div class="panel panel-inverse" data-sortable-id="index-10">
						<div class="panel-heading">
							<div class="panel-heading-btn">
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
							</div>
							<h4 class="panel-title">Calendar</h4>
						</div>
						<div class="panel-body">
							<div id="datepicker-inline" class="datepicker-full-width"><div></div></div>
						</div>
					</div>
				</div>
				<!-- end col-4 -->
			</div>
			<!-- end row -->
<script type="text/javascript">

	$(document).ready(function(){
		$('input[name="allowcomment"]').bootstrapSwitch();
		$('input[name="commentstate"]').bootstrapSwitch({
			'onText':'Global',
			'offText':'Private',
			'onColor':'success',
			'offColor':'primary'
		});

	<?php if(userExist($this->userId)): ?>
		$('input[name="allowcomment"]').on('switchChange.bootstrapSwitch', function(event, state) {

			if(state === true){
				$("#commentstatediv").fadeIn(100);
			}else{
				$("#commentstatediv").fadeOut(100);
			}
		});
	<?php endif; ?>
		$(".selectpicker").selectpicker("render");


		$(function () {

			

		<?php 	if(!empty(get_data('fromdate'))){ ?>
					var fromdate = "<?php echo get_data('fromdate')?>";
				<?php }else{ ?>
					var fromdate = gettime("<?php echo get_data('starttime')?>");
				<?php } ?>
		<?php 	if(!empty(get_data('todate'))){ ?>
					var todate = "<?php echo get_data('todate')?>";
				<?php }else{ ?>
					var todate = gettime("<?php echo get_data('endtime')?>");
				<?php } ?>

			$('#datetimepicker6').datetimepicker({

				minDate:new Date(),
				useCurrent:false,
				showClear:true,
				showTodayButton:true,
				// sideBySide: true,
				<?php if(!empty(get_data('fromdate'))||!empty(get_data('starttime'))): ?>
				defaultDate: fromdate,
				<?php endif; ?>
				<?php if(!empty(get_data('todate'))||!empty(get_data('endtime'))){ ?>
					maxDate:todate
				<?php } ?>
			});

			$('#datetimepicker7').datetimepicker({
					useCurrent: false, //Important! See issue #1075
					showClear:true,
					showTodayButton:true,
					minDate:new Date(),
					// sideBySide: true,
					<?php if(!empty(get_data('todate'))||!empty(get_data('endtime'))): ?>
					defaultDate: todate,
					<?php endif; ?>
					<?php if(!empty(get_data('fromdate'))||!empty(get_data('starttime'))){ ?>
						minDate:fromdate
					<?php } ?>
			});

			$("#datetimepicker6").on("dp.change", function (e) {
					$('#datetimepicker7').data("DateTimePicker").minDate(e.date);
			});
			$("#datetimepicker7").on("dp.change", function (e) {
					$('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
			});
		});


	});

/*Code For Auto Save*/
<?php if(userExist($this->userId)): ?>
	$(document).ready(function(){
		CKEDITOR.instances['message'].on('focus',function(){
			setInterval(function(){
				// var message = $("textarea[name=message]").val();
				url = $("input[name=url]").attr('value');
				$.post("<?=base_url().'message/url_generator'?>",{'url':url},function(data){
					if(data != ''){

						if(url == null){

							$('#messageform').append('<input type="hidden" value="'+data+'" name="url">');
							// console.log($("input[name=url]").attr('value'));
						}

						message = CKEDITOR.instances['message'].getData();

						var data = $('#messageform').serializeArray();

						data.push({
						    name: "message",
						    value: message
						});

						data.push({
						    name: "autosave",
						    value: '1'
						});

						data = jQuery.param(data);
						$.post("<?php echo base_url();?>message/save", data);

					}else{
						console.log('Ajax Error');
						$("div#back_result").css({'display':'none'});
					}
				});

			},60000);//60000
		});
	});
<?php endif; ?>

/*Code For Auto Save End*/

		function addZero(i) {
		    if (i < 10) {
		        i = "0" + i;
		    }
		    return i;
		}

		$("input[type=submit]").click(function(){
			var now = new Date();
			hours = addZero(now.getHours());
			mints = addZero(now.getMinutes());
			secs = addZero(now.getSeconds());
			zone = now.getTimezoneOffset();
			ampm= 'am';
			if(hours>= 12){
				if(hours>12) hours -= 12;
				ampm= 'pm';
			}
			userTime = hours+":"+mints+" "+ampm;
			$("input[name=user_time]").val(userTime);
			$("input[name=user_zone]").val(zone);
		});

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
				} //
				return (month + "/" + day + "/" + year + " " + hours + ":" + minutes+" "+ampm );
			}else{
				return '';
			}
		}
</script>