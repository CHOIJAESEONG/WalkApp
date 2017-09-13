<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Menu extends CI_Controller {
    function __construct(){
        parent::__construct();
    }

	function _header(){
		$this->load->view('activity/header');
	}
	function _header_no(){
		$this->load->view('activity/header_no');
	}
  function _header_p(){
		$this->load->view('activity/header_p');
	}

	function _footer(){
		$this->load->view('activity/footer');
	}

	function _footer_no(){
		$this->load->view('activity/footer_no');
	}
}
?>
