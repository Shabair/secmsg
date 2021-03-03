<?php// var_dump($message); ?>
		<div class="p-20">
			<!-- begin row -->
			<div class="row">
			    <!-- begin col-2 -->
			    <?php $this->load->view($tLSidebar); ?>
			    <!-- end col-2 -->
			    <!-- begin col-10 -->
			    <div class="col-md-10">
            <!-- begin wrapper -->
                <div class="wrapper" style="background-color:#fff">
                    <h4 class="m-b-15 m-t-0 p-b-10 underline">Bootstrap v4.0 is coming soon</h4>
                    <ul class="media-list underline m-b-20 p-b-15">
                        <li class="media media-sm clearfix">
                            <a href="javascript:;" class="pull-left">
                                <img class="media-object rounded-corner" alt="" src="assets/img/user-14.jpg" />
                            </a>
                            <div class="media-body">
                                <span class="email-from text-inverse f-w-600">
                                    from support@wrapbootstrap.com

                                </span><span class="text-muted m-l-5"><i class="fa fa-clock-o fa-fw"></i> 8: 30 AM</span><br />
                                <span class="email-to">
                                    To: nguoksiong@live.co.uk
                                </span>
                            </div>
                        </li>
                    </ul>
                    <?php echo textDecrypt($message->message) ?>
                </div>
            <!-- end wrapper -->
          </div>
			    <!-- end col-10 -->
			</div>
			<!-- end row -->
		</div>
		<!-- end #content -->
