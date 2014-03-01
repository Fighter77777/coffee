<?php 
class Settings extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if (!isset($_SESSION))
			session_start();
	}
	function index(){
		$this->load->model('content');

		$view_data['add_scripts']=array('dropzone','dropzone_init');
		$this->load->view('navigation/header',$view_data);
		$this->load->view('settings');
		$this->load->view('navigation/footer');
	}

	function uploadFile(){
		$ds          = DIRECTORY_SEPARATOR; 
		$storeFolder = 'temp_uploads'; 
		if (!empty($_FILES)) {
		    $tempFile = $_FILES['file']['tmp_name']; 
		    $targetPath = FCPATH . $storeFolder . $ds;
		    $targetFile =  $targetPath. $_FILES['file']['name'];
		    move_uploaded_file($tempFile,$targetFile);
		}
	}
	
	function addFile(){
		$this->load->model('content');
		
		$ds          = DIRECTORY_SEPARATOR; 
		$storeFolder = 'temp_uploads';
		$tasks_files = 'tasks_uploads';
		$comments_files = 'comments_uploads';

		$type = $_POST['data']['type'];
		$file_name = $_POST['data']['name'];
		$parent_id = $_POST['data']['parent_id'];
		


		if (isset($_POST)){

			if (($type == 1 || $type == 2 ) && $file_name!=""){
			
				$tempFile = FCPATH.$storeFolder.$ds.$file_name;
				
				if ($type == 1)
					$targetFile = FCPATH.$tasks_files.$ds.$file_name;
				elseif ($type == 2)
					$targetFile = FCPATH.$comments_files.$ds.$file_name;
				var_dump( $tempFile." => ".$targetFile ); 
				
				if (file_exists($tempFile))
					copy($tempFile, $targetFile);

				
				$response = $this->content->addFile($file_name, $parent_id, $type);		
				if ($response)
					echo json_encode(array('flag' => true));
				else 
					echo json_encode(array('flag'=> false));	
			}
			else 
				echo json_encode(array('flag' => false));
		}
		else
			echo json_encode(array('flag' => false));

	}



	function deleteFile(){

	
	}
	
	
}