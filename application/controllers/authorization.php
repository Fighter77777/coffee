<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Authorization extends CI_Controller {
	
	public function index()
	{
		$entered=$this->login->enter();
		
		$view_data['add_scripts']=array('jquery-ui/jquery.ui.tooltip.min');	//підключ. js унікальний для цієї сторінки 
		$view_data['add_scripts'][]='jquery-validation/jquery.validate.min';	
		$view_data['add_scripts'][]='jquery-validation/messages_ru';
		$view_data['add_scripts'][]='login';

		$this->load->view('navigation/header',$view_data);	
		
		
		if($entered){
			//Тут дані тільки для авторизованих користувачів	
			
			/*	приклад роботи з константами
			$path_ava=getConst('p_avatar');
			var_dump($path_ava);
			*/	
		}else{
				
			$this->load->view('login_page');				
		}
		$this->load->view('navigation/footer');	
	}


	public function logout()
	{
		$this->login->logout();
	}
	
	
	public function enter_form()
	{
		echo $this->login->enter();
	}
}
