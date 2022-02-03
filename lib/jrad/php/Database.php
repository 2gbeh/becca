<?PHP
// DATABASE CRUD
class Database
{
  protected $connection, $errlog, $table;
	function __construct ($database, $username, $password)
	{
    $this->connection = new mysqli('localhost',$username,$password,$database);
    if ($this->connection->connect_error) 
      die('Connection failed: '.$this->connection->connect_error);
  }	
	function __destruct ()
	{
    $this->connection->close();
  }		
	final public function logError ()
	{
			$this->errlog = $this->connection;
	}		
	final public function getErrorLog ()
	{
			return $this->errlog;
	}
	final public function getError ()
	{
			return $this->errlog->error;
	}				
  final public function setTable ($table) 
	{
		$this->table = $table;
	}
  final public function getTable () 
	{
		return $this->table;
	}  
  final public function realEscape ($value) 
	{
		$mysqli = $this->connection;
		return $mysqli->real_escape_string($value);
	}  	
	// CRUD
  final public function create ($post)
  {
		$keys = array_keys($post); // get fields
		$field_set = implode(', ',$keys);
    $values = array_values($post); // get records
    $record_set = '';
    foreach ($values as $value)
      $record_set .= '"'.$this->realEscape($value).'", ';
		$record_set = substr($record_set,0,-2);
    // execute sql command
    $sql_stmt = 'INSERT INTO '.$this->table.' ('.$field_set.') VALUES ('.$record_set.')';
    $result = $this->connection->query($sql_stmt);
		$this->logError();		
    if ($result === true)
		{
			$_POST = array();
      $insert_id = $this->connection->insert_id;
			return $insert_id;
		}
  }  
  final public function read ($order_by = 'id ASC')
  {
		$sql_stmt = 'SELECT * FROM '.$this->table.' ORDER BY '.$order_by;
		$result = $this->connection->query($sql_stmt);
		$this->logError();		
    if ($result->num_rows > 0)
    {
      $array = array();
      while ($row = $result->fetch_assoc()) 
        array_push($array,$row);
      return $array;
    }
  }
  final public function update ($post, $field, $keyword)
	{		
    $buffer = '';
    foreach ($post as $key => $value)  // prepare set clause
      $buffer .= $key.'="'.$this->realEscape($value).'", ';
    $buffer = substr($buffer,0,-2);
    // execute sql command
    $sql_stmt = 'UPDATE '.$this->table.' SET '.$buffer.' WHERE '.$field.'="'.$this->realEscape($keyword).'"';
    $result = $this->connection->query($sql_stmt); 
		$this->logError();
    if ($result === true) 
      return $this->connection->affected_rows;	
  }
  final public function delete ($field, $keyword)
	{		
    $sql_stmt = 'DELETE FROM '.$this->table.' WHERE '.$field.'="'.$this->realEscape($keyword).'"';
    $result = $this->connection->query($sql_stmt);
		$this->logError();
    if ($result === true) 
      return $this->connection->affected_rows;	
  }
	final public function execute ($sql_stmt, $strict = false)
	{
		$query_type = substr($sql_stmt,0,6);
		$result = $this->connection->query($sql_stmt);
		$this->logError();
		if ($query_type == 'SELECT') // READ
		{
			if ($result->num_rows > 0)
			{
				$array = array();
				while ($row = $result->fetch_assoc()) 
					array_push($array,$row);
				$output = ($strict == true && count($array) == 1)? current($array) : $array;
				return $output;
			}
		}
		else
		{ 
			if ($result === true)
			{
				if ($query_type == 'INSERT') // CREATE
					return $this->connection->insert_id;
				else
					return $this->connection->affected_rows; // UPADTE & DELETE
			}
		}	
	}	
}

?>
