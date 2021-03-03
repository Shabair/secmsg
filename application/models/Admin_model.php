<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

	function login($data){
		//for sql injection go into username_check function in userpanel
		// $username = $this->db->escape_str($data['username']);
		$username = $data['username'];

		$password = md5($data['password']);
		$query = $this->db->query("SELECT * FROM `users` WHERE `username`='".$username."' AND `password`='".$password."' ");

		if($result = $query->row()){
			return $result;
		}else{
			return false;
		}
	}

	function getAdmin($username){
		return $this->db->query("SELECT * FROM `admin` WHERE `username` = '".$username."'")->row();
	}


	function getUsersData(){

		$sql = "SELECT count(*) as pro FROM users WHERE type = 'pro'";
		$pro = $this->db->query($sql)->row()->pro;


		$sql = "SELECT count(*) as basic FROM users WHERE type = 'basic'";
		$basic = $this->db->query($sql)->row()->basic;

		$sql = "SELECT count(*) as visitors FROM cookies ";
		$Visitors = $this->db->query($sql)->row()->visitors;

		$sql = "SELECT DISTINCT(msg.user_id) as localuser FROM messages  as msg inner join users on users.id != msg.user_id";
		$localuser = $this->db->query($sql)->num_rows();

		return ['pro'=>$pro,'basic'=>$basic,'localuser'=>$localuser,'Visitors'=>$Visitors];
	}

	function GetAllBasic()
	{
		$wh =array();
		


		$SQL ='SELECT * FROM users';


			$wh[]=" type = 'basic'";
			$wh[]=" active = '1'";
			
			$WHERE = implode(' and ',$wh);
			$this->load->library('datatable');
			return $this->datatable->LoadJson($SQL,$WHERE);

	}

	function GetAllPro()
	{
		$wh =array();
		


		$SQL ='SELECT * FROM users';


			$wh[]=" type = 'pro'";
			$wh[]=" active = '1'";
			$WHERE = implode(' and ',$wh);
			$this->load->library('datatable');
			return $this->datatable->LoadJson($SQL,$WHERE);

	}

}//class end