<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/educational_system/account_type.php");

$loggedUser = array(
	"request" => "POST",
	"accountType" => AccountType::STUDENT
);
require($_SERVER["DOCUMENT_ROOT"] . "/educational_system/session/logged_user.php");

foreach ($_POST as $taskIdForStudent => $answer) {
	$db->answerTask($taskIdForStudent, $answer);
}

echo "Вашите отговори бяха изпратени.";
?>
