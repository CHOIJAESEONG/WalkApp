<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Magazine_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	/* getMagazineListCount
	 * 조진근
	 * 리스트 갯수 조회
 	 */
 	function getMagazineListCount(){
 		$this->db->select("count(*) cnt");
 		$this->db->from("매거진");
 		$this->db->where("시작일시 <= now()",NULL,FALSE);
 		$this->db->where("now() <= 종료일시",NULL,FALSE);
 		$this->db->where("사용여부","Y");
 		return $this->db->get()->row()->cnt;
 	}
 	/*
 	 * getMagazineList
 	 *	조진근
 	 * 20170314
 	 * 매거진 List 조회
	 * 최신순 정렬
 	 * $count : record 개수
 	 * $start : record 시작
 	 */
 	function getMagazineList($count='',$start=''){
 		$this->db->select("*");
 		$this->db->from("매거진");
 		$this->db->where("시작일시 <= now()",NULL,FALSE);
 		$this->db->where("now() <= 종료일시",NULL,FALSE);
 		$this->db->where("사용여부","Y");
 		$this->db->order_by("배포일시 DESC");
 		if($count !='' || $start !='')
 			$this->db->limit($start,$count);
 		return $this->db->get()->result();
 	}
	/*
	* 조진근
	* 20170314
	* ID값에 따른 문서조회
	* $id : 페이지 링크에서 넘어오는 id값
	*/
	function getIdMatch($id){
		$this->db->select("*");
 		$this->db->from("매거진");
 		$this->db->where("시작일시 <= now()",NULL,FALSE);
 		$this->db->where("now() <= 종료일시",NULL,FALSE);
 		$this->db->where("사용여부","Y");
		$this->db->where("매거진_id",$id);
 		return $this->db->get()->row();
 	}
}
