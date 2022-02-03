<?PHP
// APPLICATION STATE
class Activity extends Subroutine
{
	private $REDIR = 'index.php', $KEY = 'whois';
  final protected function redirect ($page)
	{
			$page = is_null($page)? $this->REDIR : $page;			
			echo '<script type="text/javascript">location.assign("'.$page.'")</script>';	
	}
  final public function postback ($id)
	{
		$result = $this->readonly('id',$id,true);
		return is_array($result)? $result : array();
	}	
  final public function register ($post, $next_page = null)
	{
		$result = $this->create($post); // returns insert_id if successful
		if (is_numeric($result))
		{
			$row = $this->hashmap($result);
			$this->setAccount($row);
			return is_null($next_page)? $row : $this->redirect($next_page);
		}
		else
			return $result;
	}
  final public function login ($post, $next_page = null)
	{
		$name = array_keys($post);
		$value = array_values($post);
		$row = $this->search($name[0],$value[0],true); // search username
		if (is_array($row))
		{
			if ($row['password'] == $value[1]) // compare password
			{
				$row['ip'] = $this->getIp();
				$row['proxy'] = $this->getProxy($row['date'],$row['id']);		
				$this->setAccount($row);
				return is_null($next_page)? $row : $this->redirect($next_page);
			}
			else
				return 409; // invalid password
		}
		else
			return 404; // invalid username
  }
  final public function logout ($next_page = null)
	{	
		if ($_GET['logout'] == true)
		{
			session_destroy(); 
			return $this->redirect($next_page);	
		}	
	}	
  final public function pagelock ($next_page = null)
	{	
		if (!isset($GLOBALS['pagelock']) && !isset($_SESSION[$this->KEY]))
				return $this->redirect($next_page);
	}	

  final public function setAccount ($row)
	{	
		$_POST = array();
		$_SESSION[$this->KEY] = (object)$row;
	}		
  final public function getAccount ()
	{	
		return $_SESSION[$this->KEY];
	}	
  final public function getProxy ($date, $id)
	{	
		// 2020-04-21 12:47:00
		$date = str_replace('-','',$date); // 20200421 12:47:00
		$date = str_replace(' ','',$date); // 2020042112:47:00
		$date = str_replace(':','',$date); // 20200421124700
		return $date.$id; // 202004211247001
	}		
  final public function getIp ()
	{	
		// get IP
		if ($_SERVER['HTTP_CLIENT_IP']) $ip = $_SERVER['HTTP_CLIENT_IP'];
		else if ($_SERVER['HTTP_X_FORWARDED_FOR']) $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		else if ($_SERVER['HTTP_X_FORWARDED']) $ip = $_SERVER['HTTP_X_FORWARDED'];
		else if ($_SERVER['HTTP_FORWARDED_FOR']) $ip = $_SERVER['HTTP_FORWARDED_FOR'];
		else if ($_SERVER['HTTP_FORWARDED']) $ip = $_SERVER['HTTP_FORWARDED'];
		else if ($_SERVER['REMOTE_ADDR']) $ip = $_SERVER['REMOTE_ADDR'];
		else $ip = $_SERVER['SERVER_ADDR'];
		// validate IP
		if (!filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) === false) return $ip;
		else if (!filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) === false) return $ip;
		else return $ip;
	}
	final public function setTraffic ($table = 'traffic')
	{
		if (!isset($GLOBALS['notraffic']))
		{
			$p->exclude = array 
			(
				'glo'=>'197.211.52.16',
				'mtn'=>'197.210.52.184',
				'debra'=>'169.254.219.6',
				'localhost'=>'127.0.0.1'
			);		
			$ip = $this->getIp();
			if (true) // !in_array($ip,$exclude)
			{
				$today = date('Y-m-d');					
				$this->setTable($table);
				$row = $this->search('ip',$ip,true);
				if (is_array($row))
				{
					$n = $row['counter'] + 1;
					$post = array('counter'=>$n,'entry'=>$today);
					return $this->update($post,'ip',$ip);
				}
				else
				{
					$post = array('ip'=>$ip,'entry'=>$today);
					return $this->create($post);
				}
			}
		}
	}		
	final public function getTraffic ($table = 'traffic')
	{
		$getHits = function($arr){$sum = 0; foreach($arr as $row) $sum += (int)$row['counter']; return $sum;};
		$this->setTable($table);
		$p = new stdClass();
		//////////////////////////////
		$p->table = $table;
		$p->ip = $this->getIp();
		$p->overall = (int)$this->getSum('counter');
		$p->unique = $this->getSize();
		//////////////////////////////
		$format = 'Y-m-d';
		$today = date($format);
		$sql_stmt = 'SELECT ip, counter FROM '.$p->table.' WHERE entry>="'.$today.'"';
		$row = $this->execute($sql_stmt);
		$p->today_unique = count($row);
		$perc = ($p->today_unique * 100) / $p->unique;
		$p->today_unique_rate = $perc > 0? round($perc).'%' : '0%';
		$p->today_overall = $getHits($row);
		$perc = ($p->today_overall * 100) / $p->overall;
		$p->today_overall_rate = $perc > 0? round($perc).'%' : '0%';		
		//////////////////////////////
		$flag = '-7 days';
		$strtotime = strtotime($today.' '.$flag);
		$week = date($format,$strtotime);
		$sql_stmt = 'SELECT ip, counter FROM '.$p->table.' WHERE entry>="'.$week.'"';
		$row = $this->execute($sql_stmt);
		$p->week_unique = count($row);
		$perc = ($p->week_unique * 100) / $p->unique;
		$p->week_unique_rate = $perc > 0? round($perc).'%' : '0%';
		$p->week_overall = $getHits($row);
		$perc = ($p->week_overall * 100) / $p->overall;
		$p->week_overall_rate = $perc > 0? round($perc).'%' : '0%';				
		//////////////////////////////
		$flag = '-30 days';
		$strtotime = strtotime($today.' '.$flag);
		$month = date($format,$strtotime);
		$sql_stmt = 'SELECT ip, counter FROM '.$p->table.' WHERE entry>="'.$month.'"';
		$row = $this->execute($sql_stmt);
		$p->month_unique = count($row);
		$perc = ($p->month_unique * 100) / $p->unique;
		$p->month_unique_rate = $perc > 0? round($perc).'%' : '0%';
		$p->month_overall = $getHits($row);
		$perc = ($p->month_overall * 100) / $p->overall;
		$p->month_overall_rate = $perc > 0? round($perc).'%' : '0%';				
		$p->row = $this->readonly('ip',$p->ip,true);
		$p->rows = $this->read();			
		return $p;
	}
	
}

?>
