<?PHP
// SQL FUNCTIONS
class Subroutine extends Database
{
  public function getSize ($table = null)
	{
		$table = is_null($table)? $this->table : $table;
		$sql_stmt = 'SELECT id FROM '.$table;
		$result = $this->connection->query($sql_stmt);
    return $result->num_rows ? $result->num_rows : 0;
  } 
  public function getRecent ($today = null)
	{
		$today = is_null($today)? date('Y-m-d') : $today;
		$sql_stmt = 'SELECT * FROM '.$this->table.' WHERE DATE(date)>="'.$today.'"';
		return $this->execute($sql_stmt);
  } 
  final public function getSum ($column)
  {
		$sql_stmt = 'SELECT SUM('.$column.') AS sum FROM '.$this->table;
		$result = $this->execute($sql_stmt,true);
		return $result['sum'];
  }		
  final public function readonly ($field, $keyword, $strict = false)
  {
		$sql_stmt = 'SELECT * FROM '.$this->table.' WHERE '.$field.'="'.$keyword.'"';
		return $this->execute($sql_stmt,$strict);
  }
  public function quickDelete	($table, $field, $keyword)
	{
    $sql_stmt = 'DELETE FROM '.$table.' WHERE '.$field.'="'.$keyword.'"';
		return $this->execute($sql_stmt);
  }
  public function search ($field, $keyword, $strict = false)
	{
		$sql_stmt = 'SELECT * FROM '.$this->table.' WHERE '.$field.'="'.$keyword.'"';
		return $this->execute($sql_stmt,$strict);		
  }
  public function hashmap ($id, $table = null)
	{
		$table = is_null($table)? $this->table : $table;
		$sql_stmt = 'SELECT * FROM '.$table.' WHERE id="'.$id.'"';
		$result = $this->execute($sql_stmt,true);	
		if (is_array($result))
			return (object)$result;
  }
  public function getCell ($cell, $field, $keyword)
	{
		$sql_stmt = 'SELECT '.$cell.' FROM '.$this->table.' WHERE '.$field.'="'.$keyword.'"';
		$result = $this->execute($sql_stmt,true);
		if (is_array($result))
			return current($result);
  }			
  public function getColumn ($field)
	{
		$sql_stmt = 'SELECT '.$field.' FROM '.$this->table;
		$result = $this->execute($sql_stmt);
		if (is_array($result))
		{
			$new = array();
			foreach ($result as $assoc)
				array_push($new,current($assoc));
			return $new;				
		}
  }
  public function getAsColumn ($sql_stmt)
	{
		$result = $this->execute($sql_stmt);
		if (is_array($result))
		{
			$new = array();
			foreach ($result as $assoc)
				array_push($new,current($assoc));
			return $new;				
		}
  }
  final public function getTop ()	
  {
		$sql_stmt = 'SELECT * FROM '.$this->table.' ORDER BY id ASC LIMIT 1';
		return $this->execute($sql_stmt,true);
  }	
  final public function getBottom ()	
  {
		$sql_stmt = 'SELECT * FROM '.$this->table.' ORDER BY id DESC LIMIT 1';
		return $this->execute($sql_stmt,true);
  }
  final public function getFirst ($field, $keyword)	
  {
		$sql_stmt = 'SELECT * FROM '.$this->table.' WHERE '.$field.'="'.$keyword.'" ORDER BY id ASC LIMIT 1';
		return $this->execute($sql_stmt,true);
  }	
  final public function getLast ($field, $keyword)	
  {
		$sql_stmt = 'SELECT * FROM '.$this->table.' WHERE '.$field.'="'.$keyword.'" ORDER BY id DESC LIMIT 1';
		return $this->execute($sql_stmt,true);
  }
  final public function getRandom ($sql_stmt, $limit = 1)
  {
		$sql_stmt .= ' ORDER BY RAND() LIMIT '.$limit;
		return $this->execute($sql_stmt,true);
  }				
}

?>
