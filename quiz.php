<?php
	include("config.php");
	$siteTitle = "Quiz";
	$quizID = $_GET['quizID'];

$content = <<<CONTENT
<!DOCTYPE html>
<html>
	<head>
		<title>$siteTitle</title>
		<link href="quiz.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<nav>
			<a class="home" href="index.php" title="Home">
			 <img src="Home.png" alt="Home" width="60%" Height="60%">
			</a>
		</nav>
		<form id="firstform" method="POST" action="checkAnswers.php?quizID=$quizID">
CONTENT;

	$count = 0;
	$sqlQuestion = $pdo->prepare("SELECT * FROM Question WHERE fk_pk_quizID  = :quizID");
	$sqlQuestion->execute(array('quizID' => $quizID));

While ($row = $sqlQuestion->fetch()) {
	$count++;
	$sqlAnswer = $pdo->prepare("SELECT * FROM Answer WHERE pk_fk_questionID = :ID");
	$sqlAnswer->execute(array('ID' => $row["pk_questionID"]));
	$content .= <<<CONTENT
	<article>
		<p id="question">$count.$row[question]</p>
CONTENT;
	
	While ($row2 = $sqlAnswer->fetch()) {
			$content .= <<<CONTENT
		<input class="radios" id="$row2[AnswerText]" type="radio" name="answer$row[pk_questionID]" value="$row2[AnswerText]">
		<label for="$row2[AnswerText]">$row2[AnswerText]</label>
		<br>
CONTENT;
	}
	
	$content .= <<<CONTENT
		</article>
CONTENT;
}
	$content .= <<<CONTENT
		<article class="center">
			<input class="ButtonAni" id="submitDisabled" type="submit" value="Check Answers" disabled>
		</article>
	</form>
	<script>
	setInterval(checkIfALLfilled, 500);
	
	function checkIfALLfilled() { 
            var QuestionsCount = $count;
			var counterFilledQuestions = 0;
            var ele = document.getElementsByTagName('input'); 
              
            for(i = 0; i < ele.length; i++) { 
                  
                if(ele[i].type=="radio") { 
                  
                    if(ele[i].checked) {
                        counterFilledQuestions++;
					}
                } 
            }
			if(counterFilledQuestions == QuestionsCount){
				document.getElementById('submitDisabled').disabled = false;
				document.getElementById('submitDisabled').id = 'submit';
			}
        }
	</script>
</html>
CONTENT;
	echo $content;