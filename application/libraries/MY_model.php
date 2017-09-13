<?php
class MY_model {
	public function __construct(){
		$this->CI =& get_instance();
	}

	//분류 조회
	function get_codeinfo($option){
		//1:대분류  2:중분류  3:대분류
		$this->CI->db->select('code, code_name, pnt');
		$this->CI->db->order_by('pnt');

		if($option['num'] == '1'){
			$result = $this->CI->db->get_where(TBL_CODE, array('create_yn'=>'Y','length(code)'=>'3','code like '=>'N%'))->result();
		}elseif($option['num'] == '2'){
			$this->CI->db->where(array('create_yn'=>'Y','length(code)>='=>'4', 'code not like'=>'%\_%\_%'))->like('code',$option['svc_code']);
			$result = $this->CI->db->get(TBL_CODE)->result();
		}elseif($option['num'] == '3'){
			$this->CI->db->where(array('create_yn'=>'Y','length(code)>='=>'7', 'code like'=>'%\_%\_%', 'code not like'=>'%\_%\_%\_%'))->like('code',$option['svc_code']);
			$result = $this->CI->db->get(TBL_CODE)->result();
		}elseif($option['num'] == '4'){
			$this->CI->db->where(array('create_yn'=>'Y','length(code)>='=>'10', 'code like'=>'%\_%\_%\_%'))->like('code',$option['svc_code']);
			$result = $this->CI->db->get(TBL_CODE)->result();
		}
	
		return $result;
	}

	//게시판분류 조회
	function get_boardinfo($option){
		//1:게시판그룹  2:게시판종류  3:게시판말머리
		if($option['num'] == '1'){
			$this->CI->db->select('code, code_name');
			$this->CI->db->order_by('pnt');
			$result = $this->CI->db->get_where(TBL_CODEDETAIL, array('create_yn'=>'Y','code_group'=>'BOARD_GR'))->result();
		}elseif($option['num'] == '2'){
			$this->CI->db->select('board_id, board_name, board_code1');
			$this->CI->db->order_by('pnt');
			$result = $this->CI->db->get_where(TBL_BOARDINFO, array('level <> '=>'9', 'board_code'=>$option['board_code']))->result();
		}
		return $result;
	}
	
	//권한 적용된 부서 조회
	function get_departShowInfo($loginId){
		$query = $this->CI->db->query("
		select code, code_name, pnt
		from t_code_detail A
		,
		(
				select DEPART_TP
				from t_dept_group_auth DD
				where DD.DEPART_GROUP in (select dept_group_id from t_p_dept_auth CC where CC.gnum = (select EE.gdnum from gija_id_tbl EE where EE.gijaid = '$loginId'))
				and (READ_ALL = 'Y' or  `READ` = 'Y')
				group by DEPART_TP
		) B
		where B.DEPART_TP = A.code
		and A.code_group = 'DEPART_TP'
		and A.create_yn = 'Y'
		order by A.pnt");
		return $query->result();
	}
	
	//부서 조회
	function get_departinfo(){
		$this->CI->db->select('code, code_name, pnt');
		$this->CI->db->order_by('pnt');
		$result = $this->CI->db->get_where(TBL_CODEDETAIL, array('create_yn'=>'Y', 'code_group'=>'DEPART_TP'))->result();
	
		return $result;
	}

	//시리즈리스트
	function get_series($lang=''){
		$this->CI->db->select('code, code_name, create_yn');
		$this->CI->db->order_by('pnt');	
		$this->CI->db->order_by('code');	
		$result = $this->CI->db->get(TBL_SERIES)->result();
		return $result;
	}
	
	//대분류 시리즈
	function get_first_series(){
		$this->CI->db->select('code, code_name, create_yn');
		$this->CI->db->order_by('create_yn', 'desc');
		$this->CI->db->order_by('pnt');
		$result = $this->CI->db->get_where(TBL_SERIES, array('LENGTH(code)'=>'3'))->result();
		return $result;
	}
	//중분류 시리즈
	function get_second_series($code){
		$this->CI->db->select('code, code_name, create_yn');
		$this->CI->db->order_by('create_yn', 'desc');
		$this->CI->db->order_by('pnt');
		$result = $this->CI->db->get_where(TBL_SERIES, array('LENGTH(code)'=>'6','create_yn'=>'Y', 'code like'=>$code.'%'))->result();
		return $result;
	}

	//소분류 시리즈
	function get_third_series($code){
		$this->CI->db->select('code, code_name, create_yn');
		$this->CI->db->order_by('create_yn', 'desc');
		$this->CI->db->order_by('pnt');
		$result = $this->CI->db->get_where(TBL_SERIES, array('LENGTH(code)'=>'9','create_yn'=>'Y', 'code like'=>$code.'%'))->result();
		return $result;
	}

	//4depth 시리즈
	function get_fourth_series($code){
		$this->CI->db->select('code, code_name, create_yn');
		$this->CI->db->order_by('create_yn', 'desc');
		$this->CI->db->order_by('pnt');
		$result = $this->CI->db->get_where(TBL_SERIES, array('LENGTH(code) > '=>'9','create_yn'=>'Y', 'code like'=>$code.'%'))->result();
		return $result;
	}
	
	//종목리스트
	function get_stockitem($word=''){
		$this->CI->db->select('gdnum, code, code_name, pnt, create_yn');
		$this->CI->db->order_by('pnt');
		if(!empty($word)){
			$this->CI->db->like('code_name', $word);
		}
		$result = $this->CI->db->get_where(TBL_CODEDETAIL, array('code_group'=>'STOCK'))->result();
		return $result;
	}	


	//기타코드 조회
	function get_t_code_detail($group){
		$this->CI->db->select('code, code_name, pnt, code_name_etc');
		$this->CI->db->order_by('pnt, code_name');
		$result = $this->CI->db->get_where(TBL_CODEDETAIL, array('create_yn'=>'Y', 'code_group'=>$group))->result();
		
		return $result;
	}

	//관련기사쿼리 - 기사키 및 관련기사쿼리개수 0이면 전부다
	function get_relnews($idx,$limit){

		$master_key = '';
		$result = null;


		//관련기사의 마스터 키를 구함 - 자기자신이 마스터키인지 먼저 조사함
		$relresult = $this->CI->db->query("select newskey from ".TBL_RELNEWS." where newskey='$idx' and rel_newskey='$idx'");
		if ($relresult->num_rows() > 0)
		{
			$relrow = $relresult->row();
			$master_key = $relrow->newskey;
		} else {
			$relresult->free_result();
			$relresult = $this->CI->db->query("select newskey from ".TBL_RELNEWS." where rel_newskey='$idx'");
			if ($relresult->num_rows() > 0)
			{
				$relrow = $relresult->row();
				$master_key = $relrow->newskey;
			}
		}

		if ($master_key <> '') {
			$this->CI->db->select("rel_newskey,rel_newstitle,rel_seq,newskey");
			$this->CI->db->order_by("rel_seq");
			if($limit > 0) {$this->CI->db->limit($limit);}			
			$result = $this->CI->db->get_where(TBL_RELNEWS, array('newskey'=>$master_key,'rel_newskey !='=>$idx))->result();			//자기자신 제외
		}
		return $result;

		// 사용시 $relresult =  $this->my_model->get_relnews($idx,0);
		// 결과가 없을지도 모르니 아래 if문을 씌워 수행함
		// if (!is_null($relresult)) { 
		//  ...
		// }
	}
	
	//조건절로 쿼리한 한 레코드의 한 필드 값을 쿼리
	function func_dbval($tbl,$fld,$wh){
		$this->CI->db->select($fld);
		$result = $this->CI->db->get_where($tbl, $wh)->row();
		if (!empty($result)) {
			return $result->$fld;
		} else {
			return '';
		}
	}

	//조건절로 한 레코드 쿼리
	function func_dbval1($tbl,$fld,$wh){
		$this->CI->db->select($fld);
		$result = $this->CI->db->get_where($tbl, $wh)->row();
		return $result;
	}

	//조건절로 레코드셋 쿼리
	function func_dbvals1($tbl,$fld,$wh){
		$result = null;
		$this->CI->db->select($fld);
		if($wh) {$result = $this->CI->db->get_where($tbl, $wh)->result();}
		else {$result = $this->CI->db->get($tbl)->result();}
		return $result;
	}
	
	//조건절로 레코드셋 배열 리턴
	function func_dbvals2($tbl,$fld,$wh){
		$result = null;
		$this->CI->db->select($fld);
		$result = $this->CI->db->get_where($tbl, $wh)->result_array();
		return $result;
	}

	//쿼리로 한 레코드 리턴
	function func_dbval_qry($qry){
		$result = null;
		$result = $this->CI->db->query($qry)->row();
		return $result;
	}

	//쿼리로 레코드셋 리턴
	function func_dbvals_qry($qry){
		$result = null;
		$result = $this->CI->db->query($qry)->result();
		return $result;
	}

	//데이터 공통 입력
	function func_dbinput($tbl,$in){
		$result = null;
		$result = $this->CI->db->insert($tbl, $in);
		return $result;
	}
	
	//데이터 공통 수정
	function func_dbupdate($tbl,$up,$wh){
		$result = null;
		$result = $this->CI->db->update($tbl, $up, $wh);
		return $result;
	}
	
	//데이터 공통 삭제
	function func_dbdel($tbl,$wh){
		$result = null;
		$result = $this->CI->db->delete($tbl, $wh);
		return $result;
	}
	
	//발췌문알아내기
	function func_text($key, $newstype='') {
		$this->CI->db->select("news_text,news_body");
		$this->CI->db->from(TBL_TEXT);
		$this->CI->db->where("newskey",$key);
		$row = $this->CI->db->get()->row();
		
		$ntext = '';
		if($row){
			$ntext = $row->news_text;
			$ntext = strip_tags($ntext);
			if (!$ntext) {
				$ntext = $row->news_body;
				$ntext = str_ireplace("\r\n","",$ntext);
				$ntext = preg_replace("/<table(.*?)<\/table>/", "", $ntext);
				$ntext = preg_replace("/<TABLE(.*?)<\/TABLE>/", "", $ntext);
				$ntext = strip_tags($ntext);
			}
		}
		return trim($ntext);
	}

	function func_wcmslog($id,$flag) {
		$query = "insert into ".TBL_WCMS_LOG." (gijaid,conn_flag,conn_date,remote_ip) values ('$id','$flag',now(),'".$_SERVER['REMOTE_ADDR']."')";
		$result = mysql_query($query);
		//console.log($query);
	}
	
	//조회 조건 부서 및 본인 권한 쿼리
	function func_getDepartAuthrity($loginId){
		$sql = "  select DEPART_TP,IFNULL(MAX(`READ_ALL`),'N') READ_ALL, IFNULL(MAX(`READ`),'N') `READ` from t_dept_group_auth DD
		where DD.DEPART_GROUP in (select dept_group_id from t_p_dept_auth CC where CC.gnum = (select EE.gdnum from gija_id_tbl EE where EE.gijaid = '$loginId'))
		group by DD.DEPART_TP
		having READ_ALL = 'Y' or  `READ` = 'Y'
		";
		$query = $this->CI->db->query($sql);
		return $query->result();
	}
	
	function func_getAuthority($loginid,$mediaTbl,$orgKey,$key,$deptListStr){
		$news_gija = ($mediaTbl == TBL_NEWS)? TBL_NEWSGIJA: TBL_AMEDIAGIJA;
		$query = $this->CI->db->query(
			"select 
					IFNULL(MAX(`READ`),'N') `READ`
					,IFNULL(MAX(`READ_ALL`),'N') READ_ALL
					,IFNULL(MAX(`WRITE`),'N') `WRITE`
					,IFNULL(MAX(`WRITE_ALL`),'N') WRITE_ALL
					,IFNULL(MAX(`RELEASE`),'N') `RELEASE`
					,IFNULL(MAX(`RELEASE_SECOND`),'N') `RELEASE_SECOND`
					,IFNULL(MAX(`RELEASE_REQUEST`),'N') `RELEASE_REQUEST`
					,IFNULL(MAX(DELETE_WRITE),'N') DELETE_WRITE
					,IFNULL(MAX(DELETE_BEFORE_RELEASE),'N') DELETE_BEFORE_RELEASE
					,IFNULL(MAX(DELETE_AFTER_RELEASE),'N') DELETE_AFTER_RELEASE
				from t_dept_group_auth DD 
				where DD.DEPART_GROUP in (select dept_group_id from t_p_dept_auth CC where CC.gnum = (select EE.gdnum from gija_id_tbl EE where EE.gijaid = '$loginid'))
				and DEPART_TP in ($deptListStr)
			");
		return $query->row();		
	}
	
	function func_getNewAuthority($loginid){
		$query = $this->CI->db->query(
				"select
				IFNULL(MAX(`READ`),'N') `READ`
				,IFNULL(MAX(`READ_ALL`),'N') READ_ALL
				,IFNULL(MAX(`WRITE`),'N') `WRITE`
				,IFNULL(MAX(`WRITE_ALL`),'N') WRITE_ALL
				,IFNULL(MAX(`RELEASE`),'N') `RELEASE`
				,IFNULL(MAX(`RELEASE_SECOND`),'N') `RELEASE_SECOND`
				,IFNULL(MAX(`RELEASE_REQUEST`),'N') `RELEASE_REQUEST`
				,IFNULL(MAX(DELETE_WRITE),'N') DELETE_WRITE
				,IFNULL(MAX(DELETE_BEFORE_RELEASE),'N') DELETE_BEFORE_RELEASE
				,IFNULL(MAX(DELETE_AFTER_RELEASE),'N') DELETE_AFTER_RELEASE
				from t_dept_group_auth DD
				where DD.DEPART_GROUP in (select dept_group_id from t_p_dept_auth CC where CC.gnum = (select EE.gdnum from gija_id_tbl EE where EE.gijaid = '$loginid'))
				and DEPART_TP in (select buseid from gija_id_tbl AA where AA.gijaid =  '$loginid')
				");
		return $query->row();
	}
	
	
}
?>