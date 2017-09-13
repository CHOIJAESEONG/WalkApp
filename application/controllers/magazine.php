<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Magazine extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->library(array('session_common','walk_common'));
		$this->session_common->checkSession("user");
		$this->load->model('magazine_model');
	}
	/*
	 * magazineMainSimple
	 * 조진근
	 * 20170315
	 * magazineMainSiple페이지표시
	 * 최대 2개 까지  최신순으로 리스트 표시
	 * 2개가 넘을경우 더보기 보이기
	 */
	function magazine_comp(){
		$type = $this->input->POST("type");
		$data["count"] = $this->magazine_model->getMagazineListCount();
		$data["magazines"] = $this->magazine_model->getMagazineList(0,2);
		if( $type == "v"){
			$this->load->view("magazine/magazine_comp_v", $data);
		}else{
			$this->load->view("magazine/magazine_comp_h", $data);
		}
	}
	/*
	 * magazineMain
	 * 조진근
	 * 20170315
	 * magazineMain 화면으로 이동
	 */
 	function magazineList(){
		$data["magazines"] = $this->magazine_model->getMagazineList();
		$this->load->view ("activity/header_p");
		$this->load->view("magazine/magazine_list", $data);
		$this->load->view ("activity/footer");
	}
	/*
	 * moveToText
	 * 조진근
	 * 20170315
	 * magazineView로 이동
	 */
	function magazineView($id){
		$data["magazine"] = $this->magazine_model->getIdMatch($id);
		$data["article"] = $this->walk_common->readHtmlFile($data["magazine"]->매거진_html);
		$this->load->view ("activity/header_p" );
		$this->load->view("magazine/magazine_view", $data);
		$this->load->view ("activity/footer" );
	}
}
?>
