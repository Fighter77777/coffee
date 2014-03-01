<?php 
class Ctrl extends CI_Model{

	function constDB($name){	//повертає значеня константи з БД  
		$this->db->select('value');
		$this->db->where('name', $name); 	
		if($query = $this->db->get('ctrl',1)){
			if ($query->num_rows() > 0)	{
			   $row = $query->row_array(); 			
			   return $row['value'];			   
			}	
		}	 
		return FALSE;			
	}
}