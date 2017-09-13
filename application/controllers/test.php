<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('test_model');
	}
	
	/*
	 * getUsersInfo
	 * 이소희
	 * 20170323
	 * 사용자 정보들을 불러온다.
	 */
	function getUsersInfo(){
		$data['userInfos'] = $this->test_model->getUsersInfo();
		$this->load->view("activity/header_p");
		$this->load->view("test/test_index",$data);
		$this->load->view("activity/footer");
	}
	
	/*
	 * increaseCount
	 * 이소희
	 * 20170324
	 * 걸음 수 추가하기
	 */
	function increaseCount(){
		$user_id = trim($this->input->post('user_id'));
		$count = trim($this->input->post('count'));
		$data['result'] = $this->test_model->dateCheck($user_id);
		
		//현재 해당하는 날짜가 DB에 존재하지 않으면 insert
		if($data['result']==null){
			$this->test_model->insertCount($user_id, $count);
		}else{
			$this->test_model->increaseCount($user_id, $count);
		}
	}
	
}
?>