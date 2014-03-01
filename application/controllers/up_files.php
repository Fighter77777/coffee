<?php 
class Up_files extends CI_Controller{
	

	function uploadFile(){
		$this->load->helper('project');
		$this->load->model('content');

		$ds          		= 	DIRECTORY_SEPARATOR; 
		$storeFolder 		= 	getConst('p_upload');
		$response	 		= 	false;
		$icon_real_path 	=	FCPATH.getConst('p_icon');
		$icon_site_path		=	site_url().getConst('p_icon');
		$file_real_path		=	FCPATH.getConst('p_upload').$_POST['section'].'/';
		$file_site_path		=	site_url()."download/".$_POST['section']."/";

		if (!empty($_FILES)) {
		    $tempFile = $_FILES['file']['tmp_name']; 
		    $targetPath = FCPATH . $storeFolder.$_POST['section'].$ds;
		    $targetFile =  $targetPath. $_FILES['file']['name'];
		    if (move_uploaded_file($tempFile,$targetFile))
		    	$response = $this->content->addFile($_FILES['file']['name'], $_POST['parent'], $_POST['section']);
		    if ($response){

			    $ext 	=	pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
			    $path 	=	(file_exists($file_real_path.$_FILES['file']['name'])?$file_site_path.$_FILES['file']['name']:'');
			    $icon 	= 	(file_exists($icon_real_path.$ext.'.png')?$icon_site_path.$ext.'.png':$icon_site_path.'empty.png');

				echo json_encode(array('flag'=>$response, 'file_path'=>$path, 'file_icon'=>$icon));
		    	die();
			}
		}
		echo json_encode(array('flag'=>$response));
	}

	function deleteFile(){
		
		$this->signIn();

		$this->load->model('content');
		
		$flag = false;
		$user = $_SESSION['user_id'];
		
		if (isset($_POST))
			$flag = $this->content->deleteFile($_POST['id'], $_POST['section'], $user_id);	
		
		echo json_encode(array('flag'=>$flag));
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