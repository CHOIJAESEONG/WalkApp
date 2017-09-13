<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->helper('date');
	}	

	/*
	 * pwCheck
	 * 이소희
	 * 20170314
	 * 비밀번호 일치 여부
	 */
	 function pwCheck($user_id,$password){
		$this->db->select("count(*) cnt");
		$this->db->from("사용자");
		$this->db->where("사용자_id",$user_id);
		$this->db->where("암호",$password);
		return $this->db->get()->row()->cnt;
	 }
	 
	/*
	 * deleteInfo
	 * 이소희
	 * 20170314
	 * 회원 탈퇴 
	 */
	 function deleteInfo($user_id,$reason,$etc){
		$this->db->set("이름",null);
		$this->db->set("암호",null)  ;
		$this->db->set("e-mail",null);
		$this->db->set("성별",null);
		$this->db->set("핸드폰",null);
		$this->db->set("사진",null);
		$this->db->set("탈퇴코드",$reason);
		//기타가 아닐 경우
		if($etc==null){
			$this->db->set("탈퇴사유",null);
		}else{
			$this->db->set("탈퇴사유",$etc);
		}
		$this->db->where("사용자_id",$user_id);
		echo $this->db->update('focus_walk.사용자');
	}
	
	/*
	 * userInfo
	 * 이소희
	 * 20170315
	 * 회원정보 확인 
	 */
	  function userInfo($user_id){
		$this->db->select("사용자_id, 이름, e-mail as email, 성별, 주소, 사진 ");
		$this->db->from("사용자");
		$this->db->where("사용자_id",$user_id);
		return $this->db->get()->row();
	 }
	 
	 /*
	 * newPwSet
	 * 이소희
	 * 20170315
	 * 비밀번호 재설정
	 */
	 function newPwSet($user_id, $pw){
		$this->db->set("암호",$pw);	
		$this->db->where("사용자_id",$user_id);
		echo $this->db->update('focus_walk.사용자');
	}
	
	/*
	 * loginCheck
	 * 이소희
	 * 20170330
	 * 로그인체크 (대회이름, 종료일시, 사용자_id, 이름, 참여중대회_id, cnt, logged_in 정보를 가지고옴)
	 */
	 function loginCheck($user_id,$password){
		$this->db->select("제목 as 대회이름,종료일시,사용자.사용자_id as user_id, 사용자.이름 as name, 사용자.참여중대회_id as contest_id, count(*) cnt");
		$this->db->from("걷기대회_참가자");
		$this->db->join("걷기대회","걷기대회_참가자.걷기대회_id=걷기대회.걷기대회_id and 걷기대회_참가자.완보여부='N'","",FALSE);
		$this->db->join("사용자","걷기대회_참가자.사용자_id = 사용자.사용자_id","right outer",FALSE);
		$this->db->where("사용자.사용자_id",$user_id);
		$this->db->where("사용자.암호",$password);
		return $this->db->get()->row();
	 }
	 
	 /*
	 * checkPhone
	 * 이소희
	 * 20170322
	 * 아이디 찾기 - 휴대폰 유무 확인
	 */
	 function checkPhone($name,$phone){
		$this->db->select("count(*) cnt");
		$this->db->from("사용자");
		$this->db->where("이름",$name);
		$this->db->where("핸드폰",$phone);
		return $this->db->get()->row()->cnt;
	 }
	 
	 
	 /*
	 * insertCode
	 * 이소희
	 * 20170317
	 * 인증번호 생성 + 인증번호 요청 시간 update 추가
	 */
	 function insertCode($name,$phone,$rand_num){
		$this->db->set("인증번호",$rand_num);
		$this->db->set("인증번호요청시간", date("Y-m-d-h:m:s",time()));
		$this->db->where("이름",$name);
		$this->db->where("핸드폰",$phone);
		return $this->db->update('focus_walk.사용자');
	 }
	 
	 /*
	 * checkCode
	 * 이소희
	 * 20170316
	 * 인증번호 일치 여부 확인 (아이디 찾기 일 때는 이름으로)
	 */
	 function checkCode($name,$phone,$code){
		$this->db->select("count(*) cnt");
		$this->db->from("사용자");
		$this->db->where("이름",$name);
		$this->db->where("핸드폰",$phone);
		$this->db->where("인증번호",$code);
		return $this->db->get()->row()->cnt;
	 }
	 
	 /*
	 * findId
	 * 이소희
	 * 20170316
	 * 아이디 찾기
	 */
	 function findId($name,$phone){
		//$this->db->select("사용자_id, DATE_FORMAT('가입일', '%Y-%m-%d') AS 가입일");
		$this->db->select("사용자_id, 가입일");
		$this->db->from("사용자");
		$this->db->where("이름",$name);
		$this->db->where("핸드폰",$phone);
		return $this->db->get()->row();
	 }
	 
	 /*
	 * checkCode2
	 * 이소희
	 * 20170317
	 * 인증번호 일치 여부 확인 
	 */
	 function checkCode2($user_id,$code){
		$this->db->select("count(*) cnt");
		$this->db->from("사용자");
		$this->db->where("사용자_id",$user_id);
		$this->db->where("인증번호",$code);
		return $this->db->get()->row()->cnt;
	 }
	 
	  /*
	 * checkIdPhone
	 * 이소희
	 * 20170322
	 * 비밀번호 찾기 - 아이디, 휴대폰 유무 확인
	 */
	 function checkIdPhone($id, $phone){
		$this->db->select("count(*) cnt");
		$this->db->from("사용자");
		$this->db->where("사용자_id",$id);
		$this->db->where("핸드폰",$phone);
		return $this->db->get()->row()->cnt;
	 }
	 
	  /*
	 * insertCode2
	 * 이소희
	 * 20170320
	 * 인증번호 생성 (아이디로 인증번호 생성)
	 */
	 function insertCode2($id, $phone, $rand_num){
		$this->db->set("인증번호",$rand_num);
		$this->db->set("인증번호요청시간", date("Y-m-d-h:m:s",time()));
		$this->db->where("사용자_id",$id);
		$this->db->where("핸드폰",$phone);
		return $this->db->update('focus_walk.사용자');
	 }
	 
	  /*
	 * newPwSet2
	 * 이소희
	 * 20170320
	 * 비밀번호 재설정 (아이디로)
	 */
	 function newPwSet2($user_id, $pw){
		$this->db->set("암호",$pw);	
		$this->db->where("사용자_id",$user_id);
		echo $this->db->update('focus_walk.사용자');
	}
	
	 /*
	 * adsChange
	 * 이소희
	 * 20170322
	 * 휴대폰 재설정 (아이디로)
	 */
	 function adsChange($user_id, $newAdd){
		$this->db->set("주소",$newAdd);	
		$this->db->where("사용자_id",$user_id);
		return $this->db->update('focus_walk.사용자');
	}
}

