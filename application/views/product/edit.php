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
     </div> 
      
      <div class="catalog">
	    <form method="POST">
	      <h1>Название товара:<input type='text'  name="pr_nm" value="<?php echo $prod['pr_nm'];  ?>"/></h1>
<br>
       <textarea name="pr_descr"><?php echo $prod['pr_descr']; ?></textarea><BR>
<br>
    
    <script>
    $(document).ready(function(){	
		tinyMCE.init({
			selector: "textarea"	
		});	
	});
    </script>
    
	
	 
	  
	  цена:<input type='text'  name="price" value="<?php echo $prod['price']; ?>"/>
	  к-во:<?php echo $prod['pr_num'];  ?>   
	  сменить кво на<input type='text'  name="add_pr_num" value=""><br>  
	  
	  <h3>Атрибути:</h3>
	  <?php if($attr)
	  			foreach($attr as $a_id=>$a_val){
	  				echo "<select size='1'>";
  						foreach($all_attr['nm'] as $id=>$val){
  							$selected=($a_id==$id)?'selected':'';
					  		echo "<option value='$id' $selected >{$val['nm']}</option>";
						}
					echo "</select>";
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
					echo "<br>";
				} 
		?>
		<input type='submit' value="Сохранить">
        </form>
      </div>
      
    </div>