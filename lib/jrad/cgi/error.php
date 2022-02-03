<?PHP
// EXCEPTION
set_error_handler(function($errno,$error,$file,$line){});
// START
$sandbox = false;
$content = READ_FILE('../../../error_log');
$collection = SCAN_FILE($content);
if ($sandbox == true) {
var_dump 
(
	$content,
	$collection
);}
// LOGIC
function READ_FILE ($directory)
{
	$flag = 'r';
	$size = filesize($directory);	
	$file_object = fopen($directory,$flag) or 
	die('No such file or directory "'.$directory.'"!');
	$content = array();
	while (!feof($file_object))
	{
		$stream = fgets($file_object); // IF FILE NOT EMPTY
		if ($stream) 
			array_push($content,$stream);
	}
	fclose($file_object);	
	return $content;
}
function SCAN_FILE ($content)
{
	$collection = array();	
	foreach ($content as $key => $value)
	{
		$hashmap = new stdClass();
		// ERROR
		$hashmap->ERROR	= trim($value);		
		$arr_main = explode('] ',$value);
		// DATE, TIME AND TIME ZONE
		$str_dtz = substr($arr_main[0],1); 
		$arr_dtz = explode(' ',$str_dtz);
		$hashmap->DATE = $arr_dtz[0];
		$d = strtotime($arr_dtz[0]);
		$hashmap->DATE_BUFF = date('D, M d, Y',$d);
		$hashmap->TIME = $arr_dtz[1];
		$t = strtotime($arr_dtz[1]);
		$hashmap->TIME_BUFF = date('h:i A',$t);
		$hashmap->TIME_ZONE = $arr_dtz[2];
		// ERROR TYPE
		$arr_ert = explode(':  ',$arr_main[1]);
		$hashmap->TYPE = $arr_ert[0];
		// ERROR TRIMMED
		$arr_err = explode(' on line ',$arr_ert[1]);
		$hashmap->ERROR_TRIM = $arr_err[0];
		// FILES AFFECTED
		$arr_erf = explode(' in /',$arr_err[0]);
		array_shift($arr_erf);
		$hashmap->FILE = $arr_erf;
		// SOURCE LINE
		$hashmap->LINE = trim($arr_err[1]);
		// BUILD HASHMAP
		$collection[$key] = $hashmap;
	}	
	return $collection;
}

?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="utf-8" />
	<title>ERROR_LOG</title>
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
	<table border="0" width="100%" summary="error log">
  <tr>
  	<th title="S/N">#</th>
  	<th title="DATE_BUFF">DATE</th>
  	<th title="TIME_BUFF (TIME_ZONE)">TIME</th>
    <th title="ERROR TYPE">TYPE</th>
  	<th title="ERROR_TRIM">ERROR MESSAGE</th>
  	<th title="ERROR LINE">LINE</th>
  </tr>
  <?php 
		// CAPTION
		$total = count($collection);
		$index = $total - 1;
		$secs = date('s');	
		$success = 'Showing rows 0 - '.$index.' (~'.$total.' total, Query took 0.00'.$secs.' seconds.)';
		$failed = 'MySQL returned an empty result set (i.e. zero rows). (Query took 0.00'.$secs.' seconds.)';
		$caption = $total > 0? $success : $failed;
		echo '<caption>&#10004; '.$caption.'</caption>';	
		// BODY
		$sn = 1;
		$buffer = '';
		krsort($collection); // ORDER BY KEY DESC
		foreach ($collection as $i => $e)
		{
			$buffer .= '<tr valign="top">';
			$buffer .= '<td align="right">'.$sn.'</td>';			
			$buffer .= '<td nowrap="true">'.$e->DATE_BUFF.'</td>';
			$buffer .= '<td nowrap="true">'.$e->TIME_BUFF.' ('.$e->TIME_ZONE.')</td>';
			$buffer .= '<td>'.$e->TYPE.'</td>';
			$buffer .= '<td>'.$e->ERROR_TRIM.'</td>';
			$buffer .= '<td>'.$e->LINE.'</td>';
			$buffer .= '</tr>';
			$sn++;
		}
		echo $buffer;
	?>
  </table>
</body>
</html>





