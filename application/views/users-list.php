	<div class="content users-list_page">
		<div class="wrap">
			<div class="row">
				<div class="panel">
					<header>
						<div class="inputs white">
							<form method="post" action="<?php echo base_url(); ?>userslist">
								<div class="l-lft" style='width: 74%'>
									<div class="row">
										<div class="field">
											<label for="">Поиск сотрудников</label>
											<input type="text" name='search_txt' value="<?php echo $sel_txt ?>">
										</div>
									</div>
								</div>
								<div class="l-rgt" style='width: 24%; margin-top: 18px;'>	
									<input type="hidden" name='tsk_in_page'  value="<?php echo $tsk_in_page; ?>">							
									<input class="button white" type="submit" value="Показать" >
								</div>
							</form>
						</div>
					</header>
					<div class="pad">
						<div class="row" style='margin-top: 20px;'>
							<a class="button blue add_user">Добавить сотрудника</a>
						</div>
						<div class="content-table user-list">
							<table>
								<tr class="tbl_head" >
									<td class='ta-lft'><a class='<?php if($sort_order=='name') {echo'active'; if($sort_direction=='asc')echo' up';} ?>' href='<?php echo $sort_name; ?>'>ФИО</a></td>
									<td><a class='<?php if($sort_order=='date_reg')  {echo'active'; if($sort_direction=='asc')echo' up';} ?>' href='<?php echo $sort_date_reg; ?>'>дата регистрации</a></td>
									<td><a class='<?php if($sort_order=='open_tasks') {echo'active'; if($sort_direction=='asc')echo' up';} ?>' href='<?php echo $sort_open_tasks; ?>'>задачи</a></td>
									<td><a class='<?php if($sort_order=='open_projects') {echo'active'; if($sort_direction=='asc')echo' up';} ?>' href='<?php echo $sort_open_projects; ?>'>проекты</a></td>
									<td><a class='<?php if($sort_order=='positions') {echo'active'; if($sort_direction=='asc')echo' up';} ?>' href='<?php echo $sort_positions; ?>'>должность</a></td>
								</tr>
								<?php if(!empty($table))
											foreach ($table as $tbl){ 																		
								?>	
									<tr title=''>
										<td class="title">
											<div class="user_sm">
												<img src="<?php echo $tbl['avatar']; ?>" alt="">
												<a href="<?php echo base_url().'profile/'.$tbl['id']; ?>"><?php echo $tbl['user_n']; ?></a>
											</div>
										</td>
										<td class="date_reg"><?php echo $tbl['date_reg']; ?></td>
										<td class="">
											<div>
												<a class="w_tip" title="количество открытых задач"><?php echo $tbl['open_tasks']; ?></a>
												/
												<a class="w_tip" title="общее количество задач"><?php echo $tbl['all_tasks']; ?></a>
											</div>
										</td>
										<td class="">
											<div>
												<a class="w_tip" title="количество открытых задач"><?php echo $tbl['open_projects']; ?></a>
												/
												<a class="w_tip" title="общее количество задач"><?php echo $tbl['all_projects']; ?></a>
											</div>
										</td>
										<td class=""><a href=""><?php echo $tbl['positions']; ?></a></td>
									</tr>								
								<?php }	?>									
							</table>
						</div>

						<!-- paging -->
						<div class="row">
							<div class="per_page">
								<label>Пользователей на странице</label>
								<div class="field">
									<div class="select">
										<span class="cur"><?php echo $tsk_in_page; ?></span>
										<ins></ins>
										<div class="sel_box" sort_rt='<?php echo $numb_rec_url_right; ?>'>
											<a href='<?php echo $numb_rec_url_left; ?>10'>10</a>
											<a href='<?php echo $numb_rec_url_left; ?>15'>15</a>
											<a href='<?php echo $numb_rec_url_left; ?>20'>20</a>
										</div>
									</div>
								</div>
							</div>
							<?php echo $this->pagination->create_links(); ?>
						</div>
						<!-- /paging -->
					</div>
				</div>
			</div>		
		</div>
	

	</div>