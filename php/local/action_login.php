<?PHP
// SCOPE VARIABLES
$table = 'user';	
$table_2 = 'admin';
$page = 'home.php';
$page_2 = 'register.php';
$page_3 = 'meal_plan.php';
$page_4 = 'admin_dashboard.php';
// LOGIN LOGIC
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
	$post = $form->filter($_POST);
	if (substr($post['username'],0,5) == 'admin') // admin login
	{
		$main->setTable($table_2);
		$result = $main->login($post,$page_4);
	}
	else
	{
		$main->setTable($table);
		$result = $main->login($post,$page_3);
	}
	if ($result == 404)
		$event->alert('ERROR Invalid Username');
	else if ($result == 409) 
		$event->alert('ERROR Invalid Password');
	else
		$event->alert('ERROR Problem Encountered');
}
?>