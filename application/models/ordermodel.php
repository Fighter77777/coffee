<?php 
class OrderModel extends CI_Model{
	
	public function pay($users_id=NULL)
	{
		$users_id=(int)$users_id;
		if($users_id>0){
			$data = array(
               'users_id' => $_SESSION['users_id'],
               'products_id' => $product_id ,
               'quantity' => $quantity
            );
			if($this->db->insert('shopping_cart', $data))
				return TRUE;			
		}
	}	
	
	
	public function content_shopping_cart()
	{
		$txt_query="SELECT products.id pr_id, products.name pr_nm,
					  products.price, shopping_cart.quantity, buy_now,   
					  discount_quantity.quantity, discount_quantity.rate,
					  discount_quantity.min_level,discount_quantity.name
					FROM shopping_cart, products, discount_quantity
					WHERE shopping_cart.products_id = products.id 
					  AND products.discount_quantity_id = discount_quantity.id
					  AND discount_quantity.users_id={$_SESSION['users_id']}";
		if($query=$this->db->query($txt_query)){			
			if ($query->num_rows() > 0){
				$prod_rez=array();
				foreach ($query->result_array() as $row){
					$amount_disc_lvl=$row['price']*$level_rate;
					$amount_disc_action=$row['price']*$row['rate'];
					$prod_rez[]=array(
								'pr_id'  =>$row['pr_id'],
								'pr_nm'  =>$row['pr_nm'],								
								'price'  =>$row['price'],
								'price_lvl'=>$row['price']-$amount_disc_lvl,
								'price_act'=>$row['price']-$amount_disc_action,
								'img'    =>$row['img'],
								'buy_now'=>$row['buy_now']								
							);
				} 
				return $count_tasks;
			}			
		}
		return FALSE;
	}	
	
	
	public function upd_shopping_cart($product_id=NULL,$buy=NULL)
	{
		$product_id=(int)$product_id;	
		$buy=($buy==1)?1:0;
		if($product_id*$quantity>0){			
			$this->db->set('buy_now', $buy); 
			$this->db->where('users_id', $_SESSION['users_id']);
			$this->db->where('products_id', $product_id);
			if($this->db->update('shopping_cart', $data))
				return TRUE;			
		}
		return FALSE;
	}	
	
	
	public function clear_shopping_cart($user_id=NULL)
	{
		$user_id=(int)$user_id;	
		if($user_id>0){			
			$this->db->where('users_id', $user_id);
			$this->db->where('buy_now', 1);
			if($this->db->delete('shopping_cart', $data))
				return TRUE;			
		}
		return FALSE;
	}
}