<?php

class TaskInfo implements JsonSerializable {
	
	private $id;
	private $correct;
	private $givenAnswer;
	private $actualAnswer;
	
	public function __construct($id, $correct=true, $givenAnswer=null, $actualAnswer=null)
	{
		$this->id = $id;
		$this->correct = $correct;
		$this->givenAnswer = $givenAnswer;
		$this->actualAnswer = $actualAnswer;
	}
	
	public function jsonSerialize() {
		return get_object_vars($this);
	}
}

?>