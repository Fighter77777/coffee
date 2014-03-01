					<? //$this->load->view("error_popup"); ?>
					<form method="post" id='edit_user_data'>
						<div class="pad inputs">
							<div class="half">
								<div class="row ch_pic">
									<img src="<?php echo $profile->user_pic; ?>" alt="Ваша фото" height='50px' id='current_ava'>
									<a id='f_upload'>сменить</a>
									<input type="hidden" name='avatar_name' value="">
								</div>
								<div class="row fields3">
									<div class="field">
										<label for="" >Фамилия *</label>
										<input type="text" name="surname" value='<?php echo $profile->surname; ?>' required  >
									</div>
									<div class="field">
										<label for="" id='top_form' title='' >Имя *</label>
										<input type="text" name="name" value='<?php echo $profile->name; ?>' required >
									</div>
									<div class="field">
										<label for="">Отчество *</label>
										<input type="text" name="mid_name" value='<?php echo $profile->mid_name; ?>' required >
									</div>
								</div>
								<div class="row">
									<div class="field">
										<label for="">Пол</label>
										<span data-id="" class="w_radio <?php if ($profile->gender=='male') echo 'checked'; ?>" val="male"><i></i>Мужской</span>
										<span data-id="" class="w_radio <?php if ($profile->gender=='female') echo 'checked'; ?>" val="female"><i></i>Женский</span>
										<input type="hidden" name='gender' value="<?php echo $profile->gender; ?>">
									</div>
								</div>					
								<div class="row">
									<div class="field">
										<label for="">Должность *</label>
										<input type="text" name="positions" value='<?php echo $profile->positions; ?>' required >
									</div>
								</div>
								<div class="row">
									<div class="field">
										<label for="">E-mail *</label>
										<input type="text" name="email" value='<?php echo $profile->email; ?>' title='' >
									</div>
								</div>
								<div class="row">
									<div class="field">
										<label for="">Телефон(моб)</label>
										<input type="text" name="mob_phone" value='<?php echo $profile->phone; ?>' >
									</div>
								</div>								
								<div class="row">
									<div class="field">
										<label for="" id='tel_err' title=''>Телефон(вн)</label>
										<input type="text" name="inner_phone" value='<?php echo $profile->inner_phone; ?>' >
									</div>
								</div>
							</div>
							<div class="half">
								<h3>Смена пароля</h3>
								<div class="row">
									<div class="field ">
										<!--<span class="err_msg">поле заполнено неправильно</span>-->
										<label for="">Текущий пароль</label>
										<input type="password" name="old_pass" title="">
									</div>
								</div>
								<div class="row">
									<div class="field">
										<label for="">Новый пароль</label>
										<input type="password" name="new_pass1" id='new_pass1'>
									</div>
								</div>
								<div class="row">
									<div class="field">
										<label for="">Подтверждение пароля</label>
										<input type="password" name="new_pass2">
										<p class="hint" title=''>*заполняйте данные поля только в том случае, если вы планируете сменить текущий пароль</p>
									</div>
								</div>
							</div>
							<div class="row" style='margin-top: 20px;'>								
								<input class="button" type="submit" value="Сохранить" >
							</div>
							<br class="clear">
						</div>
					</form>