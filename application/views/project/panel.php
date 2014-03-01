<div class="content <?=$div_tp?>">
	<div class="wrap">
		<div class="row breadcrumbs">
			<span><a href="/projectslist">Мои проекты</a></span><ins></ins><span><?=$project_name?></span>
		</div>
		<div class="row w_tabs">
			<div class="tabs">
				<a href="/project/<?=$project_id?>" class="tab <?=$section=='index'?'active':''?>">Общая информация</a>
				<a href="/project/<?=$project_id?>/tasks" class="tab <?=$section=='tasks'?'active':''?>">Задачи</a>
				<a href="/project/<?=$project_id?>/comments" class="tab <?=$section=='comments'?'active':''?>">Обсуждение</a>
				<a href="/project/<?=$project_id?>/activity" class="tab <?=$section=='activity'?'active':''?>">Активность</a>
				<a href="/project/<?=$project_id?>/settings" class="tab <?=$section=='settings'?'active':''?>">Настройки</a>
				<div class="row buts">
					<a href="" id ="add_task" class="button blue add_task">Cоздать задачу</a>
					<input type ="hidden" name="parent_id" value ='<?=$project_id?>'>
				</div>
			</div>
			<div class="panel">
				<?=$content?>
			</div>
		</div>		
	</div>
</div>
