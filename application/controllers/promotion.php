<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class promotion extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->library('session_common');
		$this->session_common->checkSession("user");
		$this->load->model('promotion_model');
	}
	/*
	* 조진근
	* 20170317
	* checkinTab
	* 진행중인 프로모션과 종료된 프로모션을 로드
	* checkinTab view에서 선택된 프로모션 리스트를 출력
	*/
	function promotionTab(){
		$this->load->view ( "activity/header_p" );
		$this->load->view("promotion/promotion_tab");
		$this->load->view ( "activity/footer" );
	}
	/*
	* 조진근
	* 20170322
	* checkinPreview
	* 마이그레이션 페이지 내에 최신 2개의 리스트 2개만 출력
	*/
	function checkinPreview(){
		$data["count"] = $this->promotion_model->getPromoCount();
		$data["events"] = $this->promotion_model->getOpenedList(0,2);
		$this->load->view ( "activity/header_p" );
		$this->load->view("promotion/checkinPreview",$data);
		$this->load->view ( "activity/footer" );
	}
	/*
	* 조진근
	* 20170322
	* checkinView
	* checkinTab 내에 진행중/종료된 프로모션 페이지자를 호출
	*/
	function promotionView($state='open'){
		if($state == "open"){
				$data["checkInList"] = $this->promotion_model->getOpenedList();
		}else if($state == "close"){
				$data["checkInList"] = $this->promotion_model->getClosedList();
		}
		$this->load->view("promotion/promotion_list", $data);

	}
}
?>
