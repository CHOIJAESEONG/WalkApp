<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Content extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->library('session_common');
		$this->session_common->checkSession("user");
		$this->load->model('content_model');
	}
	
  /*
  * 홍익표
  * 20170330
  * wish 페이지 열기
  * $id wish id
  */
	
  	function wish($id = ""){
  		$user_id = $this->session_common->getSession("user")["user_id"];  		
  		$wish = $this->content_model->getWishInfo($user_id,$id);
  		redirect(WEB_ROOT.$wish->위시_html);
  	}
  	
  	function finishWish(){
  		header("Content-Type:application/json");
  		$user_id = $this->session_common->getSession("user")["user_id"];
		if($this->content_model->issueWish($user_id)['result']){ redirect("/activity/MainActivity_2/"); }
		else{ redirect("/index/"); }
  	}
  	 
  	function mission($id = ""){
  		$user_id = $this->session_common->getSession("user")["user_id"];  		
  		$wish = $this->content_model->getMissionInfo($user_id,$id);
  		redirect(WEB_ROOT.$wish->위시_html);
  	}
  	 
  	function finishMission(){
  		header("Content-Type:application/json");
  		$user_id = $this->session_common->getSession("user")["user_id"];
		if($this->content_model->issueMission($user_id)['result']){ redirect("/activity/MainActivity_2/"); }
		else{ redirect("/index/"); }
  	}
  	
  	function deleteWish(){
  		$user_id = $this->session_common->getSession("user")['user_id'];
  		$event_id = $this->session_common->getSession("user")['contest_id'];
  		$this-> content_model -> deleteWishStamp($user_id, $event_id);
  	}
  	
  	function deleteMission(){
  		$user_id = $this->session_common->getSession("user")['user_id'];
  		$event_id = $this->session_common->getSession("user")['contest_id'];
  		$this-> content_model -> deleteMissionState($user_id, $event_id);
  	}
}

?>
