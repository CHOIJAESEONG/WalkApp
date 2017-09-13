<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Question_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}	
	
	function questionIndex_sub($index){
		$this->db->select("*");
		$this->db->from("게시판");
		$this->db->where("게시판종류",$index);
		$this->db->order_by('게시판_id');
		return $this->db->get()->result();
	}
	
	
}
?>