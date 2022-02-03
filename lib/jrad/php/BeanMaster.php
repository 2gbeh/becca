<?PHP
// DATA ACCESS OBJECT
class BeanMaster
{
	protected $db, $id;
	function __construct ($db, $id) 
	{
		$this->db = $db;
		$this->id = $id;
	}
	public function prototype ()
	{
		var_dump (
			$this->admin(),
			$this->user()
		);	
	}	
	public function admin ()
	{
		$db = $this->db;
		$tb = 'admin';
		$id = $this->id;
		$db->setTable($tb);
		$row = (array)$db->hashmap($id);
		$p = new stdClass();		
		////////////////////////////////////////////////////
		$p->name = ucwords(strtolower($row['full_name']));
		$p->username = $row['username'];
		$p->password = $row['password'];
		$self = EnumsAndroid::init($row['id']);
		$p->color = $self->name;		
		$p->hexcode = $self->hexcode;
		$p->bgcolor = $self->bgcolor;
		$p->bgstyle = $self->bgstyle;
		$p->status = (int)$row['status'];
		$enums = EnumsMaster::ADMIN;
		$p->group =  EnumsMaster::translate($enums,$p->status);
		$p->date = $row['date'];
		$strtotime = strtotime($p->date);
		$p->time = date('h:i A',$strtotime);		
		$p->essay = date('l, F j, Y h:i A',$strtotime);		
		$p->teller = date('D, M d, Y',$strtotime);
		$p->joined = date('F jS, Y',$strtotime);
		$p->id = (int)$row['id'];
		$proxy = $db->getProxy($p->date,$p->id);
		$p->proxy = (int)$proxy;
		return $p;
	}	
	public function user ()
	{
		$db = $this->db;
		$tb = 'user';
		$id = $this->id;
		$db->setTable($tb);
		$row = (array)$db->hashmap($id);
		$p = new stdClass();		
		////////////////////////////////////////////////////
		$p->name = ucwords(strtolower($row['full_name']));
		$sex = $row['sex'];
		$p->sex = strtoupper($sex);
		$p->gender = $sex == 'm'? 'Male' : 'Female';
		$p->email = $row['email'];
		$p->phone = $row['phone'];
		$p->username = $row['username'];
		$p->password = $row['password'];
		$self = EnumsAndroid::init($row['id']);
		$p->color = $self->name;		
		$p->hexcode = $self->hexcode;
		$p->bgcolor = $self->bgcolor;
		$p->bgstyle = $self->bgstyle;
		$p->status = (int)$row['status'];
		$enums =  EnumsMaster::USER;
		$p->group =  EnumsMaster::translate($enums,$p->status);
		$p->date = $row['date'];
		$strtotime = strtotime($p->date);
		$p->time = date('h:i A',$strtotime);		
		$p->essay = date('l, F j, Y h:i A',$strtotime);		
		$p->teller = date('D, M d, Y',$strtotime);
		$p->joined = date('F jS, Y',$strtotime);
		$p->id = (int)$row['id'];
		$proxy = $db->getProxy($p->date,$p->id);
		$p->proxy = (int)$proxy;
		return $p;
	}
			
}

?>