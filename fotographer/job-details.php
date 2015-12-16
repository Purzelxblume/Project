<?php

require_once('../includes/db-connect.php');
require_once('../includes/functions.php');

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>STOV | Customer Area</title>
    <link rel="stylesheet" href="http://getbootstrap.com/dist/css/bootstrap.css">
    <link rel="stylesheet" href="css/main.css">
  </head>
  <body>
    <div id="site-wrap">
      <h2>STOV | Customer Area</h2>
      <?php require_once('../includes/include.nav.php'); ?>
      <hr>
      
<?php



  try {
      $locationsStatement = $conn->prepare("SELECT * FROM locations WHERE loc_job_id = :job_id");
      $locationsStatement->execute(array(
      ':job_id' => $job->job_id
        ));
    
      while ( $location = $locationsStatement->fetch(PDO::FETCH_OBJ) ) { 
          ?>
   <article>
          <header>
            <h3><?= $location->loc_title; ?></h3>
          </header>
          <div class="article-teaser">

            <p>
            Customer: <?= $location->loc_customer ?> 
            </p>
            <p>
            Latitude: <?= $location->loc_lat ?> 
            </p>
            <p>
            Longitude: <?= $location->loc_lon ?> 
            </p>
          </div>
          <footer>
          </footer>
        </article> 

        <?php
        }
    } catch(PDOException $e) {
      $feedback = getFeedback($e->getMessage(),'danger');
    }


    </div>
  </body>
</html>
