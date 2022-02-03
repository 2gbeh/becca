<?PHP
class FileSystem
{
	public $cur_dir, $cur_file, $tar_dir, $tar_file; 
	public $name, $tmp, $alias, $type, $ext, $size, $byte, $kb, $mb, $error;
	function __construct ($f_array = null, $tar_dir = '') 
	{
		$this->init($f_array,$tar_dir);
	}
	final public function init ($f_array = null, $tar_dir = '') 
	{	
		$this->cur_dir = $getcwd = $this->get_getcwd();
		$this->cur_file = $f_array['tmp_name'];
		$this->tar_dir = $tar_dir = $getcwd . $tar_dir; 
		$this->tar_file = $tar_dir . $f_array['name'];
		$this->tmp = $f_array['tmp_name'];
		$this->name = $name = $f_array['name'];	
		$this->type = $f_array['type'];
		$this->ext = $ext = $this->get_ext($name);
		$this->alias = date('YmdHis') . $ext;
		$this->size = $size = $f_array['size'];
		$get_sizes = $this->get_sizes($size);
		$this->byte = $get_sizes['byte'];
		$this->kb = $get_sizes['kb'];
		$this->mb = $get_sizes['mb'];
		$this->error = $f_array['error'];
		return $this;
	}
	final public function upload ($new_name = null) 
	{
		$new_name = is_null($new_name)? $this->alias: $new_name;
		$this->tar_file = str_replace($this->name, $new_name, $this->tar_file);
		$result = move_uploaded_file($this->tmp, $this->tar_file);
		if ($result == true)
			return $new_name;
	}	
	final public function delete ($f_dir, $cur_dir = false) 
	{
		$this->tar_file = $cur_dir == true? $this->cur_dir . $f_dir: $f_dir;
		return unlink($this->tar_file);
	}
		
	final public function get_getcwd () 
	{
		return str_replace('\\','/',getcwd().'\\');
	}
	final public function get_getcwf () 
	{
		return $_SERVER['DOCUMENT_ROOT'] . $_SERVER['PHP_SELF'];
	}
	final public function get_ext ($f_dir) 
	{
		return '.'.array_pop(explode('.',$f_dir));
	}	
	final public function get_sizes ($size) 
	{
		$arr = array();
		$arr['byte'] = number_format($size);
		$arr['kb'] = $kb = round(($size / 1024), 2);
		$arr['mb'] = $kb / 1024;		
		return $arr;
	}
	final public function get_dates ($f_dir) 
	{		
		$date_f = array (
			'date'=>'Y-m-d', // 2020-04-29
			'time'=>'H:i:s', // 12:50:54
			'timestamp'=>'Y-m-d H:i:s', // 2020-04-29 12:50:54
			'date_long'=>'l, F j, Y', // Wednesday, April 29, 2020
			'date_short'=>'D, M j, Y', // Wed, Apr 29, 2020
			'time_short'=>'h:i A' // 12:50 PM
		);
		$arr = array();		
		$arr['c_unix'] = $unix = filectime($f_dir); // created
		foreach ($date_f as $k => $v) 
			$arr['c_'.$k] = date($v,$unix);
		$arr['m_unix'] = $unix = filemtime($f_dir); // modified
		foreach ($date_f as $k => $v) 
			$arr['m_'.$k] = date($v,$unix);
		$arr['a_unix'] = $unix = fileatime($f_dir); // accessed
		foreach ($date_f as $k => $v) 
			$arr['a_'.$k] = date($v,$unix);
		return $arr;				
	}
	
	
}

?>