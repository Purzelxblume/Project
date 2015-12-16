<?php

require_once('../includes/db-connect.php');
require_once('../includes/functions.php');

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>STOV | Fotographer Area</title>
    <link rel="stylesheet" href="http://getbootstrap.com/dist/css/bootstrap.css">
    <link rel="stylesheet" href="../css/main.css">
  </head>
  <body>
    <div id="site-wrap">
      <h2>STOV | Fotographer Area</h2>
      <?php require_once('../includes/include.nav.php'); ?>
      <hr>

<?php require_once('joblist.php'); ?>
      
    </div>
  </body>
</html>
