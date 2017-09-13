<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}	

	/*
	 * getUsersInfo
	 * 이소희
	 * 20170323
	 * 사용자 정보들을 불러온다.
	 */
	 function getUsersInfo(){
		$this->db->select("SUM(사용자통계.걸음수) as 총걸음수, 사용자통계.사용자_id, 사용자.이름");
		$this->db->from("사용자통계");
		$this->db->join('사용자','사용자.사용자_id=사용자통계.사용자_id','',FALSE);
		$this->db->group_by("사용자통계.사용자_id");
		$this->db->order_by("사용자.사용자_id asc");
		return $this->db->get()->result();
	 }
	 
	  /*
	 * dateCheck
	 * 이소희
	 * 20170324
	 * 사용자 아이디에 해당하는 DB 행 유무 확인
	 */
	function dateCheck($user_id){
		$this->db->select("*");
		$this->db->from("사용자통계");
		$this->db->join('사용자','사용자.사용자_id=사용자통계.사용자_id','',FALSE);
		$this->db->where("날짜",date("Y-m-d"));
		$this->db->where("사용자통계.사용자_id",$user_id);
		return $this->db->get()->result();
	}
	
	 /*
	 * insertCount
	 * 이소희
	 * 20170324
	 * 오늘 날짜에 해당하는 내용 삽입
	 */
	function insertCount($user_id,$count){
		$this->db->set("사용자_id", $user_id);
		$this->db->set("날짜", date("Y-m-d"));
		$this->db->set("걸음수", $count);
		echo $this->db->insert("사용자통계"); 
	}
	
	 /*
	 * increaseCount
	 * 이소희
	 * 20170324
	 * 오늘날짜O -> 걸음수만 증가
	 */
	function increaseCount($user_id,$count){
		$this->db->set('걸음수','걸음수+'.$count,false);
		$this->db->where("날짜", date("Y-m-d"));
		$this->db->where("사용자_id",$user_id);
		echo $this->db->update('focus_walk.사용자통계');
	}
}
?>