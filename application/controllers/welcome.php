<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/*Since this controller is set as the default controller in config/routes.php */
	public function index()
	{
		
		$entered=$this->login->enter();
		
		$view_data['add_scripts']=array();	//підключ. js унікальний для цієї сторінки 
		
		$this->load->view('navigation/header',$view_data);	
		if($entered){
			//echo "секретна сторінка!!!";
			$this->load->model('product');
			//$this->product->arrProducts();
			$products=$this->product->categoryProducts(5);
			echo "<pre>";		
				print_r($products);
			echo "</pre>";	
			echo "<hr>";
			$attr=$this->product->attributesProducts(5);
			echo "<pre>";		
				print_r($attr);
			echo "</pre>";		
		}else{						
			//$this->load->view('main_page/login_page');				
		}
		$this->load->view('main_page/welcome_page');
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

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */