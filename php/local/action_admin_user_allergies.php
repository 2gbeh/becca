<?PHP
// SCOPE VARIABLES
$table = 'map_user_allergies';
$page = 'admin_user_allergies.php';
// READ RECORDS
$sql_stmt = 'SELECT DISTINCT user_id FROM '.$table;
$row = $main->execute($sql_stmt); // dinstinct!
if (is_array($row))
{
	$buffer = '';
	foreach ($row as $i => $assoc)
	{
		// GET DATA OBJECTS
		$id = (int)$assoc['user_id'];	
		$new_bean = new BeanUser($main, $id);
		//////////////////////////////////////////////
		$new_bean_user = $new_bean->user();
		$full_name = $new_bean_user->name;
		$thumb = substr($full_name,0,1);
		$style = $new_bean_user->bgstyle;
		$username = $new_bean_user->username;
		//////////////////////////////////////////////
		$new_bean_allergies = $new_bean->allergies();
		$allergies = $new_bean_allergies->bracketed;
		$date = $new_bean_allergies->updated;		
		// DESIGN OUTPUT
		$buffer .= '<tr valign="top">
			<td width="10">
				<div class="thumb" '.$style.'>'.$thumb.'</div>
			</td>
			<td>
				<div class="sender">
					<time>'.$date.'</time>
					'.$full_name.'
				</div>
				<div class="subject">@'.$username.'</div>
				<div class="action">'.$allergies.'</div>
			</td>
		</tr>';
	}
}
$outp_feed = $buffer;		


?>