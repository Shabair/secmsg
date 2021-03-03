<?php 




function getUser($query = NULL){
	$CI = &get_instance();

	// if($query !== NULL){
	// 	return $CI->session->userdata('user_login')[$query];
	// }
	$userId = $CI->session->userdata('user_login')['userId'];

	$CI->load->model('User_model');

	$user = $CI->User_model->get_user($userId);
	if(!empty($user)){
		if($query !== NULL){
			return $user->$query;
		}
		return $user;
	}else{
		return false;
	}

}


function getUserDataById($userId,$col = null){
	$CI = &get_instance();
	if($col == NULL){
		$Q = "SELECT * FROM `users` WHERE `id` = '".$userId."'";
		$result = $CI->db->query($Q);
		if($result->num_rows() > 0){
			return $result->row();
		}else{
			return false;
		}
	}else{
		$Q = "SELECT `".$col."` FROM `users` WHERE `id` = '".$userId."'";
		$result = $CI->db->query($Q);
		if($result->num_rows() > 0){
			return $result->row()->$col;
		}else{
			return false;
		}
	}


}