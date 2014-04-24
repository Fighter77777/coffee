<?php
class Products extends CI_Controller{


	function index($pr_group=NULL){
		$this->load->model('product');
		$view_content['pr']=$this->product->categoryProducts($pr_group);
		
		$view_content['attr']=$this->product->attributesProducts();
		
		$view_header['header_scripts']=array();	//підключ. js унікальний для цієї сторінки у шапці
		echo '<font color="green"><pre>';
			print_r($view_content['attr']);
		echo '</pre></font>';
		$this->load->view('navigation/header', $view_header);		
		$this->load->view('products/catalogue',$view_content);
		
		$view_footer['footer_scripts']=array();//підключ. js унікальний для цієї сторінки у підвалі
		$this->load->view('navigation/footer', $view_footer);
	}
}