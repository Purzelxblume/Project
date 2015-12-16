<?php
session_start();

require_once('../includes/db-connect.php');
require_once('../includes/functions.php');

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>STOV | Customer Area</title>
    <link rel="stylesheet" href="http://getbootstrap.com/dist/css/bootstrap.css">
    <link rel="stylesheet" href="../css/main.css">
  </head>
  <body>
    <div id="site-wrap">
      <h2>STOV | Customer Area</h2>
      <?php require_once('../includes/include.nav.php'); ?>
      <hr>

      <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">@</span>
        <input type="text" class="form-control" placeholder="Username" aria-describedby="basic-addon1">
      </div>
      
      <?php
      if ( isset($feedback) )
      {
        echo $feedback;
      }
      ?> 
      </div>
  </body>
</html>