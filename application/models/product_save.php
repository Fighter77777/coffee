<?php 
class Product_save extends CI_Model{
	
	public function save($post=NULL,$pr_id=NULL)
	{
		echo '<pre>';
			print_r($post);
		echo '</pre><hr>';
			
		$product_arr=array(
		  'name'=>$post['pr_nm'],
		  'description'=>$post['pr_descr'],
		  //'display'=>$post['pr_descr'],
		  'price'=>$post['price'],
		  //'category_id'=>$post['price'],
		  //'rate_level'=>$post['price'],
		  //'discount_quantity_id'=>$post['price'],
		  //'del'=>$post['price'],,
		  'num'=>$post['price']
		);
		if($pr_id>0){
			$this->db->update('products', $product_arr,array('id' => $pr_id)); 
			
		echo	$del_attr_val ="DELETE values_atributes
							FROM values_atributes 
							  INNER JOIN products_has_values_atributes
							    ON products_has_values_atributes.values_atributes_id = values_atributes.id
							  INNER JOIN atributes
							    ON values_atributes.atributes_id = atributes.id
							WHERE products_has_values_atributes.products_id = ? AND atributes.tp = 0";
			$this->db->query($del_attr_val,$pr_id);
			
			$this->db->delete('products_has_values_atributes', array('products_id' => $pr_id)); 	
		}else{
			$this->db->insert('products', $product_arr); 
			$pr_id=$this->db->insert_id();	
		}

		if(!empty($post['attr_val'][1]))	//input
			foreach($post['attr_val'][1] as $k=>$v)
				$ins_pr_attr[]=array('products_id'=>$pr_id, 'values_atributes_id'=>$v);	
		
		echo '<pre>';
			print_r($ins_pr_attr);
		echo '</pre>';
		if(isset($post['attr_val'][0]) && is_array($post['attr_val'][0])){	//select
			foreach($post['attr_val'][0] as $k=>$v){
				$ins_val_attr[]=array('atributes_id'=>$k, 'value'=>$v);	
				$this->db->insert('values_atributes',$ins_val_attr); 
				$val_attr_id=$this->db->insert_id();	
				
				$ins_pr_attr[]=array('products_id'=>$pr_id, 'values_atributes_id'=>$val_attr_id);	
			}
		}
		echo '<pre>';
			print_r($ins_pr_attr);
		echo '</pre>';
		/*if(!empty($ins_pr_attr))
			$this->db->insert_batch('products_has_values_atributes',$ins_pr_attr); */
				
	}
}