<?PHP
// SCOPE VARIABLES
$table = 'suggestions';
$page = 'admin_user_suggestions.php';
$main->setTable($table);
// DELETE RECORD
if (isset($_GET['delete']))
{
	$id = $_GET['delete'];
	$main->delete('id',$id);
	$event->alert('INFO Record Deleted');
}
// READ RECORD
$bean_suggestions = $bean->suggestions();
$inp_category = $bean_suggestions->combo;
// MODIFY QUERY FOR FILTER-BY
if (isset($_GET['filter']) && $_GET['filter'] > 0)
{
	$status = $_GET['filter'];
	$sql_stmt = 'SELECT * FROM '.$table.' WHERE status="'.$status.'" ORDER BY id DESC';	
	$row = $main->execute($sql_stmt);
}
else
	$row = $main->read('id DESC');		
// READ DATA SOURCE
if (is_array($row))
{
	$buffer = '';
	foreach ($row as $i => $assoc)
	{
		// GET DATA OBJECTS
		$id = (int)$assoc['id'];			
		$user_id = (int)$assoc['user_id'];	
		$new_bean = new BeanUser($main, $user_id);
		//////////////////////////////////////////////
		$new_bean_user = $new_bean->user();
		$full_name = $new_bean_user->name;
		$thumb = substr($full_name,0,1);
		$style = $new_bean_user->bgstyle;
		$username = $new_bean_user->username;
		//////////////////////////////////////////////
		$suggestion = $assoc['suggestion'];
		$suggestion_buf = strlen($suggestion) > 160? substr($suggestion,0,157).'...' : $suggestion;
		$status = (int)$assoc['status'];
		$enum = Enums::SUGGESTIONS;
		$group = Enums::translate($enum,$status);
		$strtotime = strtotime($assoc['date']);
		$date = date('M j \a\t h:i A',$strtotime);
		// DESIGN OUTPUT
		$buffer .= '<tr valign="middle">
			<td width="10px">
				<div class="thumb" '.$style.'>'.$thumb.'</div>
			</td>
			<td>
				<div class="name">
					'.$full_name.' 
					<span class="username">@'.$username.'</span>
				</div>
				<div class="date"><time>Posted '.$date.'</time></div>
			</td>        
		</tr>
		<tr valign="middle" class="break">
			<td colspan="2">
				<div class="article"><b>#'.$group.'</b> '.$suggestion_buf.'</div>
				<div class="action">
					<a onClick="onDelete('.$id.')" class="button" id="sec" title="Delete Record">&#10006; Delete</a>
				</div>
			</td>		      
		</tr>';
	}
}

$outp_feed = $buffer;

?>