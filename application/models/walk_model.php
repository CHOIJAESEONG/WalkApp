<?php

if (! defined ( 'BASEPATH' ))
exit ( 'No direct script access allowed' );

class Walk_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	/*
	 * getLiveEventtTitle
	 * 정수영
	 * 20170314
	 * 사용자의 해당 대회 상태와 현재 진행중인 대회 객체 리턴
	 */
	function getLiveEvent($user) {

		$sql = "SELECT A.걷기대회_id, A.제목, A.주최, DATE_FORMAT(A.시작일시,'%Y-%m-%d') 시작일시, DATE_FORMAT(A.종료일시,'%Y-%m-%d') 종료일시, A.대회포스터, A.참가자수, A.완보자수, A.경품수, A.기념품수,
				if(B.사용자_id is null, '참가신청',C.코드명 ) 버튼상태
				FROM 걷기대회 A
				LEFT OUTER JOIN 걷기대회_참가자 B on A.걷기대회_id = B.걷기대회_id and B.사용자_id =". "'". $user. "'". "
				LEFT OUTER JOIN 공통코드 C on B.상태 = C.공통코드_id
				WHERE A.사용유무 = 'Y' and A.종료일시 >= now() and A.시작일시 <= now()
			 	ORDER BY A.걷기대회_id DESC";

		return $this->db->query( $sql )->result();
	}


	/*
	 * getOutdateEventTitle
	 * 정수영
	 * 20170322
	 * 사용자의 해당 대회 상태와 현재 진행중이 아닌 대회 객체 리턴
	 */
	function getOutdateEvent($user) {
		$sql = "SELECT A.걷기대회_id, A.제목, A.주최, DATE_FORMAT(A.시작일시,'%Y-%m-%d') 시작일시, DATE_FORMAT(A.종료일시,'%Y-%m-%d') 종료일시, A.대회포스터, A.참가자수, A.완보자수, A.경품수, A.기념품수,
				if(B.사용자_id is null, '종료',C.코드명 ) 버튼상태
				FROM 걷기대회 A
				LEFT OUTER JOIN 걷기대회_참가자 B on A.걷기대회_id = B.걷기대회_id and B.사용자_id  =". "'". $user. "'". "
				LEFT OUTER JOIN 공통코드 C on B.상태 = C.공통코드_id
				WHERE A.사용유무 = 'Y' and A.종료일시 <now() and A.사용유무='Y'
			 	ORDER BY A.걷기대회_id DESC";
		return $this->db->query( $sql )->result();
	}


	/*
	 * getPredateEventTitle
	 * 정수영
	 * 20170322
	 * 사용자의 해당 대회 상태와 앞으로 진행할 대회 객체 리턴
	 */
	function getPredateEvent($user) {
		$sql = "SELECT A.걷기대회_id, A.제목, A.주최, DATE_FORMAT(A.시작일시,'%Y-%m-%d') 시작일시, DATE_FORMAT(A.종료일시,'%Y-%m-%d') 종료일시, A.대회포스터, A.참가자수, A.완보자수, A.경품수, A.기념품수,
				if(B.사용자_id is null, '참가신청',C.코드명 ) 버튼상태
				FROM 걷기대회 A
				LEFT OUTER JOIN 걷기대회_참가자 B on A.걷기대회_id = B.걷기대회_id and B.사용자_id = ". "'". $user. "'". "
				LEFT OUTER JOIN 공통코드 C on B.상태 = C.공통코드_id
				WHERE A.사용유무 = 'Y' and A.시작일시 >= now() and A.사용유무='Y'
			 	ORDER BY A.걷기대회_id DESC";
		return $this->db->query( $sql )->result();
	}

	
	/*
	 * getSelectedPageInfo
	 * 정수영
	 * 20170322
	 * 사용자가 선택한 페이지에 대한 사용자 정보와 대회정보 load
	 * walk_view에서 사용.
	 */
	function getSelectedPageInfo($event_id){
		$sql = "SELECT(
		 		SELECT concat(group_concat(A.경품명),(select case when count(*) > 3 then '...' else '' end from 경품 B where B.걷기대회_id = A.걷기대회_id))
		 		from 경품 A
		 		where A.걷기대회_id = AA.걷기대회_id
		 		limit 3) 경품
		 		,(
				SELECT concat(group_concat(A.기념품명),(select case when count(*) > 3 then '...' else '' end from 기념품 B where B.걷기대회_id = A.걷기대회_id))
		 		from 기념품 A
				where A.걷기대회_id = AA.걷기대회_id
				limit 3
				) 기념품 ,
				concat(DATE_FORMAT(AA.시작일시,'%Y-%m-%d'),' ~ ',DATE_FORMAT(AA.종료일시,'%Y-%m-%d')) 참여기간 ,
				concat(FORMAT(AA.목표걸음수,0),'보') 완보걸음 ,
				AA.걷기대회_id ,
				AA.머릿말 ,
				AA.제목 ,
				AA.대회포스터,
				DATE_FORMAT(AA.`기념품/경품_추첨일`,'%Y-%m-%d') 추첨일,
				AA.주최,
				AA.협찬
				FROM 걷기대회 AA
				WHERE AA.걷기대회_id =" .$event_id;

		return $this->db->query( $sql )->result();
	}

	/*
	 * getInfoEvent
	 * 정수영
	 * 20170315
	 * 대회의 경품정보, 기념품정보를 얻기위한 join table 객체 리턴
	 */
	function getInfoEvent($event_id) {
		$this->db->select ( "*" );
		$this->db->from ( "걷기대회" );
		$this->db->where ( "걷기대회_id", $event_id );

		return $this->db->get()->result();
	}



	/*
	 * getInfoEventRandomPresent
	 * 정수영
	 * 20170317
	 * 대회의 경품수, 경품명을 얻기위한 객체 리턴
	 */
	function getInfoEventRandomPresent($event_id) {
		$this->db->select ( "경품명", "경품수" );
		$this->db->from ( "경품" );
		$this->db->where ( "걷기대회_id", $event_id );

		return $this->db->get()->result();
	}


	/*
	 * getUserInfo
	 * 정수영
	 * 20170323
	 * 사용자의 상태를 리턴
	 */
	function getUserInfo($user_id){
		$this-> db-> select("사용자_id,이름,암호,e-mail as 이메일,성별,핸드폰,사진,참여중대회_id,인증번호,인증번호요청시간,주소,우편번호");
		$this-> db-> from("사용자");
		$this-> db-> where("사용자_id",$user_id);
		return $this->db->get()->row();
	}

	/*
	 * getInfoEventPresent
	 * 정수영
	 * 20170317
	 * 대회의 기념품수, 기념품명을 얻기 위한 객체 리턴
	 */
	function getInfoEventPresent($event_id) {
		$this->db->select ( "기념품명", "기념품수" );
		$this->db->from ( "기념품" );
		$this->db->where ( "걷기대회_id", $event_id );

		return $this->db->get()->result();
	}


	/*
	* 조진근
	* 20170321
	* 하나의 걷기대회 정보를 가져옴
	*/
	function getWishEvent($id){
 		$this->db->select("걷기대회_id, 머릿말, 제목, 주최, 시작일시, 종료일시, 대회포스터, 목표걸음수 목표걸음");
 		$this->db->select("FORMAT(목표걸음수,0) 목표걸음수, FORMAT(참가자수,0) 최대참여인원 , 참가자수, FORMAT(완보자수,0) 최대완보인원, 완보자수, FORMAT(경품수,0) 경품수, FORMAT(기념품수,0) 기념품수",FALSE);
 		$this->db->select('date_format(시작일시,"%Y년") AS s_year,  date_format(시작일시,"%m월 %d일") AS s_md, date_format(종료일시,"%Y년") AS e_year, date_format(종료일시,"%m월 %d일") AS e_md, CAST(UNIX_TIMESTAMP(종료일시) AS SIGNED) AS dDay, CAST(UNIX_TIMESTAMP(시작일시) AS SIGNED) AS sDay',FALSE);
 		$this->db->from('걷기대회` as A');
    	$this->db->where("A.걷기대회_id",$id);
 		return $this->db->get()->row();
 	}
 	
 	
 	/*
 	 * 정수영
 	 * 20170330
 	 * 하나의 걷기대회 정보를 가져옴
 	 */
 	function getToggleInfo($event_id){
 		$sql = "select T.*, T.d_total-T.d_day d_time , T.s_total-T.s_day s_time
				from (
				  select 걷기대회_id, 머릿말, 제목, 주최, 시작일시, 종료일시, 대회포스터, 목표걸음수 목표걸음
				  ,FORMAT(목표걸음수,0) 목표걸음수, FORMAT(참가자수,0) 최대참여인원 , 참가자수, FORMAT(완보자수,0) 최대완보인원, 완보자수, FORMAT(경품수,0) 경품수, FORMAT(기념품수,0) 기념품수
				  ,date_format(시작일시,'%Y년') s_year,  date_format(시작일시,'%m월 %d일') s_md, date_format(종료일시,'%Y년') e_year
				  ,date_format(종료일시,'%m월 %d일') e_md 
				  ,CAST(UNIX_TIMESTAMP(종료일시) as SIGNED) d_total
				  ,CAST(UNIX_TIMESTAMP(시작일시) as SIGNED) s_total
				  ,CAST(UNIX_TIMESTAMP(date_format(종료일시,'%y-%m-%d')) as SIGNED) d_day 
				  ,CAST(UNIX_TIMESTAMP(date_format(시작일시,'%y-%m-%d')) as SIGNED) s_day
				  from 걷기대회 
				  where 걷기대회_id='".$event_id."' 
				) T";
 		return $this->db->query( $sql )->row();
 	}
 	
 	
	/*
	* 조진근
	* 20170324
	* 걷기대회 참여자수를 셈
	*/
	function getWishEntry($id){
		$this->db->select("(SELECT count(*) FROM 사용자 WHERE 탈퇴코드 IS null) AS 참가자수 ",FALSE);
		return $this->db->get()->row();
	}


	/*
	* 조진근
	* 20170321
	* 입력받은 걷기대회_id에 해당되는 행을 기념품 테이블에서 가져옴
	*/
	function getWishMemento($id){
 		$this->db->select('*',FALSE);
 		$this->db->from('기념품` as A');
    	$this->db->where("A.걷기대회_id",$id);
 		return $this->db->get()->result();
 	}


	/*
	* 조진근
	* 20170321
	* 입력받은 걷기대회_id에 해당되는 행을 경품 테이블에서 가져옴
	*/
	function getWishGift($id){
 		$this->db->select('*',FALSE);
 		$this->db->from('경품` as A');
    	$this->db->where("A.걷기대회_id",$id);
 		return $this->db->get()->result();
 	}


	/*
	* 조진근
	* 20170321
	* 입력받은 사용자 ID에 맞는 사용자 이름을 사용자 테이블에서 가져옴
	*/
	function getUserName($user){
		$this->db->select('이름', FALSE);
		$this->db->from('사용자 AS A');
		$this->db->where('사용자_id', $user);
		return $this->db->get()->row();
	}
	
	
	/*
	 * 정수영
	 * 20170324
	 * 입력받은 사용자 ID에 맞는 ceremony화면에 data를 loading
	 * 완보소요일 , 걷기대회_id, 완보자 랭킹, 목표걸음수 
	 */
	function getCereMony($user_id){
		$sql = "select AA.*, concat(round(미션수행*100/미션수,0),'%') 미션완료율, concat(round(Wish*100/Wish수,0),'%') Wish완료율
				,case when Wish=Wish수 then '성공' else '실패' end 체크인성공여부
				from
				(
				  select
				  if(isnull(A.목표걸음수),0,FORMAT(목표걸음수,0)) 목표걸음수
				  ,if(isnull(A.목표걸음수),0,A.목표걸음수) 목표걸음
				 ,(select if(isnull(FORMAT(round(avg(걸음수),0),0)),0,isnull(FORMAT(round(avg(걸음수),0),0)))  from 사용자통계 C where C.사용자_id = B.사용자_id and C.걷기대회_id = A.걷기대회_id) 평균걸음수
				  ,(select if(isnull(DATEDIFF(max(날짜),min(날짜))+1),1,DATEDIFF(max(날짜),min(날짜))+1) from 사용자통계 C where C.사용자_id = B.사용자_id and C.걷기대회_id = A.걷기대회_id) 소요일
				  ,(select count(*) + 1 from 걷기대회_참가자 C where C.걷기대회_id = A.걷기대회_id and C.완보일 < now()) 완보랭킹
				  ,(select count(*) from 미션_수행_삭제 C ,미션 D where C.사용자_id = B.사용자_id and C.미션_id = D.미션_id and D.걷기대회_id = A.걷기대회_id) 미션수행
				  ,(select count(*) from 위시_스템프 C ,위시 D where C.사용자_id = B.사용자_id and C.위시_id = D.위시_id and D.걷기대회_id = A.걷기대회_id) Wish
				  ,(select count(*) from 미션 D where D.걷기대회_id = A.걷기대회_id) 미션수
				  ,(select count(*) from 위시 D where D.걷기대회_id = A.걷기대회_id) Wish수
				  ,concat(concat(DATE_FORMAT(A.시작일시,'%Y-%m-%d'),'~'),DATE_FORMAT(A.종료일시,'%Y-%m-%d')) 참가기간
				  ,(DATE_FORMAT(A.시작일시,'%Y-%m-%d')) 시작일시
		      	  ,(DATE_FORMAT(A.종료일시,'%Y-%m-%d')) 종료일시
		      	  ,(select if(C.완보여부='Y','완보성공','완보실패') from 걷기대회_참가자 C where C.걷기대회_id = B.참여중대회_id and C.사용자_id = B.사용자_id) 완보여부
				  ,DATE_FORMAT(A.`기념품/경품_추첨일`,'%Y-%m-%d') 추첨일
      			  ,(select if(isnull(sum(C.걸음수)), 0 , sum(C.걸음수)) from 사용자통계 C where C.사용자_id=B.사용자_id and C.걷기대회_id=A.걷기대회_id) 누적걸음수
      	  		  ,(A.목표걸음수 - (select if(isnull(sum(C.걸음수)), 0 , sum(C.걸음수)) from 사용자통계 C where C.사용자_id=B.사용자_id and C.걷기대회_id=A.걷기대회_id)) 남은걸음수
				  from 걷기대회 A, 사용자 B
				  where B.사용자_id = '".$user_id."' and B.참여중대회_id = A.걷기대회_id
				)AA";
		
		return $this->db->query( $sql )->row();
	}

	
	/*
	 * getCompleteSpot
	 * 정수영
	 * 20170324
	 * 입력받은 사용자 ID가 완료한 핫스팟과 갯수 리턴
	 */
	function getCompleteSpot($user_id){
		$this->db->select('count(*) as 핫스팟수행수 ',FALSE);
		$this->db->from('위시_수행');
		$this->db->where("사용자_id", $user_id);
		return $this->db->get()->row();
	}
	
	/*
	 * getTotalSpot
	 * 정수영
	 * 20170327
	 * 입력받은 대회_id의 총핫스팟 개수를 리턴
	 */
	function getTotalSpot($event_id){
		$this->db->select('distinct count(*) as 핫스팟개수', False);
		$this->db->from('위시');
		$this->db->where('걷기대회_id', $event_id);
		
		return $this->db->get()->row();
	}
	
	/*
	 * getCheckInStatus
	 * 정수영
	 * 20170324
	 * 입력받은 사용자 ID가 완료한 체크인 상황과 갯수 리턴
	 */
	function getCheckInStatus($user_id){
		$this->db->select('count(*) as 체크인수행여부 ',FALSE);
		$this->db->from('핫스팟_체크인_삭제');
		$this->db->where("사용자_id", $user_id);
		$this->db->where("상태", 23);
		return $this->db->get()->row();
	}
	
	/*
	 * getPreserveEvent
	 * 정수영
	 * 20170327
	 * 입력받은 사용자가 찜한 이벤트 목록을 리턴
	 */
	function getPreserveEvent($user_id){	
		$this->db->select('date_format(시작일시,"%Y년%m월 %d일 ") AS 시작일시, date_format(종료일시,"%Y년%m월 %d일 ") AS 종료일시, 대회포스터, 제목, if(완보여부 = "N", "진행중", "완료" ) AS 진행여부 ',FALSE);
		$this->db->from('걷기대회_참가자');
		$this->db->join('걷기대회','걷기대회_참가자.걷기대회_id = 걷기대회.걷기대회_id' ,'left outer',False);
		$this->db->where("사용자_id", $user_id);
		$this->db->where("상태", '17');
		$this->db->where("완보여부", 'N');
		return $this->db->get()->result();
	}
	
	
	/*
	 * getPreserveEvent
	 * 정수영
	 * 20170327
	 * 입력받은 사용자가 찜한 이벤트 목록을 리턴
	 */
	function getDdaySday($event_id){
		$this->db->select('datediff(시작일시,now()) as 남은참가신청일 , datediff(종료일시,now()) as 남은종료일',False);
		$this->db->from('걷기대회');
		$this->db->where('걷기대회_id' , $event_id);
		return $this->db->get()->row();
	}
	
	
	/*
	 * getMissionState
	 * 정수영
	 * 20170327
	 * 해당 유저의가 실행한 distinct한 핫스팟개수를 리턴
	 */
	function getUserHotspot($user_id){
		$this->db->select('distinct count(*) as 유저핫스팟개수', False);
		$this->db->from('위시_스템프');
		$this->db->where('사용자_id', $user_id);
		return $this->db->get()->row();
	}
	
	/*
	 * getEventHotSpot
	 * 정수영
	 * 20170327
	 * 해당 event의 핫스팟개수를 리턴
	 */
	function getEventHotSpot($event_id){
		$this->db->select('distinct count(*)',False);
		$this->db->from('위시');
		$this->db->where('걷기대회_id', $event_id);
		return $this->db->get()->row();
	}
	
	/*
	 * getEventHotSpot
	 * 정수영
	 * 20170327
	 * 해당 유저가 해당이벤트의 경품대상인지 확인
	 */
	function getMissionStatus($user_id, $event_id){
		$sql = "select count(*) as 개수
				from 미션_수행_삭제 AS A, 미션 AS B
				where A.사용자_id='" . $user_id . "' and A.미션_id = B.미션_id and B.걷기대회_id='" . $event_id ."'";
		return $this->db->query( $sql )->row();
	}
	
	
	/*
	 * getWalkComplete
	 * 정수영
	 * 20170327
	 * 해당 유저가 해당이벤트를 완료했는지 여부
	 */
	function getWalkComplete($user_id, $event_id){
		$this->db->select("*");
		$this->db->from('걷기대회_참가자');
		$this->db->where('걷기대회_id', $event_id);
		$this->db->where('사용자_id', $user_id);
		return $this->db->get()->row();
	}

	
	/*
	 * getWalkCondition
	 * 정수영
	 * 20170329
	 * walk_condition에 해당하는 data load
	 */
	function getWalkCondition($user_id){
		$sql ="select AA.*, concat(round(유저미션수행개수*100/미션개수,0),'%') 미션완료율
        		,concat(round(유저위시개수*100/위시개수,0),'%') 위시완료율
        		,concat(round(유저핫스팟개수*100/핫스팟개수,0),'%') 핫스팟완료율
				,case when 유저미션수행개수=위시개수 then '성공' else '실패' end 체크인성공여부
     		   ,concat(round(누적걸음수*100/목표걸음,1),'%') 진행률
				from
				(
				  select
				  if(isnull(FORMAT(목표걸음수,0)),0,isnull(FORMAT(목표걸음수,0))) 목표걸음수
				  ,if(isnull(A.목표걸음수),0,A.목표걸음수) 목표걸음
        		  ,(select DATE_FORMAT(C.참가신청일시,'%Y.%m.%d') from 걷기대회_참가자 C where C.걷기대회_id=A.걷기대회_id and C.사용자_id=B.사용자_id) 유저참가신청일시
				  ,(select count(*) + 1 from 걷기대회_참가자 C where C.걷기대회_id = A.걷기대회_id and C.완보일 < now()) 완보랭킹
				  ,(select count(*) from 미션_수행_삭제 C ,미션 D where C.사용자_id = B.사용자_id and C.미션_id = D.미션_id and D.걷기대회_id = A.걷기대회_id) 유저미션수행개수
				  ,(select count(*) from 위시_스템프 C ,위시 D where C.사용자_id = B.사용자_id and C.위시_id = D.위시_id and D.걷기대회_id = A.걷기대회_id) 유저위시개수
        		  ,(select count(*) from 핫스팟_체크인_삭제 C where C.사용자_id = B.사용자_id and C.상태='23') 유저핫스팟개수
				  ,(select count(*) from 미션 D where D.걷기대회_id = A.걷기대회_id) 미션개수
				  ,(select count(*) from 위시 D where D.걷기대회_id = A.걷기대회_id) 위시개수
            	  ,(select count(*) from 핫스팟 C where C.걷기대회_id = A.걷기대회_id) 핫스팟개수 
          		  ,concat(concat(DATE_FORMAT(A.시작일시,'%Y-%m-%d'),'~'),DATE_FORMAT(A.종료일시,'%Y-%m-%d')) 대회기간
				  ,(DATE_FORMAT(A.시작일시,'%Y.%m.%d')) 시작일시
		    	  ,(DATE_FORMAT(A.종료일시,'%Y.%m.%d')) 종료일시
		    	  ,(select if(C.완보여부='Y','완보성공','완보실패') from 걷기대회_참가자 C where C.걷기대회_id = B.참여중대회_id and C.사용자_id = B.사용자_id) 완보여부
				  ,DATE_FORMAT(A.`기념품/경품_추첨일`,'%Y.%m.%d') 추첨일
      			  ,(select if(isnull(sum(C.걸음수)), 0 , sum(C.걸음수)) from 사용자통계 C where C.사용자_id=B.사용자_id and C.걷기대회_id=A.걷기대회_id) 누적걸음수
      	  		  ,(A.목표걸음수 - (select if(isnull(sum(C.걸음수)), 0 , sum(C.걸음수)) from 사용자통계 C where C.사용자_id=B.사용자_id and C.걷기대회_id=A.걷기대회_id)) 남은걸음수
          		  ,(A.기념품수) 기념품수
          		  ,(A.경품수) 경품수
				  ,(A.참가자수) 참가자수
          		  ,(A.완보자수) 완보자수
				  ,(A.협찬로고) 로고
 				  ,concat(round((A.완보자수*100/A.참가자수),1),'%') 완보율
				  from 걷기대회 A, 사용자 B
				  where B.사용자_id = '".$user_id."' and B.참여중대회_id = A.걷기대회_id
				)AA";
		
		return $this->db->query( $sql )->row();
	}
	
}

?>
