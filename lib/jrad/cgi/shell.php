<?PHP
// EXCEPTION
set_error_handler(function(){});
// NAV
function nav ($array)
{
	$buffer = '<ul>';
	foreach ($array as $key => $value)
	{
		$buffer .= '<li>';
		$buffer .= '<a href="?q='.$key.'">'.$key.'</a>';
		$buffer .= '</li>';
	}
	$buffer .= '</ul>';
	return $buffer;
}
// TABLE
function table ($array)
{
	// CAPTION
	$total = count($array);
	$index = $total - 1;
	$secs = date('s');	
	$success = 'Showing rows 0 - '.$index.' (~'.$total.' total, Query took 0.00'.$secs.' seconds.)';
	$failed = 'MySQL returned an empty result set (i.e. zero rows). (Query took 0.00'.$secs.' seconds.)';
	$caption = $total > 0? $success : $failed;
	// BODY
	$sn = 1;
	$tbody = '';
	ksort($array); // ORDER BY KEY DESC
	foreach ($array as $key => $value)
	{
		$tbody .= '<tr valign="top">';
		$tbody .= '<td align="right">'.$sn.'</td>';			
		$tbody .= '<td nowrap>'.$key.'</td>';
		$tbody .= '<td>'.$value.'</td>';
		$tbody .= '</tr>';
		$sn++;
	}
	$table = '<table border="0">
		<caption>&#10004; '.$caption.'</caption>
		<tr>
			<th title="S/N">#</th>
			<th title="INDEX">KEY</th>
			<th title="ELEMENT">VALUE</th>
		</tr>
		'.$tbody.'
	</table>';	
	return $table;
}
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="utf-8" />
	<title>SHELL</title>
  <style type="text/css">
	body {color:#333; font-family:Arial, Helvetica, sans-serif; font-size:14px;}
	table {border-collapse:collapse; width:100%;}
	caption {padding:10px 15px; margin-bottom:10px; background-color:#ebf8a4; text-align:left; border:solid thin #5da555; border-radius:5px 5px 0 0; border-bottom:none;}
	th, ul li a {padding:5px 10px; background-color:#dfdfdf; color:#235a93; font-weight:bold; border:solid thin #fff; text-shadow:1px 1px #FFF;}
	th, ul li a {
    background: #dfdfdf; /* For browsers that do not support gradients */
    background: -webkit-linear-gradient(#fff, #dfdfdf); /* For Safari 5.1 to 6.0 */
    background: -o-linear-gradient(#fff, #dfdfdf); /* For Opera 11.1 to 12.0 */
    background: -moz-linear-gradient(#fff, #dfdfdf); /* For Firefox 3.6 to 15 */
    background: linear-gradient(#fff, #dfdfdf); /* Standard syntax */
	}	
	th:hover {text-decoration:underline; cursor:pointer;}
	td {padding:10px; font-weight:lighter; line-height:1.2;}
	td[nowrap] {white-space:nowrap;}	
	tr:nth-child(even) td {background-color:#dfdfdf;}
	tr:hover td {background-color:#bdcbd9;}
	ul {padding:0; margin:0; margin-bottom:10px;}	
	ul li {display:inline-block;}
	ul li a {padding:10px 20px; text-decoration:none; display:block;}
	ul li a:hover {opacity:.8;}	
	</style>
</head>
<body>
	<?php 
		echo nav($GLOBALS); 
		echo table($GLOBALS[$_GET['q']]); 
	?>
  </table>
</body>
</html>





