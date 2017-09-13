<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Game extends CI_Controller {
	function __construct(){
		parent::__construct();	
		$this->load->model('game_model');
	}	
	/*
	 * NAME: 이민수
	 * DATE: 20170317
	 * Description: 마이페이지 -> 내가 참여한 대회
	 */
	function myGameList(){
		//$data["indexes"] = $this->index_model->getIndexInfo();
		$data="";
		$this->load->view("game/myGameList_view", $data);
	}
}


?>