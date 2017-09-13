<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class promotion_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	/* getPromoCount
	 * 조진근
	 * 프로모션 갯수 조회
	 */
	function getPromoCount(){
		$this->db->select("count(*) cnt");
		$this->db->from("프로모션");
		$this->db->where("now() <= 종료일시",NULL,FALSE);
		$this->db->where("사용유무","Y");
		return $this->db->get()->row()->cnt;
	}
	/*
	* 20170317
	* getOpenedList
	* 조진근
	* 현재 진행중인 프로모션 리스트를 가지고 온다.
	*/
  function getOpenedList($count='',$start=''){
 		$this->db->select('*',FALSE);
 		$this->db->from("프로모션");
		$this->db->where("now() > 시작일시",NULL,FALSE);
    	$this->db->where("now() <= 종료일시",NULL,FALSE);
		$this->db->where("사용유무","Y");
		$this->db->order_by("작성일");
		if($count !='' || $start !='')
				$this->db->limit($start,$count);
 		return $this->db->get()->result();
 	}
	/*
	* 20170317
	* getClosedList
	* 조진근
	* 현재 종료된 프로모션 리스트를 가지고 온다.
	*/
	function getClosedList(){
 		$this->db->select('*',FALSE);
 		$this->db->from("프로모션");
    	$this->db->where("now() > 종료일시",NULL,FALSE);
		$this->db->where("사용유무","Y");
 		return $this->db->get()->result();
 	}
}
?>
