<?PHP
// DATABASE CONNECTION
$main = new Activity(DATABASE,USERNAME,PASSWORD);

// APPLICATION STATE
$main->logout(LANDING);
$main->pagelock(LANDING); 
$main->setTraffic();

// SHARED RESOURCE
$whois = $main->getAccount();
$form = new Form();
$notice = new Notice();	
$event = new Event();
$fs = new FileSystem();
?>