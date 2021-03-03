<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends MY_Controller {

	function __construct(){
		parent::__construct();

		$this->load->helper('form');
    	$this->load->library('form_validation');
	}

	function index(){

			$this->load->library('Paypal');
		
			$name = "Pro Account";
			$price = 20;
			$sku = 1245;

			$data = $this->paypal->paypalLink($name,$price,$sku);

			$link = $data['link'];
			$hash = $data['hash'];

			$temp = [
				'user_id'=>getUser('id'),
				'key'=>'pro_hash',
				'value'=> $hash
			];

			$this->db->insert('temp_data',$temp);

			redirect($link);
			return 0;
		

	}


	function approval(){
		$payApprove = $this->input->get('approved');
		$hash = md5($this->input->get('paymentId'));
		if($payApprove){
			$user_id = $this->db->select('user_id')
				->where('value',$hash)->get('temp_data')->row()->user_id;

			$this->db->where('value', $hash);
			$this->db->delete('temp_data');

			$this->db->set('type', 'pro');
			$this->db->where('id', $user_id);
			$this->db->update('users');

			$data = [
				'title' => 'Congratulation!',
				'view'	=>	'payments/success',
				'heading'	=> 'Congratulation',
				'body'		=>	'You Buy The Premium Membership.So you have the unlimited Messages<br>And Other Functionalities'
			];
			$this->load->view('user/layout',$data);
		}else{
			echo 'Not payApprove';
		}
	}



}



