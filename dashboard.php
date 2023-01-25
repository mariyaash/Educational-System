<html>
	<head>
		<script>
			function onCheckAnswers() {
				  const xhttp = new XMLHttpRequest();
				  xhttp.onload = function() {
					  let jsonResponse = JSON.parse(this.responseText);
					  
					  for (let task of jsonResponse) {
						  if (task.correct == true)
							  document.getElementById("fbk" + task.id).innerHTML = "Вашият отговор е верен.";
						  else
							  document.getElementById("fbk" + task.id).innerHTML = "Вашият отговор е грешен.<br>Правилният отговор е: " + task.actualAnswer;
					  }
				  }
				  xhttp.open("GET", "/educational_system/answer/check_answers.php");
				  xhttp.send();   
			}
		</script>
		<style>
			/*Можеш да си украсиш малко елементите. Прочети малко за css в нета - за border, border-radius, color, background-color, width, height, padding, margin.*/
			
			body {
			}
			
			textarea {
			}
			
			.check {
			}
			
			button, input[type=submit] {
			}
			
			h3 {
			}
		</style>
	</head>
	<body>

	<?php
	$loggedUser = array(
		"request" => "GET",
		"accountType" => 0,
		"redirect" => true
	);
	require($_SERVER["DOCUMENT_ROOT"] . "/educational_system/session/logged_user.php");
	echo "Welcome, ".$accountType[$type]. " " . $account[0]["full_name"];
	$tasks=$db->getQuestionsForStudent($studentOrMentorId);
	echo "<form action=\"answer/submit_answers.php\" method=POST>";
	foreach($tasks as $task){
		$mentorIdForTask=$task["mentor_id"];
		$mentor=$db->getMentorById($mentorIdForTask);
		$mentorAccount=$db->getAccountById($mentor[0]["account"]);
		echo "<h3>".$task["question"]." (from mentor ".$mentorAccount[0]["full_name"].")</h3><textarea name=".$task["id"]."></textarea><div class=\"check\" id=\"fbk".$task["id"]."\"></div>";
	}
	echo "<br><button type=\"button\" onclick=\"onCheckAnswers()\">Провери отговорите</button><input type=submit value=Изпрати /></form>";
	?>

	</body>
</html>
