<!DOCTYPE html>
<!--[if IE 8]>
<html lang="uk" class="ie8"><![endif]-->
<!--[if !IE]><!--> <html lang="uk"> <!--<![endif]-->

<head>
  <meta charset="utf-8">
  <title><?php echo $title; ?></title>
  <meta name="description" content="This personal page company Caffelino">
  
  <!-- Stylesheets -->
  <link rel="stylesheet" href="<?php echo site_url(); ?>css/style.css" />
  <link rel="stylesheet" href="<?php echo site_url(); ?>css/reset.css" />
  <link rel="stylesheet" href="<?php echo site_url(); ?>css/custom-theme/jquery-ui-1.10.4.custom.min.css" />
  <!--[if lt IE 9]> 
   <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script> 
  <![endif]-->	
	<script src="<?php echo site_url() ?>js/jquery-1.11.0.min.js"></script>
	<script src="<?php echo site_url() ?>js/jquery-ui-1.10.4.custom.min.js"></script>  
	<script src="<?php echo site_url() ?>js/main.js"></script>  
		
	<?php if(!isset($_SESSION['user_id'])): // скрипти для авторизації?> 
		<!--<script type="text/javascript" src="<?php echo base_url() ?>js/jquery-ui/jquery.ui.tooltip.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url() ?>js/jquery-validation/jquery.validate.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url() ?>js/jquery-validation/messages_ru.js"></script>
		<script type="text/javascript" src="<?php echo base_url() ?>js/login.js"></script>-->
	<?php endif; 
		  if(!empty($header_scripts)):	//підкл. скрипти які викор. тільки ця сторінка 
        	foreach($header_scripts as $path):?>
            <script type="text/javascript" src="<?php print site_url().'js/'.$path.'.js' ?>"></script>
    <?php 	endforeach;
		  endif;?>
    <!-- end of scripts -->   
    
   <!-- <link rel="stylesheet" href="http://yui.yahooapis.com/2.9.0/build/reset/reset-min.css">-->
   <!-- <link rel="stylesheet" href="<?php echo site_url() ?>css/stylesheet.css">-->
</head>

<body>
<div class="mwrapper">
  <div class="wrapper">
  
    <div class="login">
      <form method="post">
        <label class="name" for="name">
        <input class="name" type="text" name="name"></label>
        <label class="pwd" for="pwd">
        <input class="pwd" type="password" name="pwd"></label>
      </form>
    </div>
  
    <div class="logo"></div>
    
    <div class="qphone"><span class="desc_phone">Номер для заказа:</span><p><span title="380505405732">+38 (050)</span> 540-57-32</p></div> 
    <div class="mcart"><p>Ваша корзина пуста</p></div>
    <div class="header_menu">
      <div class="sep_menu_l"></div>
      <div class="main_menu">
        <ul>
          <li class="active"><a href="<?php echo site_url(); ?>">Главная</a></li>
          <li><a href="">О нас</a></li>
          <li><a href="">Меню</a></li>
          <li><a href="<?php echo site_url(); ?>order">Заказ</a></li>
          <li><a href="">Контакты</a></li>
        </ul>
      </div>
      <div class="sep_menu_r"></div>
    </div>