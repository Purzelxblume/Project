<?php
require_once('../includes/functions.php');
require_once('../includes/db-connect.php');

 /* $result = mysql_query("SELECT * FROM articles WHERE id = $id"); */

try {
  
  if (!isset($conn)) {
    $conn = connectDB();
  }

  $user_id = $_SESSION['user_id'];
  $fotographStatement = $conn->prepare("SELECT * FROM user WHERE (rights = '100') AND (customer_id = :user_id)");

  $fotographStatement->execute(array(
    ':user_id' => $user_id
    ));

} catch(PDOException $e) {
  $feedback = getFeedback($e->getMessage(),'danger');
}

while ( $fotographer = $fotographStatement->fetch(PDO::FETCH_OBJ) ) { 
    ?>
   <article>
          <header>
            <h3><?= $fotographer->real_name; ?></h3>
          </header>
          <!-- <div class="article-teaser">
          </div> -->
          <footer>
            <a href="offer-job.php?fotographer_id=<?= $fotographer->user_id?>" class="btn btn-default">Offer Job</a>
          </footer>
        </article> 
        <?php
        }
        ?>
