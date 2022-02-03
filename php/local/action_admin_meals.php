<?PHP
// SCOPE VARIABLES
$dir = 'img/uploads/';
$table = 'meals';
$table_2 = 'allergies';
$table_3 = 'map_meal_allergies';
$page = 'admin_meals_add.php';
$page_2 = 'admin_meals_edit.php';
$page_3 = 'admin_meals_view.php';
// ADD RECORD
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
	$post = $form->filter($_POST);
	$extract = is_array($_POST['allergies'])? $_POST['allergies'] : array(0); // extract map records
	$post['status'] = $post['status'] > 0? $post['status'] : 1; // default status entry
	$_REQUEST['filter'] = $post['status'];	// selected status option
	//////////////////////////////////////////////////////////////////////
	if (isset($_POST['create'])) // CREATE
	{
		$fs->init($_FILES['image'],$dir); // inti file object
		$new_name = $fs->upload(); // upload image
		if ($new_name)
		{
			$meals_post = $post; // build principal post
			$meals_post['image'] = $new_name; // add image
			$main->setTable($table); // connect to principal table
			$result = $main->create($meals_post);	// insert into principal table
			if (is_numeric($result)) // i.e. dbconn->insert_id
			{						
				$main->setTable($table_3); // connect to map table
				$meal_id = $result; // get meal id					
				foreach ($extract as $allergy_id)
				{
					// build map post
					$allergies_post = array ( 
						'meal_id' => $meal_id,
						'allergy_id' => $allergy_id,
						'status' => $post['status']
					);
					$main->create($allergies_post);	// insert into map table
				}
				$event->alert('INFO Record Created');
			}
			else
				$event->alert('ERROR Could not create record');
		}
		else
			$event->alert('ERROR Could not upload file');
	}
	if (isset($_POST['update'])) // UPDATE
	{
		$main->setTable($table); // connect to principal table
		$meal_id = $_POST['postback']; // remove id field
		$result = $main->update($post,'id',$meal_id);
		if (is_numeric($result))
		{
			$main->setTable($table_3); // connect to map table
			$main->delete('meal_id',$meal_id); // delete map records
			foreach ($extract as $allergy_id)
			{
				// build map post
				$allergies_post = array ( 
					'meal_id' => $meal_id,
					'allergy_id' => $allergy_id,
					'status' => $post['status']
				);
				$main->create($allergies_post);	// insert into map table
			}	
			$event->alert('INFO Record Updated');			
		}
		else
			$event->alert('ERROR Could not update record');
	}
}
// GENERATE FORM DATA FOR UPDATE
if (isset($_REQUEST['postback']))
{
	$id = $_REQUEST['postback'];
	$main->setTable($table);	
	$_POST = $main->postback($id);
	$_REQUEST['filter'] = $_POST['status'];
	$sql_stmt = 'SELECT allergy_id FROM '.$table_3.' WHERE meal_id="'.$id.'"';
	$meal_allergy_csv = $main->getAsColumn($sql_stmt);	
}
// EDIT RECORD
if (isset($_GET['edit']))
{
	$id = $_GET['edit'];
	$request = $page_2.'?postback='.$id;	
	$event->redirect($request);
}
// DELETE RECORD
if (isset($_GET['delete']))
{
	$id = $_GET['delete'];	
		// DELETE FILE
	$main->setTable($table);
	$image = $main->getCell('image','id',$id);
	$file_dir = $dir . $image;
	$fs->delete($file_dir,true);
		// DELETE RECORD	
	$main->quickDelete($table,'id',$id);
	$main->quickDelete($table_3,'meal_id',$id);
	$event->alert('INFO Record Deleted');
}
// READ RECORDS
	// GET MEAL CATEGORIES
$bean_meals = $bean->meals();
$inp_category = $bean_meals->combo;
	// GET ALLERGY CHECKBOXES
$main->setTable($table_2);
$row = $main->read('allergy ASC');
$buffer = '<li class="checkbox_unit">
	<label class="checkbox_label">
		<input type="checkbox" name="allergies[]" value="0"  /> None
	</label>
</li>';
foreach ($row as $assoc)
{
	$allergy_name = ucwords(strtolower($assoc['allergy']));
	$allergy_id = (int)$assoc['id'];	
	$checked = in_array($assoc['id'],$meal_allergy_csv)? 'checked':'';
	$buffer .= '<li class="checkbox_unit">
		<label class="checkbox_label">
			<input type="checkbox" name="allergies[]" value="'.$allergy_id.'" '.$checked.' />
			'.$allergy_name.'
		</label>
	</li>';
}
$inp_allergy = '<ul class="checkbox_group">'.$buffer.'</ul>';
	// GET MEAL RECORDS
if (isset($_GET['filter']) && $_GET['filter'] > 0)
{
	$status = $_GET['filter'];
	$sql_stmt = 'SELECT * FROM '.$table.' WHERE status="'.$status.'" ORDER BY id DESC';	
	$row = $main->execute($sql_stmt);		
}
else
{
	$main->setTable($table);
	$row = $main->read('id DESC');		
}
// READ DATA SOURCE
if (is_array($row))
{
	$buffer = '';
	foreach ($row as $i => $assoc)
	{
		// SET DATA OBJECT
		$image = $dir.$assoc['image'];
		$bgimg = 'background-image:url('.$image.'); ';
		$meal = $assoc['meal'];
		$status = (int)$assoc['status'];
		$enums = Enums::MEALS;	
		$group = Enums::translate($enums,$status);
		$summary = $assoc['summary'];		
		$strtotime = strtotime($assoc['date']);
		$date = date('M j \a\t h:i A',$strtotime);
		$id = (int)$assoc['id'];					
		// PREPARE OUTPUT
		$buffer .= '<tr valign="top">		
			<td width="10px">
				<div class="thumb" style="'.$bgimg.'">&nbsp;</div>
			</td>
			<td>
				<div class="headline">'.$meal.'</div>
				<div class="byline"><time>Added '.$date.'</time></div>
				<div class="article">#<b>'.$group.'</b> '.$summary.'</div>			
				<div class="action">
					<a onClick="onEdit('.$id.')" class="button" id="pri" title="Edit Record">&#9998; Edit</a> &nbsp;
					<a onClick="onDelete('.$id.')" class="button" id="sec" title="Delete Record">&#10006; Delete</a>
				</div>
			</td>        
		</tr>';
	}
}

$outp_feed = $buffer;

?>