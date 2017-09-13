<?php

class Walk extends CI_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->library('session_common');
		$this->session_common->checkSession("user");
		
		$this->load->model ( 'walk_model' );
	}

	/*
	 * index
	 * 정수영
	 * 20170314
	 * walk_model data load
	 * 초기화면
	 */
	function index() {
			$this->load->view ( "activity/header_p" );
			$this->load->view ( "walk/walk_tab" );
			$this->load->view ( "activity/footer" );
	}

	/*
	 * getWalkList
	 * 정수영
	 * 20170315
	 * 원하는 태그(진행중, 진행예정, 종료된대회)클릭시 원하는 데이터 로드
	 * 초기화면
	 */
	function getWalkList($index = "") {
		$this->load->view ( "activity/header_p" );
		$user_id = $this->session_common->getSession("user")['user_id'];

		switch ($index) {
			case "close" :
				$data ["walkLists"] = $this->walk_model->getOutdateEvent($user_id); // 종료된 대회 객체
				break;
			case "predate" :
				$data ["walkLists"] = $this->walk_model->getPredateEvent($user_id); // 예정 대회 객체
				break;
			default :
				$data ["walkLists"] = $this->walk_model->getLiveEvent($user_id); // 진행중인 대회 객체
				break;
		}
		$this->load->view ( "walk/walk_list", $data );
		$this->load->view ( "activity/footer" );
	}


	/*
	 * getSelectedWalkEvent
	 * 정수영
	 * 20170319
	 * 참가신청 버튼 클릭후, 대회 상세페이지로 이동
	 * 대회 상세정보, 대회기념품정보, 경품정보 객체를 리턴
	 */
	function getSelectedWalkEvent($event_id) {
		$this->load->view ( "activity/header_p" );
		$data ["selectEvent"] = $this->walk_model->getInfoEvent( $event_id );
		$data ["alldata"] = $this->walk_model->getSelectedPageInfo($event_id);

		$this->load->view ( "walk/walk_view", $data );
		$this->load->view ( "activity/footer" );
	}


	/*
	 * getApplyWalkEvent
	 * 정수영
	 * 20170320
	 * 대회신청하기 버튼 클릭후, 대회 신청하기페이지로 이동
	 * 대회 상세정보 객체, 유저 정보 객체를 리턴
	 */
	function applyWalkEvent($event_id, $user_id="") {
		$user_id = $this->session_common->getSession("user")['user_id'];
		$this->load->view ( "activity/header_p" );
		$data ["selectEvent"] = $this->walk_model->getInfoEvent($event_id);
		$data ["selectUser"] = $this->walk_model->getUserInfo($user_id);

		$this->load->view ( "walk/apply_walk_event", $data );
		$this->load->view ( "activity/footer" );
	}


	/*
	* 조진근
	* 20170320
	* getWalkInfo
	* 대회정보 페이지로 이동
	*/
	function summary_comp(){
		$temp = $this->session_common->getSession("user");
	   	$id = $temp["contest_id"];
		$data["event"] = $this->walk_model->getWishEvent($id);
		$data["mementos"] = $this->walk_model->getWishMemento($id);
		$data["gifts"] = $this->walk_model->getWishGift($id);
		$this->load->view("walk/summary_comp",$data);
	}


	/*
	* 조진근
	* 20170320
	* getWishTrack
	* WISH TRACK 페이지로 이동
	*/
	function getWishTrack(){
	   $temp = $this->session_common->getSession("user");
	   $user = $temp["user_id"];
	   $id = $temp["contest_id"];
	   $data["name"] = $this->walk_model->getUserName($user);
	   $data["event"] = $this->walk_model->getWishEvent($id);
	   $data["user"] = $this->walk_model->getWishEntry($id);
	   $this->load->view ("activity/header_p");
	   $this->load->view("walk/walk_wish_track",$data);
	   $this->load->view ("activity/footer");
	}


	/*
	 * 정수영
	 * 20170323
	 * toggle_comp
	 * 메인페이지 상단토글에 data load
	 */
	function toggle_comp(){
		$user_id = $this->session_common->getSession("user")['user_id'];		//user_id
		$event_id = $this->session_common->getSession("user")['contest_id'];	//참여중 대회
		$data['user_info'] = $this->session_common->getSession("user");			//사용자정보
		
		$data["current_event"] = $this->walk_model->getToggleInfo($event_id);	//진행중 대회 정보
		$data["alldata"] = $this->walk_model-> getCereMony($user_id);
		
	
		$now = new DateTime(date("Y-m-d"));	//현재 --> 현재도 월/일 만
		$endday = new DateTime($data['alldata']->종료일시);	//종료일
		$date_diff_day 	= date_diff($now, $endday)->days;	//차이 D-day
		$data['date_diff_day'] = $date_diff_day;
		
		$data['flag'] = 0;	//1->대회진행중,  0->대회종료
		$contest_state = $this->input->post('contest_state');
		if($contest_state=='1'){	//대회 진행중 
			$data['flag']=1;
		}
				
		if($data['alldata']->소요일<=0){
			$data["per_day_walking"] = number_format($data['alldata']->누적걸음수);	  //일평균걸음수
		}else{
			$data["per_day_walking"] = number_format(round($data['alldata']->누적걸음수 / $data['alldata']->소요일, 2));	  //일평균걸음수
		}
		
		if($data['alldata']->목표걸음<=0){
			$data["complete_percent"]= '100%';
		}else{
			$data["complete_percent"] = round($data['alldata']->누적걸음수 * 100 / $data['alldata']->목표걸음, 2);  //진행률
		}
		
		if($date_diff_day<=0){
			$data["recommand_per_walking"] = number_format($data['alldata']->남은걸음수);
		}else{
			$data["recommand_per_walking"] = number_format(round($data['alldata']->남은걸음수 /$date_diff_day, 2));	//일평균 추천걸음수
		}
		$data['alldata']->남은걸음수 = number_format($data['alldata']->남은걸음수);
		$data['alldata']->누적걸음수 = number_format($data['alldata']->누적걸음수);
		
		$this->load->view ("walk/toggle_comp", $data);	
	}

	
	/*
	 * 정수영
	 * 20170324
	 * ceremony_popup
	 * 목표 걸음수 완료시 팝업창띄우기
	 */
	function ceremony_popup(){
		$user_id = $this->session_common->getSession("user")['user_id'];	
		$this->load->view ("activity/header_p");
		$data['middle_view'] = $this->walk_model->getCereMony($user_id);				
		$data['preserveEvent'] = $this->walk_model->getPreserveEvent($user_id);
		$data['count'] = count($data['preserveEvent']);
		
		if( $this->walk_model->getCheckInStatus($user_id)->체크인수행여부 == "0"){
			$data['checkin'] = "실패";
		}else{
			$data['checkin'] = "성공";
		}
		$this->load->view("walk/ceremony_popup",$data);
	}
	
	/*
	 * 정수영
	 * 20170327
	 * posterlist_comp
	 * posterlist view 안에 data load 하기 (사용자가 참가중인 이벤트 받아와야함.)
	 */
	function posterlist_comp(){
		$user_id = $this->session_common->getSession("user")['user_id'];
		$event_id = $this->session_common->getSession("user")['contest_id'];
		
		$data ["walkLists"] = $this->walk_model->getLiveEvent($user_id); // 진행중인 대회 객체
		$data ["diffdate"] = $this->walk_model->getDdaySday($event_id);
		$this->load->view("walk/posterlist_comp", $data );
		$this->load->view ("activity/footer");
	}
	
	
	/*
	 * 정수영
	 * 20170327
	 * userEventState
	 * 한 유저의  특정 이벤트에 대한 상태 페이지  
	 */
	function userEventState(){
		
		$user_id = $this->session_common->getSession("user")['user_id'];  
		$this->load->view ("activity/header_p");  
		
		$data['alldata'] = $this->walk_model->getCereMony($user_id);	//필요한 데이터 load
		
		$now = new DateTime();	//현재
		$prizeday = new DateTime($data['alldata']->추첨일);	//추첨일
		$date_diff_day 	= date_diff($now, $prizeday)->days;	//차이 D-day
		$date_diff_time = date_diff($now, $prizeday)->format('%h:%i:%s');
		//echo ($date_diff_time);
		$data['diff_day'] = $date_diff_day;
		$data['diff_time'] = $date_diff_time;
		if($now < $prizeday){

		}else{
			$data['diff_day'] = 0;
		}
		$this->load->view("walk/user_event", $data);
		$this->load->view ("activity/footer");				
	}
	
	/*
	 * 정수영
	 * 20170329
	 * condition
	 * walk_condition 화면 load
	 */
	function condition(){
		$user_id = $this->session_common->getSession("user")['user_id'];
		$event_id = $this->session_common->getSession("user")['contest_id'];
		$user_name = $this->session_common->getSession("user")['name'];
		$data['alldata'] = $this->walk_model->getWalkCondition($user_id);
		$data['user_id'] = $user_id;
		$data['user_name'] = $user_name;
		$start = new DateTime(str_replace('.','-',$data['alldata']->시작일시));	//대회시작일
		$end = new DateTime(str_replace('.','-',$data['alldata']->종료일시));	//대회마지막일		
		$user_part = new DateTime(str_replace('.','-',$data['alldata']->유저참가신청일시));	//user참가신청일시
		
		$now = new DateTime(date("Y-m-d"));	//현재 --> 현재도 월/일 만
		
		$data['user_prt_day'] = date_diff($now, $user_part)->days;	//user가 참가기간 -> 참가일로부터 지금까지 (대회가 안끝났을때)
		$data['end_state']=0;
		if(date_diff($end, $now)->days < 0){	//대회가 끝남
			$data['user_prt_day'] = date_diff($now, $end)->days;
			$data['end_state']=1;
		}	
	
		
		
		$data['date_diff_day'] 	= date_diff($start, $end)->days;	//시작일, 끝일 차이
		
		$this->load->view("activity/header_p");
		$this->load->view("walk/walk_condition",$data);
		$this->load->view("activity/footer");
	}
	
	/*
	 * 정수영
	 * 20170329
	 * prizeConfirm
	 * 경품화면을 보여줌
	 */
	function prizeConfirm(){
		$user_id = $this->session_common->getSession("user")['user_id'];
		$user_name = $this->session_common->getSession("user")['name'];
		
		$this->load->view("activity/header_p");
		$this->load->view("walk/prize_confirm");
		$this->load->view("activity/footer");
	}
		
}


?>
