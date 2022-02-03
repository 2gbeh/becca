<?PHP
// FORM CONTROLS
//<!--label, autofocus -->
class Form
{	
	public function filter ($post) 
	{
		$exclude = array('create','update','postback','id');
		$new = array();
		foreach ($post as $key => $value) 
		{
			if (!is_array($value) && !in_array($key,$exclude))
			{
				$value = trim($value);
				$value = stripslashes($value);
				$value = htmlspecialchars($value);
				$new[$key] = $value;				
			}
		}
		return $new;
	}
	final protected function getAction () 	
	{
		return 'action="'.htmlspecialchars($_SERVER['PHP_SELF']).'"';
	}	
	final protected function getAutoc ($autoc) 	
	{
		return $autoc == true? 'on':'off';
	}		
	public function post ($autoc = false) 
	{
		echo $this->getAction().' method="post" autocomplete="'.$this->getAutoc($autoc).'"';
	}	
	public function get ($autoc = false) 
	{
		echo $this->getAction().' method="get" autocomplete="'.$this->getAutoc($autoc).'"';
	}		
	public function label ($label, $for = '')
	{	
		$buffer =  '<label for="'.$for.'">'.$label.'</label>';
		echo $buffer;
	}	
	public function optionList ($array, $selected = null)
	{
		$buffer = '';
		foreach ($array as $key => $value)
		{
			if (!is_null($selected) && $selected == $key)
				$buffer .= '<option value="'.$key.'" selected>'.$value.'</option>';
			else
				$buffer .= '<option value="'.$key.'">'.$value.'</option>';
		}
		return $buffer;		
	}
	public function dataList ($array, $ref = 'hint')
	{
		$buffer = '';
		foreach ($array as $value)
			$buffer .= '<option value="'.$value.'" />';
		$output = '<datalist id="'.$ref.'">'.$buffer.'</datalist>';
		return $output;
	}
	public function combobox ($name, $required = true)
	{	
		$required = $required == true? 'required' : '';	
		if ($name == 'sex' || $name == 'gender') 
			$array = array('m'=>'Male','f'=>'Female');
		$optionList = $this->optionList($array,$_POST[$name]);
		$buffer = '<select name="'.$name.'" '.$required.'>
			<option></option>
			'.$optionList.'
		</select>';
		echo $buffer;		
	}
	public function textarea ($name, $required = true)
	{	
		$required = $required == true? 'required' : '';	
		$buffer =  '<textarea name="'.$name.'" id="'.$name.'" '.$required.' placeholder="Type a message">'.$_POST[$name].'</textarea>';
		echo $buffer;
	}	
	public function postback ($name = 'postback')
	{	
		$value = $_REQUEST[$name];
		$buffer =  '<input type="hidden" name="'.$name.'" value="'.$value.'" readonly />';
		echo $buffer;
	}	
	public function attrib ($name, $required = true)
	{	
		$type = $this->getTypeAttrib($name);
		$placeholder = $this->getHintAttrib($name);
		$maxlength = $this->getSizeAttrib($name);
		$required = $required == true? 'required' : '';
		$buffer =  'type="'.$type.'" id="'.$name.'" name="'.$name.'" value="'.$_POST[$name].'" 
		'.$placeholder.' '.$maxlength.' '.$required;
		echo $buffer;
	}		
	final private function getTypeAttrib ($key)
	{
		$map = array (
			'file'=>'file',
			'image'=>'file',
			'date'=>'date',
			'dob'=>'date',
			'email'=>'email',
			'phone'=>'tel',
			'mobile'=>'tel',
			'username'=>'search',
			'password'=>'password',
			'quantity'=>'number',
			'amount'=>'number',
			'price'=>'number');
		return array_key_exists($key,$map)? $map[$key] : 'text';
	}
	final private function getHintAttrib ($key)
	{	
		$map = array (
			'date'=>'YYYY-MM-DD',
			'dob'=>'YYYY-MM-DD',
			'email'=>'handle@domain.com',
			'phone'=>'+234(0)XX-XXXX-XXXX',
			'mobile'=>'+234(0)XX-XXXX-XXXX',
			'message'=>'Type a message',
			'comment'=>'Write a comment',
			'summary'=>'Enter a description',
			'description'=>'Enter a description');
		return array_key_exists($key,$map)? 'placeholder="'.$map[$key].'"' : '';
	}
	final private function getSizeAttrib ($key)
	{
		$map = array (
			'name'=>'50',
			'lname'=>'15',
			'fname'=>'15',
			'mname'=>'15',
			'surname'=>'15',
			'full_name'=>'50',
			'last_name'=>'15',
			'first_name'=>'15',
			'middle_name'=>'15',			
			'date'=>'10',
			'dob'=>'10',
			'email'=>'50',
			'phone'=>'11',
			'mobile'=>'11',
			'username'=>'25',
			'password'=>'25',
			'message'=>'160',
			'comment'=>'160',
			'summary'=>'160',
			'description'=>'160');
		return array_key_exists($key,$map)? 'maxlength="'.$map[$key].'"' : '';
	}	
	
}



?>
