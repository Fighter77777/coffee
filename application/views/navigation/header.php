<!DOCTYPE html>
<!--[if lte IE 9]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />

    <!-- less init -->
	<?php
	//$less = new $this->lessc;
	$cssfile =  $_SERVER["DOCUMENT_ROOT"]."/css/style.css";
	$lessfile = $_SERVER["DOCUMENT_ROOT"]."/css/style.less";
	//$less->checkedCompile($lessfile, $cssfile);
	?>
	<!-- end of less init -->

	<!-- styles -->	
	<link rel="stylesheet" href="<?php echo site_url() ?>css/normalize.min.css">
	<link rel="stylesheet" href="<?php echo site_url() ?>css/blitzer/jquery-ui-1.10.3.custom.css" >
	<link rel="stylesheet" href="<?php echo site_url() ?>css/style.css" type="text/css">
	<link rel="stylesheet" href="<?php echo site_url() ?>css/dropzone.css" type="text/css">
	<link rel="stylesheet" href="<?php echo site_url() ?>css/add.css" type="text/css">
	<!-- end of styles -->

	<!-- head scripts -->
	<!--[if lt IE 9]>
		<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
	<![endif]-->
	<script src="<?php echo site_url() ?>js/modernizr-2.6.2-respond-1.1.0.min.js"></script>	
	<script src="<?php echo site_url() ?>js/jquery-1.9.1.min.js"></script>
	<script src="<?php echo site_url() ?>js/jquery-ui/jquery-ui-1.10.3.custom.min.js"></script>  
	<script src="<?php echo site_url() ?>js/config.js"></script>  
		
	<?php if(!isset($_SESSION['user_id'])): // скрипти для авторизації?> 
		<script type="text/javascript" src="<?php echo site_url() ?>js/jquery-ui/jquery.ui.tooltip.min.js"></script>
		<script type="text/javascript" src="<?php echo site_url() ?>js/jquery-validation/jquery.validate.min.js"></script>
		<script type="text/javascript" src="<?php echo site_url() ?>js/jquery-validation/messages_ru.js"></script>
		<script type="text/javascript" src="<?php echo site_url() ?>js/login.js"></script>
	<?php endif ?>  
    
    <?php if(!empty($add_scripts)):	//підкл. скрипти які викор. тільки ця сторінка ?>
        <?php foreach($add_scripts as $path):?>
            <script type="text/javascript" src="<?php print site_url().'js/'.$path.'.js' ?>"></script>
        <?php endforeach;?>
    <?php endif;?>
    <!-- end of scripts -->  
</head>
<body>
	<div class='popup-bg' id="loader" style='display: none;'>
		<div class='sending'></div>
	</div>
	<header class='page-head <?php if(!isset($_SESSION['user_id'])): ?> unlogged <?php endif ?>'>
		<a href='<?php echo base_url() ?>' class="logo"><img src="<?php echo site_url() ?>i/logo.png" alt=""></a>
		<nav>
			<div class="submenu-cont" id="js-projects-menu">
				<a class="<?php if($activ_menu=="ProjectsList")echo'active' ?>" >Мои проекты</a>
				<div class="sel_box" id="project-submenu">
					<a href="<?php echo base_url() ?>projectslist">Все проекты</a>
					<a href="">Активные проекты</a>
					<a href="">Архив проектов</a>
					<a href="" id="create_project">Создать проект</a>
				</div>
			</div>
			<a href="<?php echo base_url() ?>taskslist" class="<?php if($activ_menu=="TasksList")echo'active' ?>">Мои задачи</a>
			<a href="<?php echo base_url() ?>userslist" class="<?php if($activ_menu=="UsersList")echo'active' ?>">Команда</a>
		</nav>
		<div class="head-usermenu">
			<strong><?php echo $_SESSION['user_name'] ?></strong>
			<ins></ins>
			<?php if(isset($_SESSION['user_id'])): ?>
			<div class="sel_box">
				<a href="<?php echo base_url() ?>usersettings"><i class='settings'></i>настройки</a>
				<a href="<?php echo base_url() ?>welcome/logout"><i class='logout'></i>выйти</a>
			</div>
			<?php endif ?>
		</div>
	</header>