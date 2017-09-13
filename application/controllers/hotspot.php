<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hotspot extends CI_Controller {
	function __construct(){
			parent::__construct();
			$this->load->library(array('session_common','walk_common'));
			$this->session_common->checkSession("user");
			$this->load->model('hotspot_model');
	}
  /*
  *조진근
  *20170316
  *hotspo_list 페이지로 연결
  *핫스팟 리스트에 대한 $id값을 통하여 이동됨
  */
  	function hotspotList(){
		$temp = $this->session_common->getSession("user");
		$user = $temp["user_id"];
	    $data["hotspots"] = $this->hotspot_model->getHotspotList($user);

		$this->load->view ("activity/header_p");
	    $this->load->view ("hotspot/hotspot_list", $data);
		$this->load->view ("activity/footer");
  	}
	/*
    *조진근
    *20170329
    * 프로모션 리스트를 가져옴
    */
	function hotspotListProm($id=''){
		$temp = $this->session_common->getSession("user");
		$user = $temp["user_id"];
	    $data["hotspots"] = $this->hotspot_model->getPromotionList($user, $id);
		$this->load->view ("activity/header_p");
	    $this->load->view ("hotspot/hotspot_list", $data);
		$this->load->view ("activity/footer");
  	}
	function hotspotListWithGoogleMap(){
		$temp = $this->session_common->getSession("user");
		$user = $temp["user_id"];
		$contest = $temp["contest_id"];
		$data["hotspots"] = $this->hotspot_model->getHotspotList($user);
		$data["state"] = $this->hotspot_model->getHotspotState($user, $contest);
		$this->load->view ("activity/header_p");
		$this->load->view ("hotspot/hotspot_list_with_googleMap", $data);
		$this->load->view ("activity/footer");
 	}
	/*
  	*	조진근
  	*	20170316
  	*	hotspo_view 페이지로 연결
  	*/
  	function hotspotView($id,$select=''){
		if($select == ''){
			$data["more"] = FALSE;
		}
		else{
			$data["more"] = TRUE;
		}
		$user = $this->session_common->getSession("user")["user_id"];
		$data["hotspot"] = $this->hotspot_model->getHotspotView($user ,$id);
		//파일 열기
		$data["article"] = $data["hotspot"]->핫스팟_html;

		$this->load->view ("activity/header_p");
	    $this->load->view ("hotspot/hotspot_view",$data);
		$this->load->view ("activity/footer");
  	}
	/*
  	*	조진근
  	*	20170316
  	*	insertCheckIn
	*	경품추첨권 테이블에 경품권을 얻은 사용자 정보 삽입
  	*/
	function insertCheckIn(){
		$user_id = $this->session_common->getSession("user")["user_id"];
		$hotspot_id = trim($this->input->post("hotspot_id"));
		$this->hotspot_model->insertDB($user_id, $hotspot_id);
	}
}
?>
