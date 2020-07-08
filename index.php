<?php
/**
* QuizSite Hompage
* shows a simple site with all available quizes
*/

// include database credentials and connection
include("config.php");

// specify site title
$siteTitle = "Quiz";

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
			<img src="/assets/home.png" alt="Home" width="60%" Height="60%">
			</a>
		</nav>
CONTENT;

// prepare statement for database fetch
$sql = $pdo->prepare("SELECT * FROM quiz");
// excute sql statement
$sql->execute();

// create quiz cards
while ($row = $sql->fetch()) {
	$content .= <<<CONTENT
<form id="firstform" action="quiz.php?quizID=$row[pk_quizID]" method="post">
	<article class="center">
		<h1>$row[name]</h1>
		<p>$row[description]</p>
		<!--<p>Letzter versuch: 0%</p>!-->
		<br>
		<input class="ButtonAni" id="submit" type="submit" value="Start Quiz">
	</article>
</form>
CONTENT;
}

// close body and html tag
$content .= <<<CONTENT
	</body>
</html>
CONTENT;

// print generated site
echo $content;
