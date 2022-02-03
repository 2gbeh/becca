<?PHP
// ERROR BEAN
class Notice
{
	private $error, $errno, $color, $type;
	function __construct ($args = null)
	{
    $this->error = $args['error'];
    $this->errno = $args['errno'];
    $this->color = $args['color'];
    $this->type = $args['type'];
  }		
	public function setError ($error)
	{
		$this->error = $error;
	}
	public function getError ()
	{
		return $this->error;
	}
	public function setErrno ($errno)
	{
		$this->errno = $errno;
	}
	public function getErrno ()
	{
		return $this->errno;
	}	
	public function setColor ($color)
	{
		$this->color = $color; 
	}
	public function getColor ()
	{
		return $this->color;
	}
	public function setType ($type)
	{
		// ATTENTION, SUCCESS, WARNING, FAIL
		$this->type = $type; 
	}
	public function getType ()
	{
		return $this->type;
	}	
	public function display ()
	{
		if (isset($this->error))
		{
			echo '<div class="notice '.$this->color.'" id="notice">
				<a class="notice_close" onclick="hideNotice()" title="Close">&times;</a>
				<div class="notice_message">'.$this->error.'</div>
			</div>';
		}
	}	
	public function alert ()
	{
		if (isset($this->error))
		{
			$prefix = isset($this->type)? '['.$this->type.'] ' : '';
			$args = $prefix.' '.$this->error;
			echo '<script type="text/javascript">'.$args.'</script>';
		}
	}		
	public function swiss ($message, $color)
	{
//			echo '<div class="notice '.$color.'" id="notice">
//				<a class="notice_close" onclick=hideNotice() title="Close">&times;</a>
//				<div class="notice_message">'.$message.'</div>
//			</div>';
	}	
}



?>
