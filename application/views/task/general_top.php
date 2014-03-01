<div class="pad">
	<div class="project-info">
		<h2 class="editable" id="_title">
			<ins></ins>
			<span id="editable_name" style="display:none"><input id="task_edit" value='<?=$task['name']?>'></span>
			<span id="task_name"><?=nl2br($task['name'])?></span>
		</h2>
		<div class="row"><label for="">Дата создания:</label><span><?=$task['date']?></span></div>
		<div class="row"><label for="">Дата завершения:</label><span><?=$task['deadline']?></span></div>
		<div class="row"><label for="">Статус:</label><span><?=$task['status']?></span></div>
		<div class="row"><label for="">Важность:</label><span><?=$priority?></span></div>
		<div class="users">
			<div class="row">
				<label for="">Создал:</label>
				<div class="user_sm">
					<img src="<?=$task['author_user_pic']?>" alt="">
					<a href="/profile/<?=$task['author']?>"><?=$task['author_user_name']?></a>
				</div>
			</div>
			<div class="row">
				<label for="">Ответственный:</label>
				<div class="user_sm">
					<img src="<?=$task['responsible_user_pic']?>" alt="">
					<a href="/profile/<?=$task['responsible']?>"><?=$task['responsible_user_name']?></a>
				</div>
			</div>
		</div>
		<div class="row">
			<label for="">Описание:</label>
			<div class="txt editable" id="_description">
				<ins></ins>
				<span id="task_description"><p id="edited_text"><?=nl2br($task['description'])?></p></span>
				<span id="editable_description" style='display: none;'><textarea id="t_desc" cols="1" rows="8"><?=$task['description']?></textarea></span>
			</div>
		</div>
		<?php if (isset($task['files'])): ?>
		<div class="row">	
			<label for="">Файлы</label>
			<div class="files">
				<?php foreach ($task['files'] as $file): ?>
					<div class="file">
						<a href="<?=$file['path']?>" class="download_file">
							<i><img src="<?=$file['icon']?>"></i>
						</a>
						<span><?=$file['name'];?></span>
					</div>
				<?php endforeach;?>
			</div>
		</div>
		<?php endif; ?>
	</div>