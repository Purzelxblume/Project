<?php
require_once('/stov/includes/functions.php');
require_once('/stov/includes/db-connect.php');

 /* $result = mysql_query("SELECT * FROM articles WHERE id = $id"); */
$statement = $conn->prepare("SELECT * FROM articles WHERE id = $id");
$statement->execute(array(
':id' => $id
  ));
  
?>
