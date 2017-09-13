<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Question extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('question_model');
	}
		
	function questionIndex(){
		$this->load->view("activity/header_p");
		$this->load->view("question/question_index");
		$this->load->view("activity/footer");
	}
	
	function questionIndex_sub($index){
		if($index==41){
			$data['faqs']=$this->question_model->questionIndex_sub($index);
			$this->load->view("activity/header_p");
			$this->load->view("question/faq_view",$data);
			$this->load->view("activity/footer");
		}else{
			$data['questions']=$this->question_model->questionIndex_sub($index);
			$this->load->view("activity/header_p");
			$this->load->view("question/question_view",$data);
			$this->load->view("activity/footer");
		}
	}
}
?>