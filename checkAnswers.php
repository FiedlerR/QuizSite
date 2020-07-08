<?php

/**
 * QuizSite results site
 * check the answers and shows the results of the quiz
 * the quiz is specified by the get parameter quizID
 */

// include database credentials and connection
include("config.php");
// specify site title
$siteTitle = "Quiz";

// get quizID
$quizID = $_GET['quizID'];

// max reachable points
$maxPoints = 0;

//reached points
$points = 0;

// render non generic head and navbar 
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
		<form id="firstform" action="index.php">
CONTENT;

//prepare statement to fetch questions for specified quiz id
$sqlQuestion = $pdo->prepare("SELECT * FROM Question WHERE fk_pk_quizID  = :quizID");

//bind variable and execute prepared statement
$sqlQuestion->execute(array('quizID' => $_GET["quizID"]));


//create question cards and marks wrong answers
while ($row = $sqlQuestion->fetch()) {
	//count the max reachable points
	$maxPoints++;

	//add question to question card
	$content .= <<<CONTENT
			 <article>
							<p id="question">
							 $row[question]
							</p>
CONTENT;

//prepare statement to fetch questions for specified quiz id
	$sqlAnswer = $pdo->prepare("SELECT * FROM Answer WHERE pk_fk_questionID = :ID");
	$sqlAnswer->execute(array('ID' => $row["pk_questionID"]));

	while ($row2 = $sqlAnswer->fetch()) {
		if (isset($_POST["answer" . $row["pk_questionID"]]) &&  $_POST["answer" . $row["pk_questionID"]] != $row2["AnswerText"]) {
			$content .= <<<CONTENT
				<input class="radios" id="$row2[AnswerText]" type="radio" name="answer$row[pk_questionID]" value="$row2[AnswerText]"  disabled>
CONTENT;
		} else {
			$content .= <<<CONTENT
			<input class="radios" id="$row2[AnswerText]" type="radio" name="answer$row[pk_questionID]" value="$row2[AnswerText]" checked="checked" disabled >
CONTENT;
		}
		$content .= <<<CONTENT
								<label class="
CONTENT;
		if ($row["rightAnswer"] == $row2["pk_answerID"]) {
			if ($_POST["answer" . $row["pk_questionID"]] == $row2["AnswerText"]) {
				$points++;
				$content .= <<<CONTENT
								rightAnswer
CONTENT;
			}
		} else {
			$content .= <<<CONTENT
								wrongAnswer
CONTENT;
		}
		$content .= <<<CONTENT
								" for="$row2[AnswerText]">$row2[AnswerText]</label><br>
CONTENT;
	}
	$content .= <<<CONTENT
						</article>
CONTENT;
}
$percentageOfPoints = ($points / $maxPoints) * 100;
$content .= <<<CONTENT
		<article class="center">
				<p>
				Endergebnis:
				<br>
				$points von $maxPoints 
				<br>
				$percentageOfPoints%
			</p>
			<input class="ButtonAni" id="submit" type="submit" value="Close Quiz">
		</article>
	</form>
	</body>
</html>
CONTENT;
echo $content;
