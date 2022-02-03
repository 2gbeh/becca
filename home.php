<?php 
	$pagename = 'Home';
	$pagelock = false;
	include_once('lib/jrad/php/@jrad_action.php');
	include_once('config/@app_config.php');
	include_once('php/global/template.php');
	include_once('php/local/action_home.php');		
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
<body class="mantis_landing">
<main class="mantis_frame_wrap">
  <table border="0" width="100%" class="mantis_home">
    <caption>
      <a href="<?php echo $page; ?>" title="Welcome">
        <img src="img/logo.png" class="logo" alt="<?php echo TYPEFACE; ?>"  />
      </a>
      <div class="title"><?php echo CAPTION; ?></div>
      <div class="subtitle"><?php echo TAGLINE; ?></div>
    </caption>
    <tr>
      <td>
        <a href="<?php echo $page_2; ?>" class="button" id="pri" title="Login">Log In</a>  
      </td>
    </tr>
    <tr>
      <td>
        <a href="<?php echo $page_3; ?>" class="button" id="sec" title="Register">Sign Up</a> 
      </td>
    </tr>      
  </table>
</main>
<footer><?php echo $TEMPLATE->footer; ?></footer>
</body>
</html>