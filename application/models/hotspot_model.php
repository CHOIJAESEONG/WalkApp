<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hotspot_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
  /*
  * 조진근
  * 20170316
  * getHotspotList
  * 핫스팟과 핫스팟상품 핫스팟체크인의 연관데이터 호출
  * 기간이 얼마 남지 않은 순으로 정렬
  */
	function getHotSpotList($user){
 		$this->db->select('B.핫스팟_id, B.제목, B.배너, B.위도, B.경도, B.추첨권수, C.분류, E.코드명',FALSE);
		$this->db->select('CONCAT(date_format(체크인_종료일시,"%Y년 %m월 %d일"),"까지") AS 체크인_종료시간, CAST(UNIX_TIMESTAMP(체크인_종료일시) AS SIGNED) AS 종료시간', FALSE);
 		$this->db->from('사용자` as A');
	    $this->db->join("핫스팟 as B", "A.참여중대회_id = B.걷기대회_id","",FALSE);
	   	$this->db->join("경품추첨권 as C", "C.사용자_id = A.사용자_id AND B.핫스팟_id = C.분류_id","LEFT OUTER",FALSE);
		$this->db->join("공통코드 AS E", "C.분류 = E.공통코드_id ","LEFT OUTER",FALSE);
		$this->db->order_by("체크인_종료일시 DESC");
		$this->db->where("A.사용자_id",$user);
 		return $this->db->get()->result();
 	}

	/*
    * 조진근
    * 20170316
    * getPromotionList
    * 프로모션_id와 연관된 핫스팟 데이터를 선택
    * 기간이 얼마 남지 않은 순으로 정렬
    */
  	function getPromotionList($user, $id){
   		$this->db->select("*, A.제목, A.배너,date_format(체크인_종료일시,'%Y년 %m월 %d일') AS 체크인_종료시간,  CAST(UNIX_TIMESTAMP(체크인_종료일시) AS SIGNED) AS 종료시간, ,case when 코드명 is null then '참여가능' else 코드명 end ",FALSE);
		$this->db->from("핫스팟 as A",FALSE);
		$this->db->join("경품추첨권 B "," A.핫스팟_id = B.핫스팟_id and B.사용자_id = '$user'" ,"LEFT OUTER",FALSE);
		$this->db->join("공통코드 as C", " C.공통코드_id = B.상태","LEFT OUTER",FALSE);
      	$this->db->where("A.프로모션_id",$id);
   		return $this->db->get()->result();
   	}

	/*
	* 조진근
	* 20170316
	* getHotspotView
	* 지정된 핫스팟의 정보를 호출
	*/
	function getHotspotView($user , $id){
	 	$this->db->select('*,A.제목, A.배너 as banner, C.분류',FALSE);
		$this->db->from('핫스팟 as A');
		$this->db->join("프로모션 as B", "A.프로모션_id = B.프로모션_id","right",FALSE );
		$this->db->join("경품추첨권 as C", "A.핫스팟_id = C.분류_id and C.사용자_id = '$user'","left outer",FALSE );
		$this->db->where("A.핫스팟_id",$id);
		return $this->db->get()->row();
 	}
	/*
	* 조진근
	* 20170405
	* getHotspotState
	* 핫스팟의 총 경품추첨권
	*/
	function getHotspotState($user, $id){
		$this->db->select("concat(count(case when B.분류 = 50 then A.핫스팟_id end),' / ', count(A.핫스팟_id)) as checkIn", FALSE);
		$this->db->select("concat(sum(case when B.분류 = 50 then A.추첨권수 end) ,' / ', sum(A.추첨권수)) as prize",FALSE);
		$this->db->from("핫스팟 as A", FALSE);
		$this->db->join("경품추첨권 as B","A.핫스팟_id = B.분류_id and B.사용자_id = '$user'","LEFT OUTER",FALSE);
		$this->db->where("A.걷기대회_id",$id);
		return $this->db->get()->row();
	}
	/*
	* 조진근
	* 20170405
	* insertDB
	* 경품추첨권 테이블에 핫스팟에 체크인한 유저 정보를 삽입
	*/
	function insertDB($user_id, $contest_id){
		$sql = "insert into 경품추첨권(사용자_id, 분류, 분류_id, 획득일)
				values('".mysql_real_escape_string($user_id)."', 50, '".mysql_real_escape_string($contest_id)."', now())
				ON DUPLICATE KEY UPDATE
				   사용자_id = '".mysql_real_escape_string($user_id)."',
				   분류_id = '".mysql_real_escape_string($contest_id)."'";
		$this->db->query($sql);
	}

}
?>
