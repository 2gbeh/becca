<?php 
	$pagename = 'My Preferences';
	include_once('lib/jrad/php/@jrad_action.php');
	include_once('config/@app_config.php');
	include_once('php/global/template.php');
	include_once('php/global/action_shared.php');	
	include_once('php/local/action_preferences.php');	
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
	  <?php echo $TEMPLATE->aside_user; ?>
  </div>
  <main class="mantis_frame_main">
    <table border="0" width="100%" class="mantis_compose">
      <tr>
        <th>My Allergies</th>
      </tr>
      <tr>
        <td>				
          <form <?php $form->post(); ?>>
            <?php echo $outp_allergies; ?>
            <input type="submit" name="update_allergies" value="Update" />
          </form>
        </td>
      </tr>
      <tr>
        <th>Dessert Recommendations </th>
      </tr>      
      <tr>
        <td>
          <form <?php $form->post(); ?>>
            <label>Add Dessert recommendations to my Meal Plan?</label>
            <?php echo $outp_dessert; ?>
            <input type="submit" name="update_dessert" value="Update" />
          </form>
        </td>
      </tr>
      <tr>
        <th>Feedback &amp; Suggestions</th>
      </tr>       
      <tr>
        <td>
          <form <?php $form->post(); ?>>
            <?php $form->label('Category','status'); ?>
            <select name="status" id="status" required>
              <option selected disabled></option>
              <?php echo $inp_category; ?>
            </select>
            <?php $form->textarea('suggestion'); ?>
            <input type="submit" name="create_suggestion" value="Send" />
          </form>
        </td>
      </tr>                     
    </table>
  </main>
  <?php echo $TEMPLATE->footer; ?>    
</div>
<script type="text/javascript">
	activeLink();
</script>  
</body>
</html>