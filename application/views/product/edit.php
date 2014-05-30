    <div class="content">
      <div class="left_block">
        <div class="menu">
          <h3><div class="sep_menu_l"></div>Каталог продукции<div class="sep_menu_r"></div></h3>
          <ul>
            <li><a href="">Кофе</a></li>
            <li><a href="">Чай</a></li>
            <li><a href="">Капсульные эспрессо кофеварки</a></li>
            <li><a href="">Ручные эспрессо кофеварки</a></li>
            <li><a href="">Автоматические эспрессо кофеварки</a></li>
            <li><a href="">Профессиональные кофеварки</a></li>
            <li><a href="">Кофемолки</a></li>
            <li><a href="">Кофейные аксессуары</a></li>
          </ul>
        </div>
        
        <div class="filter">
          <h3><div class="sep_menu_l"></div>Подбор параметров<div class="sep_menu_r"></div></h3>
          <form method="post">
            <div class="group_param_1">
              <h4>Клас</h4>
              <ul class="filter_by_class">
                  <li>
                    <label>
                      <input type="checkbox" name="class">
                      <a href=""><span>Капсульные эспрессо кофеварки</span></a>
                      <i>(10)</i>
                    </label>
                  </li>             
              </ul>
            </div>
            <div class="group_param_2">
              <h4>Производитель</h4>
              <ul class="filter_by_name">                  
              </ul>
            </div>
            <div class="group_param_3">
              <h4>Цена</h4>
              <label>
                <span>от</span>
                <input class="filter_price" type="text" name="price">
              </label>
              <label>
                <span>до</span>
                <input class="filter_price" type="text" name="price">
                <span>грн.</span>
              </label>
            </div>
            <input class="reset" type="reset" name="reset" value="Сбросить фильтр">
            <input type='submit' value="Сохранить">
          </form>
        </div>
      </div>
      
      
      <div class="catalog">  
      	<form method="post">
      		<h1>Название товара: <input type='text'  name="pr_nm" value="<?php echo $prod['pr_nm'];  ?>"/></h1>
	        <div class="item_product_short">
	          <a class="product_img" href=""><img src="<?php echo site_url();?>images/photo/equip-01m.png"></a>
	          <p class="price_new">
	          	<h5>Цена: <input type='text'  name="price" value="<?php echo $prod['price']; ?>"/>$</h5>
	          </p>          
	          <p class="short_desc">
	          	<textarea name="pr_descr"><?php echo $prod['pr_descr']; ?></textarea>	
	          </p>          
	        </div>
	        <div class="characters_block">
		        <h2>Характеристики товара</h2>
		        <table class="characters"> 
			        <tr>
				        <th>Характеристики</th>
				        <th>Значения</th>
			      	</tr>	       
			        <?php if($attr)
				  			foreach($attr as $a_id=>$a_val){
				  				echo "<tr><td><select size='1' class='opt_nm'>";
			  						foreach($all_attr['nm'] as $id=>$val){
			  							$selected=($a_id==$id)?'selected':'';
								  		echo "<option value='$id' $selected data-type='{$val['tp']}'>{$val['nm']}</option>";
									}
								echo "</select></td><td>";
								if($all_attr['nm'][$a_id]['tp']==1){
									echo ": <select size='1' name='attr_val[{$all_attr['nm'][$a_id]['tp']}][$a_id]'>";
				  						foreach($all_attr['val'][$a_id] as $id=>$v){
				  							$selected=($a_id==$id)?'selected':'';
									  		echo "<option value='$id' $selected >{$v['val']}</option>";
										}
									echo "</select>";
								}else{
									echo ": <input type='text'  name='attr_val[{$all_attr['nm'][$a_id]['tp']}][$a_id]' value='{$a_val['val']}'>";	
								}
								echo "</td></tr>";
							} 
					?>
				</table>		
	        </div>
	        <input type='submit' value="Сохранить">
        </form>  
      </div>      
    </div>
    <script>
    $(document).ready(function(){	
		tinyMCE.init({
			selector: "textarea"	
		});	
	});
    </script>