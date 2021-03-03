<?php

switch ($page) {
  case 'view': ?>
                <div class="email-btn-row hidden-xs timelinemenu">
                  <a href="#" class="btn btn-sm btn-inverse"><i class="fa fa-plus m-r-5"></i> New</a>
                  <a href="#" class="btn btn-sm btn-default" data-page="inbox"><i class="fa fa-arrow-left m-r-5"></i> Back</a>
                  <a href="#" class="btn btn-sm btn-default disabled">Delete</a>
                  <a href="#" class="btn btn-sm btn-default disabled">Archive</a>
                  <a href="#" class="btn btn-sm btn-default disabled">Junk</a>
                  <a href="#" class="btn btn-sm btn-default disabled">Swwep</a>
                  <a href="#" class="btn btn-sm btn-default disabled">Move to</a>
                  <a href="#" class="btn btn-sm btn-default disabled">Categories</a>
                </div>
                <div class="wrapper" style="background-color:#fff">
                  <h4 class="m-b-15 m-t-0 p-b-10 underline"><?php echo $message->subject ?></h4>
                  <?php echo $message->message ?>
                </div>
  <?php
    break;

  case 'trash':
      echo "trash";
    break;

  default: ?>
          <div class="email-btn-row hidden-xs">
            <a href="#" class="btn btn-sm btn-inverse"><i class="fa fa-plus m-r-5"></i> New</a>
            <a href="#" class="btn btn-sm btn-default temp">Reply</a>
            <a href="#" class="btn btn-sm btn-default disabled">Delete</a>
            <a href="#" class="btn btn-sm btn-default disabled">Archive</a>
            <a href="#" class="btn btn-sm btn-default disabled">Junk</a>
            <a href="#" class="btn btn-sm btn-default disabled">Swwep</a>
            <a href="#" class="btn btn-sm btn-default disabled">Move to</a>
            <a href="#" class="btn btn-sm btn-default disabled">Categories</a>
          </div>
          <div class="email-content">
            <table class="table table-email">
                  <thead>
                      <tr>
                          <th class="email-select"><a href="#" data-click="email-select-all"><i class="fa fa-square-o fa-fw"></i></a></th>
                          <th colspan="2">
                              <div class="dropdown">
                                  <a href="#" class="email-header-link" data-toggle="dropdown">View All <i class="fa fa-angle-down m-l-5"></i></a>
                                  <ul class="dropdown-menu ">
                                      <li class="active message-url"><a href="#" data-page="inbox" data-url="all">All</a></li>
                                      <li class="message-url"><a href="#" data-page="inbox" data-url="unread">Unread</a></li>
                                      <li class="message-url"><a href="#" data-page="inbox" data-url="ended">Ended</a></li>
                                      <li class="message-url"><a href="#" data-page="inbox" data-url="pandding">Pandding</a></li>
                                  </ul>
                              </div>
                          </th>
                          <th>
                              <div class="dropdown">
                                  <a href="#" class="email-header-link" data-toggle="dropdown">Arrange by <i class="fa fa-angle-down m-l-5"></i></a>
                                  <ul class="dropdown-menu">
                                      <li class="active"><a href="#">Date</a></li>
                                      <li><a href="#">From</a></li>
                                      <li><a href="#">Subject</a></li>
                                      <li><a href="#">Size</a></li>
                                      <li><a href="#">Conversation</a></li>
                                  </ul>
                              </div>
                          </th>
                          <th>
                            Start Time
                          </th>
                          <th>
                            End Time
                          </th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php if(!empty($messages)): ?>
                    <?php foreach ($messages as $message) {?>
                      <tr>
                          <td class="email-select"><a href="#" data-click="email-select-single"><i class="fa fa-square-o fa-fw"></i></a></td>
                          <td class="email-sender message-url" >
                            <a href="javascript:;" data-page="view" data-url="<?php echo $message->url?>">
                              <?php echo substr($message->subject,0,25).((strlen($message->subject)>25)?"...":'')?>
                            </a>
                          </td>
                          <td class="email-subject">
                              <a href="#" class="email-btn" data-click="email-archive"><i class="fa fa-folder-open"></i></a>
                              <a href="#" class="email-btn" data-click="email-remove"><i class="fa fa-trash-o"></i></a>
                              <a href="#" class="email-btn" data-click="email-highlight"><i class="fa fa-flag"></i></a>
                              <?php //$text = ; ?>
                              <?php echo strip_tags(substr($message->message,0,45)).((strlen($message->message)>45)?"...":'') ; ?>
                          </td>
                          <td class="email-date"><?php echo strtotime($message->create_date) ?></td>
                          <td class="email-date"><?php echo $message->starttime ?></td>
                          <td class="email-date"><?php if(!empty($message->endtime)) echo $message->endtime ?></td>
                      </tr>
                    <?php } ?>
                  <?php else: ?>
                      <tr>
                        <td colspan="6" class="email-subject text-center">
                          <h3>No Generated Message</h3>
                        </td>
                      </tr>
                  <?php endif; ?>
                  </tbody>
              </table>
            <div class="email-footer clearfix">
                <?php echo (!empty($messages))?count($messages):'0' ?> messages
                <ul class="pagination pagination-sm m-t-0 m-b-0 pull-right">
                    <li class="disabled"><a href="javascript:;"><i class="fa fa-angle-double-left"></i></a></li>
                    <li class="disabled"><a href="javascript:;"><i class="fa fa-angle-left"></i></a></li>
                    <li><a href="javascript:;"><i class="fa fa-angle-right"></i></a></li>
                    <li><a href="javascript:;"><i class="fa fa-angle-double-right"></i></a></li>
                </ul>
            </div>
          </div>
    <?php
    break;
}

?>
<script type="text/javascript">
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
  $(document).ready(function(){

  });
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

setTimeInTable('.table-email',4);
setTimeInTable('.table-email',5);
setTimeInTable('.table-email',6);



</script>
