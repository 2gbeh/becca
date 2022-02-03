<?PHP
// SCOPE VARIABLES
$table = 'user';
$table_1 = 'allergies';
$table_2 = 'meals';
$table_3 = 'suggestions';
// TRAFFIC STATS
$otis= $main->getTraffic();
$outp_otis_unique = $otis->unique;
$outp_otis_overall = $otis->overall;
$outp_otis_rate = $otis->today_unique_rate;
$outp_otis_today = $otis->today_unique;
$outp_otis_week = $otis->week_unique;
$outp_otis_month = $otis->month_unique;
// TOTAL USERS
$main->setTable($table);
$outp_tot = $main->getSize();
// USERS REGISTERED TODAY
$outp_frac = count($main->getRecent());
// PERCENTAGE OFFSET
$perc = ($outp_frac * 100) / $outp_tot;
$outp_perc = round($perc);
// TOTAL ALLERGIES
$main->setTable($table_1);
$outp_allergies = $main->getSize();
// TOTAL MEALS
$main->setTable($table_2);
$outp_meals = $main->getSize();
// TOTAL SUGGESTIONS
$main->setTable($table_3);
$outp_suggestions = $main->getSize();
?>