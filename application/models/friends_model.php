<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Friends_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	/*
	 * myFriends
	 * 최재성
	 * 20170315
	 * 친구목록 조회
	 */
	function myFriends($user_id){
		$this->db->select("*");
		$this->db->from("친구");
		$this->db->join('사용자','친구.친구_id=사용자.사용자_id','',FALSE);
		$this->db->where("친구.사용자_id",$user_id);
		$this->db->where("친구.상태",14);
		$this->db->where('사용자.탈퇴코드 is null');
		$this->db->order_by("이름");
		
		return $this->db->get()->result();
	}
	 
	/*
	 * cntFriends
	 * 최재성
	 * 20170315
	 * 친구 카운트
	 */
	function cntFriends($user_id){
		$this->db->select("COUNT(*) 친구_id");
		$this->db->from("친구");
		$this->db->join('사용자','친구.친구_id=사용자.사용자_id','',FALSE);
		$this->db->where("친구.사용자_id",$user_id);
		$this->db->where('사용자.탈퇴코드 is null');
		$this->db->where("친구.상태",14);
		
		return $this->db->get()->row()->친구_id;
	} 

	/*
	 * msCheck
	 * 최재성
	 * 20170404
	 * 쪽지보기 화면 조회
	 */
	function msCheck($user_id){
		$sql = 	"select * from 쪽지사용자그룹 A
				join (
					select AA.* from focus_walk.쪽지 AA
					where AA.쪽지_id in ( 
					SELECT max(BB.쪽지_id) 
					FROM focus_walk.쪽지 BB
					group by BB.그룹_id
					) 
				) B on A.그룹_id = B.그룹_id
				join (
					select * from 쪽지사용자그룹 where 그룹_id in (
					select 그룹_id from 쪽지사용자그룹
					where 사용자_id = '".mysql_real_escape_string($user_id)."' 
					) and 사용자_id != '".mysql_real_escape_string($user_id)."'
				) C on A.그룹_id = C.그룹_id     
				join 사용자 D on D.사용자_id = C.사용자_id
				where A.사용자_id = '".mysql_real_escape_string($user_id)."' 
				and D.탈퇴코드 is null
				order by B.쪽지_id desc";
		return $this->db->query($sql)->result();
	}
	
	/*
	 * newMsChecker
	 * 최재성
	 * 20170315
	 * 채팅방 채팅내용 조회 (로드시)
	 */
	function newMsChecker($user_id,$msId){
		$this->db->select("쪽지.쪽지_id");
		$this->db->from("쪽지");
		$this->db->join("쪽지사용자그룹","쪽지.그룹_id = 쪽지사용자그룹.그룹_id",'',FALSE);
		$this->db->where("쪽지사용자그룹.사용자_id in ('".mysql_real_escape_string($user_id)."')");
		$this->db->where("쪽지.쪽지_id",$msId);
		
		return $this->db->get()->row();
	}
	
	/*
	 * msRoom
	 * 최재성
	 * 20170315
	 * 채팅방 채팅내용 조회 (로드시)
	 */
	function msRoom($group_id){
		$this->db->select("A.*");
		$this->db->from("(select *
							from 쪽지 
							join 사용자 on 쪽지.전송_id=사용자.사용자_id
							where 쪽지.그룹_id=".mysql_real_escape_string($group_id)." 
							order by 쪽지.쪽지_id desc limit 10
							) A");
		$this->db->order_by("A.쪽지_id","asc");
		
		return $this->db->get()->result();
	}
	
	/*
	 * minMs
	 * 최재성
	 * 20170331
	 * 로드된 쪽지 중 가장 윗글의 쪽지_id 받아오기
	 */
	function minMs($group_id){
		$this->db->select("min(A.쪽지_id) as upperMsId");
		$this->db->from("(select *
							from 쪽지 
							join 사용자 on 쪽지.전송_id=사용자.사용자_id
							where 쪽지.그룹_id=".mysql_real_escape_string($group_id)." 
							order by 쪽지.쪽지_id desc limit 10
							) A");
		$this->db->order_by("A.쪽지_id","asc");
		
		return $this->db->get()->row()->upperMsId;
	}
	
	/*
	 * totalMinMs
	 * 최재성
	 * 20170403
	 * 로드된 전체쪽지 중 가장 윗 글의 쪽지 id 받아옴
	 */
	function totalMinMs($group_id){
		$this->db->select("min(A.쪽지_id) as totalMinMs");
		$this->db->from("(select *
							from 쪽지 
							where 쪽지.그룹_id=".mysql_real_escape_string($group_id)." 
							order by 쪽지.쪽지_id desc
							) A");
		$this->db->order_by("A.쪽지_id","asc");
		
		return $this->db->get()->row()->totalMinMs;
	}
	
	/*
    * msRoomCnt
    * 최재성
    * 20170331
    * 쪽지 갯수 조회 (로드시)
    */
	function msRoomCnt($group_id){
		$this->db->select("count(*) as 쪽지개수");
		$this->db->from("쪽지");
		$this->db->join('쪽지사용자그룹','쪽지.그룹_id=쪽지사용자그룹.그룹_id and 쪽지.전송_id=쪽지사용자그룹.사용자_id','',FALSE);
		$this->db->join('사용자','쪽지사용자그룹.사용자_id = 사용자.사용자_id','',FALSE);
		$this->db->where("쪽지.그룹_id",$group_id);
		$this->db->order_by("쪽지.쪽지_id","asc");
		
		return $this->db->get()->row()->쪽지개수;
	}
   
	/*
	 * addMs
	 * 최재성
	 * 20170331
	 * 채팅방 더보기 버튼 클릭시 메세지 조회
	 */
	function addMs($group_id,$upperMsId){
		$this->db->select("*");
		$this->db->from("(select *
							from 쪽지 
							join 사용자 on 쪽지.전송_id=사용자.사용자_id
							where 쪽지.그룹_id=".mysql_real_escape_string($group_id)." and 쪽지.쪽지_id<".mysql_real_escape_string($upperMsId)."
							order by 쪽지.쪽지_id desc limit 10
							) A");
		$this->db->order_by("A.쪽지_id","asc");
		
		return $this->db->get()->result();
	}
	
	/*
	 * checkYN
	 * 최재성
	 * 20170329
	 * 쪽지 확인여부 체크
	 */
	function checkYN($user_id,$group_id){
		$this->db->set("확인여부","Y");
		$this->db->where('그룹_id',$group_id);
		$this->db->where("전송_id not in ('".$user_id."')");
		return $this->db->update('쪽지');
	}
	
	/*
	 * refreshMs
	 * 최재성
	 * 20170329
	 * 쪽지 통신(새로 DB에 입력된 값을 3초마다 페이지에 뿌려준다.)
	 */
	function refreshMs($group_id,$msId){
		$this->db->select("*");
		$this->db->from("쪽지");
		$this->db->join('쪽지사용자그룹','쪽지.그룹_id=쪽지사용자그룹.그룹_id and 쪽지.전송_id=쪽지사용자그룹.사용자_id','',FALSE);
		$this->db->join('사용자','쪽지사용자그룹.사용자_id = 사용자.사용자_id','',FALSE);
		$this->db->where("쪽지.그룹_id",$group_id);
		$this->db->where("쪽지.쪽지_id > ".mysql_real_escape_string($msId)." ",NULL,FALSE);
		$this->db->order_by("쪽지.쪽지_id","asc");
		return $this->db->get()->result();
	}
	
	/*
	 * msRoomOther
	 * 최재성
	 * 20170324
	 * 채팅방 채팅내용 조회
	 */
	function msRoomOther($friend_id,$user_id){
		$this->db->select("max(그룹_id) as 그룹_id");
		$this->db->from("쪽지사용자그룹");
		$this->db->where("사용자_id in ('".$user_id."','".mysql_real_escape_string($friend_id)."')");
		$this->db->where("사용유무","Y");
		$this->db->where("그룹_id in (select 그룹_id from 쪽지사용자그룹 group by 그룹_id having count(*)=2)");
		$this->db->group_by("그룹_id");
		$this->db->having("count(*)=2");
		return $this->db->get()->row();
	}
	
	/*
	 * msRoomNew
	 * 최재성
	 * 20170321
	 * 새 채팅방 만들고 채팅방 Row return 
	 */
	function msRoomNew($friend_id,$user_id){
		$this->db->set("그룹_id","0");
		$this->db->insert("쪽지그룹");
		$그룹_id = $this->db->insert_id();
		
		$this->db->set("그룹_id",$그룹_id);
		$this->db->set("사용자_id",$user_id);
		$this->db->set("생성일","now()",FALSE);
		$this->db->insert("쪽지사용자그룹");

		$this->db->set("그룹_id",$그룹_id);
		$this->db->set("사용자_id",$friend_id);
		$this->db->set("생성일","now()",FALSE);
		$this->db->insert("쪽지사용자그룹");
		
		$this->db->select("max(그룹_id) as 그룹_id");
		$this->db->from("쪽지사용자그룹");
		$this->db->where("사용자_id in ('".$user_id."','".mysql_real_escape_string($friend_id)."')");
		$this->db->where("사용유무","Y");
		$this->db->where("그룹_id in (select 그룹_id from 쪽지사용자그룹 group by 그룹_id having count(*)=2)");
		$this->db->group_by("그룹_id");
		$this->db->having("count(*)=2");
		return $this->db->get()->row();
		
	}

	/*
	 * insertContents
	 * 최재성
	 * 20170321
	 * 쪽지 내용 삽입
	 */
	function insertContents($group_id,$user_id,$contents,$msId){
		$this->db->set("전송일시","now()",FALSE);
		$this->db->set("그룹_id",$group_id);
		$this->db->set("전송_id",$user_id);
		$this->db->set("내용",$contents);
		$this->db->insert('쪽지');
		
		$this->db->select("*");
		$this->db->from("쪽지");
		$this->db->join('쪽지사용자그룹','쪽지.그룹_id=쪽지사용자그룹.그룹_id and 쪽지.전송_id=쪽지사용자그룹.사용자_id','',FALSE);
		$this->db->join('사용자','쪽지사용자그룹.사용자_id = 사용자.사용자_id','',FALSE);
		$this->db->where("쪽지.그룹_id",$group_id);
		$this->db->where("쪽지.쪽지_id > ".mysql_real_escape_string($msId)." ",NULL,FALSE);
		$this->db->order_by("쪽지.쪽지_id","asc");		
		return $this->db->get()->result();
	}
	
	/*
	 * inviteFriend
	 * 최재성
	 * 20170317
	 * 나를 초대한 친구 조회
	 */
	function inviteFriend($user_id){
		$this->db->select("*");
		$this->db->from("친구");
		$this->db->join('사용자','친구.사용자_id=사용자.사용자_id','',FALSE);
		$this->db->where('친구.친구_id',$user_id);
		$this->db->where('사용자.탈퇴코드 is null');
		$this->db->where('친구.상태',13);
		$this->db->order_by("이름");
		
		return $this->db->get()->result();
	}

	/*
	 * inviteFriend2
	 * 최재성
	 * 20170317
	 * 내가 초대한 친구 조회
	 */
	function inviteFriend2($user_id){ //내가 초대한 친구 검색
		$this->db->select("*");
		$this->db->from("친구");
		$this->db->join('사용자','친구.친구_id=사용자.사용자_id','',FALSE);
		$this->db->where('친구.사용자_id',$user_id);
		$this->db->where('사용자.탈퇴코드 is null');
		$this->db->where('친구.상태',13);
		$this->db->order_by("이름");
		
		return $this->db->get()->result();
	}

	/*
	 * inviteEvents
	 * 최재성
	 * 20170320
	 * 대회참여 초대 조회
	 */
	function inviteEvents($mode,$user_id){
		$this->db->select("*");
		$this->db->from("걷기대회_초대");
		$this->db->join('걷기대회','걷기대회_초대.걷기대회_id=걷기대회.걷기대회_id','',FALSE);
		if($mode==1){
			$this->db->join('사용자','걷기대회_초대.사용자_id=사용자.사용자_id','',FALSE);
			$this->db->where('걷기대회_초대.초대자_id',$user_id);
		}else if($mode==2){
			$this->db->join('사용자','걷기대회_초대.초대자_id=사용자.사용자_id','',FALSE);
			$this->db->where('걷기대회_초대.사용자_id',$user_id);
		}
		$this->db->where('사용자.탈퇴코드 is null');
		$this->db->where('사용여부','Y');
		$this->db->order_by("사용자.이름");
		
		return $this->db->get()->result();
	}
	
	/*
	 * acceptEvents
	 * 최재성
	 * 20170328
	 * 대회참여 초대 수락(나를 초대한 친구)
	 */
	function acceptEvents($event_id,$user_id){
		$timeStamp = now();
		
		
		$data = array(
				'걷기대회_id' => $event_id ,
				'사용자_id' => $user_id ,
				'상태' => 18,
				'완보여부' => 'N',
				'참가신청일시' => $timeStamp,
				'완보일' =>null
				);
		return $this->db->insert('걷기대회_참가자',$data);
	}
	
	/*
	 * deletetEvents
	 * 최재성
	 * 20170328
	 * 대회참여 초대 수락(나를 초대한 친구)
	 */
	function deletetEvents($event_id,$user_id){
		$this->db->where("걷기대회_id",$event_id);
		$this->db->where("초대자_id",$user_id);
		
		return $this->db->delete('걷기대회_초대');
	}
	
	/*
	 * rejectEvents
	 * 최재성
	 * 20170328
	 * 대회참여 초대 거부(나를 초대한 친구)
	 */
	function rejectEvents($invite_id){
		$this->db->set("사용여부","N");
		$this->db->where("초대_id",$invite_id);
		return $this->db->update('걷기대회_초대');
	}
	
	/*
	 * deleteFriends
	 * 최재성
	 * 20170315
	 * 친구삭제
	 */
	function deleteFriends($user_id,$friend_id,$state){
		$this->db->where("사용자_id",$user_id);
		$this->db->where("친구_id",$friend_id);
		$this->db->set("상태",$state);
		
		return $this->db->update("focus_walk.친구");
	}
	
	/*
	 * deleteMs
	 * 최재성
	 * 20170316
	 * 채팅방 삭제
	 */
	function deleteMs($group_id,$user_id){
		$this->db->where("그룹_id",$group_id);
		$this->db->where("전송_id",$user_id);
		$this->db->delete('쪽지');
		
		$this->db->where("그룹_id",$group_id);
		$this->db->where("사용자_id",$user_id);
		$this->db->delete('쪽지사용자그룹');

		return ;
	}
	
	/*
	 * rejectFriends
	 * 최재성
	 * 20170321
	 * 친구초대 거절
	 */
	function rejectFriends($user_id,$friend_id,$state){//나를 초대한 친구 거절
		$this->db->where("사용자_id",$friend_id);
		$this->db->where("친구_id",$user_id);
		$this->db->set("상태",$state);
		
		return $this->db->update("focus_walk.친구");
	}
	
	/*
	 * rejectFriends2
	 * 최재성
	 * 20170321
	 * 친구초대 거절
	 */
	function rejectFriends2($user_id,$friend_id,$state){//내가 초대한 친구 취소
		$this->db->where("사용자_id",$user_id);
		$this->db->where("친구_id",$friend_id);
		$this->db->set("상태",$state);
		
		return $this->db->update("focus_walk.친구");
	}
	
	/*
	 * acceptFriends
	 * 최재성
	 * 20170321
	 * 친구초대 수락
	 */
	function acceptFriends($friend_id,$user_id,$state){
		$sql = 	"insert into focus_walk.친구 	(사용자_id, 친구_id ,상태,승인일)
		select '".mysql_real_escape_string($friend_id)."','".$user_id."',14, now() from dual
		union all
		select '".$user_id."','".mysql_real_escape_string($friend_id)."',14, now() from dual
		ON DUPLICATE KEY UPDATE 상태=14";
		return $this->db->query($sql);
	}
	
	/*
	 * inviteList
	 * 최재성
	 * 20170321
	 * 내친구 중 걷기대회 초대자
	 */
	function inviteList($user_id,$event_id){
		$this->db->select("*,case when E.공통코드_id is not null then E.코드명  when C.초대자_id is null then '초대' else '초대중' end 상태",FALSE);
		$this->db->from("친구 A");
		$this->db->join('사용자 B','A.친구_id = B.사용자_id','',FALSE);
		$this->db->join('걷기대회_초대 C','A.친구_id = C.초대자_id AND C.사용자_id = A.사용자_id AND C.걷기대회_id='.$event_id." and C.사용여부='Y'" ,'left outer',FALSE);
		$this->db->join('걷기대회_참가자 D','A.친구_id = D.사용자_id AND D.걷기대회_id = '.mysql_real_escape_string($event_id),'left outer',FALSE);
		$this->db->join('공통코드 E','E.공통코드_id = D.상태','left outer',FALSE);
		$this->db->where('A.사용자_id',$user_id);
		$this->db->where('A.상태',14);
		$this->db->where('B.탈퇴코드 is null');
		$this->db->order_by("B.이름");
		return $this->db->get()->result();
	}
	
	/*
	 * insertInvite
	 * 최재성
	 * 20170327
	 * 초대한 친구 삽입
	 */
	function insertInvite($event_id, $user_id, $friend_id){
		$data = array(
		'걷기대회_id' => $event_id ,
		'사용자_id' => $user_id ,
		'초대자_id' => $friend_id,
		'초대일시' => now()
		);
		
		$this->db->insert('걷기대회_초대',$data);
	}
	
	/*
	 * avgStepInfo
	 * 최재성
	 * 20170327
	 * 일일평균걸음수 조회
	 */
	function avgStepInfo($friend_id){
		$this->db->select("사용자.이름 as 이름, round(avg(사용자통계.걸음수)) as 일일평균걸음수",FALSE);
		$this->db->from("사용자");
		$this->db->join('사용자통계','사용자.사용자_id = 사용자통계.사용자_id','left outer',FALSE);
		$this->db->where('사용자.사용자_id',$friend_id);
		return $this->db->get()->row();
	}
	
	/*
	 * joinInfo
	 * 최재성
	 * 20170327
	 * 참여중인대회수 조회
	 */
	function joinInfo($friend_id){
		$this->db->select("사용자.사진,count(걷기대회_id) as 참여대회수",FALSE);
		$this->db->from("사용자");
		$this->db->join('걷기대회_참가자',"사용자.사용자_id = 걷기대회_참가자.사용자_id and 사용자.사용자_id='".mysql_real_escape_string($friend_id)."'",'',FALSE);
		$this->db->where("사용자.사용자_id in(select 걷기대회_참가자.사용자_id from 걷기대회_참가자 where 걷기대회_참가자.상태=18 or 19 or 21)");

		return $this->db->get()->row();
	}
	
	/*
	 * recentEventInfo
	 * 최재성
	 * 20170327
	 * 최근 참여 대회 3개 조회
	 */
	function recentEventInfo($friend_id){
		$this->db->select("*");
		$this->db->from("걷기대회");
		$this->db->join('걷기대회_참가자',"걷기대회.걷기대회_id=걷기대회_참가자.걷기대회_id and 걷기대회_참가자.사용자_id ='".mysql_real_escape_string($friend_id)."'",'left outer',FALSE);
		$this->db->where("걷기대회_참가자.상태",18);
		$this->db->or_where("걷기대회_참가자.상태",19);
		$this->db->or_where("걷기대회_참가자.상태",21);
		$this->db->order_by('걷기대회_참가자.참가신청일시','desc');
		$this->db->limit(3);

		return $this->db->get()->result();
	}

}	
?>