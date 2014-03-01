	<div class="popup-bg" id='add_user_ajax'>
		<div class="popup add_item" id="add_user-pop">
			<header>
				<h1>Сменить аватар:</h1>
				<a class="close add_user_close"></a>
			</header>
			<div class="cont">				
				<div class="drop" id="drop" >
					<div class="fallback">
					    <input name="file" type="file" multiple />
					</div>
				</div>
				<div class="inputs">
					<div class="row buts">
						<input class="button save" type="submit" value="Сменить" >
						<input class="button add_user_close" type="button" value="Отмена" >							
					</div>
				</div>			
			</div>
		</div>
	</div>	
	
	<script type="text/javascript" src="<?php echo site_url() ?>js/jquery-validation/jquery.validate.min.js"></script>
	<script type="text/javascript" src="<?php echo site_url() ?>js/jquery-validation/messages_ru.js"></script>
	<script type="text/javascript" src="<?php echo site_url() ?>js/dropzone_avatar.js"></script>
	<script type="text/javascript" src="<?php echo site_url() ?>js/edit_avatar.js"></script>
