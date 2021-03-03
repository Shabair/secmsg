<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {

	private $admin;
	function __construct(){
		parent::__construct();

		$this->load->helper('form');
		$this->load->helper('admin');
    	$this->load->library('form_validation');
    	$this->load->model('admin_model','am');
    	$this->admin = $this->session->userdata('admin_login');
	}

	function index(){
			$this->am->getUsersData();
		if($this->admin['admin'] == 'true'){
			$data = [
				'title' => 'Dashboard',
				'view'	=>	'admin/dashboard',
				'usersdata' => $this->am->getUsersData()
			];
			$this->load->view('admin/layout',$data);
		}else{
			redirect('admin/login');
		}
	}

	function login(){

		if(!empty($this->admin['admin'])){
            	msgPage('You Are Already Logged In.');
            	return 0;
        }

		$this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric|callback_username_check');
        $this->form_validation->set_rules('password', 'Password', 'required|callback_password_check');
        $this->form_validation->set_rules('submit', 'Submit', 'in_list[signup]');
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        if ($this->form_validation->run() == FALSE)
        {
            $data =[
				'title' => 'Secure Message Admin | Login Page'
			];
			$this->load->view('admin/login',$data);
        }
        else
        {


            $user =$this->am->getAdmin($this->input->post('username'));

            	
			$data = [
				'firstname'=>$user->firstname,
				'lastname'=>$user->lastname,
				'adminId'=>$user->id,
				"admin" => 'true',
				// 'profile_img' => $user->profile_img
			];
			$this->session->set_userdata('admin_login',$data);
					
        	return redirect('admin');
            
        }
	}

	function username_check($username){
		// $username = $this->db->escape_str($username);
		// $sql = "SELECT id FROM `users` WHERE username = '".$username."'";
		$sql = "SELECT id FROM `admin` WHERE username = ?";
		$result = $this->db->query($sql,array($username));
		if(!empty($username)){
			if($result->num_rows() == 0){
				$this->form_validation->set_message('username_check', 'The Username Incorrect');
				return false;
			}else{
				return true;
			}
		}
	}

	function password_check($password){
		$password = md5($password);
		$sql = "SELECT id FROM `admin` WHERE password = '".$password."'";
		$result = $this->db->query($sql);
		if(!empty($password)){
			if($result->num_rows() == 0){
				$this->form_validation->set_message('password_check', 'The Password Incorrect');
				return false;
			}else{
				return true;
			}
		}
	}

	function logout(){
		$this->session->unset_userdata('admin_login');
		return redirect('userpanel');
	}

	function deleteUser(){
		$id = $this->input->post('deletedId');
		$Q = "UPDATE users set active = '0' where id= '".$id."'";
		$this->db->query($Q);
		if($this->db->affected_rows() > 0){
			echo 'true';
		}else{
			echo $this->db->last_query();
			echo 'false';
		}
	}
	function newsletter(){

	}

	function basic_users(){
		$data =[
			'view' => 'admin/basic_users',
			'title' => 'Dashboard',
		];
		$this->load->view('admin/layout',$data);
	}
	function get_basic_users(){

        $Records = $this->am->GetAllBasic();

          	$data = array();
          	$count = 1;
         foreach ($Records['data']  as $user)
  		{

	        $data[]=array( 
	        	//$user['id'],
	        	$count++,
	        	
	        	$user['firstname'].' '.$user['lastname'],
	        	'<a href="javascript:;" class="message-delete" data-click="'.$user['id'].'"><i class="fa fa-trash-o"></i></a>',
	        	$user['username'],
	        	$user['email'],
	        	$user['date_reg']


	        );
        }


  		$Records['data']=$data;
        echo json_encode($Records);
	}

	function pro_users(){
		$data =[
			'view' => 'admin/pro_users',
			'title' => 'Dashboard',
		];
		$this->load->view('admin/layout',$data);
	}

	function get_pro_users(){
		$Records = $this->am->GetAllPro();

          	$data = array();
          	$count = 1;
         foreach ($Records['data']  as $user)
  		{

	        $data[]=array( 
	        	//$user['id'],
	        	$count++,
	        	
	        	$user['firstname'].' '.$user['lastname'],
	        	'<a href="javascript:;" class="message-delete" data-click="'.$user['id'].'"><i class="fa fa-trash-o"></i></a>',
	        	$user['username'],
	        	$user['email'],
	        	$user['date_reg']


	        );
        }


  		$Records['data']=$data;
        echo json_encode($Records);
	}

}//class end