<?php 
	$pagename = 'My Account';
	include_once('lib/jrad/php/@jrad_action.php');
	include_once('config/@app_config.php');
	include_once('php/global/template.php');
	include_once('php/global/action_shared.php');	
	include_once('php/local/action_user_account.php');
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
<body class="mantis_template mantis_template_nonav">
<div class="mantis_frame_wrap">
	<div class="mantis_frame_head">
		<?php echo $TEMPLATE->header; ?>    
	  <?php echo $TEMPLATE->aside_user; ?>
  </div>
  <main class="mantis_frame_main">
  	<table border="0" width="100%" class="mantis_profile"> 	
	    <caption <?php echo $outp_style; ?>>
				<div class="name"><?php echo $outp_name; ?></div>
        <div class="mantis_fab_cover">
        <a href="<?php echo $page; ?>" 
            class="mantis_fab"
            title="Edit">+</a>
        </div>        
      </caption>     
      <?php echo $outp_feed; ?>
    </table>
  </main>
  <?php echo $TEMPLATE->footer; ?>
</div>  
</body>
</html>