<style type="text/css">

	blockquote{

	    background-color: #FFF;
	    /*border-left: 5px solid #5F5959;*/
	    border: 3px solid #c5c5c5;
	}

	.message{
		margin-left: 50px;
	}

	.underline{
		border-bottom: 1px solid #e2e7eb!important;
		padding-bottom: 10px;
	}
</style>

<!-- 
<blockquote style="border-left: 5px solid #fff;">
	
</blockquote> -->
<blockquote >
	<h3 class="underline"><?php echo ($message->subject); ?></h3>
	<p class="lead"><?php echo textDecrypt($message->message); ?></p>
	
</blockquote>
<?php if($message->commentstate == 'global' || ($message->commentstate == 'private' && userExist($this->userId))): ?>
	<div class="panel panel-inverse" data-sortable-id="index-5">
		<div class="panel-heading">
			
			<h4 class="panel-title">Comments</h4>
		</div>
		<?php 
			// $CI = &get_instance();
			$sql="SELECT * FROM `comment` WHERE `msgUrl` = '".$message->url."' AND `delete` != '1'"; 
			$result = $this->db->query($sql);
			$totalComments = $result->result();
		?>
		<div class="panel-body">
			<div class="height-sm" data-scrollbar="true">
				<ul class="media-list media-list-with-divider media-messaging" id="commentlist">
				<?php foreach($totalComments as $comment): ?>
					<li class="media media-sm">
						<a href="javascript:;" class="pull-left">
							<img src="<?php echo base_url('uploads/users/'),(!empty(getUserDataById($comment->userId,'profile_img')))?getUserDataById($comment->userId,'profile_img'):'user-'.rand(1,14).'.jpg'?>" alt="" class="media-object rounded-corner" />
						</a>
						<div class="media-body">
							<h5 class="media-heading"><?php echo (!empty(userExist($comment->userId)))?getUserDataById($comment->userId,'firstname')." ".getUserDataById($comment->userId,'lastname'):$comment->nickname ?></h5>
							<p><?php echo $comment->comment ?></p>
						</div>
					</li>
				<?php endforeach; ?>
				</ul>
			</div>
		</div>
		<div class="panel-footer">
			<form id="commentform">
			<?php if(!userExist($this->userId)): ?>
				<div class="form-group" id="nickname_div">
					<label class="control-label">Nick Name</label>
					<input type="text" name="nickname" id="nickname" class="form-control bg-silver" placeholder="Enter Nick Name" required>

				</div>
			<?php endif; ?>
				<div class="input-group">
					<input type="text" name="comment" id="commentfield" class="form-control bg-silver" placeholder="Enter message" required />
					<input type="hidden" name="userid" value="<?php echo $this->userId?>" />
					<input type="hidden" name="msgurl" value="<?php echo $message->url?>" />
					<span class="input-group-btn">
						<button class="btn btn-primary" type="submit" ><i class="fa fa-pencil"></i></button>
					</span>
				</div>
			</form>
        </div>
	</div>
<?php endif; ?>

<?php  getUser('id'); ?>
<script type="text/javascript">
	$(document).on('submit','#commentform',function(e){
		e.preventDefault();
		var data = $(this).serialize();
		if(jQuery('#commentfield').val() != ''){
			$.ajax({
	            method: "POST",
	            url: "<?php echo base_url('message/comment')?>",

	            dataType: " text",
				data:data,
				success: function(data) {
					// data = '';
			  //       $('#commentlist').html($(data).find('#main *'));
			  //       $('#notification-bar').text('The page has been successfully loaded'); 2BBXPV5N
			  $("#nickname_div").fadeOut(200);
			  		console.log($("#nickname").val());
			  		$('#commentlist').append('<li class="media media-sm"><a href="javascript:;" class="pull-left"><img src="<?php echo base_url('uploads/users/'),(!empty(getUser('profile_img')))?getUser('profile_img'):'user-'.rand(1,14).'.jpg'?>" alt="" class="media-object rounded-corner" /></a><div class="media-body"><h5 class="media-heading">'+<?php echo (!empty(userExist($this->userId)))?"'".getUser('firstname')." ".getUser('lastname')."'":"$(\"#nickname\").val()"?>+'</h5><p>'+$("#commentfield").val()+'</p></div></li>');
			  		jQuery('#commentfield').val('');
				},
				error: function() {
				    $('#notification-bar').text('An error occurred');
				}
	        }).done(function(data) {
	           
	            console.log(data);
	            
	        });
		}
		
	});

</script>