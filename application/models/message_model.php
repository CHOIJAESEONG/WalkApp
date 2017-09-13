<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message_model extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->helper('date');
	}	
	
	/*
	 * celMessage_comp
	 * 이소희
	 * 20170327
	 * MainActitiy에서 개회사 및 축하메시지 하나만 출력 
	 */
	function celMessage_comp($index){
		$this->db->select("*");
		$this->db->from("메시지");
		$this->db->where("type",$index);
		$this->db->order_by('메시지_id');
		$this->db->limit(1);
		return $this->db->get()->row();
	}
	
	/*
	 * celeIndex_sub
	 * 이소희
	 * 20170327
	 * 개회사 및 축하메시지 출력 (ALL)
	 */
	function celeIndex_sub($index){
		$this->db->select("*");
		$this->db->from("메시지");
		$this->db->where("type",$index);
		$this->db->order_by('메시지_id');
		return $this->db->get()->result();
	}
}
?>
