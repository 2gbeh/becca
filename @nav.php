<?php 
	$pagename = '@nav';
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
	include_once("lib/jrad/css/@jrad_style.php");
	include_once("lib/jrad/js/@jrad_script.php");	
	include_once('php/global/external.php'); 
?>
</head>
<body class="mantis_template">
<div class="mantis_frame_wrap">
	<div class="mantis_frame_head">
		<?php echo $TEMPLATE->header; ?>    
    <?php echo $TEMPLATE->nav_user; ?>  
	  <?php echo $TEMPLATE->super; ?>
  </div>    
</div>
<script type="text/javascript">
toggleSidebar(1);
</script>
</body>
</html>