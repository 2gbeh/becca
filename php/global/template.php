<?PHP
// SCOPE VARIABLES
$tb = 'meals';
$tb_2 = 'allergies';
$tb_3 = 'map_user_allergies';
$tb_4 = 'suggestions';
// TEMPLATE OBJECT
$TEMPLATE = new stdClass();
// HEADER
$TEMPLATE->header = '<header class="mantis_header_cover">
<table class="mantis_header" border="0">
	<tr valign="middle">
		<td width="10px">
			<a href="javascript:void(0)" 
				onclick="toggleSidebar(1)" 
				class="equiv" 
				title="Open Sidebar">&equiv;
			</a>
		</td>
		<td>
			<div class="appname">'.TYPEFACE.'</div>
		</td>
	</tr>
</table>
</header>';
// NAV
$TEMPLATE->nav_admin = '<nav class="mantis_nav_cover">
<table class="mantis_nav" border="0" width="100%">
	<tr class="colsize_3">
		<td><a href="admin_dashboard.php">Dashboard</a></td>
		<td><a href="admin_meals_view.php">Meals</a></td>
		<td><a href="admin_allergies_view.php">Allergies</a></td>
	</tr>
</table>
</nav>';
$TEMPLATE->nav_user = '<nav class="mantis_nav_cover">
<table class="mantis_nav" border="0" width="100%">
<tr id="colsize_2">
	<td><a href="meal_plan.php">Meal Plan</a></td>
	<td><a href="preferences.php">Preferences</a></td>
</tr>
</table>
</nav>';
// SECTION
$TEMPLATE->section = '<section class="mantis_section_cover">
<div class="mantis_section">
	<select>
		<option>'.date('l, F jS').'</option>
	</select>
</div>
</section>';
// FOOTER
$TEMPLATE->footer = '<footer class="mantis_footer_cover">
	<div class="mantis_footer">'.COPYRIGHT.'</div>
</footer>';
// ASIDE
$TEMPLATE->aside_admin = '<aside class="mantis_aside_cover">&nbsp;</aside>
<div class="mantis_aside_wrap">
<table border="0" width="100%" class="mantis_aside">
	<caption>
		<a href="javascript:void(0)" 
			onclick="toggleSidebar(0)" 
			class="times" 
			title="Close Sidebar">&times;
		</a>
		<div class="thumb" style="background-image:url(\'img/avatar.png\');">&nbsp;</div>
		<div class="name">'.ucwords($whois->full_name).' ('.$whois->username.')</div>
		<div class="email">
			<a href="javascript:void(0)" class="caret" title="Edit">&nabla;</a> 
			Account ID: '.$whois->proxy.'
		</div>
	</caption>
	<tr valign="middle">
		<td><j>&nbsp;</j></td>
		<td><a href="admin_dashboard.php">Dashboard</a></td>
		<td>&nbsp;</td>
	</tr>
	<tr valign="middle">
		<td><j>&nbsp;</j></td>
		<td><a href="admin_meals_add.php">Add Meals</a></td>
		<td>&nbsp;</td>
	</tr>	
	<tr valign="middle">
		<td><j>&nbsp;</j></td>
		<td><a href="admin_meals_view.php">Manage Meals</a></td>
		<td><var title="Total">'.$main->getSize($tb).'</var></td>
	</tr>
	<tr valign="middle">
		<td><j>&nbsp;</j></td>
		<td><a href="admin_allergies_add.php">Add Allergies</a></td>
		<td>&nbsp;</td>
	</tr>	
	<tr valign="middle">
		<td><j>&nbsp;</j></td>
		<td><a href="admin_allergies_view.php">Manage Allergies</a></td>
		<td><var title="Total">'.$main->getSize($tb_2).'</var></td>
	</tr>
	<tr valign="middle">
		<td><j>&nbsp;</j></td>
		<td><a href="admin_user_allergies.php">User Allergies</a></td>
		<td><var title="Total">'.$main->getSize($tb_3).'</var></td>
	</tr>	
	<tr valign="middle">
		<td><j>&nbsp;</j></td>
		<td><a href="admin_user_suggestions.php">User Suggestions</a></td>
		<td><var title="Total">'.$main->getSize($tb_4).'</var></td>
	</tr>				
	<tr valign="middle" class="divide">
		<th colspan="3">MORE OPTIONS</th>
	</tr>	
	<tr valign="middle">
		<td><j>&nbsp;</j></td>
		<td><a href="admin_account.php">My Account</a></td>
		<td><var class="info" title="Account Info">i</var></td>
	</tr>	
	<tr valign="middle">
		<td><j>&nbsp;</j></td>
		<td><a href="login.php">Switch Account</a></td>
		<td>&nbsp;</td>
	</tr>			
	<tr valign="middle">
		<td><j>&nbsp;</j></td>
		<td><a href="?logout=true">Sign out</a></td>
		<td>&nbsp;</td>
	</tr>		
	<tr>
		<th colspan="3">&nbsp;</th>
	</tr>			
</table>
</div>';
$TEMPLATE->aside_user = '<aside class="mantis_aside_cover">&nbsp;</aside>
<div class="mantis_aside_wrap">
<table border="0" width="100%" class="mantis_aside">
	<caption>
		<a href="javascript:void(0)" 
			onclick="toggleSidebar(0)" 
			class="times" 
			title="Close Sidebar">&times;
		</a>
		<div class="thumb" style="background-image:url(\'img/user.png\');">&nbsp;</div>
		<div class="name">'.ucwords($whois->full_name).'</div>
		<div class="email">
			<a href="javascript:void(0)" class="caret" title="Edit">&nabla;</a> 
			'.$whois->email.'
		</div>
	</caption>
	<tr valign="middle">
		<td><j>&nbsp;</j></td>
		<td><a href="meal_plan.php">Meal Plan</a></td>
		<td>&nbsp;</td>
	</tr>
	<tr valign="middle">
		<td><j>&nbsp;</j></td>
		<td><a href="preferences.php">Preferences</a></td>
		<td>&nbsp;</td>
	</tr>		
	<tr valign="middle" class="divide">
		<td><j>&nbsp;</j></td>
		<td><a href="user_account.php">My Account</a></td>
		<td><var class="info" title="Account Info">i</var></td>
	</tr>	
	<tr valign="middle">
		<td><j>&nbsp;</j></td>
		<td><a href="login.php">Switch Account</a></td>
		<td>&nbsp;</td>
	</tr>			
	<tr valign="middle">
		<td><j>&nbsp;</j></td>
		<td><a href="?logout=true">Sign out</a></td>
		<td>&nbsp;</td>
	</tr>
</table>
</div>';
// SITEMAP
$TEMPLATE->super = '<aside class="mantis_aside_cover">&nbsp;</aside>
<div class="mantis_aside_wrap">
<table border="0" width="100%" class="mantis_aside">
	<caption>
		<a href="javascript:void(0)" 
			onclick="toggleSidebar(0)" 
			class="times" 
			title="Close Sidebar">&times;
		</a>
		<div class="thumb" style="background-image:url(\'img/2gbeh.png\');">&nbsp;</div>
		<div class="name">Tugbeh Emmanuel</div>
		<div class="email">
			<a href="javascript:void(0)" class="caret" title="Edit">&nabla;</a> 
			tugbeh.osaretin@gmail.com
		</div>
	</caption>
	<tr valign="middle">
		<td><i>1</i></td>
		<td><a href="index.html">Splash</a></td>
		<td><var title=".html" class="info">i</var></td>
	</tr>
	<tr valign="middle">
		<td><i>2</i></td>
		<td><a href="home.php">Home</a></td>
		<td>&nbsp;</td>
	</tr>	
	<tr valign="middle">
		<td><i>3</i></td>
		<td><a href="register.php">Register</a></td>
		<td>&nbsp;</td>
	</tr>	
	<tr valign="middle">
		<td><i>4</i></td>
		<td><a href="login.php">Login</a></td>
		<td>&nbsp;</td>
	</tr>	
	<tr valign="middle">
		<td><i>5</i></td>
		<td><a href="meal_plan.php">Meal Plan</a></td>
		<td>&nbsp;</td>
	</tr>	
	<tr valign="middle">
		<td><i>6</i></td>
		<td><a href="preferences.php">Preferences</a></td>
		<td>&nbsp;</td>
	</tr>	
	<tr valign="middle">
		<td><i>7</i></td>
		<td><a href="user_account.php">User Account</a></td>
		<td><var class="info" title="Account Info">i</var></td>
	</tr>			
	<tr>
		<td><i>8</i></td>
		<td><a href="user_account_edit.php">Edit User Account</a></td>
		<td>&nbsp;</td>
	</tr>							
	<tr class="divide">
		<th colspan="3">ADMIN</th>
	</tr>
	<tr>
		<td><i>9</i></td>
		<td><a href="admin_dashboard.php">Dashboard</a></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td><i>10</i></td>
		<td><a href="admin_meals_view.php">View Meals</a></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td><i>11</i></td>
		<td><a href="admin_meals_edit.php">Edit Meal</a></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td><i>12</i></td>
		<td><a href="admin_meals_add.php">Add Meal</a></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td><i>13</i></td>
		<td><a href="admin_allergies_view.php">View Allergies</a></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td><i>14</i></td>
		<td><a href="admin_allergies_edit.php">Edit Allergy</a></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td><i>15</i></td>
		<td><a href="admin_allergies_add.php">Add Allergy</a></td>
		<td>&nbsp;</td>
	</tr>	
	<tr>
		<td><i>16</i></td>
		<td><a href="admin_user_allergies.php">User Allergies</a></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td><i>17</i></td>
		<td><a href="admin_user_suggestions.php">User Suggestions</a></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td><i>18</i></td>
		<td><a href="admin_account.php">Admin Account</a></td>
		<td><var class="info" title="Account Info">i</var></td>
	</tr>
	<tr>
		<td><i>19</i></td>
		<td><a href="admin_account_edit.php">Edit Admin Account</a></td>
		<td>&nbsp;</td>
	</tr>	
	<tr>
		<th colspan="3">&nbsp;</th>
	</tr>	
</table>
</div>';


//var_dump($TEMPLATE);
?>