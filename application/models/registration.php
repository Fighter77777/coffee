<?php
class Registration extends CI_Model{

	public $err;	//масив, який містить помилки, що сталися під час реєстрації
	private $salt;	//сіль для хеша пароля
	private $pass;	//пароль

	function __construct()
    {
         $this->err=array();
    }

	private function GenerateSalt($n=3)	//генератор солі
	{									//$n - к-ть символів
		$key = '';
		$pattern = '1234567890abcdefghijklmnopqrstuvwxyz.,*_-=+';
		$counter = mb_strlen($pattern,'utf8')-1;
		for($i=0; $i<$n; $i++)
		{
			$key .= $pattern{rand(0,$counter)};
		}
		return $key;
	}

	private function GeneratePassword($v)	//генератор хеша пороля
	{									    //$v - пароль який треба захеширувать
		$this->salt = $this->GenerateSalt();		   // генеруєм сіль
		$hashed_password = md5(md5($v) . $this->salt); // генеруєм хеш пароля
		return $hashed_password;
	}

	private function filterEmail($v=NULL,$id=NULL)	//повертає чи коректний імейл і чи не має користувача з таким же в БД
	{
		$email=filter_var($v, FILTER_VALIDATE_EMAIL);
		if($email){
			$this->db->select('id');
			$this->db->where('email', $email);
			if ($id > 0)
				$this->db->where('id !=', $id);
			$query = $this->db->get('users');
			if ($query->num_rows() > 0)
	   			$this->err['email_busy']=1;
			else
				return $email;
		}else
				$this->err['email_no_valid']=1;
		return FALSE;
	}


	private function filterWord($v=NULL,$min_str_len=3)
	{
		//echo $v.'!  ';
		$v=trim($v);
		if(!empty($v)){
			//echo mb_strlen($v,'utf8').'\n';
			if(mb_strlen($v,'utf8')>=$min_str_len){				
				return $this->security->xss_clean(htmlspecialchars($v, ENT_QUOTES,'UTF-8'));
			}
		}
		$this->err['no_valid']=1;
		return FALSE;
	}


	private function filterPass($v=NULL,$min_str_len=6)
	{
		if(!empty($v) && mb_strlen($v,'utf8')<$min_str_len){
			$this->err['pass_short']=1;
			return FALSE;
		}elseif(empty($v)){												 //якщо пароль не вказаний
			$v=substr(str_shuffle(uniqid('tmpPaSsW')),0,$min_str_len+1); // генеруєм пароль
		}
		return $this->GeneratePassword($v); // генеруєм хеш пароля
	}

	private function changePass($u_id=NULL,$old_p=NULL,$new_p1=NULL,$new_p2=NULL,$min_str_len=6)//перевіряє чи вірний старий пароль і валідний новий
	{																							//якщо так, то створює хеш і сіль для нового пароля
		if((int)$u_id<1) return FALSE;	//на всякий випадок
		if(empty($old_p) && empty($new_p1) && empty($new_p2)){	 //якщо пароль не вказаний
			return FALSE;    									 //то і мінять його не будем
		}elseif(!empty($old_p) && !empty($new_p1) && !empty($new_p2)){
			if (mb_strlen($old_p,'utf8')>=$min_str_len && mb_strlen($new_p1,'utf8')>=$min_str_len && $new_p1===$new_p2 ){
				$this->db->select('salt');
				$query_salt = $this->db->get_where('users', array('id' => $u_id),1);//отрим. сіль
                if($query_salt){
                	if ($query_salt->num_rows() > 0){
   						$row = $query_salt->row_array();						
   						$hashed_old_pass = md5(md5($old_p) . $row['salt']);				//генер. хеш старого пароля   						
						$this->db->select('id');
						$query_pass = $this->db->get_where('users', array('password' => $hashed_old_pass),1);
						if($query_pass){
							if ($query_pass->num_rows() > 0){
								$row_pswd = $query_pass->row_array();
								if ($row_pswd['id']==$u_id){				 //перевіряєм чи справді такий в цього користувача старий пароль  
   									return $this->GeneratePassword($new_p1); //якщо так, то генеруєм хеш нового пароля
								}
							}
							$this->err['pass_old_not_correctly']=1;
							return FALSE;
						}					
					}
				}
			}
		}
		$this->err['pass_short']=1;
		return FALSE;
	}


	private function filterNumber($v=NULL,$min_str_len=3,$max_str_len=NULL)
	{
		if(!empty($v)){
			$len_v=mb_strlen($v,'utf8');
			if($len_v<$min_str_len || (!empty($max_str_len) && $len_v>$max_str_len)){
				$this->err['tel']=1;
				return FALSE;
			}else
				return $v;
		}
		return FALSE;
	}
	
	private function filterGender($v='male')
	{
		if($v!='male')
			$v='female';
		return $v;
	}
	
	
	private function writeLog()
	{		
		$uid=$_SESSION['user_id'];
		$new_user_id=$this->db->insert_id();		
		if(!empty($uid) && !empty($new_user_id))
			$this->Log->write($uid,1, array('profile'=>$new_user_id));
	}


	public function createUser($ar_in=array())
	{	
		$email=$this->filterEmail($ar_in['email']);
		$password=$this->filterPass($ar_in['pass']);
		$surname=$this->filterWord($ar_in['surname'],2);
		$name   =$this->filterWord($ar_in['name'],2);
		$mid_name =$this->filterWord($ar_in['mid_name']);
		$positions=$this->filterWord($ar_in['positions']);
		$tel_in =$this->filterNumber($ar_in['tel_in']);
		$tel_mob =$this->filterNumber($ar_in['tel_mob'],10,12);
		$gender =$this->filterGender($ar_in['gender']);
		if(!empty($this->err))
			return FALSE;
		if(!empty($ar_in['avatar_name']))	//створюєм аватарки різних розмірів
			$avatar=$this->img_processor($ar_in['avatar_name']);
		if(!empty($this->err))
			return FALSE;
		$this->db->set('email',  $email);
		$this->db->set('surname',$surname);
		$this->db->set('name', $name);
		$this->db->set('mid_name', $mid_name);
		$this->db->set('gender',$gender);
		$this->db->set('positions',$positions);
		$this->db->set('password', $password);
		$this->db->set('salt', $this->salt);
		if($tel_mob) $this->db->set('phone', $tel_mob);
		if($tel_in)  $this->db->set('inner_phone', $tel_in);
		if($avatar)  $this->db->set('avatar', $avatar);

		if($this->db->insert('users')){
			$uid=$this->db->insert_id();
			$this->writeLog();
			return $uid;
		}
	}


	public function updateUser($uid=NULL,$ar_in=array())
	{
		$uid=(int)$uid;
		if(!$uid) return FALSE;
		//$password=$this->updPass($ar_in['pass']);
		$email=$this->filterEmail($ar_in['email'],$uid);
		$surname =$this->filterWord($ar_in['surname'],2);
		$name    =$this->filterWord($ar_in['name'],2);
		$mid_name=$this->filterWord($ar_in['mid_name']);
		$gender =$this->filterGender($ar_in['gender']);
		$positions=$this->filterWord($ar_in['positions']);
		$tel_in  =$this->filterNumber($ar_in['tel_in']);
		$tel_mob =$this->filterNumber($ar_in['tel_mob'],10,12);
		$password=$this->changePass($uid,$ar_in['old_pass'],$ar_in['new_pass1'],$ar_in['new_pass2']);
		if(!empty($this->err))
			return FALSE;
		if(!empty($ar_in['avatar_name']))	//створюєм аватарки різних розмірів
			$avatar=$this->img_processor($ar_in['avatar_name']);
		if(!empty($this->err))
			return FALSE;
		$this->db->set('email',  $email);
		$this->db->set('surname',$surname);
		$this->db->set('name', $name);
		$this->db->set('mid_name', $mid_name);
		$this->db->set('gender',$gender);
		$this->db->set('positions',$positions);
		if($password){
			$this->db->set('password', $password);
			$this->db->set('salt', $this->salt);
        }
		if($tel_mob) $this->db->set('phone', $tel_mob);
		if($tel_in)  $this->db->set('inner_phone', $tel_in);
		if($avatar)  $this->db->set('avatar', $avatar);
		
		$this->db->where('id', $uid);
		if($this->db->update('users')){
			$_SESSION['user_name']  = $name.' '.$surname;
			if($avatar)
				$_SESSION['user_avatar']= $avatar;
			return TRUE;
		}
	}

	public function img_loader($fl) // зберігає зображення в тимчасовій папці
	{
	  $imageinfo = getimagesize($fl["tmp_name"]);
	  if($imageinfo["mime"] != "image/gif" || $imageinfo["mime"] != "image/jpeg" || $imageinfo["mime"] !="image/png") {
	  	  $mime=explode("/",$imageinfo["mime"]);  //Разширення зображення
		  $namefile=explode(".",$fl["name"]);//Ім’я файла
		  $unic_point=substr(str_shuffle(uniqid('rAnd0m')),0,8).'_';	//для унікальності
		  $new_file_name=substr($unic_point.$this->GetInTranslit($namefile[0]),0,27).".".$mime[1];
		  $new_file=getConst('p_avatar_temp').$new_file_name;	//шлях куди перемістить файл
		  if (!move_uploaded_file($fl["tmp_name"], $new_file)) {
		    $this->err[]='img_not_move';
		  }else{		  
		  	return $new_file_name;
		  }
	  }else{
		 $this->err[]="img_mime";  
      }
      return FALSE;
	}
	
	
	public function img_processor($fl) // підготовка зображення для запису в БД
	{
	  $fl_path=getConst('p_avatar_temp').$fl;	  
	  if(file_exists($fl_path)){					//якщо файл існує
		  $file_name1=$this->resize($fl_path,getConst('p_avatar_small'),20,20);//робим прев’юшки
		  $imageinfo = getimagesize($fl_path);		  
		  $file_name2=$this->resize($fl_path,getConst('p_avatar_middle'),50,50);		 
		  if($file_name1 && $file_name2 && copy($fl_path, $_SERVER['DOCUMENT_ROOT'].'/'.getConst('p_avatar_original').$fl)){	//якщо вдалося, повертаємо її ім’я
		  	//unlink($fl_path);
		  	return $file_name1;		 
		  } 		
	  }		
	}

	function resize($adr,$dest,$wdth=0,$hgt=0){
		$size_img=getimagesize($adr); 		  
		$dest_img = imagecreatetruecolor($wdth, $hgt);  
		$color = imagecolorallocate($dest_img, 255, 255, 255);
		imagefill($dest_img,0,0,$color);
		
		if($wdth!=0 && $hgt!=0){
			$sc=$wdth/$hgt;
			$sc2=$size_img[0]/$size_img[1];
			if($sc>$sc2){
				$ypar=floor($size_img[0]/$sc);
				$xpar=floor($size_img[0]);
			}
			else {
				$ypar=floor($size_img[1]);
				$xpar=floor($size_img[1]*$sc);
			}
		}
		else {
			$sc=$size_img[0]/$size_img[1];
			if($wdth==0){
				$xpar=$size_img[0];
				$ypar=$size_img[1];
				$wdth=floor($hgt*$sc);
			}
			else {
				$xpar=$size_img[0];
				$ypar=$size_img[1];
				$hgt=floor($wdth/$sc);
			}
		}
		
		
		$srcx2=floor(($size_img[0]-$xpar)/2);
		$srcy2=floor(($size_img[1]-$ypar)/2);
		
		if ($size_img[2]==2)  $src_img = imagecreatefromjpeg($adr);                       
		elseif ($size_img[2]==1) $src_img = imagecreatefromgif($adr);                       
		elseif ($size_img[2]==3) $src_img = imagecreatefrompng($adr);
		
		imagecopyresampled($dest_img, $src_img, 0, 0, $srcx2, $srcy2, $wdth, $hgt, $xpar, $ypar);
		
		$path_parts = pathinfo($adr);
		$new_file_name=$path_parts['basename'];
		$new_file=$dest.$new_file_name;
		
		if ($size_img[2] == 2) { 
			imagejpeg($dest_img, $new_file, 94);	
		} 
		if ($size_img[2] == 1) { 
			imagegif($dest_img, $new_file, 94);	
		}
		if ($size_img[2] == 3) { 
			imagepng($dest_img, $new_file, 9);	
		} 
		return $new_file_name;
	}
	
	private function GetInTranslit($string) {	//транслітерація
		$replace=array(
			"'"=>"",
			"`"=>"",
			"а"=>"a","А"=>"a",
			"б"=>"b","Б"=>"b",
			"в"=>"v","В"=>"v",
			"г"=>"g","Г"=>"g",
			"д"=>"d","Д"=>"d",
			"е"=>"e","Е"=>"e",
			"ж"=>"zh","Ж"=>"zh",
			"з"=>"z","З"=>"z",
			"и"=>"i","И"=>"i",
			"й"=>"y","Й"=>"y",
			"к"=>"k","К"=>"k",
			"л"=>"l","Л"=>"l",
			"м"=>"m","М"=>"m",
			"н"=>"n","Н"=>"n",
			"о"=>"o","О"=>"o",
			"п"=>"p","П"=>"p",
			"р"=>"r","Р"=>"r",
			"с"=>"s","С"=>"s",
			"т"=>"t","Т"=>"t",
			"у"=>"u","У"=>"u",
			"ф"=>"f","Ф"=>"f",
			"х"=>"h","Х"=>"h",
			"ц"=>"c","Ц"=>"c",
			"ч"=>"ch","Ч"=>"ch",
			"ш"=>"sh","Ш"=>"sh",
			"щ"=>"sch","Щ"=>"sch",
			"ъ"=>"","Ъ"=>"",
			"ы"=>"y","Ы"=>"y",
			"ь"=>"","Ь"=>"",
			"э"=>"e","Э"=>"e",
			"ю"=>"yu","Ю"=>"yu",
			"я"=>"ya","Я"=>"ya",
			"і"=>"i","І"=>"i",
			"ї"=>"yi","Ї"=>"yi",
			"є"=>"e","Є"=>"e"
		);
		return $str=iconv("UTF-8","UTF-8//IGNORE",strtr($string,$replace));
	}

}