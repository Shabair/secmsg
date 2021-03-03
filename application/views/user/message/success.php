
<style type="text/css">

	blockquote{

	    background-color: #FFF;
	    border-left: 5px solid #5F5959;
	}

	.message{
		margin-left: 50px;
	}
</style>


<!-- begin wrapper -->
    <div class="wrapper">
<blockquote>
<?php


echo "Your message url is : <span class='message' id='url'>".base_url().$url."</span>";
?>

<button type="button" id="formard" class="btn btn-primary pull-right" style="margin:-5px" onclick="">Forward</button>

<button type="button" class="btn btn-warning pull-right" style="margin:-5px 15px 0 0" onclick="copyToClipboard('#url')">Copy</button>
</blockquote>


        <div class="p-30 bg-white" id="forward_div" style="display: none">
            <!-- begin email form -->
            <form action="<?php echo base_url();?>message/forward" method="POST" name="email_to_form">
            <!-- <input type="hidden" name="url" value="<?php echo base_url().$url?>"> -->
                <!-- begin email to -->
                <label class="control-label">To:</label>
                <div class="m-b-15">
                    <ul id="email-to" class="inverse" name="emails[]">
                    </ul>
                </div>
                <!-- end email to -->
                <!-- begin email subject -->
                <label class="control-label">Subject:</label>
                <div class="m-b-15">
                    <input type="text" class="form-control" name="subject" />
                </div>
                <!-- end email subject -->
                <!-- begin email content -->
                <label class="control-label">Content:</label>
                <div class="m-b-15">
                    <textarea class="textarea form-control" id="wysihtml5" name="content" placeholder="Enter text ..." rows="12"><?php echo base_url().$url;?></textarea>
                </div>
                <!-- end email content -->
                <button type="submit" class="btn btn-primary p-l-40 p-r-40">Send</button>
            </form>
            <!-- end email form -->
        </div>
    </div>
		            <!-- end wrapper -->


<script type="text/javascript">
	function copyToClipboard(element) {
	  var $temp = $("<input>");
	  $("body").append($temp);
	  $temp.val($(element).text()).select();
	  document.execCommand("copy");
	  $temp.remove();
	}

    $(document).ready(function(){
        $("#formard").on('click',function(){
            $("#forward_div").toggle('slow');
            // $("#wysihtml5").value("");
        });
    });

</script>