<?php
error_reporting(0);
define("DB_HOST", "localhost"); // set database host
define("DB_USER", "root"); // set database user
define("DB_PASS", ""); // set database password
define("DB_NAME", "ors"); // set database name

$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die("Couldn't make connection.");
$db = mysqli_select_db($link, DB_NAME) or die("Couldn't select database");
