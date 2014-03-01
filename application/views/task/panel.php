	<div class="content project-general">
		<div class="wrap">
			<div class="row breadcrumbs">
				<span><a href="/taskslist">Мои задачи</a></span><ins></ins><span><a href="/project/<?=$project_id?>"><?=$project_name?></a></span><ins></ins><span><?=$task_name?></span>
				<input name="parent_id" type="hidden" value="<?=$task_id?>">
			</div>
			<div class="row w_tabs">
				<div class="tabs">
					<a href="/task/<?=$task_id?>" class="tab <?=$section=='index'?'active':''?>">Общая информация</a>
					<a href="/task/<?=$task_id?>/settings" class="tab <?=$section=='settings'?'active':''?>">Настройки</a>
				</div>
				<div class="panel">
					<?=$top?>
				</div>
			</div>	

			<?php if ($section == 'index'):?>	
				<div class="row w_tabs">
					<div class="panel dynamic" style='margin-top: 40px;'>
						<div class="top_tabs">
							<a id="all_actions" href="" class="tab">Все</a>
							<a id="action_comments" href="" class="tab active">Комментарии</a>
							<a id="actions" href="" class="tab">Действия</a>
						</div>
						<?=$bottom?>
					</div>
				</div>
			<?endif;?>
		</div>
	</div>