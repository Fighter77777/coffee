<div class="pad">
	<div class="activity">
		<?php if ($comments['items_count'] > $comments['items_on_page']): ?>

			<div class="row">
				<a href="" class="button show_old">Показать предыдущие <?php print($comments['items_count'] - $comments['items_on_page']); ?> комментарии</a>
			</div>
		<?php endif; ?>
		<?php if (isset($comments['list'])): ?>
			<?php foreach ($comments['list'] as $date => $comment): ?>		
				<div class="day-cont">
					<span class="date"><?php echo $date; ?></span>
					<ul class="activity-list">
						<?php foreach ($comment  as $id => $c): ?>
							<li>
								<?php if ($current_user_id == $c['user_id']):?>
									<a class="del" data-id ="<?php echo $id; ?>"></a>
								<?php endif;?>
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
											<a class="remove-file f_comment" data-id="<?=$id?>" href=""></a>
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
		<?php endif;?>
	</div>
	<div class="inputs add_comment">
		<form  name = "comment_form" id="comment_form"  method="POST">
			<div class="row">
				<h3>Добавить комментарий</h3>
				<div class="field">
					<textarea name="comment_area" id="comment_area" cols="30" rows="10"></textarea>
				</div>
			</div>
			<div class="row">
				<label for="">Файлы</label>
				<div id="commentsDrop" class="drop file-drag">
					<div class="step-1">
						<h1>Для загрузки файлов кликните на данную область или перетащите в нее файлы</h1>
						<!-- <h1>Перетащите файлы в данную область</h1> -->
					</div>
					<div class="fallback">
					    <input name="file" type="file" multiple />
					</div>
				</div>
			</div>
			<div class="row" style='margin-bottom: 0;'>
				<a class="button l-rgt" id="send">Опубликовать</a>
			</div>
		</form>
	</div>
	<br class="clear">

</div>

