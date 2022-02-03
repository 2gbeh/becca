<?php 
	$pagename = 'Manage Allergies';
	include_once('lib/jrad/php/@jrad_action.php');
	include_once('config/@app_config.php');
	include_once('php/global/template.php');
	include_once('php/global/action_shared.php');		
	include_once('php/local/action_admin_allergies.php');	
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
    <?php echo $TEMPLATE->nav_admin; ?>  
	  <?php echo $TEMPLATE->aside_admin; ?>
  </div>
  <main class="mantis_frame_main">
  	<table border="0" width="100%" class="mantis_inbox">  
      <?php echo $outp_feed; ?>
    </table>
    <div class="mantis_fab_cover">
    	<a href="<?php echo $page; ?>" 
      	class="mantis_fab"
        title="Add New">+</a>
    </div>     
  </main>
  <?php echo $TEMPLATE->footer; ?>
<script type="text/javascript">
	activeLink();
</script> 	
</body>
</html>