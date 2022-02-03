<?PHP
// ENUMERATED TYPES
abstract class EnumsMaster
{
	const 
		ADMIN = array (null,'Default Admin','Super Admin','Web Master'),
		USER = array (null,'Default User','Verified User','Subscribed User','Super User','Deactivated'),
		GENDER = array (null,'Female','Male'),
		MAR_STATUS = array(null,'Single','Married','Separated','Divorced','Widowed'),
		STATE = array(null,'Abia','Abuja','Adamawa','Akwa Ibom','Anambra','Bauchi','Bayelsa','Benue','Borno','Cross River','Delta','Ebonyi','Edo','Ekiti','Enugu','Gombe','Imo','Jigawa','Kaduna','Kano','Katsina','Kebbi','Kogi','Kwara','Lagos','Nasarawa','Niger','Ogun','Ondo','Osun','Oyo','Plateau','Rivers','Sokoto','Taraba','Yobe','Zamfara'),
		BANK = array(null,'Access Bank','Citi Bank','Diamond Bank (Access)','Ecobank','FCMB','Fidelity Bank','FirstBank','GTBank','Heritage Bank','Jaiz Bank','Jubilee Bank','Keystone Bank','Mainstreet Bank','Skye Bank (Polaris)','Stanbic IBTC','Standard Chartered Bank','Sterling Bank','Suntrust Bank','UBA','Union Bank','Unity Bank','WEMA Bank','Zenith Bank'),
		ERROR = array(null,'info','success','warning','danger'),
		DAY_SHORT = array(null,'Sun','Mon','Tue','Wed','Thu','Fri','Sat'),		
		DAY = array(null,'Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'),	
		MONTH_SHORT = array(null,'Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'),
		MONTH = array(null,'January','February','March','April','May','June','July','August','September','October','November','December')
	;
	public static function isKey ($enums, $e)
	{
		return array_key_exists($e, $enums);
	}
	public static function isValue ($enums, $e)
	{
		$e = strtolower($e);
		$new = array_map('strtolower',$enums);
		return in_array($e, $new);
	}	
	public static function nthKeyOf ($enums, $p)
	{
		$new = array_keys($enums);
		return $new[$p];
	}		
	public static function nthValueOf ($enums, $p)
	{
		$new = array_values($enums);
		return $new[$p];
	}
	public static function autogen ($enums, $n, $as = INDEX)
	{
		$x = is_null($enums[0])? 1 : 0; // start
		$y = count($enums) - 1; // end
		if ($as == KEY) $array = array_keys($enums);
		if ($as == VALUE) $array = array_values($enums);
		$new = array();	
		for ($i = 0; $i < $n; $i++)
		{	
			$r = mt_rand($x,$y);
			$e = $as == INDEX? $r : $array[$r];
			array_push($new,$e);
		}
		return $new;
	}		
	public static function translate ($enums, $e)
	{
		if (is_numeric($e))
			return $enums[$e];			
		else
		{
			return e;
			$e = strtolower($e);
			$new = array_map('strtolower',$enums);			
			return array_search($e, $new);
		}
	}
	public static function crowfoot ($enums)
	{
		$new = array();
		foreach ($enums as $key => $value)
			array_push($new,$key.'=>'.$value);
		return $new;
	}						
	public static function asOption ($enums, $selected = null)
	{
		$buffer = '';
		foreach ($enums as $key => $value)
		{
			if (!is_null($value))
			{
				if ($selected == $key)
					$buffer .= '<option value="'.$key.'" selected>'.$value.'</option>';
				else
					$buffer .= '<option value="'.$key.'">'.$value.'</option>';
			}
		}
		return $buffer;
	}
}
/*

*/

//var_dump
//(
//	Enums::ADMIN,
//	Enums::isKey(Enum::ADMIN,3),
//	Enums::isValue(Enum::ADMIN,'web master'),
//	Enums::nthKeyOf(Enum::ADMIN,3),
//	Enums::nthValueOf(Enum::ADMIN,3),
//	Enums::translate(Enum::ADMIN,3),
//	Enums::translate(Enum::ADMIN,'web master'),
//	Enums::asOption(Enum::ADMIN)
//);
?>