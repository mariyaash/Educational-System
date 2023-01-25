<?php
$loggedUser = array(
	"request" => "POST",
	"accountType" => 0
);
require($_SERVER["DOCUMENT_ROOT"] . "/educational_system/session/logged_user.php");

foreach ($_POST as $taskIdForStudent => $answer) {
	$db->answerTask($taskIdForStudent, $answer);
}

echo "Вашите отговори бяха изпратени.";
?>