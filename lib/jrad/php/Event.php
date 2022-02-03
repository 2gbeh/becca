<?PHP
// PSEUDO-JS FUNCTIONS
class Event
{	
	public function script ($args) 
	{
		echo '<script type="text/javascript">'.$args.'</script>';
	}
	public function strip ($args) 
	{
		if (strpos($args,' ') >= 0)
			return str_replace(' ','%20',$args);
		else
			return str_replace('%20',' ',$args);			
	}	
	public function alert ($args)
	{
		$this->script('alert("'.$args.'");');
	}
	public function console ($args)
	{
		$this->script('console.log("'.$args.'");');
	}
	public function reload ()
	{
		$this->script('location.reload();');
	}	
	public function redirect ($url)
	{
		$this->script('location.assign("'.$url.'");');
	}
	public function toPrint ()
	{
		$this->script('window.print();');
	}	
	public function isOnline ()
	{
		$this->script('navigator.onLine();');
	}	
	public function isJava ()
	{
		$this->script('navigator.javaEnabled();');
	}			
}

?>
