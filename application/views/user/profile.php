<!-- begin profile-container -->
<?php //var_dump($userData) ?>
            <div class="profile-container">
                <!-- begin profile-section -->
                <div class="profile-section">
                    <!-- begin profile-left -->
                    <div class="profile-left">
                        <!-- begin profile-image -->
                        <?php if(!empty($userData->profile_img)){
                          $profileImg = base_url('uploads/users/').$userData->profile_img;
                        }else{
                          $profileImg = base_url('assets/img/local_user.jpg');
                        } ?>
                        <div class="profile-image" id="profileImageUpload">
                            <img src="<?php echo $profileImg?>" />
                            <i class="fa fa-user hide"></i>
                        </div>
                        <!-- end profile-image -->
                        <div class="m-b-10">
                            <form id="imageUploadForm" action="<?php echo base_url()?>userpanel/ajaxPrfileImageUpload" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="user_id" value="<?php echo $userData->id?>">
                                <div class="fileupload fileupload-new " data-provides="fileupload" >
                                    <span class="btn btn-warning btn-block btn-sm btn-file">
                                        <span class="fileupload-new"><i class="fa fa-undo"></i> Update Profile Image</span>
                                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Update Profile Image</span>
                                        <input type="file" name="ImageBrowse" id="ImageBrowse">
                                    </span>
                                </div>

                            </form>
                            <!-- <a href="#" class="btn btn-warning btn-block btn-sm" id="imageUpload">Change Picture</a> -->
                        </div>
                        <!-- begin profile-highlight -->

                        <!-- end profile-highlight -->
                    </div>
                    <!-- end profile-left -->
                    <!-- begin profile-right -->
                    <div class="profile-right">
                        <!-- begin profile-info -->
                        <div class="profile-info">
                            <!-- begin table -->
                            <div class="table-responsive">

                                <table class="table table-profile">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>
                                                <h4>
                                                    <a data-name="firstname" data-type="text" data-pk="<?php echo $userData->id?>" data-title="Edit Firstname"  class="editable" ><?php echo $userData->firstname?></a>&nbsp;
                                                    <a data-name="lastname" data-type="text" data-pk="<?php echo $userData->id?>" data-title="Edit Lastname"  class="editable"><?php echo $userData->lastname?></a>

                                                    <a class="pull-right btn btn-primary" id="editablebtn"><i class="fa fa-pencil"></i> Edit Profile</a>
                                                </h4>

                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="highlight">
                                            <td class="field">Username</td>
                                            <td><a href="#"></a><?php echo $userData->username; ?></td>
                                        </tr>
                                        <tr class="highlight">
                                            <td class="field">Status</td>
                                            <td><a data-name="status" data-type="text" data-pk="<?php echo $userData->id?>" data-title="Edit Status"  class="editable"  ><?php echo isset($userData->status)?$userData->status:'<i style>Enter Your Status</i>'; ?></a></td>
                                        </tr>
                                        <tr class="divider">
                                            <td colspan="2"></td>
                                        </tr>
                                        <tr>
                                            <td class="field">Password</td>
                                            <td><a data-name="password" data-type="password" data-pk="<?php echo $userData->id?>" data-title="Edit Password"  class="editable"  >*************</a></td>
                                        </tr>
                                        <tr>
                                            <td class="field">Email</td>
                                            <td><a data-name="email" data-type="email" data-pk="<?php echo $userData->id?>" data-title="Edit Password"  class="editable"  ><?php echo $userData->email; ?></a></td>
                                        </tr>
                                        <tr>
                                            <td class="field">Gender</td>
                                            <td>
                                                <a data-name="gender" data-type="select" data-pk="<?php echo $userData->id?>" data-title="Select Gender" id="gender"></a>
                                            </td>
                                        </tr>
                                        <tr class="divider">
                                            <td colspan="2"></td>
                                        </tr>
                                        <tr class="highlight">
                                            <td class="field">Country</td>
                                            <td><a data-name="country" data-type="text" data-pk="<?php echo $userData->id?>" data-title="Enter Country"  class="editable"  ><?php echo isset($userData->country)?$userData->country:'<i style>Enter Your Country</i>'; ?></a></td>
                                        </tr>
                                        <tr class="highlight">
                                            <td class="field">State</td>
                                            <td><a data-name="state" data-type="text" data-pk="<?php echo $userData->id?>" data-title="Edit State"  class="editable"  ><?php echo isset($userData->state)?$userData->state:'<i style>Enter Your State</i>'; ?></a></td>
                                        </tr>
                                        <tr class="highlight">
                                            <td class="field">Address</td>
                                            <td><a data-name="address" data-type="text" data-pk="<?php echo $userData->id?>" data-title="Edit Address"  class="editable"  ><?php echo isset($userData->address)?$userData->address:'<i style>Enter Your Address</i>'; ?></a></td>
                                        </tr>
                                        <tr class="divider">
                                            <td colspan="2"></td>
                                        </tr>
                                        <tr>
                                            <td class="field">Birthdate</td>
                                            <td>
                                                <a data-name="dob" data-type="combodate" data-value="<?php echo (!empty($userData->dob))?$userData->dob:"1970-01-01"?>" data-pk="<?php echo $userData->id?>" data-title="Select Birthdate" id="dob"></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="field">Language</td>
                                            <td>
                                                <select class="form-control input-inline input-xs" name="language">
                                                    <option value="" selected>English</option>
                                                </select>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- end table -->
                        </div>
                        <!-- end profile-info -->
                    </div>
                    <!-- end profile-right -->
                </div>
                <!-- end profile-section -->
                <!-- begin profile-section -->

                <!-- end profile-section -->
            </div>
			<!-- end profile-container -->



<script type="text/javascript">



        function enableFunc(classes,obj = null){

           $(classes).each(function(){

                if($(this).text() == 'Empty' && !$(this).hasClass('editable-empty')){
                    $(this).editable('setValue','');
                }

                if($(this).text() == 'Empty' && $(this).hasClass('editable-empty')){
                    $(this).editable('setValue',"Empty",true);
                    $(this).html('<i class="text-danger">Empty</i>');
                    //console.log('asda');
                }

           });

           $(classes).editable('toggleDisabled') ;

           obj.find("i").toggleClass(function() {
              if ( $( this ).hasClass( "fa-pencil-square-o" ) ) {
                //$(this).parent().hasClass()
                $( this ).removeClass('fa-pencil-square-o').parent().removeClass('btn-primary').addClass('btn-danger');
                return "fa-times";
              } else {
                $( this ).removeClass('fa-times').parent().removeClass('btn-danger').addClass('btn-primary');
                return "fa-pencil-square-o";
              }
            });
        }





    $(document).ready(function() {
        $('.editable').editable({
                url:'<?php echo base_url('userpanel/edit_profile')?>',
                placeholder:'Empty',
                disabled:true,

        });

        $('#editablebtn').click(function() {
            enableFunc('.editable',$(this));

            $("#gender").disabled();

            $("#state").editable('toggleDisabled');
            $("#dob").editable('toggleDisabled');
        });



        $('#gender').editable({
            url:'<?php echo base_url('userpanel/edit_profile')?>',
            placeholder:'Empty',
            disabled:true,
            value: "",
            source: [
                  {value: '', text: 'Select gender'},
                  {value: 'm', text: 'Male'},
                  {value: 'f', text: 'Female'}
               ]
        });

        $('#dob').editable({
            url:'<?php echo base_url('userpanel/edit_profile')?>',
            format: 'YYYY-MM-DD',
            viewformat: 'DD.MM.YYYY',
            template: 'D / MMMM / YYYY',
            disabled:true,
            combodate: {
                    minYear: 1985,
                    maxYear: <?php echo date("Y"); ?>,
                    minuteStep: 1
               }
            });


    });


$(document).ready(function (e) {
    $('#imageUploadForm').on('submit',(function(e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            type:'POST',
            url: $(this).attr('action'),
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
                var img = '<?php echo base_url()."uploads/users/"?>'+data;
                $("#profileImageUpload").html('<img src="'+img+'" /><i class="fa fa-user hide"></i>');
            },
            error: function(data){
            }
        });
    }));

    $("#ImageBrowse").on("change", function() {
        $("#imageUploadForm").submit();
    });
});

</script>
