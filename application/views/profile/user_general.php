<div class="pad">
	<div class=" <?=isset($comments['list'])?'half':''?> project-info user-info">
		<div class="row user">
			<img src="<?=$user->user_pic?>" alt="">
			<h3><?=$user->name?></h3>
		</div>
		<div class="row"><label for="">Зарегистрирован:</label><span><?=$user->d_reg?></span></div>
		<div class="row"><label for="">Должность:</label><span><?=$user->positions?></span></div>
		<hr>
		<div class="row"><label for="">E-mail:</label><span><?=$user->email?></span></div>
		<div class="row"><label for="">Телефон(моб):</label><span><?=$user->phone?></span></div>
		<div class="row"><label for="">Телефон(вн):</label><span><?=$user->inner_phone?></span></div>
	</div>
	<?php if (isset($comments['list'])):?>
		<div class="half">
			<div class="activity">
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
							<span class="title"><a href="profile/<?=$c['user_id']?>"><?php echo $c['name']; ?></a></span>
							<time><?php echo $c['time']; ?></time>
							<p class="info">
								<?=$c['comment'];?>
							</p>
							<?php if (isset($c['files'])): ?>
								<div class="files">
									<?php foreach ($c['files'] as $files): ?>
										<div class="file">
											<i class='f-word'></i>
											<span><?=$files?></span>
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