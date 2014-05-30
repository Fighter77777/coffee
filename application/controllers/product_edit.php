<?php
class Product_edit extends CI_Controller{


	function index($pr_id=NULL){
		
		if(!empty($_POST)){
			$this->load->model('Product_save');
			$this->Product_save->save($_POST,$pr_id);
		}
		
		$this->load->model(array('product','attributes'));
		/*
		echo '<font color="silver"><pre>';
			print_r($_POST);
		echo '</pre></font>';
		*/
		$view_content=$this->product->getProduct($pr_id);
		$view_content['all_attr']=$this->attributes->getAllAtributes();
		//$view_content['attr']=$this->product->attributesProducts();
		
		$view_header['header_scripts']=array('tinymce/tinymce.min');	//підключ. js унікальний для цієї сторінки у шапці
		/*echo '<font color="green"><pre>';
			print_r($view_content);
		echo '</pre></font>';*/
		$this->load->view('navigation/header', $view_header);		
		$this->load->view('product/edit',$view_content);
		
		$view_footer['footer_scripts']=array('product_edit');//підключ. js унікальний для цієї сторінки у підвалі
		$this->load->view('navigation/footer', $view_footer);
	}
	
	function valuesAttrAjax($attr_id=NULL)
	{
		$this->load->model('attributes');
		$a=$this->attributes->getValAttrListByID($attr_id);
		echo json_encode($a);
	}	
}