<?php 
class Task extends CI_Controller{
	function index($id=0, $section=0){
		$this->signIn();
		
		$this->load->model(array('projects','content'));
		
		$script['add_scripts']	=	array('controls', 'quick_edit');
		
		$task_info				= 	$this->projects->getProjectInfo($id,1,false,'name, parent_id');
		
		if (!$task_info || empty($task_info->parent_id))
			exit('404');

		$data['task_name']		=	$task_info->name;
		$data['task_id']		= 	$id;
		$project_info			=	$this->projects->getProjectInfo($task_info->parent_id, 0, false, 'id, name');
		$data['project_name']	=	$project_info->name;
		$data['project_id']		=	$project_info->id;
		$data['section']		=	$section;
		
		if(!$section || $section == 'index'){
			$this->load->helper('project');

			$script['add_scripts'][] 	= 	'comments';
			$script['add_scripts'][] 	= 	'task_general';		
			$data2['task']				= 	$this->projects->getProjectInfo($id, 1, false);
			$data2['priority']			= 	getPriority($data2['task']['important']);
			$data3['comments']			=	$this->content->getCommentsList($id, 5);
			$data3['current_user_id'] 	= 	$_SESSION['user_id'];
			$data['top']				=	$this->load->view('task/general_top', $data2, true);
			$data['bottom']				=	$this->load->view('comments/comments',$data3, true);
			$data['section']			=	'index';
		}else
			if (method_exists($this, $section)){
				$script['add_scripts'][] 	= 'task';	
				$data['top'] 				= 	$this->$section($id);
			}
			else {
				echo '404';
				die();
			}
		
		$this->load->view('navigation/header', $script);
		$this->load->view('task/panel',$data);
		$this->load->view('navigation/footer');
	}

	function settings($id){
		$this->load->model(array('projects','users'));
		$this->load->helper('project');

		$data['priority']				= 	getPriority();
		$data['current'] 				=	$this->projects->getProjectInfo($id,1, false);
		$data['current']['viewers']		= 	$this->projects->getViewersList($id);
		$data['statuses']				= 	$this->projects->getStatusList();
		$data['users']					=	$this->users->getNamesList();
		$data['viewers']				=	$this->users->getNamesList('NL');
		
		$content = $this->load->view('task/settings', $data, true);

		return $content;
	}

	function showActions(){
		$this->signIn();

		$this->load->model('log');
		
		$data['status'] 	=  	'error';

		if (isset($_POST['parent_id'])){
			$this->log->sort = 1;
			
			$where 		=	array('task_id'=>$_POST['parent_id']);
			
			if (isset($_POST['conditions']) && $_POST['conditions'] == 1)
				$where['only_tasks'] = 1; 

			$category 	= 	$this->log->categoryTasks($_POST['parent_id']);
			$log		= 	$this->log->getEventsStr($category, $where, null, 5);
			if ($log){
				$data['status'] 	=  	'success';
				$data['log']		=	$log;
			}
		}
		$this->load->view('log',$data);
	}

	function saveChanges(){
		$this->signIn();

		$this->load->model(array('projects','log'));

		$flag = false;
		if (isset($_POST) && $_POST['name']!=''){
			$ex 		=	$this->projects->getProjectInfo($_POST['id'], 1, false, 'status_id, responsible, important');
			$response 	= 	$this->projects->saveChanges($_POST);
			if ($response) {
				$flag 		= 	true;
				$category 	=	$this->log->categoryTasks($_POST['id']);
				$this->log->write($_SESSION['user_id'], 2, array('category'=>$category, 'task_id'=>$_POST['id'], 'status'=>$_POST['status'], 'ex_status' =>$ex->status_id, 'responsible'=>$_POST['responsible'], 'ex_responsible'=>$ex->responsible, 'important'=>$_POST['priority'], 'ex_important'=>$ex->important));
			}
		}
		echo json_encode(array(flag => $flag));
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