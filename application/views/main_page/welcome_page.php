	<div class="content mainpage">
		<div class="wrap">
			<h1>Здравствуйте, <?php echo $_SESSION['user_name'] ?></h1>
			<div class="row">
				<div class="half">
					<div class="panel last_tasks">
						<header><h2>Мои задачи</h2></header>
						<div class="pad">
							<?php if(!empty($tasks_in_prjs))
									foreach ($tasks_in_prjs as $prj_id => $tasks):
							?>
							<div class="project">
								<h3><?php echo $projects[$prj_id]; ?></h3>
								<ul class="task-list">
									<?php foreach ($tasks as $task): ?>
										<li class="pr-<?php echo $task['important']; ?>"><ins></ins><a class="title" href="<?php echo base_url().'task/'.$task['tid'];?>"><?php echo $task['t_name']; ?></a><span class="date last">до <?php echo $task['deadline']; ?></span></li>									
									<?php endforeach; ?>
								</ul>
							</div>							
							<?php endforeach; ?>
						</div>
						<div class="row panel-bottom">
							<a href="<?php echo base_url(); ?>taskslist" class="more">смотреть все</a>
						</div>
					</div>
				</div>
				<div class="half">
					<div class="panel gray activity">
						<header><h2>Последняя активность</h2></header>
						<div class="pad">

							<?php  $count_log=count($log); $n=0;
								if($log) 
									foreach($log as $day=>$events):								
							?>
								<div class="day-cont">
									<span class="date"><?php echo $day; ?></span>
									<ul class="activity-list">	
										<?php foreach($events as $e): 
												$n++;
												if ($n>$max_log)  break 2 ;
										 			
										?>									
										<li>
											<img src="<?php echo $e['avatar'] ?>" alt="">
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
							<?php if ($n>=$max_log)  break  ;
								  endforeach; 
							?>							
						</div>
						<div class="row panel-bottom">
							<!--a href="" class="more">показать еще</a> -->
						</div>
					</div>
				</div>
			</div>		
		</div>
	

	</div>