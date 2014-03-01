<?php if(!empty($log)) 
		foreach($log as $day=>$events):								
?>
	<div class="day-cont">
		<span class="date"><?php echo $day; ?></span>
		<ul class="activity-list">	
			<?php foreach($events as $e): ?>									
			<li>
				<img src="i/userpic_thumb.png" alt="">
				<span class="title"><a href=""><?php echo $e['str']; ?></span>
				<time ><?php echo $e['time']; ?></time>
				<?php if(!empty($e['comm'])): ?>	
					<p class="info">
						<?php echo $e['comm']; ?>
					</p>
				<?php endif; ?>
			</li>										
			<?php endforeach; ?>
		</ul>
	</div>
<?php endforeach; ?>