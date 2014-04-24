	  </div>
	</div>
	
	
	<div class="fshadow"></div>
	<div class="f_wrapper">
	  <div id="footer">
	    <div class="menuf">
	      <ul>
	        <li><a href="">Главная</a></li>
	        <li><a href="">О нас</a></li>
	        <li><a href="">Меню</a></li>
	        <li><a href="">Заказ</a></li>
	        <li><a href="">Контакты</a></li>
	      </ul>
	    </div>
	    <div class="copyright"><p>2014 Кофейня Caffelino. Все права защищены.</p></div>
	    <div class="socials">
	    	<a class="email" href=""></a>
	        <a class="google" href=""></a>
	        <a class="facebook" href=""></a>
	        <a class="twitter" href=""></a>
	    </div>
	  </div>
	</div>
	<?php if(!empty($footer_scripts)):	//підкл. скрипти 
        	foreach($footer_scripts as $path):?>
            <script type="text/javascript" src="<?php print site_url().'js/'.$path.'.js' ?>"></script>
    <?php 	endforeach;
		  endif;?>
	</body>
</html>