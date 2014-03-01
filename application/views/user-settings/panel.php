	<div class="content user-<?php echo ($section=='notifications')?'notifications':'settings'; ?>">
		<div class="wrap">
			<div class="row w_tabs">
				<div class="tabs">
					<a href="<?php echo base_url() ?>usersettings" class="tab <? if($section=='index') echo'active'; ?>">Общие настройки</a>
					<a href="<?php echo base_url() ?>usersettings/notifications"class="tab <?  if($section=='notifications') echo'active'; ?> ">Уведомления</a>
				</div>
				<div class="panel">
				<?php echo $content; ?>
				</div>
			</div>		
		</div>
	

	</div>