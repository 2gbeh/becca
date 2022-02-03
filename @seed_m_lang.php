<?php 
	$pagename = $_SERVER['PHP_SELF'];
	$pagelock = false;	
	$notraffic = true;
	include_once('lib/jrad/php/@jrad_action.php');
	include_once('config/@app_config.php');
	include_once('php/global/template.php');
	include_once('php/global/action_shared.php');	
	include_once('php/local/action_meal_plan.php');		
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
<body>
<?php
$row = array();
$row[] = array(
'C++',
'Bjarne Stroustrup',
'1985',
'.cpp',
'AT&mp;T Bell Labs',
'/C%2B%2B'
);
$row[] = array(
'Perl',
'Larry Wall',
'1987',
'.pl',
'CPAN',
'/Perl'
);
$row[] = array(
'Python',
'Guido van Rossum',
'1990',
'.py',
'Python Software Foundation',
'/Python_(programming_language)'
);
$row[] = array(
'Java',
'James Gosling',
'1995',
'.java',
'Sun Microsystems (Oracle)',
'/Java_(programming_language)'
);
$row[] = array(
'Ruby',
'Yukihiro Matsumoto',
'1995',
'.rb',
'',
'/Ruby_(programming_language)'
);
$row[] = array(
'PHP',
'Rasmus Lerdorf',
'1995',
'.php',
'Zend Technologies',
'/PHP'
);
$row[] = array(
'C#',
'Anders Hejlsberg',
'2000',
'.cs',
'Microsoft',
'/C_Sharp_(programming_language)'
);
$row[] = array(
'JavaScript',
'Brendan Eich',
'1995',
'.js',
'Netscape Communications (Oracle)',
'/JavaScript'
);
$row[] = array(
'Swift',
'Chris Lattner',
'2014',
'.swift',
'Apple Inc.',
'/Swift_(programming_language)'
);
$row[] = array(
'Go',
'Robert Griesemer, Rob Pike, Ken Thompson',
'2009',
'.go',
'The Go Authors (Google)',
'/Go_(programming_language)'
);
$row[] = array(
'Kotlin (eww)',
'Andrey Breslav',
'2011',
'.kt',
'JetBrains',
'/Kotlin_(programming_language)'
);
$row[] = array(
'VBScript',
'Alan Cooper',
'1996',
'.vbs',
'Microsoft',
'/VBScript'
);
$row[] = array(
'Dart',
'Lars Bak',
'2011',
'.dart',
'Google',
'/Dart_(programming_language)'
);
$row[] = array(
'Rust',
'Graydon Hoare',
'2010',
'.rs',
'Netscape Communications (Mozilla)',
'/Rust_(programming_language)'
);
$row[] = array(
'TypeScript',
'Anders Hejlsberg',
'2012',
'.ts',
'Microsoft',
'/TypeScript'
);
$row[] = array(
'LiveScript',
'Jeremy Ashkenas',
'2011',
'.ls',
'',
'/LiveScript'
);
$row[] = array(
'CoffeeScript',
'Jeremy Ashkenas',
'2009',
'.coffee',
'',
'/CoffeeScript'
);
$row[] = array(
'Scala',
'Martin Odersky',
'2004',
'.scala',
'EPFL',
'/Scala_(programming_language)'
);
$row[] = array(
'ActionScript',
'Gary Grossman',
'1998',
'.as',
'Adobe Systems',
'/ActionScript'
);
$row[] = array(
'Objective-C',
'Brad Cox',
'1984',
'.h',
'Apple Inc.',
'/Objective-C'
);
$row[] = array(
'Visual Basic .NET',
'Allan Cooper',
'1991',
'.vb',
'Microsoft',
'/Visual_Basic_.NET'
);
$row[] = array(
'Elm',
'Evan Czaplicki',
'2012',
'.elm',
'',
'/Elm_(programming_language)'
);
$row[] = array(
'ReasonML',
'Jordan Walke',
'2016',
'.re',
'Facebook',
'/Reason_(syntax_extension_for_OCaml)'
);
$row[] = array(
'PureScript',
'Phil Freeman',
'2013',
'.purs',
'',
'/PureScript'
);
$row[] = array(
'Tcl /tickle/',
'John Ousterhout',
'1988',
'.tcl',
'Tcl Core Team',
'/Tcl'
);
sort($row);
$fn = func($main, $row);
//var_dump($row);
var_dump($fn);

function func ($main, $row)
{
	$main->setTable('m_lang');	
	$col = array('image','name','author','year','type','company','wiki');				
	foreach ($row as $index => $assoc)
	{
		// append image
		$id = $index + 1;
		$secs = $id < 10? '0'.$id: $id;
		$img = '202005152100'.$secs.'.png';
		array_unshift($assoc,$img);
		// append wiki
		$url = 'https://en.wikipedia.org/wiki';
		$assoc[6] = $url . $assoc[6];
		// prepare post
		$post = array();		
		foreach ($assoc as $key => $value)
			$post[$col[$key]] = $assoc[$key];
		// insert rec
//		return $post;
		$main->create($post);
	}
	// select rec
	return $main->read();
}

?>
<script type="text/javascript">

</script>
</body>
</html>