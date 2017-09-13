<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}	

	/*
	 * getIndexInfo
	 * 정수영
	 * 20170313
	 * t_index table의 모든 record return
	 */
	
	function getIndexInfo(){
		$this->db->select("*");
		$this->db->from("개발목록");
		$this->db->order_by("항목 asc");
		return $this->db->get()->result();
	}
	
}

?>
