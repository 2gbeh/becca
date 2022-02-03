<?PHP
// SCOPE VARIABLES
$user_id = $whois->id;
$table = 'user';
$page = 'user_account_edit.php?postback='.$user_id;
$page_2 = 'user_account.php';
// UPDATE RECORD
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
	if (isset($_POST['update']) && ($_POST['password'] == $_POST['cfm_password'])) // UPDATE
	{
		$id = $_POST['postback'];		
		$post = $form->filter($_POST);
		array_pop($post); // remove cfm_password
		$main->setTable($table);
		$result = $main->update($post,'id',$id);		
		if (is_numeric($result))
			$event->alert('INFO Account Updated');
		else
			$event->alert('ERROR Could not update account');
	}
	else
		$event->alert('ERROR Password does not match');	
}
// GENERATE FORM DATA FOR UPDATE
if (isset($_REQUEST['postback']))
{
	$id = $_REQUEST['postback'];
	$main->setTable($table);	
	$_POST = $main->postback($id);
}
// READ RECORD
$hashmap = $bean->user();
$outp_style = $hashmap->bgstyle;
$outp_name = $hashmap->name;
if (strlen($hashmap->sex) > 0) $row['Gender'] = $hashmap->gender;
else $row['Gender'] = '---';
$row['Email'] = $hashmap->email;
$row['Phone'] = $hashmap->phone? $hashmap->phone : '---';
$row['Username'] = $hashmap->username;
$row['Account ID'] = $hashmap->proxy;
$row['Joined'] = $hashmap->joined;

//var_dump($hashmap,$row);
// DESIGN LAYOUT
$buffer = '';
foreach ($row as $key => $value)
{
	$buffer .= '<tr valign="middle">
		<td width="10px;">
			<i class="icon">&nbsp;</i>
		</td>
		<td>
			<div class="fieldset">
				<div class="input">'.$value.'</div>
				<div class="label">'.$key.'</div>
			</div>
		</td>
		<td>&nbsp;</td>		
	</tr>';
}
$outp_feed = $buffer;
?>