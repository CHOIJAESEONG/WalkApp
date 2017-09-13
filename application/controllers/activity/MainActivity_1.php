<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once APPPATH.'controllers/activity/common/menu.php';

class MainActivity_1 extends CI_Controller {
	function __construct(){
		parent::__construct();	
		//$this->load->model('index_model');
	}
	
	/*
	 * C : MainActivity_1
	 * 로그인 정보 없을 시 표출
	 * 대회리스트, 매거진 등 각 모듈별 리스트 페이지 
	 */
	function index(){
		//$data["indexes"] = $this->index_model->getIndexInfo();
		Menu::_header();
		$this->load->view("activity/MainActivity_1/index");
		Menu::_footer();
		
	}
	
	

}


?>