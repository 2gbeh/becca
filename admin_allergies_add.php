<?php 
	$pagename = 'Add Allergies';
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
    <form <?php $form->post(); ?>>  
  	<table border="0" width="100%" class="mantis_compose">
     	<tr>
      	<th>Add New</th>
			</tr>       
     	<tr>
      	<td>
          <label for="allergy">Allergy Name</label>
          <input <?php $form->attrib('allergy'); ?> placeholder="Sea foods" />
        </td>
			</tr> 
     	<tr>
      	<td>               
					<label for="summary">Allergy Description</label>
          <?php $form->textarea('summary'); ?>
        </td>
			</tr>      
     	<tr>
      	<td>
					<input type="submit" name="create" value="Add" />
          
          <div class="link_cover">
	          <a href="<?php echo $page_3; ?>" class="button">View Records</a>
          </div>
        </td>
			</tr>
    </table>
    </form>    
  </main>
  <?php echo $TEMPLATE->footer; ?>
</body>
</html>