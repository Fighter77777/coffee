<div class="pad">
	<div class="half project-info" <?=(!isset($project['comments']) ? "style='width:100%'" : '')?> >
		<h2 id="_title" class='editable'>
			<ins></ins>
			<span id="editable_name" style="display:none"><input id="task_edit" value='<?=$project['name']?>'></span>
			<span id="task_name"><?=nl2br($project['name'])?></span>
		</h2>
		<div class="row"><label for="">Дата создания:</label><span><?=$project['date']?></span></div>
		<div class="row"><label for="">Дата завершения:</label><span><?=$project['deadline']?></span></div>
		<div class="row"><label for="">Статус:</label><span><?=$project['status']?></span></div>
		<div class="row"><label for="">Категория:</label><span><?=$category?></span></div>	
		<div class="users">
			<div class="row">
				<label for="">Создал:</label>
				<div class="user_sm">
					<img src="<?=$project['author_user_pic']?>" alt="">
					<a href="/profile/<?=$project['author']?>"><?=$project['author_user_name']?></a>
				</div>
			</div>
			<div class="row">
				<label for="">Ответственный:</label>
				<div class="user_sm">
					<img src="<?=$project['responsible_user_pic']?>" alt="">
					<a href="/profile/<?=$project['responsible']?>"><?=$project['responsible_user_name']?></a>
				</div>
			</div>
		</div>
		<div class="row">
			<label for="">Описание:</label>
			<div class="txt editable" id="_description">
				<ins></ins>
				<span id="task_description"><p id="edited_text"><?=nl2br($project['description'])?></p></span>
				<span id="editable_description" style='display: none;'><textarea id="t_desc" cols="1" rows="8"><?=$project['description']?></textarea></span>
			</div>
		</div>
		<?php if (isset($project['files'])): ?>
		<div class="row">	
			<label for="">Файлы</label>
			<div class="files">
				<?php foreach ($project['files'] as $file): ?>
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
	<?php if (isset($project['comments'])): ?>
		<div class="half">
			<div class="activity">
				<?php foreach ($project['comments'] as $date => $comment): ?>		
					<div class="day-cont">
						<span class="date"><?php echo $date; ?></span>
						<ul class="activity-list">
							<?php foreach ($comment  as $id => $c): ?>
								<li>
									<img src="<?=$c['user_pic']?>" alt="">
									<span class="title"><a href="/profile/<?=$c['user_id']?>"><?php echo $c['name']; ?></a></span>
									<time><?php echo $c['time']; ?></time>
									<p class="info">
										<?=nl2br($c['comment']);?>
									</p>
									<?php if (isset($c['files'])): ?>
										<div class="files">
											<?php foreach ($c['files'] as $id => $file): ?>
												<div class="file">
													<a href="<?=$file['path']?>" class="download_file">
														<i><img src="<?=$file['icon']?>"></i>
													</a>
													<span><?=$file['name'];?></span>
												</div>
											<?php endforeach;?>
										</div>
									<?php endif; ?>
								</li>
							<?php endforeach; ?>
						</ul> 
					</div>
				<?php endforeach; ?>
			</div> 
		</div>
	<?php endif;?>
	<br class="clear">
</div>