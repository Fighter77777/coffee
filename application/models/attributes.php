<?php 
class Attributes extends CI_Model{
	
	public function getAllAtributes()
	{
		$this->db->select('id, name, tp');	
		if($query=$this->db->get_where('atributes',array('del' => 0))){
			if($query->num_rows()>0){
				foreach ($query->result_array() as $row){
   					$r[$row['id']]=array('nm'=>$row['name'],'tp'=>$row['tp']);
					if($row['tp']==1)
						$sel[]=$row['id'];
				}				
				if($sel)
					$sel_ls=$this->getListValAtributesByID($sel);
				return array('nm'=>$r,'val'=>$sel_ls);
			}
		}
	}
	
	
	private function getListValAtributesByID($ids)
	{
			
		//$this->db->select('id, value');
		$this->db->order_by("value", "asc"); 	
		$this->db->where_in('atributes_id', $ids);
		if($query=$this->db->get('values_atributes'))
			if($query->num_rows()>0){
				foreach ($query->result_array() as $row)
   					$r[$row['atributes_id']][]=array('id'=>$row['id'],'val'=>$row['value']);
				return $r;
			}
	}
	
}