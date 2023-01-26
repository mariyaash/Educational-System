<?php
require ($_SERVER["DOCUMENT_ROOT"] . "/educational_system/request/assert.php");
session_start();
if(assertSession("loginId")){
	header("Location:/educational_system/dashboard.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Login Page </title>
    <style>
body {
  font-family: Helvetica, sans-serif;
  background-color: lightyellow;
}

button {
	background-color: #4CAF50;
	width: 100%;
	margin-left: 3px;
	color: orange;
	padding: 15px;
	margin: 10px 0px;
	border: none;
	cursor: pointer;
	border-radius: 10px;
	display: block;
}
 form {
        border: 3px solid #f1f1f1;
		display: block;
    }
 input[type=text], input[type=password] {
        width: 100%;
        margin: 8px 0;
        padding: 12px 20px;
        display: inline-block;
        border: 2px solid blue;
        box-sizing: border-box;
    }
 button:hover {
        opacity: 0.7;
    }
  .cancelbtn {
        width: auto;
        padding: 10px 18px;
        margin: 10px 5px;
    }
	
	.fullname {
		display: none;
	}
.container {
padding: 25px;
background-color: lightblue;
}

    </style>
	<script type="text/javascript">
	
	function onRadioBtnChange(e) {
		if (e.target.id === "Login") {
			let full_name_input = document.getElementsByClassName("fullname");
			full_name_input[0].style.display = "none";
			full_name_input[1].type = "hidden";
		} else {
			let full_name_input = document.getElementsByClassName("fullname");
			full_name_input[0].style.display = "block";
			full_name_input[1].type = "text";
		}
	}
	
	window.onload = function() {
		let loginRadioBtn = document.getElementById("Login");
		let registerRadioBtn = document.getElementById("Register");
		
		loginRadioBtn.addEventListener("change", onRadioBtnChange);
		registerRadioBtn.addEventListener("change", onRadioBtnChange);
	}
	
	</script>
</head>
<body>
<h1> Please insert your login credentials</h1>
<div class="container">
    <form action="auth.php" method="post">
	    <label class="fullname">Full name : </label>
        <input type="hidden" class="fullname" placeholder="Full name " name="full_name" id="full_name"/>
        <label>Username : </label>
        <input type="text" placeholder="Enter email address " name="email" id="email"/>
        <label>Password : </label>
        <input type="password" placeholder="Enter Password" name="password" id="password"/>
		<input type="radio" name="login" id="Login" checked="checked" value="1">
		<label>Login</label>
		<input type="radio" name="login" id="Register" value="0">
		<label>Register</label>
        <button name="action" id="btn_login">Submit</button>
    </form>
</div>
</body>
</html>
