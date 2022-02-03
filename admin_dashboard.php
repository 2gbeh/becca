<?php 
	$pagename = 'Dashboard';
	include_once('lib/jrad/php/@jrad_action.php');
	include_once('config/@app_config.php');
	include_once('php/global/template.php');
	include_once('php/global/action_shared.php');		
	include_once('php/local/action_admin_dashboard.php');	
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
  	<table border="0" width="100%" class="mantis_dashboard"> 
      <caption>
        <div class="header_cover">
          <div class="header_wrap">
            <?php echo $outp_otis_unique; ?> /
            <var title="Overall Hits"><?php echo $outp_otis_overall; ?></var>
          </div>
          Visitor Metrics
        </div>
        <div class="chart_cover">
          <div class="chart_donut">
            <div class="chart_wrap">
              <div class="percent"><?php echo $outp_otis_rate; ?></div>
              <div class="label">Growth Rate</div>
            </div>
          </div>
        </div>
   	  </caption>
      <tr>
        <th>
            <?php echo $outp_otis_today; ?>
            <div class="label">Today</div>
        </th>
        <th>
            <?php echo $outp_otis_week; ?>
            <div class="label">This Week</div>
        </th>
        <th>
            <?php echo $outp_otis_month; ?>
            <div class="label">This Month</div>
        </th>                
      </tr>
      <tr class="section">
        <td colspan="3">User Metrics</td>
      </tr>
      <tr>
        <td colspan="3">
          <var><?php echo $outp_tot; ?></var>
          Total Users
        </td>
      </tr>
      <tr>
        <td colspan="3">
          <var><?php echo $outp_frac; ?></var>
					Registrations Today
        </td>
      </tr>
      <tr>
        <td colspan="3">
          <var><?php echo $outp_perc; ?>%</var>
          Growth Rate
        </td>
      </tr>
      <tr class="section">
        <td colspan="3">Entity Metrics</td>
      </tr>
      <tr>
        <td colspan="3">
          <var><?php echo $outp_allergies; ?></var>
          Total Allergies
        </td>
      </tr>
      <tr>
        <td colspan="3">
          <var><?php echo $outp_meals; ?></var>
          Total Meals
        </td>
      </tr>
      <tr>
        <td colspan="3">
          <var><?php echo $outp_suggestions; ?></var>
          Total Suggestions
        </td>
      </tr>      
    </table>
  </main>
  <?php echo $TEMPLATE->footer; ?>
<script type="text/javascript">
	activeLink();
</script>
</body>
</html>