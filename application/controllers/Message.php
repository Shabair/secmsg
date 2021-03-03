<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message extends MY_Controller {
	private $visitorInfo = null;
	function __construct(){
		parent::__construct();

		$this->load->helper('form');
    	$this->load->library('form_validation');
    	$this->load->model('message_model');
		$this->load->vars('files','message');
	}


	function view($msg){
		
		$message = $this->message_model->getMessage($msg); //get data in object array

		if($message === false || $message->status === 'del' || $message->status === 'pdel' || $message->saved === '1'){
			$data =[
					'view'=>'error',
					'title'=>'Error | Secure Message',
				];
			return $this->load->view('user/layout',$data);
		}

		if($message->msgaccess == 'local' && !userExist($this->userId)): 
			$data =[
					'view'=>'errors/need_login',
					'title'=>'Error | Secure Message',
				];
			return $this->load->view('user/layout',$data);
		endif;
		if($message->block_countries !== NULL){
			$BLCountries = explode(',', $message->block_countries);
			$userCountry = getIpInfo('country');
			if(in_array($userCountry, $BLCountries)){
				$data =[
					'view' =>	'error',
					'title'=>	'Error | Secure Message',
				];
				return $this->load->view('user/layout',$data);
			}
		}

		$currentTime = strtotime(date("m/d/Y h:i:sa"));

		if(!($message->starttime <= $currentTime) || (($message->endtime <= $currentTime) && !empty($message->endtime))){
				$data =[
					'view'=>'error',
					'title'=>'Error | Secure Message',
				];
				return $this->load->view('user/layout',$data);
			// return redirect(base_url());
		}

		// no of viewer count start
		$this->visitorInfo = getIpInfo();
		if($message->no_of_views != '-1'){
			$totalViewers = $this->message_model->totalViewers($msg);
			$userData =[
				'url' => $msg,
				'userip' => $this->visitorInfo['ip'],
				'userid' => $this->session->userdata("user_login")['userId']
			];

			if($totalViewers == $message->no_of_views && $this->message_model->notViewBy($userData)){
					$data =[
						'view'  => 'errors/default',
						'title' => 'Error | Secure Message',
						'heading' => 'No of Viewers exceeded',
						'body' => 'Contact to the Sender To Increase the number of Viewers',
					];
					return $this->load->view('user/layout',$data);
			}
		}
		
		// no of viewer count end


		/*Per Viewer Count*/
		$userData = [
				'msgUrl'=>$msg,
				'userIp'=>$this->visitorInfo['ip'],
				'userId'=>$this->session->userdata("user_login")['userId']
		];

		$msgCount = $this->message_model->getMsgCount($userData);
		if(!empty($msgCount->count) && $message->no_of_per_views != '-1'){
			if(($msgCount->count) >= ($message->no_of_per_views)){
				$data =[
					'view'  => 'errors/default',
					'title' => 'Error | Secure Message',
					'heading' => 'No of View exceeded',
					'body' => 'Contact to the Sender To Increase the number of Views',
				];
				return $this->load->view('user/layout',$data);
			}
		}

		/*Per Viewer Count End*/

		if(!empty($message->msgpassword)){
			$getmsgpassword = $this->input->post('getmsgpassword');
			if($getmsgpassword !== textDecrypt($message->msgpassword)){
				$error = '';
				if(NULL !== $this->input->post('getmsgpasswordform'))
				$error="Password Not Corrected!";

				$data =[
					'view'=>'user/message/password',
					'title'=>'Message Password',
					'url' =>$msg,
					'error'=>$error
				];
				return $this->load->view('user/layout',$data);
			}
			
		}
		$this->msgVisitorDet($msg);

		$data=[
			'view'=>'user/message/view',
			'title'=>'Message View',
			'message'=>$message
		];

		header( "refresh:500;url=".base_url().'userpanel' );
		$this->load->view('user/layout',$data);

	}

	function url_generator(){

		$url = $this->input->post('url');

		if(empty($url)){
			$url = url_generator();


			echo $url;
		}else{
			echo $url;
		}


	}

	function country_check($asasd,$country){
		$countries = get_country();
		$commingCntry = explode(',', $country);

        foreach ($commingCntry as $coun) {
   	        if(!array_key_exists($coun,$countries)){
   	        	$this->form_validation->set_message('country_check', "Please Check The Correct Countries");
   	        	return false;
       		}
        }

        return true;

	}

	function save(){

		// die(var_dump($this->input->post()));
		$this->form_validation->set_rules('message', 'Message', 'required');
		$this->form_validation->set_rules('subject', 'Subject', 'required');
		$this->form_validation->set_rules('msgaccess', 'Message Access Type', 'in_list[global,local]');

		$country = NULL;
    if(!empty($this->input->post('country'))){
    	$country = implode(',', $this->input->post('country'));
    	$this->form_validation->set_rules('country', 'Country', "callback_country_check[$country]");
    }

    $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

    if ($this->form_validation->run() == FALSE){

    	$this->load->library('form_validation');
			$this->editor('');
			$data =[
				'view' => 'user/dashboard',
				'title' => 'Dashboard'
			];
			$this->load->view('user/layout',$data);

    }else{

			$subject=$this->input->post('subject');
			$message=textEncrypt($this->input->post('message'));
			if(!empty($this->input->post('msgpassword'))){
				$msgpassword=textEncrypt($this->input->post('msgpassword'));
			}else{
				$msgpassword = '';
			}
			$starttime=$this->input->post('starttime');
			$endtime=strtotime($this->input->post('endtime'));
			$allowcomment=$this->input->post('allowcomment');
			if(!empty($allowcomment) && userExist($this->userId)){
				$commentstate=$this->input->post('commentstate');
				if(empty($commentstate)){
					$commentstate = 'private';
				}else{
					
					$commentstate = 'global';
				}
			}else{
					$commentstate = 'no';
			}

			
			if(userExist($this->userId)){
				$msgaccess = $this->input->post('msgaccess');
			}

			if(empty($msgaccess)){

				$msgaccess = 'global';
			
			}

			if(userExist($this->userId)){
				$no_of_views=(!empty($this->input->post('no_of_views')))?$this->input->post('no_of_views'):'-1';
			}else{
				$no_of_views = '-1';
			}

			if(userExist($this->userId)){
				$no_of_per_views=(!empty($this->input->post('no_of_per_views')))?$this->input->post('no_of_per_views'):'-1';
			}else{
				$no_of_per_views = '-1';
			}

			$userCurrentTime = strtotime($this->input->post('user_time'));

			if(!empty($this->input->post('fromdate'))){
				$fromdate= strtotime($this->input->post('fromdate')); //convert time into seconds 01/01/1970
				$fromdate = $fromdate + ($this->input->post('user_zone')*60);
			}else{
				$fromdate = time();
			}

			if(!empty($this->input->post('todate'))){
				$todate= strtotime($this->input->post('todate'));
				$todate = $todate + ($this->input->post('user_zone')*60);
			}else{
				$todate ='';
			}


			$data =[
				'subject' =>$subject,
				'message' =>$message,
				'msgpassword'=>$msgpassword,
				'block_countries' => $country,
				'no_of_views' => $no_of_views,
				'no_of_per_views' => $no_of_per_views,
				'starttime'=> $fromdate,
				'endtime'=> $todate,
				'msgaccess'=>$msgaccess,
				'commentstate' => $commentstate,
				"user_id" =>$this->session->userdata('user_login')['userId']
			];

			$url = $this->input->post('url');
			if(empty($url)){
				$url = url_generator();
			}

			if(!empty($this->input->post('submit')) || !empty($this->input->post('update'))){
				$data['saved'] = '0';
				// $data['status'] = '';
			}/*else{
				$data['status'] = 'del';
			}*/

			if($this->message_model->isMessage($url) === true){

				$this->message_model->update($url,$data);
				
			}else{

				$data['url'] = $url;	
				$this->message_model->save($data);
			}



			$data = [
				'view' =>'user/message/success',
				'title' =>'Message Saved',
				'url' => $url
			];
// die($url);
			$this->session->set_tempdata('message_url', $url, 300);
			// $this->session->set_flashdata('message_url',$url);
	// $this->load->
			return redirect('message/success');
		}
	}

	function edit($url){
		// $message = $this->message_model->getMessage($url);
		// $this->editor('');
		// $data =[
		// 	'view' => 'user/dashboard',
		// 	'title' => 'Dashboard',
		// 	'message'=>$message
		// ];
		// $this->load->view('user/layout',$data);
	}

	function success(){

		$data = [
			'view' =>'user/message/success',
			'title' =>'Message Saved',
			'url' => $this->session->tempdata('message_url')
		];
		return $this->load->view('user/layout',$data);
	}

	function delete($url = null){

		if(!empty($this->input->post('deletedUrl'))){
			$url = $this->input->post('deletedUrl');
		}

		$perDelete = ($this->session->userdata('messagestatus') == 'del')?true:false;

		if($this->message_model->delete($url,$perDelete)){
			echo 'true';
		}else{
			echo 'false';
		}
	}

	function restore(){
		if(!empty($this->input->post('restoreUrl'))){
			$url = $this->input->post('restoreUrl');
		}

		if($this->message_model->restore($url)){
			echo 'true';
		}else{
			echo 'false';
		}

	}
	function setBookmark(){
		$url = $this->input->post('bookmarkUrl');

		$this->message_model->setBookmark($url,$this->userId);
	}

	function msgVisitorDet($url){
		// $visitorInfo = getIpInfo();
		// $visitorInfo;
		// var_dump($visitorInfo);
		// die();
		$userId = $this->session->userdata("user_login")['userId'];
		//$cookieUserId = unserialize(get_cookie('localUser'))['userId']
		$userIp=$this->visitorInfo['ip'];
		$loc=$this->visitorInfo['loc']; // add logitude and latitude

		$data = [
				'msgUrl'=>$url,
				'userIp'=>$userIp,
				'userId'=>$userId
		];
		$msgCount = $this->message_model->getMsgCount($data);
		// var_dump($msgCount);
		// die();
		$data['loc'] = $loc;
		$this->message_model->msgHistory($data); // insert msg viewer Ip ,userId with msgUrl
		// die();
		if(empty($msgCount)){
			$data['count'] = 1;
		}else{
			$data['count'] = ++$msgCount->count;
		}
		//var_dump($msgCount);
		//die();
		$this->message_model->addMsgCount($data); // increment the msg view count by ip and userId
		// die($this->db->last_query());
	}

	function forward(){
		// var_dump($this->input->post());

		$this->load->library('email');
		$emails = $this->input->post('emails');
		for ($i=0; $i < count($emails); $i++) { 
			
		
			$this->email->from(getUser('email'), getUser('firstname'));
			$this->email->to($emails[$i]);
			// $this->email->cc('another@another-example.com');
			// $this->email->bcc('them@their-example.com');

			$this->email->subject($this->input->post('subject'));
			$this->email->message($this->input->post('content'));

			$this->email->send();
			$this->session->set_flashdata('success', 'Your Message Send To all Mentioned Emails Successfully');
			return redirect('userpanel');
		}
	}


	function comment(){

		$data = [
			'comment'	=>	$this->input->post('comment'),
			'userid'	=>	$this->input->post('userid'),
			'msgurl'	=>	$this->input->post('msgurl'),
			'nickname'	=>	$this->input->post('nickname'),

		];
		$result = $this->message_model->insertComment($data);
		if($result > 0){
			echo 'true';
		}else{
			echo 'false';
		}
	}


}//end of class
