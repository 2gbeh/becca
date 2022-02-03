<?PHP
// CONSTANTS
define('APPNAME', 'Harley');
define('TYPE', 'Personal Digital Assistant (PDA)');
define('CATEGORY', 'Food Health');
define('ALIAS', null);
// LINKS
define('DIR', 'C:\wamp64\www\harley');
define('URL', 'localhost/harley');
define('LANDING', 'home.php');
// DATABASE
if ($_SERVER['SERVER_NAME'] == 'localhost') {
	define('DATABASE', 'harley_db');
	define('USERNAME', 'root');
	define('PASSWORD', '');
}
else {
	define('DATABASE', 'hwplabsc_dive');
	define('USERNAME', 'hwplabsc_root');
	define('PASSWORD', '_Strongp@ssw0rd');
}
// STUBS
define('TITLE', null);
define('PREFIX', null);
define('SUFFIX', ' - HARLEY');
define('TYPEFACE', 'HARLEY');
define('CAPTION', 'Hi, I\'m Harley!');
define('TAGLINE', 'Your Virtual Dietician');
define('COPYRIGHT', '&copy; 2020 Harley, Inc. All rights reserved.');
// UI
define('PRIMARY', '#4EAE26');
define('SECONDARY', '#E6A754');
define('ACCENT', '#F73D23');
// DEVELOPER
define('CREATED', 'Monday, April 14th, 2020');
define('COMPANY', 'HWP Labs');
define('TEMPLATE', 'MANTIS');
define('BUILD', '6.18.4.20');


$define = get_defined_constants(true);
//var_dump(	$define['user']);

?>