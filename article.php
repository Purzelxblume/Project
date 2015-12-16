<?php

require_once('includes/db-connect.php');
require_once('includes/functions.php');

if ( isset($_GET['id']) )
{
  extract($_GET); # $id ist ab hier existent

 /* $result = mysql_query("SELECT * FROM articles WHERE id = $id"); */
$statement = $conn->prepare("SELECT * FROM articles WHERE id = $id");
$statement->execute(array(
':id' => $id
  ));
}
else
{
  header('Location: index.php');
  exit;
}

?><!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>littleBlog | Artikel</title>
    <link rel="stylesheet" href="http://getbootstrap.com/dist/css/bootstrap.css">
    <link rel="stylesheet" href="css/main.css">
  </head>
  <body>
    <div id="site-wrap">
      <h2>Little Blog</h2>
      <?php require_once('includes/include.nav.php'); ?>
      <hr>
      <?php

      while ( $article = $statement->fetch(PDO::FETCH_OBJ) )
      {        
        ?>
        <article>
          <header>
            <h3><?= $article->title; ?></h3>
            <h5>Posted on <?= date('H:i, d.m.Y', $article->postedOn); ?></h5>
          </header>
          <div class="article-teaser">
            <figure>
              <img src="<?= $article->teaserImg; ?>" alt="">
            </figure>
            <p>
              <strong><?= nl2br($article->teaser); ?></strong>
            </p>
            <p>
              <?= $article->content; ?>
            </p>
          </div>
          <footer>
            <a href="<?= "index.php" ?>" class="btn btn-primary">Back home</a>
          </footer>
        </article>
        <?php
      }
      ?>
    </div>
  </body>
</html>