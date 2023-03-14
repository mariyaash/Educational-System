<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/educational_system/account_type.php");

$loggedUser = array(
	"request" => "POST",
	"accountType" => AccountType::MENTOR
);
require_once($_SERVER["DOCUMENT_ROOT"] . "/educational_system/session/logged_user.php");

$mentor = $db->getMentorById($studentOrMentorId);

foreach ($_POST as $taskAnswerId => $assessment) {
	if($db->isTaskOwnedByMentor($taskAnswerId, $mentor[0]["id"])) {
		$db->assessStudentTask($taskAnswerId, $assessment);
	}
	else echo "грешка";
}

echo "Вашите оценки бяха изпратени.";
?>