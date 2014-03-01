<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 Хелпер для даного проекта
 */
if ( ! function_exists('getConst')){
	function getConst($name)	//ф-я, яка повертає одну з констант даного проекта 
	{			
		$c=array();				
		
		$c['p_icon']	= 'i/icons/';						//path to files icons
		$c['p_upload'] 	= 'upload/';						//файли завантажені на сайт
		$c['p_avatar'] 	= $c['p_upload'].'users/';			//шлях до аватарок		
		$c['p_avatar_temp']=$_SERVER['DOCUMENT_ROOT'].'/'.$c['p_avatar'].'tmp/';//шлях куди завантажуватимуться аватарки для подальшої обробки
		$c['p_avatar_original']=$c['p_avatar'].'original/'; //шлях до аватарок оригінального розміру
		$c['p_avatar_middle']=  $c['p_avatar'].'middle/';   //шлях до аватарок середнього розміру
		$c['p_avatar_small']=   $c['p_avatar'].'small/';    //шлях до аватарок малого розміру
		
		if(isset($c[$name]))
			return $c[$name];
		else
			return FALSE;
	}
}

if (! function_exists('getPriority')){
	function getPriority($key=0){
		$priority = array(
			1 => 'Высокий приоритет',
			2 => 'Средний приоритет',
			3 => 'Низкий приоритет',
			4 => 'Тривиальная',
			);

		if ($key)
			return $priority[$key];
		
		return $priority;
	}
}


function getCircleStatus($status=NULL){
	switch ($status) {
		case 1:
		   return "high";
		case 2:
		    return "mid";
		case 3:
		    return "low";			
		case 4:
		    return "gray";
		default: 
			return $status;
	}	 
}
	

