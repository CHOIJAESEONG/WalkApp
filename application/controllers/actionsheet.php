<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Actionsheet extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->library('session_common');
		$this->session_common->checkSession("user");
		$this->load->model('prize_model');	
		$this->load->model('walk_model');		
		
	}
	
	/*
	 * 이종호
	 * 20170329
	 * Main_2 스탬프 ActionSheet
	 * 스탬프 현황
	 */
	function getstamp_sheet(){	
		$user 		= $this->session_common->getSession("user")['user_id']; 
		$contest_id = $this->session_common->getSession("user")['contest_id'];	
		
		$data["contest"] 	= $this->walk_model->getInfoEvent($contest_id);
		$data["stamp"] 		= $this->prize_model->getStampRate($user,$contest_id);		
		$data["user"] 		= $this->session_common->getSession("user");
		$data["state"] 		= "get";
		$this->load->view("actionsheet/stamp_sheet",$data);
	}
	
	/*
	 * 이종호
	 * 20170329
	 * Main_2 스탬프 ActionSheet
	 * 스탬프 적립 
	 */
	function setstamp_sheet(){	
		$user 		= $this->session_common->getSession("user")['user_id']; 
		$contest_id = $this->session_common->getSession("user")['contest_id'];	
		
		$data["contest"] 	= $this->walk_model->getInfoEvent($contest_id);
		$data["stamp"] 		= $this->prize_model->getStampRate($user,$contest_id);		
		$data["user"] 		= $this->session_common->getSession("user");
		$data["state"] 		= "set";
		$this->load->view("actionsheet/stamp_sheet",$data);
	}
	
	/*
	 * 이종호
	 * 20170330
	 * Main_2 스탬프 ActionSheet
	 * 경품 현황
	 */
	function getprize_sheet(){	
		$user 		= $this->session_common->getSession("user")['user_id']; 
		$contest_id = $this->session_common->getSession("user")['contest_id'];	
		
		$data["contest"] 	= $this->walk_model->getInfoEvent($contest_id);
		$data["prize"] 		= $this->prize_model->getUserPrizeCount($user,$contest_id);	
		$data["user"] 		= $this->session_common->getSession("user");
		$data["state"] 		= "get";
		$this->load->view("actionsheet/prize_sheet",$data);
	}
	
	/*
	 * 이종호
	 * 20170330
	 * Main_2 스탬프 ActionSheet
	 * 경품 받기 
	 */
	function setprize_sheet(){	
		$user 		= $this->session_common->getSession("user")['user_id']; 
		$contest_id = $this->session_common->getSession("user")['contest_id'];	
		
		$data["contest"] 	= $this->walk_model->getInfoEvent($contest_id);
		$data["prize"] 		= $this->prize_model->getStampRate($user,$contest_id);		
		$data["user"] 		= $this->session_common->getSession("user");
		$data["state"] 		= "set";
		$this->load->view("actionsheet/prize_sheet",$data);
	}
	
	
}