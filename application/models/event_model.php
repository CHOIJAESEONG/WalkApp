<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Event_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}	

	/*
	 * getLiveEventCount
	 * 홍익표
	 * 20170310
	 * 이벤트 Count 조회
	 */
	
	function getLiveEventCount(){
		$this->db->select("count(*) cnt");
		$this->db->from("이벤트");
		$this->db->where("시작일시 <= now()",NULL,FALSE);
		$this->db->where("now() <= 종료일시",NULL,FALSE);
		$this->db->where("사용여부","Y");
		return $this->db->get()->row()->cnt;
	}
	
	/*
	 * getLiveEvent
	 * 홍익표
	 * 20170310
	 * 이벤트 List 조회
	 * $count : record 개수
	 * $start : record 시작
	 */	
	function getLiveEvent($count='',$start=''){
		$this->db->select("*");
		$this->db->from("이벤트");
		$this->db->where("시작일시 <= now()",NULL,FALSE);
		$this->db->where("now() <= 종료일시",NULL,FALSE);
		$this->db->where("사용여부","Y");
		$this->db->order_by("이벤트_id desc");
		if($count !='' || $start !='')
			$this->db->limit($start,$count);
		return $this->db->get()->result();
	}	
}




?>
