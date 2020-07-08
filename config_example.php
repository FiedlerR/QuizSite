<?php
   /**
   * example for config.php
   * create an untracked config.php to connect to the database
   */
   define('DB_HOST', 'mysql:host=localhost');
   define('DB_USERNAME', 'USERNAME');
   define('DB_PASSWORD', 'PASSWORD');
   define('DB_DATABASE', 'dbname=quizsite');
   $pdo = new PDO(DB_HOST.'; '.DB_DATABASE,DB_USERNAME, DB_PASSWORD);
?>
