<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserSettings extends CI_Controller {
	
	public function index()
	{	//	var_dump($_SESSION);				
		$entered=$this->login->enter();		
		$view_data['add_scripts']=array('jquery-validation/jquery.validate.min','jquery-validation/messages_ru','edit_user');	//js для цієї сторінки 		
		$this->load->view('navigation/header',$view_data);	
		if($entered){
			$this->load->model(array('users'));			
					
				
			$body_dat['profile']=$this->users->getUser($_SESSION['user_id'],'FN');
			$body_dat['section']=__FUNCTION__;
			$view['content']=$this->load->view('user-settings/form',$body_dat,TRUE);//основна форма із настройками	
			//var_dump($body_dat['profile']);			
			$this->load->view('user-settings/panel',$view);//сторінка настройок			
		}else{				
			$this->load->view('main_page/login_page');				
		}
		$this->load->view('navigation/footer');		
	}
		
			
	public function updateProfile()
	{
		$entered=$this->login->enter();			
		if(!empty($_POST) && $entered){ 
			$this->load->model('registration');
			if($this->registration->updateUser($_SESSION['user_id'],$_POST))
				echo json_encode(array('ok'=>1,'user'=>$_SESSION['user_id']));
			else
				echo json_encode($this->registration->err);	
		}				
	}

	
	public function notifications()
	{
		$entered=$this->login->enter();		
		$view_data['add_scripts']=array('notice_settings','controls');	//js для цієї сторінки 		
		$this->load->view('navigation/header',$view_data);	
		if($entered){
			$this->load->model(array('users','notifications'));			
					
			$body_dat['all_notif']=$this->notifications->listAll();	
			$body_dat['user_notif']=$this->notifications->notice_one_user($_SESSION['user_id']);	
			//var_dump($body_dat['user_notif']);
			$body_dat['profile']=$this->users->getUser($_SESSION['user_id'],'FN');
			$body_dat['section']=__FUNCTION__;
			$view['content']=$this->load->view('user-settings/notifications',$body_dat,TRUE);//основна форма із настройками	
			//var_dump($body_dat['profile']);			
			$this->load->view('user-settings/panel',$view);//сторінка настройок			
		}else{				
			$this->load->view('main_page/login_page');				
		}
		$this->load->view('navigation/footer');		 
		
	}
	
	
	public function save_notifications()
	{
		$entered=$this->login->enter();			
		if($entered){
			/*			
			echo "<pre>";				
				print_r($_POST);
			echo "</pre>";
			
			 */				
		}	
		redirect(base_url().'profile/'.$_SESSION['user_id']);
	}
	
	
	public function loadAvatarsEditor(){
		$entered=$this->login->enter();			
		if($entered){
			$this->load->view('user-settings/ed_avatar');					
		}			
	}
				
	
}
