<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Marquee extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->library('session_common');
		$this->session_common->checkSession("user");
		$this->load->model('statistics_model');
	}
	
	/*
	 * 이종호
	 * 20170328
	 * Main_1 상단 컴포넌트
	 * 참가중인대회
	 */
	function main_1_comp(){		
		$name		= $this->session_common->getSession("user")['name']; 
		$contest_id = $this->session_common->getSession("user")['contest_id'];
		$result 	= $this->statistics_model->main_1_marquee($contest_id);	
		if(!$result){ $data["str"]	= ""; }
		else{ 
			$date_a = new DateTime();
			$date_b = new DateTime($result->종료일시);
			$date_diff = date_diff($date_a, $date_b);
			$data["str"] 	= $name."님은 ".$result->제목."에 참가중입니다. (D-".$date_diff->days."일)"; 
		}
		$this->load->view("marquee/main_1_comp",$data);
	}
	
	/*
	 * 이종호
	 * 20170328
	 * Main_2 상단 컴포넌트
	 * 걸음수, 추천걸음
	 */
	function main_2_comp(){
		$user 		= $this->session_common->getSession("user")['user_id']; 
		$name		= $this->session_common->getSession("user")['name']; 
		$contest_id = $this->session_common->getSession("user")['contest_id'];
		$result 	= $this->statistics_model->main_2_marquee($user, $contest_id);	
		
		// var_dump($result);
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
			if(count($contest)==0){
				$data["str"] 	= $name."님은 걸은 이력이 없습니다.";
			}
			else{
				if(count($contest)==0) 	$rate = 0;
				else 					$rate = ($total_step/$flag_step) *100;
				// $rate = ( ($total_step/count($contest)) / (($flag_step - $total_step)/$date_diff) ) * 100;
				$data["str"] 	= $name."님은 평균걸음보다 ".(int)$rate."% 많이 걸어야 FINAL에 도착하실 수 있습니다. 조금만 더 힘내세요!"; 
			}			
			
		}
		$this->load->view("marquee/main_2_comp",$data);
		
	}
}