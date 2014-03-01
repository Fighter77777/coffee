<?php 
class Users extends CI_Model{

	function getNamesList($format=NULL, $id=NULL){		
		if($format=="NL")
			$name = "CONCAT(u.surname,' ',u.name)";
		elseif($format=="FN")
			$name = "CONCAT(u.surname,' ', u.name,' ', u.mid_name)";
		else 
			$name = "CONCAT(u.surname,' ', LEFT(u.name,1),'.',LEFT(u.mid_name,1),'.')";
		$where=($id)?'WHERE id = '.$id:'';
		$select 	= 	"SELECT $name AS name FROM users u  $where ";
		if($query=$this->db->query($select)){
			$query_res=$query->result_array();
			$num_users=count($query_res);		
			for ($i=0; $i <$num_users; $i++) 
				$users[$query_res[$i]['id']]=$query_res[$i]['name'];
			return $users;
		} 
		return FALSE;		
	}

	function getUsers($format=NULL,$id=NULL){

		$result = array();
		
		if($format=="NL")
			$name = "CONCAT(surname,' ',name)AS name";
		elseif($format=="FN")
			$name = "surname, name, mid_name";
		else 
			$name = "CONCAT(surname,' ', LEFT(name,1),'.',LEFT(mid_name,1),'.')AS name";
		$where=($id)?'WHERE id = '.$id:'';
		
		$select = 	"SELECT 
						$name,
						avatar						AS user_pic, 
						email,						
						phone,			
						d_reg 
					FROM 
						users
					$where
					";
		if($query=$this->db->query($select)){
			$query_res=$query->result_array();
			$num_users=count($query_res);		
			for ($i=0; $i <$num_users; $i++) 
				$data_out[$i]['avatar']= (!empty($data_out[$i]['avatar']))?site_url().getConst('p_avatar_small').$data_out[$i]['avatar']:site_url().'i/userpic_thumb.png';	
			return $users;
		}
		return FALSE;	
	}
}