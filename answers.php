<?php
session_start();
require ("request/assert.php");
if(!assertRequest("POST")||!assertSession("loginId")){
http_response_code(400);
	exit;
}
require("db/connect.php");
$accountId=$_SESSION["loginId"];
$accountType=array("student","mentor");
$account=$db->getAccountById($accountId);
$accountInfo=$db->getAccountInfo($accountId);
$type=$accountInfo["type"];
$studentOrMentorId=$accountInfo[0]["id"];
if($type==1){
	http_response_code(400);
	exit;
}
$tasks=$db->getTasksForStudent($studentOrMentorId);
$compareArray=array($_POST,$tasks);
var_dump($_POST);
foreach($_POST as $value){

	
}
?>