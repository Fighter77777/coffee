<?php 
class Download extends CI_Controller{
	function index($path, $file){
		$this->load->helper('project');

		$ext 	=	pathinfo($file, PATHINFO_EXTENSION);
		header("Content-disposition: attachment; filename=".$file);
		header("Content-type: application/".$ext);
		readfile(site_url().getConst('p_upload').$path."/".$file);
			
	}
}