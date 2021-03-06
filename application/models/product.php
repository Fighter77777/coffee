<?php 
class Product extends CI_Model{
	public $where;
	public $sort;
	public $limit;
	
	
	private function queryWhere($only_condition=NULL)
	{
		$where_db=array();
		if(!empty($this->where['cat_id']))
			$where_db['categorys.id']='products.category_id='.(int)$this->where['cat_id'];
		if(!empty($this->where['pr_id']))
			$where_db['pr_id']='products.id='.(int)$this->where['pr_id'];
		if(!empty($this->where['attr_nm_id']))
			$where_db['atributes.id']='atributes.id='.(int)$this->where['attr_nm_id'];
	/*	if(isset($this->where['attr_val_id'])){
			if(is_array($this->where['attr_val_id'])){}
			$where_db['values_atributes.id']=(int)$this->where['attr_val_id'];
		}*/
		if(!empty($this->where['prod_display']))
			if($this->where['prod_display']=='no_del')
				$where_db['products.display']='products.display<>del';	
			else
				$where_db['products.display']='products.display='.(int)$this->where['prod_display'];		
		if(!empty($where_db)){
			$where_txt=implode (' AND ', $where_db); 
			if(!$only_condition)
				$where_txt=' WHERE '.$where_txt;
			else
				$where_txt=' AND '.$where_txt;
			return $where_txt;
		}
	}
	
		
	private function queryOrder()
	{
		if (is_array($this->sort)) {
			$order=array();
			$list_version = array('pr_nm' => '`pr_nm`', 'price' => 'price');
			foreach ($this->sort as $column=>$direction) {
				if (isset($list_version[$column])){
					$direction=($direction=='desc')?'DESC':'ASC';
					$order[]=" {$list_version[$column]} $direction ";					
				}
			}
			if(!empty($order))
					return " ORDER BY ".implode(",  ", $order);
		}
		return FALSE;
	}
	
	
	private function queryLimit()
	{										//генерує "LIMIT"
		$num = (int)$this->limit;
		if ($num > 0)
			return " LIMIT $num ";
		return FALSE;
	}
	
	
	private function queryProducts()
	{
		$where=$this->querywhere();
		$order=$this->queryOrder();	
		$limit=$this->queryLimit();
		$query_txt="SELECT
					  categorys.name cat_nm, products.id pr_id, products.name pr_nm, products.description pr_descr, 
					  products.price, products.display, products.num pr_num, images.name img,
					  atributes.id attr_id, atributes.name attr_nm, values_atributes.value attr_val,
					  discount_quantity.name discount_name, discount_quantity.quantity, discount_quantity.min_level, discount_quantity.rate  
					FROM products
					  INNER JOIN categorys
					    ON products.category_id = categorys.id
					  LEFT JOIN images
					    ON products.id = images.products_id
					  LEFT JOIN products_has_values_atributes
					    ON products.id = products_has_values_atributes.products_id
					  LEFT JOIN values_atributes
					    ON products_has_values_atributes.values_atributes_id = values_atributes.id
					  LEFT JOIN atributes
					    ON values_atributes.atributes_id = atributes.id
					  LEFT JOIN discount_quantity
					    ON products.discount_quantity_id = discount_quantity.id
					  $where $order $limit";
		//echo $query_txt;				
		$query = $this->db->query($query_txt);
		return $query->result_array();
	}
	
	
	public function arrProducts()
	{
		$prod_db=$this->queryProducts();
		if(empty($prod_db))
			return FALSE;
		$prod_rez=array();
		$level_rate=(isset($_SESSION['level_rt']))?$_SESSION['level_rt']:0;
		$num_row=count($prod_db);
		for($i=0;$i<$num_row;$i++){
			if($i==0 || $prod_db[$i]['pr_id']!=$prod_db[$i-1]['pr_id']){
				$amount_disc_lvl=$prod_db[$i]['price']*$level_rate;
				$amount_disc_action=$prod_db[$i]['price']*$prod_db[$i]['rate'];
				//$price_for_you=$prod_db[$i]['price']*$prod_db[$i]['rate'];
				$prod_rez[]=array(
								'cat_nm' =>$prod_db[$i]['cat_nm'],
								'pr_id'  =>$prod_db[$i]['pr_id'],
								'pr_nm'  =>$prod_db[$i]['pr_nm'],
								'pr_descr'=>$prod_db[$i]['pr_descr'],
								'price'  =>$prod_db[$i]['price'],
								'price_lvl'=>$prod_db[$i]['price']-$amount_disc_lvl,
								'price_act'=>$prod_db[$i]['price']-$amount_disc_action,
								'img'    =>$prod_db[$i]['img'],
								'attr'   =>array(array('nm'=>$prod_db[$i]['attr_nm'],'val'=>$prod_db[$i]['attr_val']))
							);	
			}else{
				end($prod_rez);
				$prod_rez[key($prod_rez)]['attr'][]=array('nm'=>$prod_db[$i]['attr_nm'],'val'=>$prod_db[$i]['attr_val']);				
			}		
		}
		return $prod_rez;		
	}
	
	
	public function attributesList()
	{
		$where=$this->queryWhere(1);
		$query_txt="SELECT atributes.id `attr_id`, atributes.name, values_atributes.id, values_atributes.value
						  FROM products, products_has_values_atributes, values_atributes, atributes
						  WHERE products.id = products_has_values_atributes.products_id
						   AND products_has_values_atributes.values_atributes_id = values_atributes.id
						   AND values_atributes.atributes_id = atributes.id
						   $where
						GROUP BY values_atributes.value
						ORDER BY atributes.name, values_atributes.value ASC";
		echo $query_txt;				
		$query = $this->db->query($query_txt);
		return $query->result_array();
	}
	
	
	public function categoryProducts($category_id=NULL)
	{
		$this->where['cat_id']=$category_id;
		$this->where['prod_display']='no_del';
		$this->sort['price']='asc';
		$prod=$this->arrProducts();
		return $prod;		
	}
	
	public function attributesProducts($category_id=NULL)
	{
		//$this->where['cat_id']=$category_id;
		//$this->where['prod_display']='no_del';
		$attr=$this->attributesList();
		$old_tp_attr=NULL;
		$num_attr=count($attr);		
		for($i=0;$i<$num_attr;$i++)	{
			if($i==0 || $old_tp_attr!=$attr[$i]['attr_id'])
				$r[$attr[$i]['attr_id']]=array('nm'=>$attr[$i]['name'],'val'=>array($attr[$i]['value']));		
			else
				$r[$attr[$i]['attr_id']]['val'][]=$attr[$i]['value'];	
			$old_tp_attr=$attr[$i]['attr_id'];	
		}	
		return $r;		
	}
	
	
	public function getProduct($pr_id=NULL)
	{
		if($pr_id>0){
			$this->where['pr_id']=$pr_id;
			//$this->sort['price']='asc';
			$prod=$this->queryProducts();
			if($prod){
				foreach($prod as $p)
					$attr[$p['attr_id']]=array('nm'=>$p['attr_nm'], 'val'=>$p['attr_val']);	
				$pr=$prod[0];
				unset($pr['attr_id']); unset($pr['attr_nm']); unset($pr['attr_val']);
			}
			return array('prod'=>$pr, 'attr'=>$attr);
		}		
	}
}