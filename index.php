<?php
	include("config.php");
	$siteTitle = "Quiz";
	
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
CONTENT;

$sql = $pdo->prepare("SELECT * FROM quiz");
$sql->execute();


while($row = $sql->fetch()) {
$content .= <<<CONTENT
<form id="firstform" action="quiz.php?quizID=$row[pk_quizID]" method="post">
	<article class="center">
		<h1>$row[name]</h1>
		<p>$row[description]</p>
		<!--<p>Letzter versuch: 0%</p>!-->
		<br>
		<input class="ButtonAni" id="submit" type="submit" value="Quiz starten">
	</article>
</form>
CONTENT;
}

$content .= <<<CONTENT
		</form>
	</body>
</html>
CONTENT;

echo $content;
