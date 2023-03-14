<?php

class TaskInfo implements JsonSerializable {
	
	private $id;
	private $assessment;
	private $givenAnswer;
	private $actualAnswer;
	
	public function __construct($id, $assessment=1, $givenAnswer=null, $actualAnswer=null)
	{
		$this->id = $id;
		$this->assessment = $assessment;
		$this->givenAnswer = $givenAnswer;
		$this->actualAnswer = $actualAnswer;
	}
	
	public function jsonSerialize() {
		return get_object_vars($this);
	}
}

?>