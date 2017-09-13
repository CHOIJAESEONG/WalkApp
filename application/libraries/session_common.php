<?php 

class Session_common {
	public function __construct(){
		$this->CI =& get_instance();
	}
	
	/*
	 * setSession
	 * 이소희
	 * 20170330
	 * DB 결과를 세션에 저장
	 */
	function setSession($sesName, $user){
		$user_array = get_object_vars($user);
		$user_array['logged_in'] = True;
		$this->CI-> session -> set_userdata($sesName,$user_array);
	}
	
	/*
	 * changeSession
	 * 이소희
	 * 20170330
	 * 세션 일부분 수정
	 */
	function changeSession($sesName, $key, $value){
		$session_data = $this->CI->session->userdata($sesName);
		$session_data[$key] = $value;
		$this->CI->session->set_userdata($sesName,$session_data);
	}
	
	/*
	 * getSession
	 * 이소희
	 * 20170320
	 * 세션에 있는 정보 가져오기
	 */
	function getSession($key){
		$session_data = $this->CI->session->userdata($key);
		return $session_data;
	}
	 
   
	/*
	 * checkSession
	 * 이소희
	 * 20170322
	 * 세션에 있는 정보 가져오기
	 */
	function checkSession($key){
		if(!$this-> getSession($key)){
			header("Location: /user/loginIndex"); 
		}else{
			return true;
		}
	}
	
	/*
	 * logout
	 * 이소희
	 * 20170320
	 * 세션 종료
	 */
	function logout(){
		if (!isset($_SESSION)){
			session_start();
		}
		$this->CI->session->unset_userdata('user');
		session_destroy();
	}
}
?>