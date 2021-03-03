<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Timeline_model extends CI_Model {

  function GetAll($id_login)
  {
  	$wh =array();
    $systemTime = time();
  	if($this->session->userdata('messageType')!=''){
      $messagetype =$this->session->userdata('messageType');
      if($messagetype == 'expired'){
        $wh[] = " `endtime` < '".$systemTime."' AND `endtime` != '' ";
      }else if($messagetype == 'pandding'){
        $wh[] = " `starttime` > '".$systemTime."' ";
      }else if($messagetype == 'current'){
        $wh[] = " `starttime` <= '".$systemTime."' ";
        $wh[] = " (`endtime` >= '".$systemTime."' OR `endtime` = '') ";
      }else if($messagetype == 'saved'){
        $wh[] = " `saved` = '1' ";
      }
  	}else{
      if($this->session->userdata('messagestatus') !== 'del'){
        $wh[] = " `saved` != '1' ";
      }
    }
  	if($this->session->userdata('fromdate')!=''){
      $fromdate =strtotime($this->session->userdata('fromdate'));
      $fromdate = $fromdate + ($this->session->userdata('zone')*60);
        $wh[] = " `starttime` >= '".$fromdate."' ";
  	}
  	if($this->session->userdata('todate')!=''){
      $todate =strtotime($this->session->userdata('todate'));
       $todate = $todate + ($this->session->userdata('zone')*60);
        $wh[] = " `endtime` <= '".$todate."' ";
  	}

    if(!empty($this->session->userdata('messagestatus'))){
      if($this->session->userdata('messagestatus') == 'del'){
        $wh[] = " `status` = 'del' ";
        // $wh[] = " `saved` = '0' ";
      }
    }else{
        $wh[] = " `status` != 'del' ";
        $wh[] = " `status` != 'pdel' ";
    }

    if(!empty($this->session->userdata('timelineReq'))){
        $timelineReq = $this->session->userdata('timelineReq');
        foreach($timelineReq as $key => $value){
          $wh[]=" `".$key."` ".$value[0]." '".$value[1]."' ";
        }
    }

  	$SQL ='SELECT * FROM messages';

  	if($id_login != '')
  	{
  		$wh[]=" user_id = '".$id_login."'";
  		$WHERE = implode(' and ',$wh);
  		return $this->datatable->LoadJson($SQL,$WHERE);
  	}
  	// else if(count($wh)>0)
  	// {
  	// 	$WHERE = implode(' and ',$wh);
  	// 	return $this->datatable->LoadJson($SQL,$WHERE);
  	// }
  	else
  	{
  		return $this->datatable->LoadJson($SQL);
  	}
  }

  function getMessages($userId,$url = ''){
    $where='And ';
    $systemTime = time();
      switch ($url) {
        case 'expired':
                $where .= "`endtime` < '".$systemTime."'";
                $where .= " AND `endtime` != ''";
          break;
        case 'pandding':
                $where .= "`starttime` > '".$systemTime."'";
          break;

        default:
            $where = '';
          break;
      }

    $sql = "SELECT * FROM `messages` WHERE user_id = '".$userId."' ".$where." order by create_date DESC";
    // echo $sql;
    // die();
    return getResult($sql);
  }

  function singleMessage($url,$userId){
    $sql = "SELECT * FROM `messages` WHERE url ='".$url."' AND user_id ='".$userId."'";
    return getSingleResult($sql);
  }//SELECT msg.* ,u.firstname,u.email,u.profile_img FROM `messages` as msg inner join users as u on u.id = msg.user_id WHERE url='8GXDDOSG'

  function getMsglnglat($url){
    $sql = "SELECT `loc` FROM `msgvisitors` WHERE msgUrl = ?";
    return $result = $this->db->query($sql,array($url))->result();

  }
}
