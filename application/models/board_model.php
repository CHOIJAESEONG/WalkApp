<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Board_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}	

	//공지사항 가져오기
	function getNotices($count=2){
		$this->db->select("a.*,b.코드명");
		 $this->db->from("게시판 as a");
		 $this->db->join('공통코드 as b', 'a.게시판종류 =b.공통코드_id','',FALSE);
		 $this->db->where("a.게시판종류",29);
		 $this->db->order_by("a.등록일 desc");
		 //$this->db->limit(2,0); //거꾸로
		 return $this->db->get()->result();
		  
	}
	
	/*
	 * getCommentTags
	 * 이소희
	 * 20170331
	 * 댓글 태그 정보 가져오기
	 */
	function getCommentTags(){
		$this->db->select("*");
		$this->db->from("공통코드");
		$this->db->where("코드분류_id","COMMENT_TAG");
		return $this->db->get()->result();
	}
	
	/*
	 * commentCnt
	 * 이소희
	 * 20170403
	 * 댓글 전체 개수 가져오기
	 */
	function commentCnt(){
		$this->db->select("count(*) cnt");
		$this->db->from("댓글");
		return $this->db->get()->row()->cnt;
	}
	
	/*
	 * getTalkComments
	 * 이소희
	 * 20170331
	 * 모든 댓글 가져오기
	 */
	function getTalkComments(){	
		$this->db->select("댓글_id, 작성자, date_format(작성일, '%y-%m-%d') as 작성날짜, 댓글, 사진",false);
		$this->db->from("댓글");
		$this->db->join('사용자', '댓글.작성자 = 사용자.사용자_id','',FALSE); 
		$this->db->order_by("댓글_id","desc");
		$this->db->limit(10);
		return $this->db->get()->result();
	}
	
	/*
	 * commentByTag
	 * 이소희
	 * 20170331
	 * 태그에 따라 댓글 가져오기
	 */
	function commentByTag($ctag_id){
		$this->db->select("작성자, 댓글.태그, date_format(작성일, '%y-%m-%d') as 작성날짜, 공통코드.코드명, 댓글, 사진",false);
		$this->db->from("댓글");
		$this->db->join('공통코드', '공통코드.공통코드_id=댓글.태그','',FALSE);
		$this->db->join('사용자', '댓글.작성자 = 사용자.사용자_id','',FALSE); 
		$this->db->where("태그", $ctag_id);
		$this->db->order_by("댓글_id","desc");
		$this->db->limit(10);
		return $this->db->get()->result();
	}
	
	/*
	 * commentTagCnt
	 * 이소희
	 * 20170403
	 * 태그 기준 댓글 전체 개수 가져오기
	 */
	function commentTagCnt($ctag_id){
		$this->db->select("count(*) cnt");
		$this->db->from("댓글");
		$this->db->where("태그",$ctag_id);
		return $this->db->get()->row()->cnt;
	}
	
	/*
	 * addComment
	 * 이소희
	 * 20170404
	 * 덧글 더보기 추가 (내림차순으로 정렬)
	 */
	function addComment($firstIndex,$totalCnt){	
		/*$sql = "select 작성자, date_format(작성일, '%y-%m-%d') as 작성날짜, 댓글, 사진 from 댓글 join 사용자 on 댓글.작성자 = 사용자.사용자_id"
		 ." order by 댓글_id desc limit ".$firstIndex.", 10";*/
		$sql = "select 작성자, date_format(작성일, '%y-%m-%d') as 작성날짜, 댓글, 사진 from 댓글 join 사용자 on 댓글.작성자 = 사용자.사용자_id where 댓글.댓글_id<=".$totalCnt."-".$firstIndex." order by 댓글.댓글_id desc limit 10";
		return $this->db->query( $sql )->result();
	}
	
	/*
	 * addCommentByTag
	 * 이소희
	 * 20170404
	 * 덧글 더보기 추가 (내림차순으로 정렬) - addComment는 댓글_id기준으로 비교했지만 Tag를 통해 select한 거기 때문에 비교하기가 힘들다. 
	 */
	function addCommentByTag($ctag_id, $firstIndex2){	
		$sql = "select 작성자, date_format(작성일, '%y-%m-%d') as 작성날짜, 댓글, 사진 from 댓글 join 공통코드 on 공통코드.공통코드_id=댓글.태그 join 사용자 on 댓글.작성자 = 사용자.사용자_id"
		 ." where 태그=".$ctag_id." order by 댓글_id desc limit ".$firstIndex2.", 10";
		return $this->db->query( $sql )->result();
	}
	
	/*
	 * insertComment
	 * 이소희
	 * 20170331
	 * 모든 댓글 가져오기
	 */
	function insertComment($user_id, $comment){
		$this->db->set("작성자", $user_id);
		$this->db->set("댓글", $comment);
		$this->db->set("작성일","NOW()", FALSE);
		return $this->db->insert('댓글');
	}
	
	/*
	 * 이소희
	 * 20170329
	 * MainActivity_2 하위 컴포넌트
	 * 대회 댓글 컴포넌트 (댓글 3개)
	 */
	function getThreeComments(){
		$this->db->select("*");
		$this->db->from("focus_walk.댓글");
		$this->db->join('사용자', '댓글.작성자 = 사용자.사용자_id','',FALSE);
		$this->db->order_by("작성일","desc");
		$this->db->limit(3);
		return $this->db->get()->result();
	}
	
	/*
	 * faqType
	 * 이소희
	 * 20170328
	 * FAQ 질문 분류(코드명) 불러오기
	 */
	function faqType(){
		$this->db->select("*");
		$this->db->from("공통코드");
		$this->db->where('코드분류_id','FAQ_TYPE');
		$this->db->order_by('공통코드_id');
		return $this->db->get()->result();
	}
	
	/*
	 * questionIndex_sub
	 * 이소희
	 * 20170328
	 * FAQ질문을 머릿글 종류에 따라 불러오기
	 */
	function questionIndex_sub($index){
		$this->db->select("*");
		$this->db->from("게시판");
		$this->db->join('공통코드','게시판.머릿글종류=공통코드.공통코드_id','',FALSE);
		$this->db->where("게시판종류",$index);
		$this->db->order_by('게시판_id');
		return $this->db->get()->result();
	}
	
	
	/*
	 * qnaType
	 * 이소희
	 * 20170328
	 * QnA SELECT 박스(코드명) 불러오기
	 */
	function qnaType(){
		$this->db->select("*");
		$this->db->from("공통코드");
		$this->db->where('코드분류_id','QNA_TYPE');
		$this->db->order_by('공통코드_id');
		return $this->db->get()->result();
	}
	
	/*
	 * insertQue
	 * 이소희
	 * 20170328
	 * 문의하기
	 */
	function insertQue($info){
		$data = array(
				'게시판종류' => 42 ,
				'머릿글종류' => $info['queKind'],
				'글제목' => $info['contents'],
				'글내용' => null,
				'등록일' => date("Y-m-d"),
				'수정일' => null,
				'작성자_id' => $info['name'],
				'삭제여부' => 0
				);
		return $this->db->insert('게시판',$data);
	}
}

?>
