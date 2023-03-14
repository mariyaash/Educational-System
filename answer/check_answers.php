<?php
$loggedUser = array(
	"request" => "GET",
	"accountType" => 0
);
require($_SERVER["DOCUMENT_ROOT"] . "/educational_system/session/logged_user.php");
$tasks = $db->getAnswersForStudent($studentOrMentorId);
require($_SERVER["DOCUMENT_ROOT"] . "/educational_system/answer/class/task_info.php");

$result = [];
$index = 0;
foreach ($tasks as $task) {
	
	if ($task["answer"] !== $task["actualAnswer"] ) {
		$result[$index] = new TaskInfo($task["id"], $task["assessment"], $task["answer"], $task["actualAnswer"]);
	} else {
		$result[$index] = new TaskInfo($task["id"], 1);
	}
	
	$index++;
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);
?>