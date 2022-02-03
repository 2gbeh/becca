<?php 
	$pagename = 'Login';
	$pagelock = false;
	include_once('lib/jrad/php/@jrad_action.php');
	include_once('config/@app_config.php');
	include_once('php/global/template.php');
	include_once('php/global/action_shared.php');		
	include_once('php/local/action_login.php');	
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
  <form <?php $form->post(); ?>>
  <table border="0" width="100%" class="mantis_login">
    <caption>
      <a href="<?php echo $page; ?>" title="Home">
        <img src="img/logo.png" class="logo" alt="<?php echo TYPEFACE; ?>"  />
      </a>
      <div class="title"><?php echo $pagename; ?></div>        
    </caption>
    <tr>
      <td>
        <label for="username">Username</label>
        <input <?php $form->attrib('username'); ?> />
      </td>
    </tr>
    <tr>
      <td>
        <div class="password_cover">
          <label for="password">Password</label>      
          <input <?php $form->attrib('password'); ?> />
          <a onClick="togglePassword()" title="Show/Hide">SHOW</a>
        </div>
      </td>
    </tr>      
    <tr> 
      <td>
        <input type="submit" value="Login" />
        <div class="button_cover">
          <a href="#" title="Retrieve Password">Forgot Password?</a>
        </div>
      </td>
    </tr>
    <tr>
      <td>
        <div class="link_cover">
          <span class="">Don't have an account?</span>
          <a href="<?php echo $page_2; ?>" title="Register">Sign up</a>
        </div>
      </td>
    </tr>
  </table>
  </form>
</main>
</body>
</html>