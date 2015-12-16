<?php
session_start();

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


<?php
      if ( isset($feedback) )
      {
        echo $feedback;
      }

 /* $result = mysql_query("SELECT * FROM articles WHERE id = $id"); */
$dbMgr = new DBManager();

try {
  $user_id = $_SESSION['user_id'];
  $jobsStatement = $dbMgr->conn->prepare("SELECT * FROM jobs WHERE job_fotographer_id = '$user_id'");
  $locationsStatement = $dbMgr->conn->prepare("SELECT * FROM locations WHERE loc_job_id = :job_id");

  $jobsStatement->execute(array(
    ':user_id' => $user_id
    ));

} catch(PDOException $e) {
  $feedback = getFeedback($e->getMessage(),'danger');
  header('Location: index.php');
}

while ( $job = $jobsStatement->fetch(PDO::FETCH_OBJ) ) { 
    try {
      $locationsStatement->execute(array(
      ':job_id' => $job->job_id
        ));
    
    } catch(PDOException $e) {
      $feedback = getFeedback($e->getMessage(),'danger');
    }

    ?>
   <article>
          <header>
            <h3><?= $job->job_title; ?></h3>
          </header>
          <div class="article-teaser">
      
            <p>
            Locations: <?= $locationsStatement->rowCount() ?> 
            </p>
          </div>
          <footer>
            <a href="accept-job.php?job_id=<?=$job->job_id?>&user_id=<?= $user_id?>" class="btn btn-primary">Accept</a>
            <a href="job-details.php?job_id=<?=$job->job_id?>&user_id=<?= $user_id?>" class="btn btn-info">Details</a>
          </footer>
        </article> 
        <?php
        }
        ?>






      
      
      </div>
  </body>
</html>
