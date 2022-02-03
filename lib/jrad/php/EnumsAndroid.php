<?PHP
// ENUMERATED TYPES
abstract class EnumsAndroid extends EnumsMaster
{
	public $hexcode, $border, $bgcolor, $color;
	const
		PALETTE = array (
			'black' => '#000',
			'red' => '#F44336',
			'pink' => '#E91E63',
			'purple' => '#9C27B0',
			'deep purple' => '#673AB7',
			'indigo' => '#3F51B5',
			'blue' => '#2196F3',
			'light blue' => '#03A9F4',
			'cyan' => '#00BCD4',
			'teal' => '#009688',
			'green' => '#4CAF50',
			'light green' => '#8BC34A',
			'lime' => '#CDDC39',
			'yellow' => '#FFEB3B',
			'amber' => '#FFC107',
			'orange' => '#FF9800',
			'deep orange' => '#FF5722',
			'brown' => '#795548',
			'grey' => '#9E9E9E',
			'blue grey' => '#607D8B'),
		CONTACTS = array (
			'black' => '#000',		
			'red' => '#F44336',
			'pink' => '#E91E63',
			'purple' => '#9C27B0',
			'indigo' => '#3F51B5',
			'light blue' => '#03A9F4',
			'cyan' => '#00BCD4',
			'green' => '#4CAF50',
			'light green' => '#8BC34A',
			'amber' => '#FFC107',
			'orange' => '#FF9800',
			'deep orange' => '#FF5722')			
	;	
	//////////////////////////////////////////////////////////////////
	public static function init ($n, $enums = self::CONTACTS)
	{
		$n = $n >= count($enums)? $n - count($enums) : $n;
		$p = new stdClass();
		$p->name = self::nthKeyOf($enums,$n);		
		$p->hexcode = self::nthValueOf($enums,$n);
		$p->border = 'border-color:'.$p->hexcode.'; ';
		$p->bgcolor = 'background-color:'.$p->hexcode.'; ';
		$p->color = 'color:'.$p->hexcode.'; ';
		$p->bgstyle = 'style="background-color:'.$p->hexcode.';" ';
		return $p;
	}	
	public static function update ($db, $enums = self::CONTACTS)
	{
		$users = $db->getColumn('id');
		$last = count($enums) - 1; 
		$i = 0;
		$report = array();
    foreach ($users as $id)
		{
			$r = mt_rand(0,$last);
			$post = array('color'=>$r);
		  $result = $db->update($post,'id',$id);
			array_push($report,'color('.$r.') id('.$id.') result('.$result.')');
		}
		return $report;
	}		
}

?>