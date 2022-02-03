<?PHP
// SCOPE VARIABLES
$table = 'map_user_allergies';
$table_2 = 'user_dessert';
$table_3 = 'suggestions';
$user_id = $whois->id;
// UPDATE PREFERENCES
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
	$post = $form->filter($_POST);
	array_pop($post); // remove submit buttons
	if ($_POST['update_allergies'])
	{
		// extract map records
		$extract = is_array($_POST['allergies'])? $_POST['allergies'] : array(0); 
		$main->setTable($table); // connect to map table
		$main->delete('user_id',$user_id); // delete map records	
		foreach ($extract as $allergy_id)
		{
			// build map post
			$allergies_post = array ( 
				'user_id' => $user_id,
				'allergy_id' => $allergy_id
			);
			$main->create($allergies_post);	// insert into map table
		}
		$event->alert('INFO Allergies Updated. Refresh Meal Plan');
	}
	if ($_POST['update_dessert_ignore'])
	{
		$backup_post = array('breakfast'=>0,'lunch'=>0,'dinner'=>0); // if none selected
		$dessert_post = count($post) > 0? $post : $backup_post;
		$main->setTable($table_2); // connect to map table
		$main->update($dessert_post,'user_id',$user_id); // update record
		$event->alert('INFO Dessert Preference Updated');		
	}
	if ($_POST['update_dessert'])
	{	
		$main->setTable($table_2); // connect to map table
		$main->update($post,'user_id',$user_id); // update record
		$event->alert('INFO Dessert Preference Updated');	
	}
	if ($_POST['create_suggestion'])
	{
		$post['user_id'] = $user_id; // add user_id
		$main->setTable($table_3); // connect to map table
		$result = $main->create($post);
		if (is_numeric($result))
			$event->alert('INFO Suggestion Sent');
	}
}
// MY ALLERGIES
$hashmap = $bean->allergies();
$outp_allergies = $hashmap->ctrl;
// DESEERT OPTION
$hashmap = $bean->dessert();
$outp_dessert = $hashmap->radio;
// RECOMMENDATIONS
$hashmap = $bean->suggestions();
$inp_category = $hashmap->combo;

//var_dump($hashmap);

?>