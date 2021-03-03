<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Userpanel extends MY_Controller {


	function __construct(){
		parent::__construct();

		$this->load->helper('form');
    	$this->load->library('form_validation');
		$this->load->vars('files','dashboard');

	}


	public function index($url = NULL)
	{
		if($url != NULL){
			$this->load->model('message_model');
			$message = (array)$this->message_model->getMessage($url);
			$message['update'] = 'update';
		}else{
			$message = '';
		}
		//die();
		// var_dump($this->session->userdata('user_login'));
		// var_dump(unserialize(get_cookie('localUser')));
		// die();
		$this->editor('');
		$data =[
			'view' => 'user/dashboard',
			'title' => 'Dashboard',
			'message'=>$message
		];
		$this->load->view('user/layout',$data);
	}

	public function login()
	{
        $this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric|callback_username_check');
        $this->form_validation->set_rules('password', 'Password', 'required|callback_password_check');
        $this->form_validation->set_rules('remember', 'Remember', 'in_list[on]');
        $this->form_validation->set_rules('submit', 'Submit', 'in_list[signup]');

        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        if ($this->form_validation->run() == FALSE)
        {
            $data =[
				'title' => 'Login Page'
			];
			$this->load->view('user/login',$data);
        }
        else
        {
            $this->load->model('user_model','um');

            $user =$this->um->login($this->input->post());

            if(!$user){
            	$data =[
								'title' => 'Login Page'
							];
							$this->load->view('user/login',$data);
            }else{
							$data = [
								'firstname'=>$user->firstname,
								'lastname'=>$user->lastname,
								'userId'=>$user->id,
								"userType" => $user->type,
								'profile_img' => $user->profile_img
							];
							$this->session->set_userdata('user_login',$data);
							$localUser = get_cookie('localUser');
							if(!empty($localUser)){
								$localUser = unserialize($localUser);
								$this->db->set("user_id",$data['userId']);
								$this->db->where("user_id",$localUser['userId']);
								$this->db->update('messages');
								delete_cookie('localUser');
							}
           	  if($this->input->post('remember') == 'on'){
        				$this->remember_user($this->input->post('username'),$this->input->post('password'));
        			}
							// var_dump($this->session->userdata());
							// die();
            	return redirect('userpanel');
            }
        }
	}

	function username_check($username){
		$sql = "SELECT id FROM `users` WHERE username = ?";
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
		$sql = "SELECT id FROM `users` WHERE password = '".$password."'";
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

	public function remember_user($user,$pass =null){

		$ciphertext = $this->encrypt->encode($user.'::'.$pass);
		$cookie =[
			'name' =>'rememberme',
			'value' => $ciphertext,
			'expire' =>8800,
			'domain' =>'localhost',
			'path' => '/',
		];
		set_cookie($cookie);
	}
	public function logout(){
		$this->session->unset_userdata('user_login');
		delete_cookie('rememberme');
		return redirect('userpanel');
	}

	public function register(){

        $this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[users.username]|alpha_numeric');
        $this->form_validation->set_rules('firstname', 'First Name', 'trim|required|alpha');
        $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required|alpha');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[users.email]|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('repassword', 'Re-Password', 'required|matches[password]');

        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        if ($this->form_validation->run() == FALSE)
        {
            $data =[
							'title' => 'Register'
						];
						return $this->load->view('user/register',$data);
        }
        else
        {
          $data = [
						'id' => md5(openssl_random_pseudo_bytes ((15))),
						'firstname' => $this->input->post('firstname'),
						'lastname' => $this->input->post('lastname'),
						'username' => $this->input->post('username'),
						'email' => $this->input->post('email'),
						'password' => md5($this->input->post('password'))
					];

			if(!empty($_FILES['profile_img']['type'])){
				// die(var_dump($_FILES['profile_img']));
							$config['upload_path']          = './uploads/users';
	            $config['allowed_types']        = 'gif|jpg|png';
	            $config['max_size']             = 100000;
	            $config['encrypt_name']         = true;

	            $this->load->library('upload', $config);

	            if ( ! $this->upload->do_upload('profile_img'))
	            {
                $error =  $this->upload->display_errors();

                 $data =[
									'title' => 'Register',
									'file_error' => $error
								];
								return $this->load->view('user/register',$data);
	            }
	            else
	            {
	              //$data = array('upload_data' => );
	            	$data['profile_img'] = $this->upload->data('file_name');
	                    //$this->load->view('upload_success', $data);
	            }
	        }//image end
			//unset( $this->input->post('repassword'));

			$this->db->insert('users', $data);
			$this->session->set_flashdata('success', 'User Registered Successfully please Verify your Account By Generated Link Sent to Email');
			return redirect('userpanel');
        }

	}


	public function profile(){

		$this->load->model('user_model');
		$userId= $this->session->userdata('user_login')['userId'];

		$result = $this->db->query("SELECT country FROM users WHERE id= '".$userId."' ")->row();
		if(empty($result->country)){
			$country = get_country(getIpInfo('country'));
			$this->db->set('country', $country);
			$this->db->where('id', $userId);
			$this->db->update('users');
		}
		$userData = $this->user_model->get_user($userId);
		$data = [
			'view' => 'user/profile',
			'title' => $this->session->userdata('user_login')['firstname'].'\'s Profile',
			'userData' => $userData
		];
		$this->load->view('user/layout',$data);
	}

	public function edit_profile(){
		$name = $this->input->post('name');
		$value = $this->input->post('value');
		$id = $this->input->post('pk');

		if($name == 'password'){
			$value = md5($value);
		}

		$this->db->query("UPDATE `users` SET `".$name."` = '".$value."' WHERE id='".$id."'");
	}

	public function ajaxPrfileImageUpload(){
		$user_id=$this->input->post('user_id');
		// var_dump($_FILES['ImageBrowse']);
		if(!empty($_FILES['ImageBrowse'])){
			$config['upload_path']          = './uploads/users';
		    $config['allowed_types']        = 'gif|jpg|png';
		    $config['max_size']             = 10000;
		    $config['encrypt_name']         = true;

		    $this->load->library('upload', $config);

		    if ( ! $this->upload->do_upload('ImageBrowse'))
		    {
	            $error =  $this->upload->display_errors();

	             $data =[
					'title' => 'Register',
					'file_error' => $error
				];
				return $this->load->view('user/register',$data);
		    }
		    else
		    {
		            //$data = array('upload_data' => );
		    	$imageName = $this->upload->data('file_name');
		    	$this->db->query("UPDATE users SET profile_img = '".$imageName."' WHERE id = '".$user_id."'");
		    	echo $imageName;
		            //$this->load->view('upload_success', $data);
		    }



		}//image end
	}

	

}
