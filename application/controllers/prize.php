<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Prize extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->library('session_common');
		$this->session_common->checkSession("user");
		$this->load->model('prize_model');
	}

	/*
	 * NAME: 이민수
	 * DATE: 20170317
	 * Description: 스탬프 및 경품 추첨권
	 */
	function index(){
		//$data["indexes"] = $this->index_model->getIndexInfo();
		$temp = $this->session_common->getSession("user");
		$data["prizes"] = $this->prize_model->getPrizeList($temp["contest_id"]);
		$data["gifts"] = $this->prize_model->getGiftList($temp["contest_id"]);
		$this->load->view("prize/prize_view", $data);
	}
	/*
	* 조진근
	* 20170327
	* 경품추첨 탭을 표시
	*/
	function drawTab(){
		$this->load->view("activity/header_p");
		$this->load->view("prize/draw_tab");
		$this->load->view("activity/footer");
	}
	/*
	* 조진근
	* 20170327
	* 경품추첨 뷰페이지
	* 탭 선택에 따라서 경품과 기념품을 보여줌
	*/
	function drawView($state="prize"){
		if($state == "prize"){
			$data["prizes"] = $this->prize_model->getPrizeList();
			$data["flag"] = "prize";
		}else if($state == "gift"){
			$data["prizes"] = $this->prize_model->getGiftList();
			$data["flag"] = "gift";
		}
		$this->load->view("prize/draw_view",$data);
	}
	/*
	* 조진근
	* 20170328
	* 경품추첨 관련 탭을 표시
	*/
	function awardTab(){
		$this->load->view("activity/header_p");
		$this->load->view("prize/prize_award_tab");
		$this->load->view("activity/footer");
	}
	/*
	* 조진근
	* 20170328
	* 경품추첨 관련 내용을 표시함
	*/
	function awardView($tag = "stamp"){
		$temp = $this->session_common->getSession("user");
		$data["user"] = $temp["name"];

		if ($tag == "mission") {
			$data["spots"] = $this->prize_model->getMissionState($temp["user_id"],$temp["contest_id"]);
			$data["count"] = $this->prize_model->getCountMission($temp["user_id"],$temp["contest_id"]);
			$data["flag"] = "flag";
		} else {
			$data["spots"] = $this->prize_model->getSpotState($temp["user_id"],$temp["contest_id"]);
			$data["count"] = $this->prize_model->getCountSpot($temp["user_id"],$temp["contest_id"]);
			$data["flag"] = "stamp";
		}
		$this->load->view("prize/prize_award",$data);
	}
	
	
}


?>
