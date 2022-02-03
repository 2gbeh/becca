<?PHP
// START SESSION
session_start();
// SUPRERSS ERROR
error_reporting(E_ALL ^ E_DEPRECATED);
set_error_handler (function(){});
// NO CACHE
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');
?>