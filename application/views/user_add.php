	<div class="popup-bg" id='add_user_ajax'>
		<div class="popup add_item" id="add_user-pop">
			<header>
				<h1>Создание профайла сотрудника:</h1>
				<a class="close add_user_close"></a>
			</header>
			<div class="cont">
				<!-- <div class="userpic">
					<img src="<?php echo site_url(); ?>i/userpic-add.png" alt="" >
				</div>
			-->
				<div class="userpic drop" id="drop" >
					<div class="fallback">
					    <input name="file" type="file" multiple />
					</div>
				</div>
					
				<form method="post" id='create_user_form'>
					<div class="inputs">
						<div class="row fields3">
							<div class="field">
								<label for="" >Фамилия *</label>
								<input type="text" name="surname" required autofocus="autofocus" >
							</div>
							<div class="field">
								<label for="" id='top_form' title='' >Имя *</label>
								<input type="text" name="name" required >
							</div>
							<div class="field">
								<label for="">Отчество *</label>
								<input type="text" name="mid_name" required >
							</div>
						</div>
						<div class="row">
							<div class="field">
								<label for="">Пол</label>
								<span data-id="" class="w_radio checked" val="male"><i></i>Мужской</span>
								<span data-id="" class="w_radio" val="female"><i></i>Женский</span>
								<input type="hidden" name='gender' value="male">
							</div>
						</div>
						<div class="row">
							<div class="field">
								<label for="">Должность *</label>
								<input type="text" name='positions' required >
							</div>
						</div>
						<div class="row">
							<div class="field">
								<label for="">E-mail *</label>
								<input type="text" name='email' title='' required >
								<p class="hint">На данный адрес будет отправлена информация с данными доступа</p>
							</div>
						</div>
						<div class="row">
							<div class="field">
								<label for="">Пароль</label>
								<input type="password" name="pass" title=''>
								<p class="hint">Если пароль не указан - он будет сгенерирован автоматически</p>
							</div>
						</div>
						<div class="row">
							<div class="field">
								<label for="">Телефон (вн)</label>
								<input type="text" name='tel_in'>
							</div>
						</div>
						<div class="row">
							<div class="field">
								<label for="" id='tel_err' title=''>Телефон (моб)</label>
								<input type="text" name='tel_mob'>
							</div>
						</div>
						<div class="row buts">
							<input type="hidden" name='avatar_name' value="">
							<input class="button" type="submit" value="Создать" >
							<input class="button add_user_close" type="button" value="Отмена" >							
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>	
	
	<script type="text/javascript" src="<?php echo site_url() ?>js/jquery-validation/jquery.validate.min.js"></script>
	<script type="text/javascript" src="<?php echo site_url() ?>js/jquery-validation/messages_ru.js"></script>
	<script type="text/javascript" src="<?php echo site_url() ?>js/dropzone_avatar.js"></script>
	<script type="text/javascript" src="<?php echo site_url() ?>js/jquery-ui/jquery.ui.tooltip.min.js"></script>
	<script type="text/javascript" src="<?php echo site_url() ?>js/add_user_submit.js"></script>,
