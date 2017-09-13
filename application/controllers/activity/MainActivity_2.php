<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once APPPATH.'controllers/activity/common/menu.php';

class MainActivity_2 extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->library('session_common');
		$this->session_common->checkSession("user");
		$this->load->model('walk_model');
		$this->load->model('statistics_model');	//사용자진행율
		
	}

	/*
	 * C : MainActivity_2
	 * 참가중인 대회 대쉬보드
	 * 
	 */
	function index($contest_state = 3){
		$data["event_info"]	= $this->walk_model->getInfoEvent( $this->session_common->getSession("user")['contest_id'] );	
		
		
		if($contest_state==0){ $data["contest_state"] = 0; }
		else if($contest_state==1){ $data["contest_state"] = 1; }
		else{
			$date_a 			= new DateTime();
			$date_b 			= new DateTime($data["event_info"][0]->종료일시);
			if($date_b < $date_a) 	{ $data["contest_state"] = 0; }	//대회 종료
			else					{ $data["contest_state"] = 1; }	//대회 진행중
		}	
		
		$this->load->view ("activity/header");
		$this->load->view ("activity/MainActivity_2/index",$data);
		$this->load->view ("activity/footer");

	}


	/*
	 * MainActivity_2 하위 컴포넌트
	 * 대회 트랙 컴포넌트
	 * 
	 */	 
	function contest_comp(){
		$this->load->model('prize_model');		// 사용자 스탭프/경품
		$contest_state = $this->input->post("contest_state");
		$data["event_info"] = $this->walk_model->getCereMony( $this->session_common->getSession("user")['user_id'] );
		$data["contest_info"] = $this->walk_model->getInfoEvent( $this->session_common->getSession("user")['contest_id'] );
		$data["user_info"] = $this->session_common->getSession("user");
		/* 사용자 진행율 */
		$user 		= $this->session_common->getSession("user")['user_id']; 
		$name		= $this->session_common->getSession("user")['name']; 
		$contest_id = $this->session_common->getSession("user")['contest_id'];
		$result 	= $this->statistics_model->main_2_marquee($user, $contest_id);	

		if(!$result){ $data["str"]	= ""; }
		else{ 
			$flag_step	= $result["대회"] -> 목표걸음수;
			$date 		= $result["대회"] -> 종료일시;
			$contest	= $result["통계"];
			
			$date_a 	= new DateTime();
			$date_b 	= new DateTime($date);
			$date_diff 	= date_diff($date_a, $date_b)->days;
			
			$total_step = 0;			
			foreach ($contest as $val) { $total_step += $val->걸음수; }
			if(count($contest)==0) 	$rate = 0;
			else 					$rate = ($total_step/$flag_step) *100;
			//$rate = ( ($total_step/count($contest)) / (($flag_step - $total_step)/$date_diff) ) * 100;
		}
						
		/* 사용자 스탬프 */		
		$stamp 	= $this->prize_model->getStampRate($user,$contest_id);
		if($contest_state ==1){
			$data["stamp_info"]		= $this->prize_model->getTrackStamp($contest_id);
			$data["checked_info"]	= $this->prize_model->getTrackCheckedStamp($user,$contest_id);
			
			// $data["stamp_info"] = array();
			// foreach ($stamp_info as $val) { array_push($data["stamp_info"],(array)$val); }
		}

		/* 사용자 경품 */		
		$prize  = $this->prize_model->getUserPrizeCount($user,$contest_id);
		
		$data["stat_info"] = array(
								"total_step"=> $total_step,
								"rate" 		=> (int)$rate,
								"stamp"		=> $stamp[0]->얻은스탬프." / ".$stamp[0]->총스탬프,
								"prize" 	=> $prize,
							);
		
							
		if($contest_state==0) $this->load->view ("track/contest_end_comp",$data);		
		if($contest_state==1) $this->load->view ("track/contest_ing_comp",$data);		
			
	}
	

	
	
	
	
}


?>
