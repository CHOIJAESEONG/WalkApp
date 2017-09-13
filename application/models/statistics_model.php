<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Statistics_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}	

	//나의 대회 참여 통계
	function getMyStepStatistics($사용자_id,$걷기대회_id){
		$sql = "
		    select 무형식원본날짜,원본날짜,
			날짜,
			format(걸음수,0) 걸음수,
			format(누적걸음수,0) 누적걸음수,
			format(( 목표걸음수-누적걸음수),0) 남은걸음수 ,
			(목표걸음수-누적걸음수) 원본남은걸음수,
			concat(round((누적걸음수 /목표걸음수)*100,1),'%') 진행률,
			round((누적걸음수 /목표걸음수)*100,1) 원본진행률,
			증감
			from
			(
			SELECT 
			날짜 무형식원본날짜,
			DATE_FORMAT(날짜,'%Y.%m.%d') 원본날짜,
			DATE_FORMAT(날짜,'%m.%d') 날짜,
			걸음수,
			(@runtot :=  a.걸음수  + @runtot) 누적걸음수,
			COALESCE(a.걸음수-@이전값,0) 증감,
			@이전값:=a.걸음수,
			(SELECT 목표걸음수 FROM focus_walk.걷기대회 a where a.걷기대회_id=".$걷기대회_id.") 목표걸음수
			FROM focus_walk.사용자통계 a 
			,(SELECT @runtot:=0,@lastStep:=0,@이전값:=0) c
			where a.사용자_id='".$사용자_id."' and a.걷기대회_id =".$걷기대회_id."  order by 사용자_id asc
			) c
			";	
		
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	//대회 참가 현황 통계
	function getMyTournamentInfo($걷기대회_id){
		 $this->db->from("걷기대회");
		 $this->db->where("걷기대회_id",$걷기대회_id);
		 return $this->db->get()->result();
	}
	
	//대회 참가신청일
	function getMyTournamentStart($사용자_id,$걷기대회_id){		
		 $sql = "SELECT DATE_FORMAT(참가신청일시, '%Y.%m.%d') 참가신청일시 FROM (걷기대회_참가자) WHERE 걷기대회_id = '$걷기대회_id' AND 사용자_id = '$사용자_id'";
		 $query = $this->db->query($sql);
		return $query->result();
		 
	}
	
	//획득 스탬프
	function getMyStamp($사용자_id,$걷기대회_id){
		$sql = "
		    select * from
			(
			select a.위시_id,a.위시제목,if(isnull(사용자_id),'실패','성공') 위시성공여부   FROM 
			위시 a left join 위시_스템프 b on a.위시_id = b.위시_id and b.사용자_id='$사용자_id'
			where 걷기대회_id =$걷기대회_id  order by a.위시기준
			) aa
			";	
		
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	//획득 경품추천권
	function getMyCard($사용자_id,$걷기대회_id){
		$sql = "
		    select * from
			(
			select a.미션_id,a.미션명,if(isnull(사용자_id),'실패','성공') 미션성공여부   FROM 
			미션 a left join 미션_수행 b on a.미션_id = b.미션_id and b.사용자_id='$사용자_id'
			where 걷기대회_id =$걷기대회_id
			) aa
			";	
		
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	
	/*
	 * Main_1 상단 marquee 컴포넌트 모델
	 * 이종호
	 * 20170328
	 * 사용자 현재 참가중인 대회 이름, 기간 리턴
	 */
	function main_1_marquee($contest) {

		$this->db->select("제목, 종료일시");
		$this->db->from("걷기대회");
		$this->db->where("걷기대회_id",$contest);
		return $this->db->get()->row();
	}
	
	
	/*
	 * Main_2 하단 marquee 컴포넌트 모델
	 * 이종호
	 * 20170328
	 * 사용자 평균걸음 및 추천걸음 리턴
	 */
	function main_2_marquee($user,$contest) {

		$this->db->select("종료일시,목표걸음수");
		$this->db->from("걷기대회");
		$this->db->where("걷기대회_id",$contest);
		$a = $this->db->get()->row();
		
		$this->db->select("*");
		$this->db->from("사용자통계");
		$this->db->where("사용자_id",$user);
		$this->db->where("걷기대회_id",$contest);
		$b = $this->db->get()->result();
		
		return array("대회"=>$a,"통계"=>$b);
	}
	
	/*
	 * Main_1 상단 걷기 통계
	 * 이종호
	 * 20170328
	 * 사용자 전체걸음수 리턴
	 */
	function getAllStep($user) {
		$this->db->select("사용자_id, 날짜, 걸음수 ");
		$this->db->from("사용자통계");
		$this->db->where("사용자_id",$user);
		$this->db->order_by('날짜',"desc");
		return $this->db->get()->result();
	}
	
	
}

?>
