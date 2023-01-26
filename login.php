<?php
if(!assertRequest("POST","email","password", "login")){
	http_response_code(400);
	exit;
}

require ($_SERVER["DOCUMENT_ROOT"] . "/educational_system/db/connect.php");
$result=$db->queryAsMap("SELECT * FROM mydb.account where email like \"".$_POST["email"]."\" and password like\"".$_POST["password"]."\"");
if(count($result)==0){
	echo "Failed";
	exit;
}
session_start();
$_SESSION["loginId"]=$result[0]["id"];
header("Location:/educational_system/dashboard.php");

?>