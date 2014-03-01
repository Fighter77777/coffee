					<header>
						<form method="post" action="<?php echo base_url(); ?>profile/<?php echo $user_id ?>/activity">
							<div class="inputs white">
								<div class="row type button-group">
									<label for="">Тип</label>
									<a class="button white <?php if(!empty($only_tasks)) echo active; ?>" tp="only_tasks">Работа с задачами</a>
									<input type="hidden" name='only_tasks'  value="<?php echo $only_tasks; ?>">
									<a class="button white <?php if(!empty($only_comments)) echo active; ?>" tp="only_comments">Комментарии</a>
									<input type="hidden" name='only_comments'  value="<?php echo $only_comments; ?>">
									<a class="button white <?php if(!empty($only_files)) echo active; ?>" tp="only_files">Файлы</a>
									<input type="hidden" name='only_files'  value="<?php echo $only_files; ?>">
									<a class="button white <?php if(!empty($only_responsibles)) echo active; ?>" tp="only_responsibles">Ответственный</a>
									<input type="hidden" name='only_responsibles'  value="<?php echo $only_responsibles; ?>">
									<a class="button white <?php if(!empty($only_status)) echo active; ?>" tp="only_status">Статус</a>
									<input type="hidden" name='only_status'  value="<?php echo $only_status; ?>">
								</div>
								<div class="row">
									<div class="field user_filter">
										<label for="">Проекты</label>
										<div class="select">
											<ins></ins><span class="cur"><?php echo (!empty($proj[$project_id]))?$proj[$project_id]:"<все>" ?></span>
											<div class="sel_box">
												<a proj_id='0'><все></a>	
												<?php if(!empty($proj)){
												  foreach ($proj as $k=>$v){ ?>														  													
													<a proj_id=<?php echo $k; ?>><?php echo $v; ?></a>	
												  <?php }	
												} ?>
											</div>
											<input type="hidden" name='search_proj' value="<?php echo $project_id; ?>">
										</div>	
									</div>
									<input class="button white show" type="submit" value="Показать" >
								</div>
							</div>
						</form>
					</header>
					<div class="pad">
						<div class="activity">
							<?php if(!empty($log)) 
									foreach($log as $day=>$events):								
							?>
								<div class="day-cont">
									<span class="date"><?php echo $day; ?></span>
									<ul class="activity-list">	
										<?php foreach($events as $e): ?>									
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
							<?php endforeach; ?>						
						</div>
						<br class="clear">

					</div>