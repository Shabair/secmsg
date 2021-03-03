<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message_model extends CI_Model {



	function save($data){
		// extract($data); // array key => value create variable
		// $this->db->insert("INSERT INTO messages (`message`,`url`) VALUES ('".$message."','".$url."')");
		$this->db->insert('messages',$data);
	}

	function update($url,$data){
		$this->db->where('url', $url);
		$this->db->update('messages', $data);
	}

	function getMessage($url){
		$result =  $this->db->query("SELECT * FROM `messages` WHERE url = '".$url."'");
		if($result->num_rows() > 0){
			return $result->row();
		}else{
			return false;
		}
	}	

	function isMessage($url){
		$result = $this->db->query("SELECT id FROM `messages` WHERE url = '".$url."'");
		if($result->num_rows() > 0){
			return true;
		}else{
			return false;
		}
	}

	function delete($url,$perDelete){
		$status = ($perDelete == false)?'del':'pdel';
		if(is_array($url)){
			array_walk($url,function(&$item) { $item = "'".$item."'"; });
			$allUrls = implode(',',$url);
			return $this->db->query("UPDATE `messages` SET status='".$status."' WHERE `url` in(".$allUrls.")");
		}else{
			return $this->db->query("UPDATE `messages` SET `status` = '".$status."' WHERE `url` = '".$url."';");
		}
	}

	function restore($url){

		if(is_array($url)){
			array_walk($url,function(&$item) { $item = "'".$item."'"; });
			$allUrls = implode(',',$url);
			return $this->db->query("UPDATE `messages` SET status='' WHERE `url` in(".$allUrls.")");
		}else{
			return $this->db->query("UPDATE `messages` SET `status` = '' WHERE `url` = '".$url."';");
		}
	}

	function getDeleteMsgs($userId){
		return $this->db->query("SELECT *  FROM messages Where status = 'del' AND user_id = '".$userId."'")->result();
	}

	function setBookmark($url,$userId){
		$this->db->query("UPDATE messages m1, ( SELECT case m2.bookmark when '1' then '0' else '1' END as m2bookmark FROM messages m2 where m2.user_id = '".$userId."' AND m2.url =  '".$url."' )m2 SET m1.bookmark = m2.m2bookmark WHERE m1.user_id='".$userId."' AND m1.url = '".$url."'");
		// echo $this->db->affected_rows();
	}

	function msgHistory($data){
		extract($data);
		$sql = "INSERT INTO `msgvisitors` (`msgUrl`, `userIp`, `userId`,`loc`) SELECT * FROM (SELECT '".$msgUrl."', '".$userIp."', '".$userId."', '".$loc."') AS tmp WHERE NOT EXISTS ( SELECT id FROM msgvisitors WHERE `msgUrl` = '".$msgUrl."' AND (`userIp` = '".$userIp."' OR `userId` = '".$userId."')) LIMIT 1";
		//$this->db->insert('msgvisitors',$data);
		$this->db->query($sql);
		//return $this->db->affected_rows();
	}

	function getMsgCount($data){
		extract($data);
		$sql = "SELECT count FROM `msgvisitors` WHERE `msgUrl` = '".$msgUrl."' AND (`userIp` = '".$userIp."' OR `userId` = '".$userId."')";
		return $this->db->query($sql)->row();
	}

	function addMsgCount($data){
		extract($data);
		$sql = "UPDATE `msgvisitors` SET count = '".$count."' WHERE `msgUrl` = '".$msgUrl."' AND (`userIp` = '".$userIp."' OR `userId` = '".$userId."')";
		$this->db->query($sql);
	}

	function totalViewers($url){
		return $this->db->select('count("id") as total')->where('msgUrl',$url)->get('msgvisitors')->row()->total;
	}

	function notViewBy($data){
		extract($data);
		$sql = "SELECT id FROM msgvisitors WHERE `msgUrl` = '".$url."' AND  (`userIp` = '".$userip."' OR `userId` = '".$userid."')";
		$result  =  $this->db->query($sql);
		if($result->num_rows() <= 0){
			return true;
		}else{
			return false;
		}
	}

	function insertComment($data){

		$this->db->insert('comment',$data);
		return $this->db->affected_rows();
	}
}
