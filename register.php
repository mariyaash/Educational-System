<?php
require($_SERVER["DOCUMENT_ROOT"] . "/educational_system/db/connect.php");

if(!assertRequest("POST","email","password", "login", "full_name")){
	http_response_code(400);
	exit;
}

$email = $_POST["email"];
$password = $_POST["password"];
$full_name = $_POST["full_name"];
if ($db->emailExists($email) == true) {
	echo "Вече съществува такъв имейл";
	http_response_code(400);
	exit;
}

$pattern = "/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/";

if (!preg_match($pattern, $email)) {
	echo "Имейлът е невалиден";
    http_response_code(400);
	exit;
}

$pattern = "/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/";
if (!preg_match($pattern, $password)) {
	echo "Паролата е невалидна";
    http_response_code(400);
	exit;
}


$db->addStudent($full_name, $email, $password);
echo "Регистрацията е успешна";
?>