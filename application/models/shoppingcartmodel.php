<?php 
class ShoppingCartModel extends CI_Model{
	
	public function add_shopping_cart($product_id=NULL,$quantity=NULL)
	{
		$product_id=(int)$product_id;	$quantity=(int)$quantity;
		if($product_id*$quantity>0){
			$data = array(
               'users_id' => $_SESSION['users_id'],
               'products_id' => $product_id ,
               'quantity' => $quantity
            );
			if($this->db->insert('shopping_cart', $data))
				return TRUE;			
		}
	}	
	
	
	public function content_shopping_cart($pay=NULL)
	{
		$txt_query="SELECT products.id pr_id, products.name pr_nm,
					  products.price, shopping_cart.quantity sc_quantity, buy_now,   
					  discount_quantity.quantity d_quantity, discount_quantity.rate,
					  discount_quantity.min_level,discount_quantity.name
					FROM shopping_cart, products, discount_quantity
					WHERE shopping_cart.products_id = products.id 
					  AND products.discount_quantity_id = discount_quantity.id
					  AND discount_quantity.users_id={$_SESSION['users_id']}";
		if($pay)
			$txt_query.=" AND shopping_cart.buy_now=1";	
		if($query=$this->db->query($txt_query)){			
			if ($query->num_rows() > 0){
				$prod_rez=array();
				$level_rate=(isset($_SESSION['level_rt']))?$_SESSION['level_rt']:0;
				foreach ($query->result_array() as $row){
					$amount_disc_lvl=$row['price']*$level_rate;
					if($_SESSION['level_id']>=$row['min_level'] && $row['sc_quantity']>=$row['d_quantity']){					
						$amount_disc_action=$row['price']*$row['rate'];
						$final_price=$row['price']-$amount_disc_lvl-$amount_disc_action;
					}else
						$final_price=$row['price']-$amount_disc_lvl;
					$prod_rez[]=array(
								'pr_id'  =>$row['pr_id'],
								'pr_nm'  =>$row['pr_nm'],								
								'price'  =>$row['price'],								
								'final_price'=>$final_price,
								'quantity'=>$row['sc_quantity'],
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
	
	
	public function pay()
	{
		$prods=$this->content_shopping_cart(1);	
		if($prods){
			if($this->db->insert('order', array('users_id'=>$_SESSION['users_id']))){				
				$order_id=$this->db->insert_id();
				foreach ($prods as $pr)
					$ins[]="({$pr['pr_id']},{$pr['sc_quantity']},{$pr['final_price']},$order_id)";	
				$ins=implode (', ', $ins);
				$txt_query="INSERT INTO order_product (`products_id`,`quantity`,`price`,`order_id`) VALUES $ins";
				if($query=$this->db->query($txt_query)){
					$txt_del="DELETE FROM shopping_cart WHERE buy_now = 1 AND users_id = ?";
					if($query=$this->db->query($txt_del,array($_SESSION['users_id'])))
						return TRUE;	
				} 
			}		
		}
		return FALSE;
	}
	
	
	public function changeStatusOrder($order_id=NULL,$status=NULL)
	{
		$order_id=(int)$order_id;	
		$status_list=array('Новый'=>NULL, 'Формируется'=>NULL, 'Ждет отправки'=>NULL, 
						   'Отправлен'=>NULL, 'Получен'=>NULL, 'Возвращен'=>NULL);
		if($order_id>0 && array_key_exists($status,$status_list)){			
			$this->db->set('status', $status); 
			$this->db->where('order_id', $order_id);
			if($this->db->update('order', $data))
				return TRUE;			
		}
		return FALSE;
	}
	
	
	public function orderList($order_id=NULL,$user_id=NULL)
	{
		$order_id=(int)$order_id;	$user_id=(int)$user_id;
		$where='';
		if($order_id>0)
			$where.=' AND `order`.id='.$order_id;	
		if($order_id>0)
			$where.=' AND `order`.user_id='.$user_id;	
		$txt_query="SELECT `order`.date_buy `dt`, categorys.name `category`, products.name `product`, 
					  order_product.price, order_product.quantity,					  
					  users.surname, users.name, users.phone
					FROM `order`, order_product, products, users 
					WHERE `order`.id = order_product.order_id
					  AND order_product.products_id = products.id
					  AND products.category_id = categorys.id
					  AND `order`.users_id = users.id
					  $where
					ORDER BY `dt`, `category`, `product` ASC";
		if($query=$this->db->query($txt_query)){			
			if ($query->num_rows() > 0){
				return $query->result_array(); 
			}			
		}
		return FALSE;
	}		
}