<?php 
	$pagename = $_SERVER['PHP_SELF'];
	$pagelock = false;	
	$notraffic = true;
	include_once('lib/jrad/php/@jrad_action.php');
	include_once('config/@app_config.php');
	include_once('php/global/template.php');
	include_once('php/global/action_shared.php');	
	include_once('php/local/action_meal_plan.php');		
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<?php 
	include_once('php/global/meta.php');
//	include_once("lib/jrad/css/@jrad_style.php");
	include_once("lib/jrad/js/@jrad_script.php");	
//	include_once('php/global/external.php'); 
?>
</head>
<body>
<?php
$f_array = array (
	'name' => 'clip.txt',
	'type' => 'text/plain',
	'tmp_name' => 'C:\wamp64\tmp\php17C5.tmp',
	'error' => 0,
	'size' => 221
);
$tar_dir = 'lib/';
$new = new FileSystem($f_array,$tar_dir);
$ini = $fs->init($f_array,$tar_dir);
var_dump($new);
var_dump($ini);
//var_dump($_FILES);

?>
    <form <?php $form->post(); ?> enctype="multipart/form-data">
	<input type="file" name="image" />
 	<input type="submit" />
</form>
<script type="text/javascript">

</script>
</body>
</html>
