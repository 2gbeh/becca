<?PHP
// DATA ACCESS OBJECT
class BeanUser extends BeanMaster
{
	public function prototype ()
	{
		var_dump (
			$this->admin(),
			$this->user(),
			$this->plan(),
			$this->dessert(),
			$this->allergies(),
			$this->meals(),
			$this->suggestions()
		);	
	}	
	public function plan ()
	{
		$db = $this->db;
		$tb = 'user_meal_plan';
		$tb_2 = 'meals';
		$dir = 'img/uploads/';
		$no_meal = 'img/no_meal.png';
		$id = $this->id;
		$db->setTable($tb);
		$row = $db->search('user_id',$id,true);
		$p = new stdClass();		
		////////////////////////////////////////////////////
		$enums = Enums::MEALS;
		$brk = 'breakfast_id'; $lun = 'lunch_id'; $din = 'dinner_id'; $des = 'dessert_id';
		$csv = array($brk=>$row[$brk], $lun=>$row[$lun], $din=>$row[$din], $des=>$row[$des]);
		$p->keys = array_values($csv);
		$inner = $assoc = array();
		foreach ($csv as $key => $value)
		{
			$db->setTable($tb_2);
			$assoc = (array)$db->hashmap($value);
			$inner['isset'] = count($assoc) > 0;
			$inner['image'] = $assoc['image'];
			$inner['src'] = $dir.$assoc['image'];
			$inner['bgimg'] = 'background-image:url('.$inner['src'].'); ';
			$inner['meal'] = $assoc['meal'];			
			$inner['summary'] = $assoc['summary'];
			$status = (int)$assoc['status'];
			$inner['group'] = Enums::translate($enums,$status);
			$strtotime = strtotime($assoc['date']);
			$inner['posted'] = date('M j \a\t h:i A',$strtotime);			
			$inner['id'] = (int)$value;
			$index = str_replace('_id','',$key);
			$p->rows->$index = $inner;
		}
		$p->nan = array (
			'image'=> array_pop(explode('/',$no_meal)),
			'src'=> $no_meal,
			'bgimg'=> 'background-image:url('.$no_meal.'); ',
			'meal'=> 'Suggested meal unavailable',
			'summary'=> 'Suggested meal no longer recommended due to allergic reaction.',
		);
		$p->cols = array($brk,$lun,$din,$des);
		$p->updated = array_shift(explode(' ',$row['date']));
		$p->id = $row['id'];
		return $p;
	}	
	public function refresh ()
	{
		$no_null = function($v) {return is_null($v)? 0:$v;};
		$db = $this->db;
		$tb = 'user_meal_plan';
		$id = $this->id;
		$p = new stdClass();		
		////////////////////////////////////////////////////
		$plan = $this->plan();
		$today = date('Y-m-d');
		if ($plan->updated != $today) // update if date of current meal_plan not today
		{
			$cols = $plan->cols;
			$avail_meals = $this->meals();
			$date = date('Y-m-d H:i:s');
			$p->post = array (
				$cols[0] => $no_null($avail_meals->breakfast_r),
				$cols[1] => $no_null($avail_meals->lunch_r),
				$cols[2] => $no_null($avail_meals->dinner_r),
				$cols[3] => $no_null($avail_meals->dessert_r),
				'date' => $date
			);
			$db->setTable($tb);					
			$p->result = $db->update($p->post,'user_id',$id);
		}
		return $p;	
	}		
	public function dessert ()
	{
		$db = $this->db;
		$tb = 'user_dessert';
		$id = $this->id;
		$db->setTable($tb);
		$row = $db->search('user_id',$id,true);
		$p = new stdClass();		
		////////////////////////////////////////////////////
		$p->status = $row['status'];		
		$brk = 'breakfast'; $lun = 'lunch'; $din = 'dinner';
		$p->{$brk} = $row[$brk] == 1; // returns true or false
		$p->{$lun} = $row[$lun] == 1;
		$p->{$din} = $row[$din] == 1;
		$csv = array($brk=>$row[$brk], $lun=>$row[$lun], $din=>$row[$din]);
		$p->keys = array_values($csv);		
		$n = 0; // total selected
		$buffer = '';
		foreach ($csv as $key => $value)
		{
			if ($value == 1) {
				$checked = 'checked';
				$n++;
			}
			else
				$checked = '';
			$buffer .= '<li class="checkbox_unit">
				<label class="checkbox_label">
					<input type="checkbox" name="'.$key.'" value="1" '.$checked.' /> '.ucwords($key).'
				</label>
			</li>';
		}
		$p->ctrl = '<ul class="checkbox_group">'.$buffer.'</ul>';		
		$p->pick = (int)$n;
		if ($p->status > 0) 
			$radio_check_yes = 'checked';
		else 
			$radio_check_no = 'checked';
		$p->radio = '<ul class="radio_group">
			<li class="radio_unit">
				<label class="radio_label">
					<input type="radio" name="status" value="1" '.$radio_check_yes.' /> Yes
				</label>
			</li>
			<li class="radio_unit">
				<label class="radio_label">
					<input type="radio" name="status" value="0" '.$radio_check_no.' /> No
				</label>
			</li>
		</ul>';
		return $p;
	}
	public function allergies ()
	{
		$db = $this->db;
		$tb = 'map_user_allergies';
		$tb_2 = 'allergies';		
		$id = $this->id;
		$db->setTable($tb);
		$p = new stdClass();		
		////////////////////////////////////////////////////
		$sql_stmt = 'SELECT allergy_id FROM '.$tb.' WHERE user_id="'.$id.'"';
		$csv = $db->getAsColumn($sql_stmt); // MY ALLERGIES
		$p->size = count($csv);		
		$p->keys = $csv;
		$db->setTable($tb_2);
		$row = $db->read('allergy ASC'); // ALL ALLERGIES
		$new = array();	$i = 0;
		$buffer = '<li class="checkbox_unit">			
				<label class="checkbox_label">
					<input type="checkbox" name="allergies[]" value="0"  /> None
				</label>
			</li>';	
		foreach ($row as $assoc)
		{
			$allergy_name = ucwords($assoc['allergy']);
			$allergy_id = (int)$assoc['id'];
			if (in_array($allergy_id, $csv))
			{
				array_push($new,$allergy_name);
				$checked = 'checked';
			}
			else
				$checked = '';
			$buffer .= '<li class="checkbox_unit">
				<label class="checkbox_label">
					<input type="checkbox" name="allergies[]" value="'.$allergy_id.'" '.$checked.' /> 
					'.$allergy_name.'
				</label>
			</li>';		
		}
		$p->values = $new;
		$bracket = $list = '';
		foreach ($new as $li)
		{
			$list .= '<li>'.$li.'</li>';
			$bracket .= '['.$li.'] ';
		}
		$p->listed = '<ul class="list_group">'.$list.'</ul>';		
		$p->bracketed = $bracket? $bracket : '[None]';
		$db->setTable($tb);
		$last = $db->getLast('user_id',$id);
		$strtotime = strtotime($last['date']);
		$p->updated = date('M j',$strtotime);
		$p->ctrl = '<ul class="checkbox_group">'.$buffer.'</ul>';
		return $p;
	}		
	public function meals ()
	{
		$db = $this->db;
		$tb = 'map_meal_allergies';
		$id = $this->id;
		$p = new stdClass();		
		////////////////////////////////////////////////////
		$allergies = $this->allergies();
		$user_csv = $allergies->keys;
		$buffer = '';
		foreach ($user_csv as $k)
			$buffer .= $k.',';
		$exclude = substr($buffer,0,-1);
		$enums = Enums::MEALS;
		$p->combo = Enums::asOption($enums,$_REQUEST['filter']);
		$category = array_map('strtolower',$enums);		
		$inner = array();
		foreach ($category as $key => $value)
		{
			if ($key > 0)
			{
				// allergy-free meals grouped by category
				$sql_stmt = 'SELECT DISTINCT meal_id FROM '.$tb.' WHERE allergy_id NOT IN ('.$exclude.') AND status="'.$key.'"';
				$inner = $db->getAsColumn($sql_stmt);
				$p->$value = $inner;
				// random pick for each meal for refresh
				shuffle($inner);
				$value .= '_r';
				$p->$value = $inner[0];
			}
		}		
		return $p;	
	}			
	public function suggestions ()
	{
		$db = $this->db;
		$tb = 'suggestions';		
		$id = $this->id;
		$db->setTable($tb);
		$row = $db->search('user_id',$id);
		$p = new stdClass();		
		////////////////////////////////////////////////////
		$enums = Enums::SUGGESTIONS;
		$outer = $inner = array();
		foreach ($row as $i => $assoc)
		{
			$inner['suggestion'] = $assoc['suggestion'];
			$status = (int)$assoc['status'];
			$inner['group'] = Enums::translate($enums,$status);
			$strtotime = strtotime($assoc['date']);
			$inner['posted'] = date('M j \a\t h:i A',$strtotime);
			$inner['id'] = (int)$assoc['id'];
			array_push($outer,$inner);
		}
		$p->size = count($outer);
		$p->rows = $outer;
		$p->last = end($outer);
		$p->combo = Enums::asOption($enums,$_REQUEST['filter']);
		return $p;
	}		
			
}
// INSTANCE OF USER BEAN CLASS
$bean = new BeanUser($main, $whois->id);

?>