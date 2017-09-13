<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Prize_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}

	//스탬프 정보
	//위시 성공여부 및 획득 갯수
	//혜택
	//스탬프 획득방법
	function getStampInfo(){

	}

	//경품추천권 정보
	//미션 성공여부 및 획득 갯수
	//혜택
	//경품 추첨권 획득방법
	function getCardInfo(){

	}
	/*
	* 조진근
	* 20170327
	* 경품 리스토 호출
	*/
	function getPrizeList($contest_id = ""){
        $this->db->select("경품_id, 경품명, 경품사진, 걷기대회_id, 경품수");
		if($contest_id != ""){
			$this->db->where("걷기대회_id", $contest_id);
		}
		$this->db->order_by("경품수");
        $this->db->from("경품");
        return $this->db->get()->result();
    }
	/*
	* 조진근
	* 20170327
	* 기념품 리스토 호출
	*/
    function getGiftList($contest_id = ""){
		$this->db->select("기념품_id as 경품_id, 기념품명 as 경품명, 기념품사진 as 경품사진 , 걷기대회_id, 기념품수");
		if($contest_id != "")
			$this->db->where("걷기대회_id", $contest_id);
		$this->db->order_by("기념품수");
		$this->db->from("기념품");
		return $this->db->get()->result();
    }
	/*
	* 	조진근
	*	20170328
	*	위시 수행상태를 가져옴
	*/
	function getSpotState($user,$contest_id){
		$this->db->select("A.위시_id as ID  , A.위시명 as title", NULL);
		$this->db->select("case when B.위시_id is null then 0 else 1 end checkFlag",FALSE);
		$this->db->from("위시 as A");
		$this->db->join("위시_스템프 as B", "A.위시_id = B.위시_id and B.사용자_id = '$user'", "LEFT OUTER", NULL);
		$this->db->where("A.걷기대회_id",$contest_id);
		return $this->db->get()->result();
	}
	/*
	*	조진근
	*	20170328
	*	현재 이용자의 스탬프 완료갯수를 가져옴
	*/
	function getCountSpot($user,$contest_id){
		$this->db->select("COUNT(*) cnt", NULL);
		$this->db->from("위시 as A");
		$this->db->join("위시_스템프 as B", "A.위시_id = B.위시_id and B.사용자_id = '$user'", "LEFT OUTER", NULL);
		$this->db->where("A.걷기대회_id",$contest_id);
		return $this->db->get()->row()->cnt;
	}
	/*
	* 	조진근
	*	20170328
	*	마션 수행상태를 가져옴
	*/
	function getMissionState($user,$contest_id){
		$this->db->select("A.미션_id as ID, A.미션명 as title");
		$this->db->select("case when B.미션_id is null then 0 else 1 end checkFlag",FALSE);
		$this->db->from("미션 as A");
		$this->db->where("A.걷기대회_id",$contest_id);
		$this->db->join("미션_수행 as B", "A.미션_id = B.미션_id and B.사용자_id = '$user'","LEFT OUTER", NULL);
		return $this->db->get()->result();
	}
	/*
	*	조진근
	*	20170328
	*	현재 이용자의 미션 완료갯수를 가져옴
	*	현재 이용자가 얻은 경품의 갯수
	*/
	function getCountMission($user,$contest_id){
		$this->db->select("COUNT(*) cnt", NULL);
		$this->db->from("미션 as A");
		$this->db->where("A.걷기대회_id",$contest_id);
		$this->db->join("미션_수행 as B", "A.미션_id = B.미션_id and B.사용자_id = '$user'","LEFT OUTER", NULL);
		return $this->db->get()->row()->cnt;
	}
	/*
	*	조진근
	*	20170328
	*	총 스탬프의 갯수와 성공한 스탬프 갯수를 표시
	*/
	function getStampRate($user_id,$contest_id){
		$sql = "
			select 총스탬프, 얻은스탬프, ROUND((얻은스탬프/총스탬프)*100) 원본비율, CONCAT(ROUND((얻은스탬프/총스탬프)*100),'%') 비율 from (select count(*) 총스탬프,
	  			(select count(*)
					from 위시 A
					JOIN 위시_스템프 B ON  A.위시_id = B.위시_id AND A.걷기대회_id = '".$contest_id."' AND B.사용자_id ='".$user_id."'
					) 얻은스탬프
	  			from 위시
	  			where 걷기대회_id = '".$contest_id."'
	  		) c
		";
  		$query = $this->db->query($sql);
  		return $query->result();
	}
	
	/*
	*	이종호
	*	20170329
	*	트랙에 표출한 스탬프 정보
	*/
	function getTrackStamp($contest_id){
		$sql = "
			select a.*,b.목표걸음수 FROM focus_walk.위시 a, focus_walk.걷기대회 b where a.걷기대회_id = '".$contest_id."' and a.걷기대회_id = b.걷기대회_id order by a.위시기준;
		";
		
  		return $this->db->query( $sql )->result();
	}
	
	/*
	*	이종호
	*	20170329
	*	사용자가 통과한 스탬프 정보
	*/
	function getTrackCheckedStamp($user,$contest_id){
		$sql = "
			select a.위시_id FROM focus_walk.위시 a, focus_walk.걷기대회 b, focus_walk.위시_스템프 c
			where a.걷기대회_id = '".$contest_id."' and a.걷기대회_id = b.걷기대회_id and c.사용자_id = '".$user."' and a.위시_id = c.위시_id order by a.위시기준;
		";
		
  		return $this->db->query( $sql )->result();
	}
	
	/*
	 *	정수영
	 *	20170403
	 *	사용자가 얻은 경품추첨권 개수
	 */
	function getUserPrizeCount($user,$contest_id){
		$sql= "
		        select count(*) cnt
				from(
				  select B.걷기대회_id as 미션_걷기대회_id, C.걷기대회_id as 핫스팟_걷기대회_id, A.분류 as 분류
				  from 경품추첨권 A
				  left outer join 미션 B on A.분류_id = B.미션_id
				  left outer join 핫스팟 C on A.분류_id = C.핫스팟_id
				  where A.사용자_id = '".$user."' 
				) AA
				where AA.미션_걷기대회_id='".$contest_id."' or AA.핫스팟_걷기대회_id='".$contest_id."'
				";	
		return $this->db->query( $sql )->result();
	}
	
	
	
}

?>
