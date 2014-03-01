<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UsersList extends CI_Controller {
	
	public function index($count_on_pg=NULL, $s_txt='search_text', $order='name', $order_direction='asc')
	{						
		$entered=$this->login->enter();	
		$view_data['activ_menu']=__CLASS__;	
		$view_data['add_scripts']=array('controls','filters_userslist','add_user');	//js для цієї сторінки 		
		$this->load->view('navigation/header',$view_data);	
		if($entered){
			$this->load->model(array('ctrl','usersls','projects'));
			$this->load->library('pagination');
			
			$s_txt_db =($s_txt!='search_text')?rawurldecode($s_txt):NULL;//обнуляем значения "пустышку" пошуку працівників (викор. в URL)			
			
			if(!empty($_POST))
				$s_txt_db=$_POST['search_txt'];		//дані для пошуку
								
			//передача вибраних значень в URL для пагінації і сортування та відображення на формі вибраних значень			
			if(!empty($s_txt_db))  
				$body_dat['sel_txt']=$s_txt=htmlspecialchars($s_txt_db);			
			if(!empty($order))
				$body_dat['sort_order']=$order=htmlspecialchars($order);	
			if(!empty($order_direction)) 
				$body_dat['sort_direction']=$order_direction=htmlspecialchars($order_direction);
			
			//пагінація			
			$config['total_rows'] = $this->usersls->count_all($s_txt_db);							
			if(empty($count_on_pg) && empty($_POST['tsk_in_page'])) $count_on_pg=$this->ctrl->constDB('users_num_pg');
			$config['per_page'] = (!empty($_POST['tsk_in_page']))?$_POST['tsk_in_page']:(int)$count_on_pg;//к-ть записів на сторінку
			$config['num_links'] = 4;	//Количество ссылок с цифрами, которое должно отображаться до и после номера выбранной страницы
			$start_but='<span class="button">';	
			$end_but  ='</span>';		
			$config['full_tag_open'] = '<div class="paging">';
			$config['full_tag_close'] = '</div>';
			$config['num_tag_open'] = $start_but;//Настройка ссылки с номером страницы
			$config['num_tag_close'] = $end_but;
			$config['cur_tag_open'] = '<span class="button active">';//Настройка ссылки "Текущая страница"
			$config['cur_tag_close'] = $end_but;
			$config['first_link'] = '<<';	//Настройка ссылки "Начало"
			$config['first_tag_open'] = $start_but;
			$config['first_tag_close'] = $end_but;			
			$config['last_link'] = '>>';	//Настройка ссылки "Конец"
			$config['last_tag_open'] = $start_but;
			$config['last_tag_close'] = $end_but;
			$config['next_link'] = '>';	//Настройка ссылки "Следующий"
			$config['next_tag_open'] = $start_but;
			$config['next_tag_close'] = $end_but;
			$config['prev_link'] = '<';	//Настройка ссылки "Предыдущий"
			$config['prev_tag_open'] = $start_but;
			$config['prev_tag_close'] = $end_but;	
			$config['uri_segment'] = 7;  // указываем где в URL номер страницы	
			$sort_url= base_url()."index.php/".mb_strtolower(__CLASS__)."/index/{$config['per_page']}/{$s_txt}/";	//для початку ссилкі сортування
			$config['base_url'] = $sort_url."{$order}/{$order_direction}/";	//для ссилкі пагінаціїї
					
			$this->pagination->initialize($config);			
			$config['curr_pg'] = $this->uri->rsegment($config['uri_segment']);//зміщення
			$body_dat['tsk_in_page']=$config['per_page'];		  //к-ть записів на стор.
			$body_dat['table']=$this->usersls->dataForTabUsers($config['curr_pg'],$config['per_page'],$s_txt_db,$order,$order_direction);	//масив - список користувачів	
			
			$body_dat['sort_name']     =$this->sort_url('name',$sort_url,$order,$order_direction);		//посилання для сортування
			$body_dat['sort_date_reg'] =$this->sort_url('date_reg',$sort_url,$order,$order_direction);
			$body_dat['sort_open_task']=$this->sort_url('open_task',$sort_url,$order,$order_direction);
			$body_dat['sort_open_projects']   =$this->sort_url('open_projects',$sort_url,$order,$order_direction);
			$body_dat['sort_positions']   =$this->sort_url('positions',$sort_url,$order,$order_direction);			
			$body_dat['numb_rec_url_left'] =base_url().'index.php/'.mb_strtolower(__CLASS__).'/index/';
			$body_dat['numb_rec_url_right'] ="/{$order}/{$order_direction}/";	//для формування посилання з кількістю записів на сторінку
						
			$this->load->view('users-list',$body_dat);//основна таблиця			
		}else{				
			$this->load->view('main_page/login_page');				
		}
		$this->load->view('navigation/footer');		
	}


	private function sort_url($column,$sort_url,$order,$order_direction)
	{ 
		$direction=($column==$order && ($order_direction!='desc'))?'desc':'asc';
		return "{$sort_url}{$column}/{$direction}";
	}
	
	public function add()
	{ 
		$this->load->view('user_add');
	}
	
	public function create()
	{
		$entered=$this->login->enter();
		if($entered){
			if(!empty($_POST)){ 
				$this->load->model(array('registration','Log'));
				if($uid=$this->registration->createUser($_POST))
					echo json_encode(array('ok'=>$uid));
				else
					echo json_encode($this->registration->err);	
			}
		}
		
	}

	public function uploadAvatar()
	{
		$entered=$this->login->enter();
		if($entered){	
			if(isset($_FILES["file"])){
				 $this->load->model(array('registration'));			
			//var_dump($_FILES["file"]);
				$load_img=$this->registration->img_loader($_FILES["file"]);		
				if($load_img)
					echo json_encode(array('img'=>$load_img));
				else
					echo json_encode($this->registration->err);	
			}
		}
		
	}
}
