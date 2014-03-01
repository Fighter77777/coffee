<div id="mw_project_add" class="popup-bg">
	<div class="popup add_item" id="add_project-pop">
		<header>
			<h1>Создайте проект:</h1>
			<a  id="close_button" class="close mw_close"></a>
		</header>
		<form id="project_create" method="post">
			<div class="cont inputs">
				<div class="row">
					<div class="field">
						<label for="">Название проекта</label>
						<input name="project_name" type="text">
					</div>
				</div>
				<div class="row fields3">
					<div class="field">
						<label for="">Ответственный</label>
						<div class="select">
							<ins></ins><span id="project_responsible" data-id='1' class="cur"><?=$users[1]?></span>
							<div class="sel_box">
								<?php foreach ($users as $id => $user):?>
									<a data-id="<?=$id?>"><?=$user;?></a>
								<?php endforeach;?>
							</div>
						</div>
					</div>
					<div class="field">
						<label for="">Статус</label>
						<div class="select">
							<ins></ins><span id="project_status" data-id='1' class="cur"><?=$statuses[1];?></span>
							<div class="sel_box">
								<?php foreach ($statuses as $id => $status):?>
									<a data-id="<?=$id;?>"><?=$status;?></a>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
					<div class="field">
						<label for="">Категория</label>
						<div class="select">
							<ins></ins><span id="project_category" data-id='1' class="cur"><?=$categories[1];?></span>
							<div class="sel_box">
								<?php foreach ($categories as $id => $category):?>
									<a data-id="<?=$id?>"><?=$category;?></a>
								<?php endforeach;?>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="field">
						<label for="">Описание</label>
						<textarea name="project_description" id="project_description" cols="30" rows="10"></textarea>
					</div>
				</div>
				<div class="row">
					<label for="">Файлы</label>
					<div id="mwProjectDrop" class = "drop file-drag">
						<div class="step-1">
							<h1>Для загрузки файлов кликните на данную область или перетащите в нее файлы</h1>
							<!-- <h1>Перетащите файлы в данную область</h1> -->
						</div>
						<div class="fallback">
						    <input name="file" type="file" multiple />
						</div>
					</div>
				</div>
				<div class="row">
					<div class="row">
						<label class='l-lft' for="">Наблюдатели</label>
						<div class="check-actions">
							<a id="p_checkAll">отметить всех</a>
							<a id="p_uncheckAll">убрать все отметки</a>
						</div>
					</div>
					<ul class="watchers">
						<?php foreach($viewers as $id => $viewer):?>
							<li><span data-id="<?=$id;?>" class="w_check checked"><i></i><?=$viewer?></span></li>
						<?php endforeach;?>
					</ul>
				</div>
				<div class="row buts">
					<a href="" id="t_project_create" class="button">Создать</a>
					<a href="" id="t_project_cancel" class="button mw_close">Отмена</a>
				</div>
			</div>
		</form>
	</div>
</div>
<script src="<?=site_url() ?>js/mw_project.js"></script>