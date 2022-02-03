<?PHP
// SCOPE VARIABLES
$table = 'user';
$table_2 = 'user_dessert';
$table_3 = 'map_user_allergies';
$table_4 = 'meals';
$table_5 = 'user_meal_plan';
$page = 'home.php';
$page_2 = 'login.php';
// LOGIN LOGIC
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
	$post = $form->filter($_POST);
	$main->setTable($table);
	$result = $main->register($post);
	// returned hashmap	
	if (is_object($result))
	{
		$user_id = $result->id;
		// seed dessert table
		$dessert_post = array('user_id'=>$user_id,'status'=>1);
		$main->setTable($table_2);		
		$main->create($dessert_post);
		// seed allergy table
		$allergy_post = array('user_id'=>$user_id);
		$main->setTable($table_3);		
		$main->create($allergy_post);
		// seed meal plan
		$sql_stmt = 'SELECT id FROM '.$table_4.' WHERE status="1"'; // breakfast
		$brk_r = $main->getRandom($sql_stmt);
		$sql_stmt = 'SELECT id FROM '.$table_4.' WHERE status="2"'; // lunch
		$lun_r = $main->getRandom($sql_stmt);
		$sql_stmt = 'SELECT id FROM '.$table_4.' WHERE status="3"'; // dinner
		$din_r = $main->getRandom($sql_stmt);
		$sql_stmt = 'SELECT id FROM '.$table_4.' WHERE status="4"'; // dessert
		$des_r = $main->getRandom($sql_stmt);
		$meal_plan_post = array (
			'user_id' => $user_id,
			'breakfast_id' => $brk_r['id'],
			'lunch_id ' => $lun_r['id'],
			'dinner_id' => $din_r['id'],
			'dessert_id' => $des_r['id'],									
		);
		$main->setTable($table_5);
		$main->create($meal_plan_post);
		// goto login
		$event->alert('INFO Registration complete. Login to continue.');
		$event->redirect($page_2);	
	}
	else
		$event->alert('ERROR Email or Username already exist.');
}
?>