<?php
class Profile extends CI_Controller {
	function index($id = 0, $section = 0) {
		$this -> signIn();

		$this -> load -> model(array('users', 'content'));
		$script['add_scripts'] = array('controls');
		$script['activ_menu'] = "UsersList";
		$data['user_name'] = $this -> users -> getNamesList('NL', $id);
		$data['user_id'] = $id;
		$data['section'] = $section;

		if (!$section || $section == 'index') {
			$data2['user'] = $this -> users -> getUser($id, "NL");
			$data2['comments'] = $this -> content -> getCommentsList($id, 3, 'user_id');
			$data['content'] = $this -> load -> view('profile/user_general', $data2, true);
			$data['section'] = 'index';
			$data['div_tp'] = 'project-general';
		} else if (method_exists($this, $section)) {
			if ($section == 'tasks') {
				$script['add_scripts'][] = 'filters_projectslist';
				$data['div_tp'] = 'user-tasks';
			} elseif ($section == 'activity') {
				$script['add_scripts'][] = 'activity';
				$data['div_tp'] = 'project-activity';
			} else
				$data['div_tp'] = 'project-general';
			$data['content'] = $this -> $section($id);
		} else {
			echo '404';
			die();
		}

		$this -> load -> view('navigation/header', $script);
		$this -> load -> view('profile/panel', $data);
		$this -> load -> view('navigation/footer');

	}

	private function activity($id) {
		$this -> load -> model(array('Log', 'tasks'));
		if ($id) {
			$log = $this -> Log -> sort = 1;
			$log_arr = array('user_id' => $id);
			$cat = -1;
			if (!empty($_POST)) {
				if (!empty($_POST['only_tasks']))
					$log_arr['only_tasks'] = $_POST['only_tasks'];
				if (!empty($_POST['only_comments']))
					$log_arr['only_comments'] = $_POST['only_comments'];
				if (!empty($_POST['only_files']))
					$log_arr['only_files'] = $_POST['only_files'];
				if (!empty($_POST['only_responsibles']))
					$log_arr['only_responsibles'] = $_POST['only_responsibles'];
				if (!empty($_POST['only_status']))
					$log_arr['only_status'] = $_POST['only_status'];
				if (!empty($_POST['search_proj'])) {
					echo '111';
					$log_arr['project_id'] = $_POST['search_proj'];
					$cat = $this -> Log -> categoryProjects($log_arr['project_id']);
				} elseif(count($log_arr)>2){
						$cat = -2;
				}
			}
			//echo $cat.'cat';
			$log_arr['log'] = $this -> Log -> getEventsStr($cat, $log_arr);
			/*echo "<pre>";
			 var_dump($log_arr['log']);
			 echo "</pre>!!!!!";*/
			$log_arr['proj'] = $this -> tasks -> getProjectsList();
			

			$response = $this -> load -> view('profile/activity', $log_arr, true);

			return $response;
		}
		return redirect(base_url() . 'projectslist');
	}

	function signIn() {

		$entered = $this -> login -> enter();

		if (!$entered) {
			echo $this -> load -> view('navigation/header', 0, true);
			echo $this -> load -> view('main_page/login_page', 0, true);
			die();
		}
	}

	public function tasks($s_user = NULL) {
		$entered = $this -> login -> enter();

		if ($entered) {
			if ($s_user < 1)
				redirect(base_url() . 'userslist', 'refresh');
			//якщо не коректний id перекидаєм на спис. користувачів
			$this -> load -> model(array('users', 'projects', 'tasks', 'ctrl'));
			$this -> load -> library('pagination');

			$count_on_pg = $this -> uri -> rsegment(5);
			$s_txt = $this -> uri -> rsegment(6);
			$s_resp = $this -> uri -> rsegment(7);
			$s_stat = $this -> uri -> rsegment(8);
			$s_proj = $this -> uri -> rsegment(9);
			$s_my_pr = $this -> uri -> rsegment(10);
			$order = $this -> uri -> rsegment(11);
			$order_direction = $this -> uri -> rsegment(12);

			$s_txt_db = ($s_txt != 'search_text') ? rawurldecode($s_txt) : NULL;
			//обнуляем значения "пустышки"
			$s_resp_db = ($s_resp != 'responsible') ? $s_resp : NULL;
			$s_stat_db = ($s_stat != 'status') ? $s_stat : NULL;
			$s_proj_db = ($s_proj != 'project') ? $s_proj : NULL;
			$s_my_pr_db = ($s_my_pr == 'only_my') ? 1 : $s_my_pr;
			$order_db = ($order != 'sorting') ? $order : NULL;
			$order_direction_db = ($order_direction != 'direction') ? $order_direction : NULL;

			$body_dat['responsible'] = $this -> users -> getNamesList();
			//дані для випадаючих списків
			$body_dat['status'] = $this -> projects -> getStatusList();
			$body_dat['proj'] = $this -> tasks -> getProjectsList();

			if (!empty($_POST)) {
				//var_dump($_POST);
				$terms = $_POST;
				//фільтри для запита вибрані користувачем

			} else {
				$terms = array('search_txt' => $s_txt_db, 'search_responsible' => $s_resp_db, 'search_status' => $s_stat_db, 'search_category' => $s_proj_db, 'only_my' => $s_my_pr_db);
			}
			$terms['search_user'] = $s_user;
			$body_dat['sel_resp_v'] = $body_dat['sel_stat_v'] = $body_dat['sel_proj_v'] = '<все>';

			//передача вибраних значень в URL для пагінації і сортування та відображення на формі вибраних значень
			$body_dat['user_id'] = $terms['search_user'];
			$order_direction_db = ($order_direction != 'direction') ? $order_direction : NULL;
			if (!empty($terms['search_txt']))
				$body_dat['sel_txt'] = $s_txt = htmlspecialchars($terms['search_txt']);
			else
				$s_txt = 'search_text';
			if (!empty($terms['search_responsible'])) {
				$body_dat['sel_resp_id'] = $s_resp = (int)$terms['search_responsible'];
				$body_dat['sel_resp_v'] = $body_dat['responsible'][$terms['search_responsible']];
			} else
				$s_resp = 'responsible';
			if (!empty($terms['search_status'])) {
				$body_dat['sel_stat_id'] = $s_stat = (int)$terms['search_status'];
				$body_dat['sel_stat_v'] = $body_dat['status'][$terms['search_status']];
			} else
				$s_stat = 'status';
			if (!empty($terms['search_category'])) {
				$body_dat['sel_proj_id'] = $s_proj = (int)$terms['search_category'];
				$body_dat['sel_proj_v'] = $body_dat['proj'][$terms['search_category']];
			} else
				$s_proj = 'project';
			if (!empty($terms['only_my']) || $terms['only_my'] == '0') {
				$body_dat['only_my'] = $terms['only_my'];
				$s_my_pr = $terms['only_my'];
			} else {
				$body_dat['only_my'] = 1;
				$s_my_pr = 'only_my';
			}
			if (!empty($order_db)) {
				$order = htmlspecialchars($order_db);
				$body_dat['sort_order'] = $order;
			} else
				$order = 'sorting';
			if (!empty($order_direction_db)) {
				$order_direction = htmlspecialchars($order_direction_db);
				$body_dat['sort_direction'] = $order_direction;
			} else
				$order_direction = 'direction';
			//var_dump($terms);
			//пагінація
			$config['total_rows'] = $this -> tasks -> count_all($terms);
			if (empty($count_on_pg) && empty($_POST['tsk_in_page']))
				$count_on_pg = $this -> ctrl -> constDB('user_tasks_num_pg');
			$config['per_page'] = (!empty($_POST['tsk_in_page'])) ? $_POST['tsk_in_page'] : (int)$count_on_pg;
			//к-ть записів на сторінку
			$config['num_links'] = 4;
			//Количество ссылок с цифрами, которое должно отображаться до и после номера выбранной страницы
			$start_but = '<span class="button">';
			$end_but = '</span>';
			$config['full_tag_open'] = '<div class="paging">';
			$config['full_tag_close'] = '</div>';
			$config['num_tag_open'] = $start_but;
			//Настройка ссылки с номером страницы
			$config['num_tag_close'] = $end_but;
			$config['cur_tag_open'] = '<span class="button active">';
			//Настройка ссылки "Текущая страница"
			$config['cur_tag_close'] = $end_but;
			$config['first_link'] = '<<';
			//Настройка ссылки "Начало"
			$config['first_tag_open'] = $start_but;
			$config['first_tag_close'] = $end_but;
			$config['last_link'] = '>>';
			//Настройка ссылки "Конец"
			$config['last_tag_open'] = $start_but;
			$config['last_tag_close'] = $end_but;
			$config['next_link'] = '>';
			//Настройка ссылки "Следующий"
			$config['next_tag_open'] = $start_but;
			$config['next_tag_close'] = $end_but;
			$config['prev_link'] = '<';
			//Настройка ссылки "Предыдущий"
			$config['prev_tag_open'] = $start_but;
			$config['prev_tag_close'] = $end_but;
			$config['uri_segment'] = 12;
			// указываем где в URL номер страницы
			$sort_url = base_url() . "profile/{$s_user}/tasks/{$config['per_page']}/{$s_txt}/{$s_resp}/{$s_stat}/{$s_proj}/{$s_my_pr}/";
			//для початку ссилкі сортування
			$config['base_url'] = $sort_url . "{$order}/{$order_direction}/";
			//для ссилкі пагінаціїї

			$this -> pagination -> initialize($config);
			$config['curr_pg'] = $this -> uri -> rsegment($config['uri_segment']);
			//зміщення
			$body_dat['tsk_in_page'] = $config['per_page'];

			$body_dat['table'] = $this -> tasks -> dataForTabProj($config['curr_pg'], $config['per_page'], $terms, $order_db, $order_direction_db);
			//масив - список проектів

			$body_dat['sort_name'] = $this -> sort_url('name', $sort_url, $order, $order_direction);
			//посилання для сортування
			$body_dat['sort_deadline'] = $this -> sort_url('deadline', $sort_url, $order, $order_direction);
			$body_dat['sort_open_tasks'] = $this -> sort_url('open_tasks', $sort_url, $order, $order_direction);
			$body_dat['sort_user_n'] = $this -> sort_url('user_n', $sort_url, $order, $order_direction);
			$body_dat['sort_status'] = $this -> sort_url('status', $sort_url, $order, $order_direction);
			$body_dat['sort_project'] = $this -> sort_url('project', $sort_url, $order, $order_direction);
			$body_dat['numb_rec_url_left'] = base_url() . 'profile/' . $s_user . '/tasks/';
			$body_dat['numb_rec_url_right'] = "/{$order}/{$order_direction}/";
			//для формування посилання з кількістю записів на сторінку

			return $this -> load -> view('profile/tasks', $body_dat, TRUE);
			//основна таблиця
		} else {
			return $this -> load -> view('main_page/login_page', array(), TRUE);
		}
	}

	private function sort_url($column, $sort_url, $order, $order_direction) {
		$direction = ($column == $order && ($order_direction != 'desc')) ? 'desc' : 'asc';
		return "{$sort_url}{$column}/{$direction}";
	}

}
