
<?php if ($status!="error"):?>
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