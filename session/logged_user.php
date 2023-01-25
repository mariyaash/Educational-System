<?php
if (!isset($loggedUser) || !is_array($loggedUser) || !array_key_exists("request", $loggedUser) || !array_key_exists("accountType", $loggedUser)) {
	http_response_code(400);
	exit;
}

session_start();
require ("request/assert.php");
if(!assertRequest($loggedUser["request"])||!assertSession("loginId")){
	if (array_key_exists("redirect", $loggedUser))
		header("Location:/educational_system/index.php");
	else
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

if($type!=$loggedUser["accountType"]){
	http_response_code(400);
	exit;
}
?>