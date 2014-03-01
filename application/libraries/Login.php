<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login  {

    protected $CI;
	protected $CookieLife;

    function __construct()
    {
       $this->CI =&get_instance();
		 $this->CookieLife=2592000; // время жизни куки - 30 дней
    }

	function logout(){    //Чистим сесію і кукі
		session_start();
		if (isset($_SESSION['user_id']))
			unset($_SESSION['user_id']);
		setcookie('id', '', 0, "/");
		setcookie('password', '', 0, "/");
		header('Location: '.$_SERVER['SCRIPT_NAME']);
		exit;       // і переходим на головну
	}

	function enter()
	{
		@session_start();		
		
	//------------------------Перевірка на авторизацію--------------------------//
		if (!isset($_SESSION['user_id']))   {	//если нет активной сесии пользователя
			// то проверяем его куки
			// вдруг там есть id и пароль пользователя сайта
			if (isset($_COOKIE['id']) && isset($_COOKIE['password'])) {
				// если же такие имеются
				// то пробуем авторизовать пользователя по этим логину и паролю
				$uid = $this->CI->db->escape($_COOKIE['id']);
				$password =$this->CI->db->escape($_COOKIE['password']);
				// и по аналогии с авторизацией через форму:
				// делаем запрос к БД
				// и ищем юзера с таким логином и паролем
				$txt_query = "SELECT `id`, CONCAT(name,' ', surname)AS`user_name`, avatar
							FROM `users`
							WHERE `id`={$uid} AND `password`=".$password."
							LIMIT 1";
				$query =$this->CI->db->query($txt_query);
				//$sql = mysql_query($query) or die(mysql_error());
				// если такой пользователь нашелся
				if ($query->num_rows() == 1)     {
					// то мы ставим об этом метку в сессии (допустим мы будем ставить ID пользователя)
					//$row = mysql_fetch_assoc($sql);
					$row=$query->row_array();
					$_SESSION['user_id']    = $row['id'];// не забываем, что для работы с сессионными данными, у нас в каждом скрипте должно присутствовать session_start();
					$_SESSION['user_name']  = $row['user_name'];
					$_SESSION['user_avatar']= $row['avatar'];
					return TRUE;
				}
			}
		} else {
			return TRUE;
		}

		//-----------------------------------Авторизація ч-з форму-----------------------------//
		if (!empty($_POST)){
			if (isset($_POST['authorization'])){
				if(!empty($_POST['password']) && !empty($_POST['login'])) {
					$login = ($_POST['login']);
					$t_query="SELECT `salt`
							 FROM `users`
							 WHERE `email`='{$login}'
							 LIMIT 1";
					//$sql = mysql_query($query) or die(mysql_error());
					//if (mysql_num_rows($sql) == 1)  {
					//	$row = mysql_fetch_assoc($sql);
					$query =$this->CI->db->query($t_query);
					if ($query->num_rows() == 1)     {
						$row=$query->row_array();
						$salt = $row['salt'];  // итак, вот она соль, соответствующая этому логину
						// теперь хешируем введенный пароль как надо и повторям шаги, которые были описаны выше:
						$password = md5(md5($_POST['password']) . $salt);
						// и пошло поехало...
						// делаем запрос к БД
						// и ищем юзера с таким логином и паролем
						$txt_query = "SELECT `id`, CONCAT(name,' ', surname)AS`user_name`, avatar
									FROM `users`
									WHERE `email`='{$login}' AND `password`=\"{$password}\"
									LIMIT 1";
						$query =$this->CI->db->query($txt_query);
						//$sql = mysql_query($query) or die(mysql_error());
						// если такой пользователь нашелся
						if ($query->num_rows() == 1)     {
						//if ((mysql_num_rows($sql) == 1)) {
							//$row = mysql_fetch_assoc($sql);
							$row=$query->row_array();
							$_SESSION['user_id'] = $row['id'];
							$_SESSION['user_name'] = $row['user_name'];
							$_SESSION['user_avatar'] = $row['avatar'];
							// если пользователь решил "запомнить себя"
							// то ставим ему в куку логин с хешем пароля
							$time =$this->CookieLife; 
							if (!empty($_POST['remember']))	{								
								setcookie('id', $row['id'], time()+$time, "/");
								setcookie('password', $password, time()+$time, "/");								
							};
							//setcookie('auth', 1, time()+7, "/");//для повідомлення про успішну авторизацію
							
							//header('Location: '.base_url());//------------
							//header('Location: '.$_SERVER['PHP_SELF']);
							//exit;
							//echo "string";
							return TRUE;
						}
	   		        }
	   		    }
				//setcookie('auth', -1, time()+8, "/");//для повідомлення про помилку при авторизації
	   		}
	   	}
		return FALSE;
	}

	
}

?>