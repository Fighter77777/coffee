	<div class="content task_list-page">
		<div class="wrap">
			<div class="row">
				<form method="post" action="<?php echo base_url(); ?>projectslist">
					<div class="panel">
						<header>
							<div class="inputs white">							
								<div class="l-lft" style='width: 74%'>
									<div class="row">
										<div class="field">
											<label for="">Название проекта</label>
											<input type="text" name='search_txt' value="<?php echo $sel_txt ?>">
										</div>
									</div>
									<div class="row fields3">
										<div class="field">
											<label for="">Ответственный</label>
											<div class="select">
												<ins></ins><span class="cur"><?php echo $sel_resp_v ?></span>
												<div class="sel_box">
													<a resp_id='0'><все></a>
													<?php if(!empty($responsible)){													
													  foreach ($responsible as $uid=>$unm){ ?>													  													
														<a resp_id=<?php echo $uid; ?>><?php echo $unm; ?></a>	
													  <?php }	
													} ?>
												</div>
											</div>
											<input type="hidden" name='search_responsible'  value="<?php echo $sel_resp_id; ?>">
										</div>
										<div class="field">
											<label for="">Статус</label>
											<div class="select">
												<ins></ins><span class="cur"><?php echo $sel_stat_v ?></span>
												<div class="sel_box">
													<a stat_id='0'><все></a>															
													<?php if(!empty($status)){													  
													  foreach ($status as $k=>$v){ ?>													  											
														<a stat_id=<?php echo $k; ?>><?php echo $v; ?></a>	
													  <?php }	
													} ?>												
												</div>
												<input type="hidden" name='search_status' value="<?php echo $sel_stat_id; ?>">
											</div>
										</div>
										<div class="field">
											<label for="">Категория</label>
											<div class="select">
												<ins></ins><span class="cur"><?php echo $sel_cat_v ?></span>
												<div class="sel_box">
													<a cat_id='0'><все></a>													
													<?php if(!empty($cat)){
													  foreach ($cat as $k=>$v){ ?>														  													
														<a cat_id=<?php echo $k; ?>><?php echo $v; ?></a>	
													  <?php }	
													} ?>
												</div>
												<input type="hidden" name='search_category' value="<?php echo $sel_cat_id; ?>">
											</div>
										</div>
									</div>
								</div>
								<div class="l-rgt" style='width: 24%'>
									<div class="row">
										<span class="w_check white " style='margin-top: 20px; margin-bottom: 32px;'>
											<i></i>Только мои проекты
											<ins class="info_ic w_tip" title="отображать только проекты, созданные вами или назначенные на ваше имя"></ins>
											<input type="hidden" name='only_my'  value="<?php echo $only_my; ?>">
										</span>
									</div>
									<div class="row">
										<input class="button white" type="submit" value="Показать" >
									</div>
								</div>							
							</div>
						</header>
						<div class="pad">
							<div class="content-table">
								<table>
									<tr class="tbl_head">
										<td class='ta-lft'><a class='<?php if($sort_order=='name') {echo'active'; if($sort_direction=='asc')echo' up';} ?>' href='<?php echo $sort_name; ?>'>проект</a></td>
										<td class="dline"><a class='<?php if($sort_order=='deadline') {echo'active'; if($sort_direction=='asc')echo' up';} ?>' href='<?php echo $sort_deadline; ?>'>дедлайн</a></td>
										<td><a class='<?php if($sort_order=='open_task'){echo'active'; if($sort_direction=='asc')echo' up';} ?>' href='<?php echo $sort_open_task; ?>'>задач</a></td>
										<td class="responsible"><a class='<?php if($sort_order=='user_n')   {echo'active'; if($sort_direction=='asc')echo' up';} ?>' href='<?php echo $sort_user_n; ?>'>ответственный</a></td>
										<td><a class='<?php if($sort_order=='status')   {echo'active'; if($sort_direction=='asc')echo' up';} ?>' href='<?php echo $sort_status; ?>'>статус</a></td>
										<td><a class='<?php if($sort_order=='category') {echo'active'; if($sort_direction=='asc')echo' up';} ?>' href='<?php echo $sort_category; ?>'>категория</a></td>
										<td></td>
									</tr>								
									<?php if(!empty($table))
											foreach ($table as $tbl){ 																		
									?>												
												<tr class=''>
													<td class="title"><a href="<?=base_url().'project/'.$tbl['id']?>"><?php echo $tbl['name']; ?></a></td>
													<td class="dline">до <?php echo $tbl['deadline']; ?></td>
													<td class="tasks_count">
														<div class="w_tip">
															<a class="w_tip" title="количество открытых задач"><?php echo $tbl['open_task']; ?></a>/<a class="w_tip" title="общее количество задач"><?php echo $tbl['tsk_all']; ?></a>
														</div>
													</td>
													<td class="responsible">
														<div class="user_sm">
															<img src="<?php echo $tbl['avatar']; ?>" alt="">
															<a href="<?php echo base_url()."profile/".$tbl['uid']; ?>"><?php echo $tbl['user_n']; ?></a>
														</div>
													</td>
													<td class="status"><?php echo $tbl['stat_n']; ?></td>
													<td class="category"><a"><?php echo $tbl['cat_n']; ?></a></td>
													<td class='open'><a class="show_tasks" task_id="<?php echo $tbl['id']; ?>"></a></td>
												</tr>
									<?php }	?>								
								</table>
							</div>
	
							<!-- paging -->
							<div class="row">
								<div class="per_page">
									<label>Задач на странице</label>
									<div class="field">
										<div class="select">
											<span class="cur"><?php echo $tsk_in_page; ?></span>
											<ins></ins>
											<div class="sel_box" sort_rt='<?php echo $numb_rec_url_right; ?>'>
												<a href='<?php echo $numb_rec_url_left; ?>10'>10</a>
												<a href='<?php echo $numb_rec_url_left; ?>15'>15</a>
												<a href='<?php echo $numb_rec_url_left; ?>20'>20</a>
											</div>
											<input type="hidden" name='tsk_in_page'  value="<?php echo $tsk_in_page; ?>">
										</div>
									</div>
								</div>
								<?php echo $this->pagination->create_links(); ?>
							</div>
							<!-- /paging -->
						</div>
					</div>
				</form>
			</div>		
		</div>
	

	</div>