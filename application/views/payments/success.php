<style type="text/css">
    
a {
    text-decoration: none;
}
    
a:hover{
    
    text-decoration: none;
}


</style>
<div class="error">
    <div class="error-code m-b-10"><a style="color: #2d353c;font-size: 48px;" href="<?php echo base_url('userpanel/login')?>"><?php echo $heading?></a></div>
    <div class="error-content">
        <div class="error-message"></div>
        <div class="error-desc m-b-5">
            <?php echo $body ?>
        </div>
        <div>
            <a href="<?php echo base_url()?>" class="btn btn-success">Go Back to Home Page</a>
        </div>
    </div>
</div>
