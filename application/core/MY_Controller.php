<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	 public $userId = '';
	 public $data = '';
	 public $temdata = '';
	 
	function __construct(){
		parent::__construct();

		$this->userId = $this->session->userdata('user_login')['userId'];
		$this->setCookie();

		$this->userCheck();

	}

	function userCheck(){
		$localUser = get_cookie('localUser');
		if(!$localUser && empty($this->session->userdata('user_login'))){
			$sessionID = md5(openssl_random_pseudo_bytes ((12)));
			$userID = md5(openssl_random_pseudo_bytes ((15)));

			$data=[
				"userType" => "local",
				"userId"	=>$userID,
				"id" =>$sessionID,
				'firstname'=>"Fisrt Name",
				'lastname'=>"Last Name",
				'profile_img' => "local_user.jpg"
			];

			$dbData =[
				"machine" =>$this->input->user_agent(),
				"id"=>$data['id'],
				"ipaddress" => $this->input->ip_address()
			];

			$this->db->insert("cookies",$dbData);
			$this->session->set_userdata("user_login",$data);
			//
			$ciphertext = serialize($data);

			$cookie =[
				'name' =>'localUser',
				'value' => $ciphertext,
				'expire' =>8800,
				'domain' =>'localhost',
				'path' => '/',
			];
			set_cookie($cookie);

		}
	}

	function setCookie(){
		$cypher = get_cookie('rememberme');
		if(!empty($cypher)){
			if(empty($this->session->userdata('user_login'))){
				$plain = $this->encrypt->decode($cypher);
				$plain = explode('::',$plain);
				$username = $plain[0];
				$password = md5($plain[1]);
				$query = $this->db->query("SELECT `id`,`firstname`,`lastname`,`profile_img` FROM `users` WHERE `username`='".$username."' AND `password`='".$password."' ");
				if($result = $query->row()){
					$data = [
						'firstname'=>$result->firstname,
						'lastname'=>$result->lastname,
						'userId'=>$result->id,
						'profile_img' => $result->profile_img
					];
					$this->session->set_userdata('user_login',$data);
				}
			}
		}
		$localUser = get_cookie('localUser');
		if(!empty($localUser)){
			$ciphertext = unserialize($localUser);
			$this->session->set_userdata("user_login",$ciphertext);
		}
	}

	function editor($path) {
	    //Loading Library For Ckeditor
	    $this->load->library('CKEditor');
	    $this->load->library('CKFinder');
	    //configure base path of ckeditor folder
	    $this->load->helper('url');
	    $this->ckeditor->basePath = base_url().'assets/js/ckeditor/';
	    $this->ckeditor->config['toolbar'] = 'Full';
	    $this->ckeditor->config['language'] = 'en';
	    $this->ckeditor->config['width'] = 712.5;
	    $this->ckeditor->config['height'] = 252;
	    //configure ckfinder with ckeditor config
	    $this->ckfinder->SetupCKEditor($this->ckeditor,$path);

	}

}
