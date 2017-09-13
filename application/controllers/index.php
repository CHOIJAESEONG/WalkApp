<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {
	function __construct(){
		parent::__construct();	
		$this->load->library('session_common');
		$this->session_common->checkSession("user");
		
		$this->load->model('index_model');
	}
	
	/*
	 * index
	 * 정수영
	 * 20170313
	 * 첫 redirection 
	 * url 조회
	 */
	function index(){
		$data["indexes"] = $this->index_model->getIndexInfo();
		$this->load->view("index/index_view", $data);
	}
}


?>