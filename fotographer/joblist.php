<?php
session_start();
require_once('/stov/includes/functions.php');
require_once('/stov/includes/db-connect.php');

 /* $result = mysql_query("SELECT * FROM articles WHERE id = $id"); */
 $user_id = $_SESSION['user_id'];
$statement = $conn->prepare("SELECT * FROM jobs WHERE job_fotographer_id = '$user_id'");
$statement->execute(array(
':id' => $id
  ));
 while ( $job = $statement->fetch(PDO::FETCH_OBJ) ) { ?>
   <article>
          <header>
            <h3><?= $job->job_title; ?></h3>
          </header>
          <div class="article-teaser">
      
            <p>
              Beschreibung            
            </p>
          </div>
          <footer>
            <a href="<?= "index.php" ?>" class="btn btn-primary"></a>
          </footer>
        </article> 
        <?php
  
 }

?>
