<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('message_model');
		$this->load->library('session_common');
	}
	
	/*
	 * celMessage_comp
	 * 이소희
	 * 20170327
	 * MainActitiy에서 개회사 및 축하메시지 하나만 출력 
	 */
	function celMessage_comp(){
		$data['speech'] = $this->message_model->celMessage_comp(1);
		$data['celMessage'] = $this->message_model->celMessage_comp(2);
		$this->load->view("message/celMessage_comp",$data);		
	}
	
	/*
	 * celeIndex
	 * 이소희
	 * 20170324
	 * 축하메시지 메뉴 초기화면
	 */
	function celeIndex($index){
		$data['index'] = $index;
		$this->load->view("activity/header_p");
		$this->load->view("message/celeIndex",$data);
		$this->load->view("activity/footer");
	}

	/*
	 * celeIndex_sub
	 * 이소희
	 * 20170327
	 * 개회사 및 축하메시지 출력 
	 */
	function celeIndex_sub($index){
		if($index==1){
			$data['speeches'] = $this->message_model->celeIndex_sub($index);
			$this->load->view("activity/header_p");
			$this->load->view("message/openSpeech",$data);
			$this->load->view("activity/footer");
		}else{
			$data['celMessages'] = $this->message_model->celeIndex_sub($index);
			$this->load->view("activity/header_p");
			$this->load->view("message/celMessage",$data);
			$this->load->view("activity/footer");
		}
	}	
}
?>