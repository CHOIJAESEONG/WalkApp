<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Board extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->library('session_common');
		$this->session_common->checkSession("user");
		$this->load->model('board_model');
	}
	/*
	 * index
	 * 이민수
	 * 20170316
	 * 게시판
	 */
	function index(){		
		
	}
	
	//공지사항,이벤트 게시판
	function myBoard(){
		//로그인한 정보
		$myLogin = array('USER_ID'  => "gildong", 'USER_NAME'  => "홍길동","USER_PIC"=>경로_사용자."hong.jpg");				
		$data["notices"] = $this->board_model->getNotices();
		$this->load->view("board/myBoard_notice_view", $data);
	}
		
	/*
	 * talkBoard
	 * 이소희
	 * 20170331
	 * 댓글 게시판
	 */
	//대회톡 게시판(댓글)
	function talkBoard(){
		//댓글 태그 정보 가져오기
		$data["commentTags"] = $this->board_model->getCommentTags(); // 공통코드에 있는 태그 정보들 가져오기
		$data["totalCnt"] =$this->board_model->commentCnt(); //댓글 전체 개수 가져오기 (더보기 - 갯수 체크)
		$data["comments"] = $this->board_model->getTalkComments(); // 댓글 가져오기
		$this->load->view ( "activity/header_p" ); 
		$this->load->view("board/talkBoard_view", $data);
		$this->load->view ( "activity/footer" ); 
	}
	
	/*
	 * commentByTag
	 * 이소희
	 * 20170331
	 * 태그 기준으로 댓글 가져오기
	 */
	function commentByTag(){
		$ctag_id=trim($this->input->post('ctag_id'));
		$data['commentByTags'] =$this->board_model->commentByTag($ctag_id);
		$data["totalTagCnt"] =$this->board_model->commentTagCnt($ctag_id); //태그 기준 댓글 전체 개수 가져오기 (더보기 - 갯수 체크)
		echo json_encode($data);
	}
	
	/*
	 * addComment
	 * 이소희
	 * 20170404
	 * 덧글 더보기 추가
	 */
	function addComment(){
		$firstIndex=trim($this->input->post('firstIndex'));
		$totalCnt=trim($this->input->post('totalCnt'));
		$data['addcomments'] =$this->board_model->addComment($firstIndex,$totalCnt);
		echo json_encode($data);
	}
	
	/*
	 * addCommentByTag
	 * 이소희
	 * 20170404
	 * 태그 기준 더보기 추가
	 */
	function addCommentByTag(){
		$ctag_id=trim($this->input->post('ctag_id'));
		$firstIndex2=trim($this->input->post('firstIndex2'));
		$data['addcommentByTags'] =$this->board_model->addCommentByTag($ctag_id,$firstIndex2);
		echo json_encode($data);
	}
	
	/*
	 * insertComment
	 * 이소희
	 * 20170331
	 * 댓글 추가
	 */
	function insertComment(){
		$user_id = $this->session_common->getSession("user")["user_id"];
		$comment = $this->input->post('comment');
		$result = $this->board_model->insertComment($user_id, $comment);
		echo $result;	
	}
	
	/*
	 * 이소희
	 * 20170329
	 * MainActivity_2 하위 컴포넌트
	 * 대회 댓글 컴포넌트 (댓글 3개)
	 */
	function comment_comp(){
		$data['comments'] = $this->board_model->getThreeComments();
		$this->load->view ("board/comment_comp",$data);
	}

	/*
	 * questionIndex
	 * 이소희
	 * 20170328
	 * 질문게시판 초기화면
	 */
	function questionIndex(){
		$this->load->view("activity/header_p");
		$this->load->view("board/question_index");
		$this->load->view("activity/footer");
	}
	
	/*
	 * questionIndex_sub
	 * 이소희
	 * 20170328
	 * 질문게시판 분기 (FAQ/문의): index 41 : FAQ / 42: 문의
	 */
	function questionIndex_sub($index){
		if($index==41){
			//FAQ 질문 분류(코드명) 불러오기
			$data['listTitles'] = $this->board_model->faqType($index);
			$data['faqs']=$this->board_model->questionIndex_sub($index);
			
			$this->load->view("activity/header_p");
			$this->load->view("board/faq_view",$data);
			$this->load->view("activity/footer");
		}else{
			$data['qnaTitles'] = $this->board_model->qnaType();
			$this->load->view("activity/header_p");
			$this->load->view("board/question_view",$data);
			$this->load->view("activity/footer");
		}
	}
	
	/*
	 * insertQue
	 * 이소희
	 * 20170328
	 * 문의하기
	 */
	function insertQue(){
		$name=trim($this->input->post('name'));
		$email=trim($this->input->post('email'));
		$contents=trim($this->input->post('contents'));
		$queKind =trim($this->input->post('queKind'));
		
		$info = array(
			'name' => $name,
			'email' => $email,
			'contents' => $contents,
			'queKind' => $queKind
		);	
		$result = $this->board_model->insertQue($info);
		//저장후 FAQ로 이동
		header('Location : /board/questionIndex');
	}
}
?>