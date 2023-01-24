<?php
session_start();
require ("request/assert.php");
if(!assertRequest("GET")||!assertSession("loginId")){
	header("Location:/educational_system/index.php");
	exit;
}
require("db/connect.php");
$accountId=$_SESSION["loginId"];
$accountType=array("student","mentor");
$account=$db->getAccountById($accountId);
$accountInfo=$db->getAccountInfo($accountId);
$type=$accountInfo["type"];
$studentOrMentorId=$accountInfo[0]["id"];
echo "Welcome, ".$accountType[$type]. " " . $account[0]["full_name"];
if($type==0){
	$tasks=$db->getTasksForStudent($studentOrMentorId);
	//var_dump($tasks);
	echo "<form action=\"answers.php\" method=POST>";
	foreach($tasks as $task){
		$mentorIdForTask=$task["mentor_id"];
		$mentor=$db->getMentorById($mentorIdForTask);
		$mentorAccount=$db->getAccountById($mentor[0]["account"]);
		echo "<h3>".$task["question"]." (from mentor ".$mentorAccount[0]["full_name"].")</h3><textarea name=".$task["id"]."></textarea>";
	}
	echo "<input type=submit value=Изпрати /></form>";
}
?>
