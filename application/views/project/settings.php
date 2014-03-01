<div class="pad">
	<div class="cont inputs">
		<div class="row">
			<div class="field">
				<label for="">Название проекта</label>
				<input name="project_name" type="text" value='<?=$current['name']?>'>
			</div>
		</div>
		<div class="row fields3">
			<div class="field">
				<label for="">Ответственный</label>
				<div class="select">
					<ins></ins><span id="project_responsible" data-id="<?=$current['responsible']?>" class="cur"><?=$current['responsible_user_name']?></span>
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
					<ins></ins><span id="project_status" data-id="<?=$current['status_id']?>" class="cur"><?=$current['status']?></span>
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
					<ins></ins><span id="project_category" data-id="<?=$current['category_id']?>" class="cur"><?=$current['category_name']?></span>
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
				<textarea id="project_description" cols="30" rows="10"><?=$current['description']?></textarea>
			</div>
		</div>
		<?php if (isset($current['files'])): ?>
		<div class="row">	
			<label for="">Файлы</label>
			<div class="files">
				<?php foreach ($current['files'] as $id => $file): ?>
					<div class="file">
							<i><img src="<?=$file['icon']?>"></i>
						<a class="remove-file" data-id="<?=$id?>" href=""></a>
						<span><?=$file['name'];?></span>
					</div>
				<?php endforeach;?>
			</div>
		</div>
		<?php endif; ?>
		<div class="row">
			<div id="psdrop" class="drop file-drag">
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
					<a id="ps_checkAll">отметить всех</a>
					<a id="ps_uncheckAll">убрать все отметки</a>
				</div>
			</div>
			<ul class="watchers">
				<?php foreach ($viewers as $id => $viewer):?>
					<li><span data-id="<?=$id?>" class="w_check <?=(in_array($id, $current['viewers'])?('checked'):'')?>"><i></i><?=$viewer?></span></li>
				<?endforeach;?>
			</ul>
		</div>
		<div class="row buts">
			<a href="" id="save_changes" class="button" style="width: 200px">Сохранить изменения</a>
		</div>
	</div>
	<br class="clear">
</div>
