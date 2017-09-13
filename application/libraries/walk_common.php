<?php
	/*
	 * Walk_common
	 * 최재성
	 * 20170314
	 * 공통라이브러리
	 */
class Walk_common {
	public function __construct(){
		$this->CI =& get_instance();
	}
	
	/*
	 * func_getData
	 * 최재성
	 * 20170314
	 * t_code테이블의 데이터 return
	 */
	public function func_getCode($code){		
		$result = null;
		$this->CI->db->select("*");
		$this->CI->db->from("공통코드");
		$this->CI->db->where("코드분류_id" , $code);
		$this->CI->db->order_by("순서");
		$this->CI->db->order_by("코드명");				
		$result = $this->CI->db->get()->result();
		return $result;
	}
	
	public function readHtmlFile($fileName){
		$htmlFile = FILE_ROOT.$fileName;	
		if(!file_exists($htmlFile))
			return "";
		
		$fm = fopen( $htmlFile, "rb" );
		$fileSize = filesize ( $htmlFile );
		$cur=0; //remote_file_size 웹에서 불러온 파일은 filesize가 인식을 못함 따라서 위와 같은 함수를 hotspot_model에 정의
		$html = "";
		while(!feof($fm)&&$cur<$fileSize){
			 $html .= fread($fm,min(1024 *16,$fileSize-$cur));
			 $cur+=1024 * 16;
		}
		fclose($fm);		
		return $html;	
		
	}
	

}
?>