<?php
session_start();
require_once('../includes/functions.php');
require_once('../includes/db-connect.php');

 /* $result = mysql_query("SELECT * FROM articles WHERE id = $id"); */

try {
  $user_id = $_SESSION['user_id'];
  $jobsStatement = $conn->prepare("SELECT * FROM jobs WHERE job_fotographer_id = '$user_id'");
  $locationsStatement = $conn->prepare("SELECT * FROM locations WHERE loc_job_id = :job_id");

  $jobsStatement->execute(array(
    ':user_id' => $user_id
    ));

} catch(PDOException $e) {
  $feedback = getFeedback($e->getMessage(),'danger');
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
            <a href="acceptJob.php?job_id=<?= $job->job_id?>&" class="btn btn-primary">Accept</a>
            <a href="<?= "jobDetails.php" ?>" class="btn btn-info">Details</a>
          </footer>
        </article> 
        <?php
        }
        ?>
