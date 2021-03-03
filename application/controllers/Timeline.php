<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Timeline extends MY_Controller {

  function __construct(){
    parent::__construct();
    $this->load->library('datatable');
    $this->load->model('timeline_model','tl');
    $data= [
      "tLSidebar" =>'user/timeline/sidebar',
      'files' =>'timeline'
    ];
    $this->load->vars($data);
  }

  public function search(){
    if(!empty($this->input->post('messageType'))){
      $this->session->set_userdata('messageType',$this->input->post('messageType'));
    }
      $this->session->set_userdata('fromdate',$this->input->post('fromdate'));
      $this->session->set_userdata('todate',$this->input->post('todate'));
      $this->session->set_userdata('zone',$this->input->post('zone'));

  }
  public function datatable_json()
  	{
  		 $id_login = $this->session->userdata('user_login')['userId'];

         $Records = $this->tl->GetAll($id_login);

          $data = array();
          $count = 1;
          foreach ($Records['data']  as $message)
  		{

        $data[]=array( //<i class="fa fa-folder-open"></i>
          '<input type="checkbox" data-url="'.$message['url'].'">',
          substr($message['subject'],0,25).((strlen($message['subject'])>25)?"...":''),
          '<span class="message-actions"><a href="javascript:;" class="email-btn" data-click="email-archive"></a><a href="javascript:;" class="message-delete" data-click="'.$message['url'].'"><i class="fa fa-trash-o"></i></a><a href="javascript:;" class="message-bookmark'.(($message['bookmark']==1)?' text-danger':'').'" data-click="'.$message['url'].'"><i class="fa fa-star"></i></a>'.(($this->session->userdata('messagestatus')=='del')?'<a href="javascript:;" class="message-restore" data-click="'.$message['url'].'"><i class="fa fa-folder-open"></i></a>':'').'</span>',
          '<a href="javascript:;" onclick="viewmsg(\''.$message['url'].'\')">'.base_url().$message['url'].'</a>',
          strtotime($message['create_date']),
          $message['starttime'],
          (!empty($message['endtime']))?$message['endtime']:''
        );
          }

// echo $this->db->last_query();
// die();
  		$Records['data']=$data;
          echo json_encode($Records);
  	}

  private function unSetFilters(){
    $this->session->unset_userdata('messageType');
    $this->session->unset_userdata('fromdate');
    $this->session->unset_userdata('todate');
    $this->session->unset_userdata('zone');

    $this->session->unset_userdata('messagestatus');
    $this->session->unset_userdata('timelineReq');
  }

  function index(){
    $this->unSetFilters();

    $data = [
      "title" => "TimeLine",
      "view"  => "user/timeline/timeline",
    ];

    $this->load->view('user/layout',$data);
  }

  function view($url){
    
    $userId = $this->session->userdata('user_login')['userId'];
    $message = $this->tl->singleMessage($url,$userId);
    if($message){
      $data = [
        "title" => $message->url."-Message",
        "view"  => "user/timeline/view",
        "files" => "timeline",
        "message" => $message,
      ];

      $this->load->view('user/layout',$data);
    }else{
      return errorPage();
    }

  }



  function getPage(){
    $page = $this->input->post('page');
    $where = $this->input->post('where');
    $userId = $this->session->userdata('user_login')['userId'];
    $data = array();
    switch ($page) {
      case 'view':
          $message = $this->tl->singleMessage($where,$userId);
          if($message){
            ob_start();
            ?>
            <div class="wrapper" style="background-color:#fff">
              <h4 class="m-b-15 m-t-0 p-b-10 underline"><?php echo $message->subject ?></h4>
              <?php echo textDecrypt($message->message) ?>
            </div>
            <?php
            echo ob_get_clean();
          }
        break;
    case 'trash':

      $this->unSetFilters();
      $this->session->set_userdata('messagestatus','del');

    break;
    case 'bookmarks':

      $this->unSetFilters();
      $data = [
                'bookmark' =>['=','1']
      ];
      $this->session->set_userdata('timelineReq',$data);

    break;
    case 'inbox':

      $this->unSetFilters();
      $this->session->unset_userdata('messagestatus');

    break;
    case 'map':
      $locs = $this->tl->getMsglnglat($where);
      $lnglat = [];
      foreach ($locs as $loc) {
        $loc = explode(',',$loc->loc);
        $lnglat[] = ['123456789',$loc[0],$loc[1]];
      }
    echo json_encode($lnglat);

    break;
    case 'draft':
      $this->unSetFilters();
      $this->session->set_userdata('messageType','pandding');

    break;
    case 'saved':
      $this->unSetFilters();
      $this->session->set_userdata('messageType','saved');

    break; 
      default:

              $getMessage = $this->tl->getMessages($this->session->userdata('user_login')['userId'],$where);
              if(!empty($getMessage)){
                foreach ($getMessage as $message) {
                  $data[]=array(
                    substr($message->subject,0,25).((strlen($message->subject)>25)?"...":''),
                    '<span class="message-actions"><a href="#" class="email-btn" data-click="email-archive"><i class="fa fa-folder-open"></i></a><a href="#" class="message-delete"><i class="fa fa-trash-o"></i></a><a href="#" class="email-btn" data-click="email-highlight"><i class="fa fa-flag"></i></a></span>',
                    strip_tags(substr($message->message,0,45)).((strlen($message->message)>45)?"...":''),
                    strtotime($message->create_date),
                    $message->starttime,
                    (!empty($message->endtime))?$message->endtime:''
                  );
                }
              }
        break;
    }

  }

}//end Timeline class
