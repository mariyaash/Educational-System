<?php
$loggedUser = array(
	"request" => "GET",
	"accountType" => 0,
	"redirect" => true
);
require("session/logged_user.php");
echo "Welcome, ".$accountType[$type]. " " . $account[0]["full_name"];
$tasks=$db->getTasksForStudent($studentOrMentorId);
echo "<form action=\"submit_answers.php\" method=POST>";
foreach($tasks as $task){
	$mentorIdForTask=$task["mentor_id"];
	$mentor=$db->getMentorById($mentorIdForTask);
	$mentorAccount=$db->getAccountById($mentor[0]["account"]);
	echo "<h3>".$task["question"]." (from mentor ".$mentorAccount[0]["full_name"].")</h3><textarea name=".$task["taskIdForStudent"]."></textarea>";
}
echo "<input type=submit value=Изпрати /></form>";
?>