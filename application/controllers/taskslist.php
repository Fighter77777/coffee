<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class TasksList extends CI_Controller {
	
	public function index($count_on_pg=NULL, $s_txt='search_text', $s_resp='responsible', $s_stat='status', $s_proj='project',$s_my_pr='only_my',$order='sorting',$order_direction='direction')
	//public function index($count_on_pg=NULL, $order='none', $order_direction='none')
	{
		$entered=$this->login->enter();
		$view_data['activ_menu']=__CLASS__;
		$view_data['add_scripts']=array('controls','filters_projectslist');	//js для цієї сторінки 		
		$this->load->view('navigation/header',$view_data);	
		if($entered){
			$this->load->model(array('users','projects','tasks','ctrl'));
			$this->load->library('pagination');
			
			$s_txt_db =($s_txt!='search_text')?rawurldecode($s_txt):NULL;//обнуляем значения "пустышки"
			$s_resp_db=($s_resp!='responsible')?$s_resp:NULL;
			$s_stat_db=($s_stat!='status')?$s_stat:NULL;
			$s_proj_db =($s_proj!='project')?$s_proj:NULL;
			$s_my_pr_db=($s_my_pr=='only_my')?1:0;
			$order_db =($order!='sorting')?$order:NULL;
			$order_direction_db =($order_direction!='direction')?$order_direction:NULL;			
			
			$body_dat['responsible']=$this->users->getNamesList();//дані для випадаючих списків
			$body_dat['status']=$this->projects->getStatusList();
			$body_dat['proj']=$this->tasks->getProjectsList();			
			
			if(!empty($_POST)){
				//var_dump($_POST);
				$terms=$_POST;		//фільтри для запита вибрані користувачем				
			}else{			
				$terms=array('search_txt'=>$s_txt_db, 'search_responsible'=>$s_resp_db, 'search_status'=>$s_stat_db, 'search_category'=>$s_proj_db, 'only_my'=>$s_my_pr_db);
			}			
			
			$body_dat['sel_resp_v']=$body_dat['sel_stat_v']=$body_dat['sel_proj_v']='<все>';
			
			//передача вибраних значень в URL для пагінації і сортування та відображення на формі вибраних значень			
			if(!empty($terms['search_txt']))  $body_dat['sel_txt']=$s_txt=htmlspecialchars($terms['search_txt']);
			if(!empty($terms['search_responsible'])) {
				$body_dat['sel_resp_id']=$s_resp=(int)$terms['search_responsible'];
				$body_dat['sel_resp_v']=$body_dat['responsible'][$terms['search_responsible']];				
			}
			if(!empty($terms['search_status'])) {
				$body_dat['sel_stat_id']=$s_stat=(int)$terms['search_status'];
				$body_dat['sel_stat_v']=$body_dat['status'][$terms['search_status']];		
			}
			if(!empty($terms['search_category'])) {
				$body_dat['sel_proj_id']=$s_proj=(int)$terms['search_category'];
				$body_dat['sel_proj_v']=$body_dat['proj'][$terms['search_category']];
			}			
			if($terms['only_my']==1) {
				$body_dat['only_my']=1;
				$s_my_pr='only_my';
			}else
				$s_my_pr='viewer';
			if(!empty($order_db)){ 
				$order=htmlspecialchars($order_db);
				$body_dat['sort_order']=$order;
			}
			if(!empty($order_direction_db)) {
				$order_direction=htmlspecialchars($order_direction_db);
				$body_dat['sort_direction']=$order_direction;
			}
			
			//пагінація			
			$config['total_rows'] = $this->tasks->count_all($terms);			
			//$config['total_rows'] = 52;			
			//echo $_POST['tsk_in_page'];
			if(empty($count_on_pg) && empty($_POST['tsk_in_page'])) $count_on_pg=$this->ctrl->constDB('my_tasks_num_pg');
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
			$config['uri_segment'] = 11;  // указываем где в URL номер страницы		
			$sort_url= base_url()."index.php/taskslist/index/{$config['per_page']}/{$s_txt}/{$s_resp}/{$s_stat}/{$s_proj}/{$s_my_pr}/";	//для початку ссилкі сортування
			$config['base_url'] = $sort_url."{$order}/{$order_direction}/";	//для ссилкі пагінаціїї
					
			$this->pagination->initialize($config);			
			$config['curr_pg'] = $this->uri->rsegment($config['uri_segment']);//зміщення
			$body_dat['tsk_in_page']=$config['per_page'];			
			
			$body_dat['table']=$this->tasks->dataForTabProj($config['curr_pg'],$config['per_page'],$terms,$order_db,$order_direction_db);	//масив - список проектів	
			
			$body_dat['sort_name']     =$this->sort_url('name',$sort_url,$order,$order_direction);		//посилання для сортування
			$body_dat['sort_deadline'] =$this->sort_url('deadline',$sort_url,$order,$order_direction);
			$body_dat['sort_open_tasks']=$this->sort_url('open_tasks',$sort_url,$order,$order_direction);
			$body_dat['sort_user_n']   =$this->sort_url('user_n',$sort_url,$order,$order_direction);
			$body_dat['sort_status']   =$this->sort_url('status',$sort_url,$order,$order_direction);
			$body_dat['sort_project'] =$this->sort_url('project',$sort_url,$order,$order_direction);
			$body_dat['numb_rec_url_left'] =base_url().'index.php/taskslist/index/';
			$body_dat['numb_rec_url_right'] ="/{$order}/{$order_direction}/";	//для формування посилання з кількістю записів на сторінку
						
			$this->load->view('tasks-list',$body_dat);//основна таблиця
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
	
}
