<?php
class Comments extends CI_Controller{


	function addComment(){

		$this->signIn();

		$this->load->model(array("content", "log"));
		$this->load->helper("project");

		$current_date 	= 	date('H:m');
		
		if (isset($_POST['data']['task_id'])){
			if ($_POST['data']['task_id']>0){
				$data = $this->security->xss_clean($_POST['data']);

				$user_id 	= 	$_SESSION['user_id'];
				$comment 	= 	$data['comment'];
				$task_id 	= 	$data['task_id'];
				$user_pic 	= 	empty($_SESSION['user_avatar']) ? site_url().'i/userpic_thumb.png' : site_url().getConst('p_avatar_middle').$_SESSION['user_avatar'];
				$user_name 	= 	$_SESSION['user_name'];

				$response = $this->content->insertComment($user_id, $task_id, $comment);
				if ($response){
					$category = $this->log->categoryProjects($task_id);
					if (!$category)
						$category = $this->log->categoryTasks($task_id);

					$this->log->writeComment($user_id, 1,$task_id, $category, $response);
					echo json_encode(array('flag'=>true, 'user_name' => $user_name, "user_pic" => $user_pic, 'comment_id'=> $response, 'comment'=>$comment, 'date'=>$current_date));	
					die();				
				}
			} 
		} 	
		echo json_encode(array('flag'=>false));
	}

	function deleteComment(){
		
		$this->signIn();

		$this->load->model(array("content","log"));
		$flag		=	false;

		if (isset($_POST['id']) && $_POST['id']>0){
			$response = $this->content->deleteComment($_POST['id'], $_SESSION['user_id']);
			if ($response){
				$category = $this->log->categoryProjects($_POST['parent']);
				if (!$category)
					$category = $this->log->categoryTasks($_POST['parent']);

				$this->log->writeComment($_SESSION['user_id'],3, $_POST['parent'], $category, $_POST['id']);
				$flag 	=	true;
			}
		}
			echo json_encode(array(flag=>$flag));
	}

	function show(){
		
		$this->signIn();

		$this->load->model("content");
		$data['current_user_id'] = $_SESSION['user_id'];
		$limit = 0;

		if ($_POST['limit'])
			$limit = $_POST['limit'];

		if (isset($_POST['parent_id']))
			if ($_POST['parent_id']>0){
				$comments = $this->content->getCommentsList($_POST['parent_id'], $limit);
				if (count($comments)){
					$data['comments'] = $comments;
					$this->load->view('comments/show_comments', $data);
				}
				else{
					$data['status'] = 'error';
					$this->load->view('comments/show_comments', $data);
				} 
					
			} else{
					$data['status'] = 'error';
					$this->load->view('comments/show_comments', $data);
			}
	}
	
	function signIn(){

		$entered 	=	$this->login->enter();
		
		if (!$entered){
			echo $this->load->view('navigation/header', 0, true);
			echo $this->load->view('main_page/login_page', 0, true);
			die();
		}
	}	
}