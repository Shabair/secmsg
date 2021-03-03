<?php

class User_model extends CI_Model{


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

	function get_user($id){
		return $this->db->query("SELECT * FROM `users` WHERE `id` = '".$id."'")->row();
	}

}
