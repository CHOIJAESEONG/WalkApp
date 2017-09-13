<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Friends extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->library('session_common');
		$this->session_common->checkSession("user");
		$this->load->model('friends_model');
	}
	
	/*
	 * index
	 * 최재성
	 * 20170314
	 * 친구 초기화면
	 */
	function index(){
		$user_id = $this->session_common->getSession("user")["user_id"];
		$this->load->view ( "activity/header_p" ); 
		$this->load->view("friends/friendIndex_view");
		$this->load->view ( "activity/footer" ); 
	}
	
	/*
	 * friendList
	 * 최재성
	 * 20170314
	 * 친구목록 대메뉴
	 */
	function friendList(){
		$user_id = $this->session_common->getSession("user")["user_id"];
		$this->load->view("friends/friendsList_view"); 
	}
	
	/*
	 * invite
	 * 최재성
	 * 20170320
	 * 친구초대 소메뉴
	 */
	function invite(){
		$user_id = $this->session_common->getSession("user")["user_id"];
		$this->load->view("friends/invite_view");
	}
	
	/*
	 * myFriends
	 * 최재성
	 * 20170315
	 * 친구목록 화면
	 */
	function myFriends(){
		$user_id = $this->session_common->getSession("user")["user_id"];
		$data["friendIds"]= $this->friends_model->myFriends($user_id);
		$data["friendcnt"]= $this->friends_model->cntFriends($user_id);
		$this->load->view("friends/myFriends_view",$data);
	}
	
	/*
	 * friendsInfo
	 * 최재성
	 * 20170315
	 * 친구프로필 화면
	 */
	function friendsInfo(){
		$user_id = $this->session_common->getSession("user")["user_id"];
		$friend_id= (string) $this->input->post('friend_id');
		$data["friendcnt"]= $this->friends_model->cntFriends($friend_id); //친구 수
		$data["stepinfos"]= $this->friends_model->avgStepInfo($friend_id);
		$data["joininfos"]= $this->friends_model->joinInfo($friend_id);
		$data["recentEventInfos"]= $this->friends_model->recentEventInfo($friend_id);
		$this->load->view("friends/friendsInfo_view",$data);
	}  
	
	/*
	 * msCheck
	 * 최재성
	 * 20170315
	 * 쪽지보기 화면
	 */
	function msCheck(){
		$user_id = $this->session_common->getSession("user")["user_id"];
		$data["userId"]=$user_id;
		$data["friendIds"]= $this->friends_model->msCheck($user_id);
		$this->load->view("/friends/msCheck_view",$data);
	}
	
	/*
	 * refreshCheck
	 * 최재성
	 * 20170403
	 * 쪽지보기 화면 refresh
	 */
	function refreshCheck(){
		$user_id = $this->session_common->getSession("user")["user_id"];
		$data["userId"]=$user_id;
		$data["friendIds"]= $this->friends_model->msCheck($user_id);
		$this->load->view("/friends/msCheck_view_list",$data);
	}
	
	/*
	 * refreshMs
	 * 최재성
	 * 20170329
	 * 채팅 통신
	 */
	function refreshMs(){
		$user_id = $this->session_common->getSession("user")["user_id"]; 
		$group_id= (string) $this->input->post('groupId');
		$msId=trim($this->input->post('msId'));
		$data["groupIds"]= $group_id;
		$data["user_id"] = $user_id;
		$data["friendIds"] = $this->friends_model->refreshMs($group_id,$msId);
		$result=$this->friends_model->checkYN($user_id,$group_id);
		$this->load->view("/friends/msRoom_view_list",$data);
	}
	
	/*
	 * addMs
	 * 최재성
	 * 20170315
	 * 더보기 메세지
	 */
	function addMs(){
		$user_id = $this->session_common->getSession("user")["user_id"]; 
		$group_id= (string) $this->input->post('groupId');
		$upperMsId= (string) $this->input->post('upperMsId');
		
		if($group_id==null &&$upperMsId==null){
			return;
		}else{
			$data["friendIds"]= $this->friends_model->addMs($group_id,$upperMsId);
			$data["user_id"] = $user_id;
			$this->load->view("/friends/msRoom_view_list",$data);
		}
	}
	
	/*
	 * msRoom
	 * 최재성
	 * 20170315
	 * 채팅방 화면(쪽지 보기를 통한 접근)
	 */
	function msRoom(){
		$user_id = $this->session_common->getSession("user")["user_id"]; 
		$group_id= (string) $this->input->post('groupId');
		$data["user_id"] = $this->session_common->getSession("user")["user_id"];
		$data["friendIds"]= $this->friends_model->msRoom($group_id);
		$minRow=$this->friends_model->minMs($group_id);
		$totalminMs=$this->friends_model->totalminMs($group_id);
		$msCnt= $this->friends_model->msRoomCnt($group_id);
		$result=$this->friends_model->checkYN($user_id,$group_id);
		$data["groupIds"]= $group_id;
		$data["msCnt"]= $msCnt;
		$data["upperMsId"]= $minRow;
		$data["totalminMs"]= $totalminMs;
		
		$this->load->view ( "activity/header_p" ); 
		$this->load->view("/friends/msRoom_view",$data);
		$this->load->view ( "activity/footer" );
	}
	
	/*
	 * msRoomOther
	 * 최재성
	 * 20170315
	 * 채팅방 화면(내 친구 탭에서 쪽지 버튼을 통한 접근)
	 */
	function msRoomOther(){
		$friend_id= (string) $this->input->post('friend_id');
		$user_id = $this->session_common->getSession("user")["user_id"];
		$row = $this->friends_model->msRoomOther($friend_id,$user_id);

		if(count($row) == 0){
			$row = $this->friends_model->msRoomNew($friend_id,$user_id);
		}
		
		$group_id=$row->그룹_id;
		$minRow=$this->friends_model->minMs($group_id);
		$totalminMs=$this->friends_model->totalminMs($group_id);
		$msCnt= $this->friends_model->msRoomCnt($group_id);
		$updateYN = $this->friends_model->checkYN($user_id,$group_id); //확인여부를 체크하여 New 아이콘 없앰
		$data["groupIds"]= $group_id;
		$data["msCnt"]= $msCnt;
		$data["upperMsId"]= $minRow;
		$data["totalminMs"]= $totalminMs;
		$data["user_id"] = $this->session_common->getSession("user")["user_id"];
		$data["friendIds"]= $this->friends_model->msRoom($group_id);
		
		$this->load->view ( "activity/header_p" ); 
		$this->load->view("/friends/msRoom_view",$data);
		$this->load->view ( "activity/footer" );
	}

	/*
	 * insertContents
	 * 최재성
	 * 20170315
	 * 채팅방 내용저장
	 */
	function insertContents(){
		$user_id = $this->session_common->getSession("user")["user_id"];
		$contents=trim($this->input->post('contents'));
		$group_id=trim($this->input->post('groupId'));
		$msId=trim($this->input->post('msId'));
		
		$data["groupIds"]= $group_id;
		$data["user_id"] = $user_id;
		$data["friendIds"] = $this->friends_model->insertContents($group_id,$user_id,$contents,$msId);		
		$this->load->view("/friends/msRoom_view_list",$data);
	}
	
	/*
	 * inviteFriends
	 * 최재성
	 * 20170317
	 * 친구초대
	 */
	function inviteFriends(){
		$user_id = $this->session_common->getSession("user")["user_id"];
		$data["friendIds"]= $this->friends_model->inviteFriend($user_id);
		$data["userIds"]= $this->friends_model->inviteFriend2($user_id);
		$this->load->view("/friends/inviteFriend_view",$data);
	}
	
	/*
	 * acceptEvents
	 * 최재성
	 * 20170328
	 * 대회참여 수락
	 */
	function acceptEvents(){
		$user_id = $this->session_common->getSession("user")["user_id"];
		$event_id=trim($this->input->post('event_id'));
		//$friend_id=trim($this->input->post('friend_id'));
		$result=$this->friends_model->acceptEvents($event_id,$user_id);
		$result=$this->friends_model->deletetEvents($event_id,$user_id);
		
		return $result;
	}
	
	/*
	 * rejectEvents
	 * 최재성
	 * 20170328
	 * 대회참여 수락
	 */
	function rejectEvents(){
		$invite_id=trim($this->input->post('invite_id'));
		$result=$this->friends_model->rejectEvents($invite_id);
		
		return $result;
	}
	
	/*
	 * inviteEvents
	 * 최재성
	 * 20170317
	 * 대회참여 초대
	 */
	function inviteEvents(){
		$user_id = $this->session_common->getSession("user")["user_id"];
		$data["friendIds"]= $this->friends_model->inviteEvents($mode="1",$user_id);
		$data["userIds"]= $this->friends_model->inviteEvents($mode="2",$user_id);
		$this->load->view("/friends/inviteEvent_view",$data);
	}
	
	/*
	 * deleteMs
	 * 최재성
	 * 20170316
	 * 채팅방 삭제
	 */
	function deleteMs(){
		$user_id = $this->session_common->getSession("user")["user_id"];
		$group_id=trim($this->input->post('groupId'));
		$result = $this->friends_model->deleteMs($group_id, $user_id);
		
		return $result;
	}
	
	/*
	 * deleteFriends
	 * 최재성
	 * 20170314
	 * 친구삭제
	 */
	function deleteFriends(){
		$user_id = $this->session_common->getSession("user")["user_id"];
		$friend_id=trim($this->input->post('friend_id'));
		$state = $this->state=16;
		$result = $this->friends_model->deleteFriends($user_id, $friend_id, $state);
		$result = $this->friends_model->deleteFriends($friend_id, $user_id, $state);
		
		return $result;
	}
	
	/*
	 * rejectFriends
	 * 최재성
	 * 20170317
	 * 친구 초대 거절
	 */
	function rejectFriends(){
		$user_id = $this->session_common->getSession("user")["user_id"];		
		$state = $this->state=15;
		$friend_id=trim($this->input->post('friend_id'));
		$result=$this->friends_model->rejectFriends($user_id,$friend_id,$state);
		$result=$this->friends_model->rejectFriends2($user_id,$friend_id,$state);
		
		return $result;
	}
	
	/*
	 * acceptFriends
	 * 최재성
	 * 20170317
	 * 친구 초대 수락
	 */
	function acceptFriends(){
		$user_id = $this->session_common->getSession("user")["user_id"];
		$state = $this->state=14;
		$friend_id=trim($this->input->post('friend_id'));
		$result=$this->friends_model->acceptFriends($friend_id, $user_id,$state);
		
		return $result;
	}
	
	/*
	 * index
	 * 최재성
	 * 20170314
	 * 초대 기본화면
	 */
	function inviteIndex(){
		$user_id = $this->session_common->getSession("user")["user_id"];
		$this->load->view ( "activity/header_p" ); 
		$this->load->view("friends/inviteIndex_view");
		$this->load->view ( "activity/footer" ); 
	}

	/*
	 * inviteList
	 * 최재성
	 * 20170314
	 * 초대 초기화면
	 */
	function inviteList(){
		$user_id = $this->session_common->getSession("user")["user_id"];
		$event_id = $this->session_common->getSession("user")["contest_id"];
		$data["invitefriends"]= $this->friends_model->inviteList($user_id,$event_id);
		$this->load->view("friends/inviteList_view",$data);
	}
	
	/*
	 * insertInvite
	 * 최재성
	 * 20170314
	 * 초대한 친구 저장
	 */
	function insertInvite(){
		$user_id = $this->session_common->getSession("user")["user_id"];
		$event_id = $this->session_common->getSession("user")["contest_id"];
		$friend_id=trim($this->input->post('friend_id'));
		$result = $this->friends_model->insertInvite($event_id, $user_id, $friend_id);
		
		return $result;
	}
}
?>