<?PHP
// SCOPE VARIABLES
$table = 'user_meal_plan';
$page = '?refresh=true';
// REFESH MEAL PLAN
if (isset($_GET['refresh']))
{
	$new_post = array('date'=>'2020-04-14 11:50:10');
	$main->setTable($table);
	$main->update($new_post,'user_id',$whois->id);
}
// MEAL PLAN FEED
$refresh = $bean->refresh();
$dessert = $bean->dessert();
$plan = $bean->plan();
$nan = $plan->nan;
$rows = (array)$plan->rows; 
if ($dessert->status < 1) array_pop($rows);
//var_dump($plan,$dessert->pick,$rows);
foreach ($rows as $name => $value)
{
	if ($value['isset'] == true)
	{
		$buffer .= '<tr valign="top">
			<td width="10px">
				<div class="thumb" style="'.$value['bgimg'].'">&nbsp;</div>
			</td>
			<td>
				<div class="headline">'.$value['meal'].'</div>
				<div class="byline">#'.$value['group'].'</div>
				<div class="article">'.$value['summary'].'</div>
			</td>        
		</tr>';
	}
	else
	{
		$buffer .= '<tr valign="top">
			<td>
				<div class="thumb" style="'.$nan['bgimg'].'">&nbsp;</div>
			</td>
			<td>
				<div class="headline">'.$nan['meal'].'</div>
				<div class="article">'.$nan['summary'].'</div>
			</td>        
		</tr>';	
	}
}
$outp_feed = $buffer;

//var_dump($hashmap);

?>