<?PHP
// SCOPE VARIABLES
$table = 'allergies';
$table_2 = 'map_meal_allergies';
$table_3 = 'map_user_allergies';
$page = 'admin_allergies_add.php';
$page_2 = 'admin_allergies_edit.php';
$page_3 = 'admin_allergies_view.php';
// ADD RECORD
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
	$main->setTable($table);	
	$post = $form->filter($_POST);
	if (isset($_POST['create'])) // CREATE
	{
		$result = $main->create($post);
		if (is_numeric($result))
			$event->alert('INFO Record Created');
		else
			$event->alert('ERROR Could not create record');
	}
	if (isset($_POST['update'])) // UPDATE
	{
		$id = $_POST['postback'];
		$result = $main->update($post,'id',$id);		
		if (is_numeric($result))
			$event->alert('INFO Record Updated');
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
	$main->quickDelete($table,'id',$id);
	$main->quickDelete($table_2,'allergy_id',$id);
	$main->quickDelete($table_3,'allergy_id',$id);
	$event->alert('INFO Record Deleted');
}
// READ RECORDS
$main->setTable($table);	
$row = $main->read('id DESC');
if (is_array($row))
{
	$buffer = '';
	foreach ($row as $i => $assoc)
	{
		// GET DATA OBJECTS
		$id = (int)$assoc['id'];		
		$allergy = $assoc['allergy'];
		$thumb = substr($allergy,0,1);
		$self = EnumsAndroid::init($id);
		$style = $self->bgstyle;
		$summary = $assoc['summary'];
		$strtotime = strtotime($assoc['date']);
		$date = date('M j',$strtotime);
		// DESIGN OUTPUT
		$buffer .= '<tr valign="top">
			<td width="10px">
				<div class="thumb" '.$style.'>'.$thumb.'</div>
			</td>
			<td>
				<div class="sender">
					<time>'.$date.'</time>
					'.$allergy.'
				</div>
				<div class="message">'.$summary.'</div>
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