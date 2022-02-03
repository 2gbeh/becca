<?php 
	$pagename = 'Edit Account';
	include_once('lib/jrad/php/@jrad_action.php');
	include_once('config/@app_config.php');
	include_once('php/global/template.php');
	include_once('php/global/action_shared.php');		
	include_once('php/local/action_admin_account.php');	
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
    <form <?php $form->post(); ?>>  
  	<table border="0" width="100%" class="mantis_compose">
     	<tr>
      	<th><?php echo $pagename; ?></th>
			</tr>             
      <tr>
        <td>
          <label for="full_name">Full Name</label>
          <input <?php $form->attrib('full_name'); ?> />
        </td>
      </tr>
      <tr>
        <td>
          <label for="username">Username</label>
          <input <?php $form->attrib('username'); ?> readonly />
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
          <label for="cfm_password">Confirm Password</label>
          <input <?php $form->attrib('cfm_password'); ?> />

          <?php $form->postback(); ?>
					<input type="submit" name="update" value="Save" />
          <div class="link_cover">
	          <a href="<?php echo $page_2; ?>" class="button">Preview Account</a>
          </div>
        </td>
			</tr>
    </table>
    </form>
  </main>
  <?php echo $TEMPLATE->footer; ?>
</body>
</html>