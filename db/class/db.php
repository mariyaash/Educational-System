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
	
	public function updateQuery($sql) {
		$this->lastQuery = $this->db->query($sql);
		return $this->lastQuery;
	}
	
	public function getLastQuery(){
		return $this->lastQuery;
	}
	
	public function getAccountInfo($id){
		$this->queryAsMap("SELECT * FROM student where account=$id");
		if(count($this->lastQuery)==0){
			$this->queryAsMap("SELECT * FROM mentor where account=$id");
			$this->lastQuery["type"]=1;
			return $this->lastQuery;
		}
		$this->lastQuery["type"]=0;
		return $this->lastQuery;
	}
	
	public function getAccountById($id){
		return $this->queryAsMap("SELECT * FROM account where id=$id");
	}
	
	public function getTasksForStudent($id){
		return $this->queryAsMap("SELECT task_student.id AS taskIdForStudent, task_student.*, task.* FROM task_student INNER JOIN task ON task_student.task_id=task.id where student_id=$id;");
	}
	
	public function getMentorById($id){
		return $this->queryAsMap("SELECT * FROM mentor where id=$id");
	}
	
	public function answerTask($taskIdForStudent, $answer) {
		return $this->updateQuery("UPDATE task_student SET answer='$answer' WHERE id=$taskIdForStudent");
	}
}
?>