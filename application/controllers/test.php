<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {
	
	public function index()
	{
			$this->load->model('Log');	
			echo $this->Log->write(2,3,array('task_id'=>5,'category'=>'1','ex_status'=>1,'status'=>4));	
			echo "<pre>";
			print_r($this->Log->error);
			echo "</pre>";
	}
	
	
	public function read()
	{
			$this->load->model('Log');	
			
			echo $this->Log->categoryTasks(349);
			
			//echo $this->Log->write(4,1, array('category'=>1,'task_id'=>5, 'responsible'=>2,  'important'=>4, 'file_id'=>542, 'file_event'=>1));
			//echo $this->Log->write(4,2, array('category'=>1,'task_id'=>5, 'file_id'=>540, 'file_event'=>1));	
			
			echo "<pre>";
			print_r($this->Log->error);
			echo "</pre>";
			
			
			/*
			echo $this->Log->getEvents(0,array('profile_id'=>7, 'user_id' => 3));	
			echo "<pre>";
			print_r($this->Log->error);
			echo "</pre>";
			*/
			
			/*echo $this->Log->getEvents(1,NULL,array('user_nm'=>'ASC', 'event' => "ASC"),50,'2013-01-01','2013-11-10');	
			echo '<br>';
			echo $this->Log->getEvents(0,array('event'=>1),array('date_event'=>'ASC', 'event' => "DESC"),20,'2013-01-01','2013-12-01');	
			 * 
			 */
			$this->Log->sort = 1;
			//$log = $this->Log->getEventsStr(-1);
		//	$log = $this->Log->getEventsStr(-1);		
			
			/*echo "<pre>";
			print_r($log);
			echo "</pre>";*/
		//	$log = $this->Log->getEventsStr(-1,NULL,NULL,NULL,5);
			//$cat = $this->Log->categoryTasks(290);	
			//var_dump($cat);
	}

}
