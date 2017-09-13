<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {
	function __construct(){
		parent::__construct();	
		$this->load->model('index_model');
	}
	
	/*
	 * Activity Index
	 * 
	 * 
	 */
	function index(){
		$data["indexes"] = $this->index_model->getIndexInfo();
		$this->load->view("index/index_view", $data);
	}
}


?>