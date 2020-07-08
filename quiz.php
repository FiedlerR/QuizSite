<?php

/**
 * QuizSite Quiz
 * shows a quiz with multiple choice questions cards
 * the quiz is specified by the get parameter quizID
 */

// include database credentials and connection
include("config.php");

// specify site title
$siteTitle = "Quiz";

// get quizID
$quizID = $_GET['quizID'];

// render non generic head and navbar 
$content = <<<CONTENT
<!DOCTYPE html>
<html>
	<head>
		<title>$siteTitle</title>
		<link href="CSS/quiz.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<nav>
			<a class="home" href="index.php" title="Home">
			 <img src="assets/home.png" alt="Home" width="60%" Height="60%">
			</a>
		</nav>
		<form id="firstform" method="POST" action="checkAnswers.php?quizID=$quizID">
CONTENT;
//counter to track current question id
$count = 0;

//prepare statement to fetch questions for specified quiz id
$sqlQuestion = $pdo->prepare("SELECT * FROM Question WHERE fk_pk_quizID  = :quizID");

//bind variable and execute prepared statement
$sqlQuestion->execute(array('quizID' => $quizID));


//create question cards
while ($row = $sqlQuestion->fetch()) {
	//increment question id
	$count++;
	//prepare statement to fetch answers for specified question id
	$sqlAnswer = $pdo->prepare("SELECT * FROM Answer WHERE pk_fk_questionID = :ID");

	//bind variable and execute prepared statement
	$sqlAnswer->execute(array('ID' => $row["pk_questionID"]));

	//add question to question card
	$content .= <<<CONTENT
	<article class="questionCard">
		<p id="question">$count.$row[question]</p>
CONTENT;

	//add answers to question card
	while ($row2 = $sqlAnswer->fetch()) {
		// add radio button and label for each answer
		$content .= <<<CONTENT
		<input class="radios" id="$row2[AnswerText]" type="radio" name="answer$row[pk_questionID]" value="$row2[AnswerText]">
		<label for="$row2[AnswerText]">$row2[AnswerText]</label>
		<br>
CONTENT;
	}

	//close question card tag
	$content .= <<<CONTENT
		</article>
CONTENT;
}

//add submit area and javascript function which enable the submit butten when all questions are answered
$content .= <<<CONTENT
		<article class="center">
			<input class="ButtonAni" id="submitDisabled" type="submit" value="Check Answers" disabled>
		</article>
	</form>
	<script src="JS/index.js"></script> 
</html>
CONTENT;

//print generated site content
echo $content;
