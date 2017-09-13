 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class MY_function {	
	public function __construct(){
		$this->CI =& get_instance();
	}
	
	//URL 세그먼트 전체 값 설정
	public function get_segment(){
		if ($this->CI->uri->segment(6)){
			$arrSegment = $this->CI->uri->uri_to_assoc(6);
			$segment_str = $this->CI->uri->assoc_to_uri($arrSegment);
		}else{
			$segment_str = '';
		}
		return $segment_str;
	}
	//URL 세그먼트 전체 값 설정

	
	//문자열자르기
	//예 : encode_substr($org_str,0,$length,'utf-8');
	function encode_substr($str,$start,$end,$encoding){
		mb_internal_encoding($encoding);
		$str_len = mb_strlen($str);
		if($end<$str_len){$str = trim(mb_substr($str,$start,$end))."..";}
		else{$str = mb_substr($str,$start,$end);}
		return $str;
	}

	//문자열자르기 .. 없음
	function encode_substr_nd($str,$start,$end,$encoding){
		mb_internal_encoding($encoding);
		$str_len = mb_strlen($str);
		if($end<$str_len){$str = trim(mb_substr($str,$start,$end));}
		else{$str = mb_substr($str,$start,$end);}
		return $str;
	}

	//자바스크립트용 타이틀
	function title_js($tit) {
		$tit = str_replace("'","`",$tit);
		$tit = str_replace("\"","``",$tit);
		$tit = str_replace("\n","",$tit);
		return $tit;
	}

	function make_dir($dir){
		if(!is_dir($dir)){
			@umask(0000);
			@mkdir($dir, 0777, true);
			@chmod($dir, 0777);
		}
	}
		
	//조회 조건 부서 및 본인 권한 쿼리
	function func_getDepartAuthrity($loginId){
		return $this->CI->my_model->func_getDepartAuthrity($loginId);
	}

	//권한 조회
	function getAuthority($loginid, $loginbuse, $key){
		$levelGroup = '1'; $authoritys = array(); $mediaTbl = ''; $orgKey = '';
		$isConfirm = FALSE;
		//버튼 권한
		$isSave = FALSE; 		
		$isModifyOrder = FALSE; //수정요청
		$isConfirmRequest = FALSE; //승인요청
		$isModifyComplete = FALSE; //수정완료
		
		$isReleaseRequest = FALSE; //출고요청 
		$isRelease = FALSE; //출고버튼
		$isDelete = FALSE; //삭제 
		//복원 및 삭제
		$isRestore = FALSE; $isPerfectDelete = FALSE;
		
		$isSelf = FALSE; $isHold = FALSE;
		//20160523 본인이거나 데스크 이상이면 수정가능하게 변경
		$isMediaModify = FALSE;
		
		
		//기사정보
		$confirm = '0'; $create_id = $loginid; $byline_gijaid = $loginid; $service_tf = '1'; $webnews_type = $loginbuse;

		if(substr($key, 8, 2) == "00"){
			$mediaTbl = TBL_NEWS;
			$orgKey = "newskey";
		}else{
			$mediaTbl = TBL_AMEDIA;
			$orgKey = "mediakey";
		}		

		$newsInfo = $this->CI->my_model->func_dbval1($mediaTbl, '*', array($orgKey=>$key));     //기사정보 확인
		if(!empty($newsInfo)){
			if($newsInfo->first_releasedate != '' && strlen($newsInfo->first_releasedate) == 19){
				$isConfirm = TRUE; //재출고 확인
			}
			$deptListStr = "";
			$deptLists = explode(';', $newsInfo->byline_buseid);
			for($i=0;$i<count($deptLists);$i++){
				if( strlen(trim($deptLists[$i])) > 0  ){
					if($deptListStr == "")
						$deptListStr = "'".trim($deptLists[$i])."'";
					else
						$deptListStr .= ",'".trim($deptLists[$i])."'";
				}
			}
			$userAuthority = $this->CI->my_model->func_getAuthority($loginid,$mediaTbl,$orgKey,$key,$deptListStr);
			$confirm = $newsInfo->confirm;
			$create_id = $newsInfo->create_id;
			$byline_gijaid = $newsInfo->byline_gijaid;
			$service_tf = $newsInfo->service_tf;
			$webnews_type = $newsInfo->webnews_type;
		
			//본인 여부 확인
			if($create_id == $loginid || stripos($byline_gijaid, $loginid.';') !== FALSE){
				$isSelf = TRUE;			
			}
			
			if($service_tf == '1'){//정상 기사				
				//출고 버튼
				if((substr($key, 8, 2) == "01" || substr($key, 8, 2) == "04") && stripos($loginbuse,  'L') === FALSE){
					//사진 사진첩 모두 출고 가능 단 지역기자는 없음
					$isRelease = TRUE;
				}		
				if($userAuthority->RELEASE == "Y")
					$isRelease = TRUE;
				else if($userAuthority->RELEASE_SECOND == "Y" && ($isConfirm && ($confirm == '1' || $confirm == '4' || $confirm == '5')))
					$isRelease = TRUE;
				
				//승인 요청
				//수정 완료
				//저장 버튼
				if($userAuthority->WRITE_ALL == "Y" || ($userAuthority->WRITE  == "Y"  && $isSelf)){
					$isMediaModify = TRUE;
					if($confirm == '0' || $confirm == '2'){     //작성중, 승인요청 상태
						$isConfirmRequest = TRUE;
					}else if($confirm == '4'){      //수정지시 상태
						$isModifyComplete = TRUE;
					}						
					if($confirm != '1' && $confirm != '6')
						$isSave = TRUE;
				}					
				
				//수정 요청
				if($userAuthority->RELEASE == "Y" || $userAuthority->RELEASE_SECOND == "Y"){ //출고권이 있는 사람
					$levelGroup = '3';
					//HIP 20151030 출고된 기사 수정이 안 보여서 출고 가능한 사람은 보이게 수정
					$isSave = TRUE;									
					if($confirm != '0')
						$isModifyOrder = TRUE;					
				}					
				//수정 요청
				//출고 요청
				if($userAuthority->RELEASE_REQUEST == "Y"){ //해당 부서에 출고 요청 권한이 있는경우 
					$levelGroup = '2';
					if($confirm != '1')  //출고요청
						$isReleaseRequest = TRUE;	
					if($confirm != '0'){ //수정 요청
						$isModifyOrder = TRUE;
					}
				}										
				//삭제  버튼: 
				if($userAuthority->DELETE_AFTER_RELEASE == "Y")
					$isDelete = TRUE;
				else if($userAuthority->DELETE_BEFORE_RELEASE == "Y" && $confirm != '1' && !$isConfirm) 
					$isDelete = TRUE;
				else if($userAuthority->DELETE_WRITE == "Y" && $confirm == '0' && $isSelf ) //작성 중인 기사는 삭제는 본인것만 가능
					$isDelete = TRUE;
				else if($userAuthority->RELEASE_REQUEST == "Y" && $confirm == '2') //출고 요청자는 승인요청 기사에 대해 삭제 버튼 나옴
					$isDelete = TRUE;
	
			}else{//삭제기사 복원, 완전삭제
				if($userAuthority->DELETE_AFTER_RELEASE == "Y" || $userAuthority->DELETE_BEFORE_RELEASE == "Y"){
					//삭제 권한이 있는 사람은 복원 가능 : 필요시 분기
					$isRestore = TRUE;
					$isPerfectDelete = TRUE;
				}				
			}
		}else{//신규기사 버튼 
			//저장 버튼
			$userAuthority = $this->CI->my_model->func_getNewAuthority($loginid);
			$isSave = true;
			if($userAuthority->RELEASE == "Y"){
				$isRelease = TRUE;
			}
			//승인 요청
			if($userAuthority->WRITE_ALL == "Y" || ($userAuthority->WRITE  == "Y")){
				$isConfirmRequest = TRUE;
			}
			//출고 요청
			if($userAuthority->RELEASE_REQUEST == "Y"){ //해당 부서에 출고 요청 권한이 있는경우
				$isReleaseRequest = TRUE;				
			}
		}
		
		$authoritys["levelGroup"] = $levelGroup;
		$authoritys["isSave"] = $isSave;
		$authoritys["isConfirmRequest"] = $isConfirmRequest;
		$authoritys["isModifyOrder"] = $isModifyOrder;
		$authoritys["isModifyComplete"] = $isModifyComplete;
		$authoritys["isReleaseRequest"] = $isReleaseRequest;
		$authoritys["isRelease"] = $isRelease;
		$authoritys["isDelete"] = $isDelete;
		$authoritys["isRestore"] = $isRestore;
		$authoritys["isPerfectDelete"] = $isPerfectDelete;
		$authoritys["isHold"] = $isHold;
		$authoritys["isMediaModify"] = $isMediaModify;		
		return $authoritys;
	}

	//로그인 여부 확인
	function login_check($loginId){
		$result = array("isLogin"=>TRUE, "msg"=>'', "url"=>'');
		if($loginId == '' || $loginId == FALSE || $loginId == '0'){
		//if(TRUE){
			$result["isLogin"] = FALSE;
			$result["msg"] = "로그인 시간이 만료되었습니다.<br>다시로그인해주시기 바랍니다.";
			$result["url"] = HTTPS_WCMSPATH."auth/login";
		}

		return $result;
	}
}
?>
