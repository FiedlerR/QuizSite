<?php
include("config.php");
	$siteTitle = "Quiz";
	$quizID = $_GET['quizID'];
	$maxPoints = 0;
	$points = 0;
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
		$sqlQuestion = $pdo->prepare("SELECT * FROM Question WHERE fk_pk_quizID  = :quizID");
		$sqlQuestion->execute(array('quizID' => $_GET["quizID"]));

			While ($row = $sqlQuestion->fetch()) {
				$maxPoints++;
			$content .= <<<CONTENT
			 <article>
							<p id="question">
							 $row[question]
							</p>
CONTENT;
	$sqlAnswer = $pdo->prepare("SELECT * FROM Answer WHERE pk_fk_questionID = :ID");
	$sqlAnswer->execute(array('ID' => $row["pk_questionID"]));
							
	While ($row2 = $sqlAnswer->fetch()) {
		if(isset($_POST["answer".$row["pk_questionID"]]) &&  $_POST["answer".$row["pk_questionID"]] != $row2["AnswerText"]){
$content .= <<<CONTENT
				<input class="radios" id="$row2[AnswerText]" type="radio" name="answer$row[pk_questionID]" value="$row2[AnswerText]"  disabled>
CONTENT;

		}else{
			$content .= <<<CONTENT
			<input class="radios" id="$row2[AnswerText]" type="radio" name="answer$row[pk_questionID]" value="$row2[AnswerText]" checked="checked" disabled >
CONTENT;
		}
			$content .= <<<CONTENT
								<label class="
CONTENT;
									if($row["rightAnswer"] == $row2["pk_answerID"]){
										if($_POST["answer".$row["pk_questionID"]] == $row2["AnswerText"]) {
										$points++;
$content .= <<<CONTENT
								rightAnswer
CONTENT;
										}
										}else{
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
$percentageOfPoints = ($points/$maxPoints )*100;
$content .= <<<CONTENT
		<article class="center">
				<p>
				Endergebnis:
				<br>
				$points von $maxPoints 
				<br>
				$percentageOfPoints%
			</p>
			<input class="ButtonAni" id="submit" type="submit" value="Quiz beenden">
		</article>
	</form>
	</body>
</html>
CONTENT;
echo $content;