<?php

session_start();

try {
$conn = new PDO('mysql:host=localhost;dbname=sanja_stovl', 'sanja', 'password', array(
PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
));

} catch (PDOException $error) {
echo $error->getMessage();
$line = $error->getLine();
$line = $error->getFile();
echo "Error in $file, line $line: $message";
}


?>
