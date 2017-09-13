<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('user_model');
		$this->load->library('walk_common');
		$this->load->library('session_common');
	}

	/*
	 * indexPw
	 * 이소희
	 * 20170313
	 * 비밀번호 초기화면
	 */
	function indexPw($check){
		$this->load->view ("activity/header_p");
		$data["check"] = $check;
		$data["pw_error"] = "";
		$this->load->view("user/user_pw_view",$data);
		$this->load->view ("activity/footer");
	}
	
	/*
	 * pwCheck
	 * 이소희
	 * 20170314
	 * 비밀번호 확인 후 탈퇴 사유 뷰로 이동
	 */
	function pwCheck($check){
		if($this->session_common->checkSession("user")){
			$user_id = $this->session_common->getSession("user")['user_id'];
		}
		$pw=trim($this->input->post('password'));
		$cnt = $this->user_model->pwCheck($user_id,$pw);
	
		//비밀번호를 입력하지 않거나 일치 하지 않을떄	
		if ($cnt < 1){
			$data["pw_error"] = "비밀번호가 일치하지 않습니다.";
			$data["check"] = $check;
			$this->load->view ("activity/header_p");
			$this->load->view("user/user_pw_view",$data);
			$this->load->view ("activity/footer");
		}else{
			$data["pwReasons"]= $this->walk_common->func_getCode('USER_LEAVE');
			$this->load->view ("activity/header_p");
			$this->load->view("/user/user_delete_reason",$data);
			$this->load->view ("activity/footer");
		}
		
	}
	
	/*
	 * deleteInfo
	 * 이소희
	 * 20170314
	 * 회원 탈퇴
	 */
	function deleteInfo(){
		if($this->session_common->checkSession("user")){
			$user_id = $this->session_common->getSession("user")['user_id'];
		}
		$reason=trim($this->input->post('reason'));
		$etc=trim($this->input->post('etc'));
		return $this->user_model->deleteInfo($user_id, $reason, $etc);
	}
	
	/*
	 * userInfo
	 * 이소희
	 * 20170317
	 * 회원정보 확인 + 세션 아이디로 회원 정보 확인
	 */
	function userInfo(){
		if($this->session_common->checkSession("user")){
			$user_id = $this->session_common->getSession("user")['user_id'];
			
		}
			$data["info"] = $this->user_model->userInfo($user_id);
			$this->load->view("activity/header_p");
			$this->load->view("user/user_info_view",$data);
			$this->load->view("activity/footer");
		
	}
	
	/*
	 * pwChange
	 * 이소희
	 * 20170315
	 * 비밀번호 확인 후 변경 페이지로 이동 
	 */
	function pwChange($check){
		if($this->session_common->checkSession("user")){
			$user_id = $this->session_common->getSession("user")['user_id'];
		}
		$pw=trim($this->input->post('password'));
		$cnt = $this->user_model->pwCheck($user_id,$pw);
	
		//비밀번호를 입력하지 않거나 일치 하지 않을떄	
		if ($cnt < 1){
			$data["pw_error"] = "비밀번호가 일치하지 않습니다.";
			$data["check"] = $check;
			$this->load->view("activity/header_p");
			$this->load->view("user/user_pw_view",$data);
			$this->load->view("activity/footer");
		}else{
			$data["info"] = $this->user_model->userInfo($user_id);	
			$this->load->view("activity/header_p");
			$this->load->view("/user/user_pw_change",$data);
			$this->load->view("activity/footer");
		}
		
	}
	
	/*
	 * newPwSet
	 * 이소희
	 * 20170315
	 * 비밀번호 재설정
	 */
	function newPwSet(){
		if($this->session_common->checkSession("user")){
			$user_id = $this->session_common->getSession("user")['user_id'];
		}
		$pw=trim($this->input->post('password'));
		return $this->user_model->newPwSet($user_id, $pw);
	}
	
	/*
	 * loginIndex
	 * 이소희
	 * 20170316, 20170317
	 * 로그인화면 (main, 로그아웃 후 로그인 화면으로 이동)
	 */
	 function loginIndex(){
		$this->load->view("activity/header");
		$this->load->view("user/login_index_view");
		$this->load->view("activity/footer");		 
	 }
	
	/*
	 * loginCheck
	 * 이소희
	 * 20170316
	 * 로그인체크
	 * 사용자_id : (대회이름, 종료일시, 사용자_id, 이름, 참여중대회_id, cnt, logged_in 정보를 가지고옴)
	 */
	 function loginCheck(){
		$user_id=trim($this->input->post('user_id'));
		$password=trim($this->input->post('password'));

		$user = $this->user_model->loginCheck($user_id,$password);
		if($user->cnt==1){
			$this->session_common->setSession("user", $user);
		}
		echo $user->cnt;
	 }
	 

	 /*
	 * logout
	 * 이소희
	 * 20170317
	 * 로그아웃
	 */
	 function logout(){
		$this -> session_common -> logout();
		$this->load->view("activity/header_p");
		$this->load->view("user/login_index_view");
		$this->load->view("activity/footer");
	 }
	 
	 /*
	 * findIdIndex
	 * 이소희
	 * 20170316
	 * 아이디 찾기 index뷰
	 */
	 function findIdIndex(){
		$this->load->view("activity/header_p");
		$this->load->view("user/find_id_index_view");
		$this->load->view("activity/footer");		
	 }
	 
	 /*
	 * insertCode
	 * 이소희
	 * 20170316
	 * 인증번호 생성
	 */
	 function insertCode(){
		$name=trim($this->input->post('name'));
		$phone=trim($this->input->post('phone'));
		//전화번호 DB 여부 확인
		$cnt = $this->user_model->checkPhone($name, $phone);
		//해당 정보가 없을 때 	
		if ($cnt < 1){
			$return["cnt"] = $cnt;
			 echo json_encode($return);
		}else{
			$return["cnt"] = $cnt;
			//인증번호 6자리 생성
			$rand_num = sprintf("%06d",rand(000000,999999));
			$this->user_model->insertCode($name, $phone, $rand_num);
			$return["rand_num"] = $rand_num;
			 echo json_encode($return);
		}
	 }
	 
	 /*
	 * checkCode
	 * 이소희
	 * 20170316
	 * 인증번호 일치 여부 확인
	 */
	 function checkCode(){
		$name=trim($this->input->post('name'));
		$phone=trim($this->input->post('phone'));
		$code=trim($this->input->post('code'));
		$cnt = $this->user_model->checkCode($name,$phone,$code);
		echo $cnt;	
	 }
	 
	 /*
	 * findId
	 * 이소희
	 * 20170316, 20170317
	 * 아이디 찾기 + get방식이 아니라 post방식으로 바꿈
	 */
	 function findId(){
		$name=trim($this->input->post('name'));
		$phone=trim($this->input->post('phone'));
		$data['fid'] = $this->user_model->findId($name,$phone);
		$this->load->view("activity/header_p");
		$this->load->view("user/find_id_result",$data);	
		$this->load->view("activity/footer");	
	 }
	 
	 /*
	 * findPwIndex
	 * 이소희
	 * 20170317
	 * 비밀번호 찾기 index 뷰
	 */
	 function findPwIndex(){
		$this->load->view("activity/header_p");
		$this->load->view("user/find_pw_index_view");
		$this->load->view("activity/footer");
	 }
	 
	/*
	 * insertCode2
	 * 이소희
	 * 20170320
	 * 인증번호 생성 (아이디로 인증번호 생성)
	 */
	 function insertCode2(){
		$id=trim($this->input->post('user_id'));
		$phone=trim($this->input->post('phone'));
		
		//전화번호 DB 여부 확인
		$cnt = $this->user_model->checkIdPhone($id, $phone);
		//해당 정보가 없을 때 	
		if ($cnt < 1){
			$return["cnt"] = $cnt;
			 echo json_encode($return);
		}else{
			$return["cnt"] = $cnt;
			//인증번호 6자리 생성
			$rand_num = sprintf("%06d",rand(000000,999999));
			$this->user_model->insertCode2($id, $phone, $rand_num);
			$return["rand_num"] = $rand_num;
			 echo json_encode($return);
		}
	 }
	 
	 
	 /*
	 * checkCode2
	 * 이소희
	 * 20170317
	 * 인증번호 일치 여부 확인 (아이디로 확인)
	 */
	 function checkCode2(){
		$user_id=trim($this->input->post('user_id'));
		$code=trim($this->input->post('code'));
		$cnt = $this->user_model->checkCode2($user_id,$code);
		echo $cnt;
	 }
	 
	 /*
	 * findPw
	 * 이소희
	 * 20170317
	 * 비밀번호 재설정
	 */
	 function findPw(){
		$data['user_id']=trim($this->input->post('user_id'));
		$this->load->view("activity/header_p");
		$this->load->view("user/find_pw_change",$data);	
		$this->load->view("activity/footer");
	 }
	 
	 /*
	 * newPwSet2
	 * 이소희
	 * 20170320
	 * 비밀번호 재설정(아이디 고정X) 
	 */
	function newPwSet2(){
		$user_id=trim($this->input->post('user_id'));
		$pw=trim($this->input->post('password'));
		return $this->user_model->newPwSet2($user_id, $pw);
	}
	 
	 /*
	 * registerIndex
	 * 이소희
	 * 201703
	 * 회원가입 index 뷰
	 */
	 function registerIndex(){
		$this->load->view("activity/header_p");
		$this->load->view("user/register_index_view");
		$this->load->view("activity/footer");		
	 }
	 
	 /*
	 * adsChangeIndex
	 * 이소희
	 * 20170322
	 * 주소 변경 인덱스 뷰
	 */
	 function adsChangeIndex(){
		if($this->session_common->checkSession("user")){
			$data['user_id'] = $this->session_common->getSession("user")['user_id'];
		}
		$this->load->view("activity/header_p");
		$this->load->view("user/ads_change_index",$data);
		$this->load->view("activity/footer");
	 }
	 
	 /*
	 * adsChange
	 * 이소희
	 * 20170322
	 * 주소 재설정
	 */
	function adsChange(){
		if($this->session_common->checkSession("user")){
			$user_id = $this->session_common->getSession("user")['user_id'];
		}
		$newAdd=trim($this->input->post('newAdd'));
		$result = $this->user_model->adsChange($user_id, $newAdd);
		if($result==1){
			redirect('/user/userInfo');	
		}
	
	}

}
?>