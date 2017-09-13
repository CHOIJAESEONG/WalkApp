<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Statistics extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->library('session_common');
		$this->session_common->checkSession("user");
		$this->load->model('statistics_model');
	}
	/*
	 * index
	 * 이민수
	 * 20170315
	 * 참가현황 통계
	 */
	function index(){		
		echo "잘못된 접근";
		exit();
	}
	
	//나의 대회 참여 통계
	function myTableStep(){
		//로그인한 정보
		$myLogin = array('USER_ID'  => "gildong", 'USER_NAME'  => "홍길동","USER_PIC"=>경로_사용자."hong.jpg");
		$data["myInfo"] = $myLogin;		
		
		//현재 참여중인 대회 여부???
		$걷기대회_id="2";
		$data["myTable_Step_Data"] = $this->statistics_model->getMyStepStatistics($myLogin['USER_ID'],$걷기대회_id);
		$data["myTable_TournamentStart"] = $this->statistics_model->getMyTournamentStart($myLogin['USER_ID'],$걷기대회_id);
		$data["myTable_TournamentInfo"] = $this->statistics_model->getMyTournamentInfo($걷기대회_id);
		
		$data["myTable_Stamp_Data"] = $this->statistics_model->getMyStamp($myLogin['USER_ID'],$걷기대회_id);
		$data["myTable_Card_Data"] = $this->statistics_model->getMyCard($myLogin['USER_ID'],$걷기대회_id);
		
		$this->load->view("statistics/my_statistics", $data);
		
	}
	
	//나의 통계
	function myTableStepChart(){
		$data="";
		$this->load->view("statistics/my_statistics_chart", $data);
	}
	
	/*
	 * 이종호
	 * 20170328
	 * Main_1 상단 걷기이력 컴포넌트
	 * 
	 */
	function step_comp(){		
		$user				= $this->session_common->getSession("user")['user_id']; 
		$std 	= $this->statistics_model->getAllStep($user);
		$data["step_info"] = array();
		foreach ($std as $val) { 
			$step = number_format($val->걸음수);
			$date = (new DateTime($val->날짜))->format('Y년 m월 d일');
			array_push($data["step_info"],json_encode(array("날짜"=>$date,"걸음수"=>$step))); 
		}
		$this->load->view("statistics/step_comp",$data);
	}
	
}
?>