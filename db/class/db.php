<?php 
class MyDatabase{
	private $db;
	private $lastQuery;
	
	public function __construct($address,$username,$password,$dbname){
		$this->db = new Mysqli($address,$username,$password,$dbname); 
		if ($this->db->connect_errno != 0) 
		{         
			echo "Connection error"; 
			exit; 
		} 
		$this->lastQuery=null;
	}
	
	public function queryAsMap($sql){
		$qo = $this->db->query($sql); 
		$this->lastQuery = $qo->fetch_all(MYSQLI_ASSOC); 
		return $this->lastQuery;
	}
	
	public function getLastQuery(){
		return $this->lastQuery;
	}
	
	public function getAccountInfo($id){
		$this->lastQuery=$this->queryAsMap("SELECT * FROM student where account=$id");
		if(count($this->lastQuery)==0){
			$this->lastQuery=$this->queryAsMap("SELECT * FROM mentor where account=$id");
			$this->lastQuery["type"]=1;
			return $this->lastQuery;
		}
		$this->lastQuery["type"]=0;
		return $this->lastQuery;
	}
	
	public function getAccountById($id){
		$this->lastQuery=$this->queryAsMap("SELECT * FROM account where id=$id");
		return $this->lastQuery;
	}
	
	public function getTasksForStudent($id){
		$this->lastQuery=$this->queryAsMap("SELECT * FROM task_student INNER JOIN task ON task_student.task_id=task.id where student_id=$id");
		return $this->lastQuery;
	}
	public function getMentorById($id){
		$this->lastQuery=$this->queryAsMap("SELECT * FROM mentor where id=$id");
		return $this->lastQuery;
	}
}
?>