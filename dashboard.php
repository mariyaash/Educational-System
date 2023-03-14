<html>
	<head>
		<script>
			function onCheckAnswers() {
				  const xhttp = new XMLHttpRequest();
				  xhttp.onload = function() {
					  let jsonResponse = JSON.parse(this.responseText);
					  
					  for (let task of jsonResponse) {
						  if (task.assessment == 1)
							  document.getElementById("fbk" + task.id).innerHTML = "Вашият отговор е верен.";
						  else if (task.assessment == -1)
							  document.getElementById("fbk" + task.id).innerHTML = "Вашият отговор е грешен.<br>Правилният отговор е: " + task.actualAnswer;
						  else
							  document.getElementById("fbk" + task.id).innerHTML = "Вашият отговор все още не е оценен.";
					  }
				  }
				  xhttp.open("GET", "/educational_system/answer/check_answers.php");
				  xhttp.send();   
			}
		</script>
		<style>
			body {
			}
			
			answer {
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
	require_once($_SERVER["DOCUMENT_ROOT"] . "/educational_system/account_type.php");
	
	$loggedUser = array(
		"request" => "GET",
		"accountType" => AccountType::ANY,
		"redirect" => true
	);
	require($_SERVER["DOCUMENT_ROOT"] . "/educational_system/session/logged_user.php");
	echo "Welcome, " . $accountType[$type] . " " . $account[0]["full_name"] . "<br>";
	
	if ($type == AccountType::STUDENT) {
		$tasks=$db->getQuestionsForStudent($studentOrMentorId);
		echo "<form action=\"answer/submit_answers.php\" method=POST>";
		$hasUnansweredTasks = false;
		foreach($tasks as $task){
			$mentorIdForTask=$task["mentor_id"];
			$mentor=$db->getMentorById($mentorIdForTask);
			$mentorAccount=$db->getAccountById($mentor[0]["account"]);
			echo "<h3>".$task["question"]." (from mentor ".$mentorAccount[0]["full_name"].")</h3>";
			
			if ($task["locked"]==0) {
				$hasUnansweredTasks = true;
				echo "<textarea class=\"answer\" name=".$task["id"]."></textarea>";
			}
			else
				echo "<div class=\"answer\">".$task["answer"]."</div>";
			echo "<div class=\"check\" id=\"fbk".$task["id"]."\"></div>";
		}
		echo "<br><button type=\"button\" onclick=\"onCheckAnswers()\">Провери отговорите</button>";
		if ($hasUnansweredTasks)
			echo "<input type=submit value=Изпрати /></form>";
	}
	else {
		define('containerIndex', 0);
		define('answersIndex', 1);
		
		$mentor = $db->getMentorById($studentOrMentorId);
		$tasks = $db->getAllAnswersForMentor($mentor[0]["id"]);
		$tasksHTML = array();
		
		echo "<form action='/educational_system/answer/submit_assessments.php' method='post'>";
		foreach ($tasks as $task) {
				if (!array_key_exists($task["task_id"], $tasksHTML)) {
					$tasksHTML[$task["task_id"]] = null;
					$tasksHTML[$task["task_id"]][containerIndex] = "<div class='taskContainer' id='taskConatiner-". $task["task_id"] ."'><h4>" . $task["question"] . "</h4>";
					$tasksHTML[$task["task_id"]][answersIndex] = null;
				}
				
				if ($task["actual_answer"] !== $task["answer"]) {
					$tasksHTML[$task["task_id"]][answersIndex] .= "<div class='answerContainer' id='answerContainer-'". $task["task_student_id"] . ">" . $task["actual_answer"] . " (от " . $task["full_name"] . ")" . "</div><select name=" . $task["task_student_id"] . " id='select-'". $task["task_student_id"] ."><option value='0'>Без оценка</option><option value='1'>Вярно</option><option value='-1'>Невярно</option></select>";
				}
		}
		
		foreach ($tasksHTML as $taskHTML) {
			echo $taskHTML[containerIndex] . $taskHTML[answersIndex] . "</div>" ;
		}
		echo "<input type='submit' value='Изпрати'></form>";
	
	}
	?>

	</body>
</html>
