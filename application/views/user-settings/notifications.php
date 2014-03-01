					<form method="post" action="<?php echo base_url() ?>usersettings/save_notifications">
						<div class="pad">
							<span class="w_check checked"><input type="hidden"name="send_email" value="<?php echo $profile->notify_email; ?>"><i></i>Отправлять мне уведомления на почту <?php echo $profile->email; ?></span>
							<div class="cases">
							<?php if(!empty($all_notif))	foreach($all_notif as $notif_id=>$notif_descript): ?>
								<span class="w_check <?php if(isset($user_notif[$notif_id])) echo 'checked'?>" notif_id='<?php echo $notif_id?>'><input type="hidden"name="notif[<?php echo $notif_id?>]" value="<?php if(isset($user_notif[$notif_id])) echo 1?>"><i></i><?php echo $notif_descript?></span>
							<?php endforeach; ?>		
							</div>
							<p>Пожалуйста, укажите события, уведомления о которых должны приходить вам на адрес, который вы указали в <a href="<?php echo base_url() ?>usersettings">общих настройках.</a></p>
							<div class="row">							
								<input class="button" type="submit" value="Сохранить изменения" >
							</div>
							<br class="clear">
						</div>
					</form>