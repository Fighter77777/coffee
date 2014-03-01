<div class="content <?=$div_tp?>">
		<div class="wrap">
			<div class="row breadcrumbs">
				<span><a href="/userslist">Команда</a></span><ins></ins><span><?=$user_name?></span>
			</div>
			<div class="row w_tabs">
				<div class="tabs">
					<a href='/profile/<?=$user_id?>' class="tab <?=$section=='index'?'active':''?>">Общая информация</a>
					<a href='/profile/<?=$user_id?>/tasks' class="tab <?=$section=='tasks'?'active':''?>">Задачи</a>
					<a href='/profile/<?=$user_id?>/activity' class="tab <?=$section=='activity'?'active':''?>">Активность</a>
				</div>
				<div class="panel">
					<?=$content?>
				</div>
			</div>		
		</div>	

	</div>