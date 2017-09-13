<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Event extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('event_model');
		$this->load->library('walk_common');
	}

	/*
	 * index
	 * 홍익표
	 * 20170310
	 * 이벤트 조회 
	 * max3개 까지 리스트 조회
	 * 3개가 넘을경우 더보기 보이기
	 */
	function index(){
		$data["events"] = $this->event_model->getLiveEvent();
		$this->load->view("event/event_view", $data);	
	}	
	/*
	 * walkMain
	 * 홍익표
	 * 20170310
	 * 걷기 메일에서 호출
	 * max3개 까지 리스트 조회
	 * 3개가 넘을경우 더보기 보이기 
	 */
	function walkMain(){
		$data["count"] = $this->event_model->getLiveEventCount();
		$data["events"] = $this->event_model->getLiveEvent(0,3);	
		$this->load->view("event/event_walk_main", $data);		
	}
	
	
}

?>