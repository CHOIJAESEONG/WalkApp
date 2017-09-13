<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Content_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	/*
  	* 홍익표
  	* 20170330
 	* wish 정보 조회
  	* $id wish id
  	*/
	
	function getWishInfo($user_id,$id){
		$this->db->set("참여위시",$id);
		$this->db->where("사용자_id",$user_id);
		$this->db->update("사용자");
		
	 	$this->db->select('*');
		$this->db->from('위시');
		$this->db->where("위시_id",$id);
		return $this->db->get()->row();
 	}
	
 	/*
 	 * 홍익표
 	 * 20170331
 	 * wish 스템프 발행
 	 * $id wish id
 	 */
 	function issueWish($user_id){ 		
 		$this->db->select('참여위시');
 		$this->db->from('사용자');
 		$this->db->where("사용자_id",$user_id);
 		$row = $this->db->get()->row(); 		
 		if(count($row) < 1 || $row->참여위시 < 1){
 			$result["result"] = false;
 			$result["message"] = "참여 Wish가 없습니다.";
 			return $result;
 		} 		
 		$this->db->select('count(*) cnt');
 		$this->db->from('위시_스템프');
 		$this->db->where("사용자_id",$user_id);
 		$this->db->where("위시_id",$row->참여위시);
 		$cnt = $this->db->get()->row()->cnt;
 		if($cnt >  0){
 			$result["result"] = false;
 			$result["message"] = "이미 스템프룰 획득한 Wish입니다.";
 			return $result;
 		}
 			
 		$this->db->set("위시_id",$row->참여위시);
 		$this->db->set("사용자_id",$user_id);
 		$this->db->set("스탬프획득일시","now()",FALSE);
 		$ret = $this->db->insert("위시_스템프");
 		if($ret == FALSE){	
 			$result["result"] = false;
 			$result["message"] = "스템프 발행 중 에러가 발생 했습니다.";
 			return $result; 				
 		}
 		
 		$result["result"] = true;
 		$result["message"] = "스템프가 발행 되었습니다.";
 		return $result;
 	}
 	
 	
 	/*
 	 * 홍익표
 	 * 20170331
 	 * Mission 정보 조회
 	 * $id wish id
 	 */
 	
 	function getMissionInfo($user_id,$id){
 		$this->db->set("참여미션",$id);
 		$this->db->where("사용자_id",$user_id); 			
 		$this->db->update("사용자");
 		
 		$this->db->select('*');
 		$this->db->from('미션');
 		$this->db->where("미션_id",$id);
 		return $this->db->get()->row();
 	}
 	
 	/*
 	 * 홍익표
 	 * 20170331
 	 * 경품 추첨권
 	 * $id wish id
 	 */
 	function issueMission($user_id){
 		$this->db->select('참여미션');
 		$this->db->from('사용자');
 		$this->db->where("사용자_id",$user_id);
 		$row = $this->db->get()->row();
 		if(count($row) < 1 || $row->참여미션 < 1){
 			$result["result"] = false;
 			$result["message"] = "참여 미션이 없습니다.";
 			return $result;
 		}
 		$this->db->select('count(*) cnt');
 		$this->db->from('경품추첨권');
 		$this->db->where("사용자_id",$user_id);
 		$this->db->where("분류","MISSION");
 		$this->db->where("분류_id",$row->참여미션);
 		$cnt = $this->db->get()->row()->cnt;
 		if($cnt >  0){
 			$result["result"] = false;
 			$result["message"] = "이미 경품추첨권을 받은 미션 입니다.";
 			return $result;
 		}
 		
 		$this->db->set("분류","MISSION");
 		$this->db->set("사용자_id",$user_id);
 		$this->db->set("분류_id",$row->참여미션);
 		$this->db->set("획득일","now()",FALSE);
 		$ret = $this->db->insert("경품추첨권");
 		if($ret == FALSE){
 			$result["result"] = false;
 			$result["message"] = "경품추첨권 발행 중 에러가 발생 했습니다.";
 			return $result;
 		}
 			
 		$result["result"] = true;
 		$result["message"] = "경품추첨권이 발행 되었습니다.";
 		return $result;
 	}
 	
 	
 	
 	/*
 	 * 정수영
 	 * deleteWishStamp
 	 * 사용자_id와 사용자가 참여중인 대회_id를 받아오면, 위시_스템프 테이블에서 해당 위시_id에 해당하는 기록들을 삭제한다.
 	 */
 	function deleteWishStamp($user_id, $event_id){
 		$sql = "  delete A
				  from 위시 B, 위시_스템프 A
				  where B.걷기대회_id='".$event_id."' and A.사용자_id='".$user_id."' and A.위시_id=B.위시_id";
 		return $this->db->query( $sql )->result();
 	}
 	
 	
 	/*
 	 * 정수영
 	 * deleteWishStamp
 	 * 사용자_id와 사용자가 참여중인 대회_id를 받아오면, 미션_수행 테이블에서 해당 미션_id에 대당하는 기록들을 삭제한다.
 	 */
 	function deleteMissionState($user_id, $event_id){
 		$sql = "delete A
				from 미션 B, 미션_수행 A
				where B.걷기대회_id='".$event_id."'  and A.사용자_id='".$user_id."' and A.미션_id=B.미션_id";
 		
 		return $this->db->query( $sql )->result();
 	}
 	
 	
 	
}
?>
