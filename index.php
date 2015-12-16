<?php

require_once('includes/db-connect.php');
require_once('includes/functions.php');

if (!isset($_Session['username'])) {
  header('Location: login.php');
}

?><!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>littleBlog | Startseite</title>
    <link rel="stylesheet" href="http://getbootstrap.com/dist/css/bootstrap.css">
    <link rel="stylesheet" href="css/main.css">
  </head>
  <body>
    <div id="site-wrap">
      <h2>Little Blog</h2>
      <?php require_once('includes/include.nav.php'); ?>
      <hr>
      <?php

      $result = $conn->query("SELECT * FROM articles ORDER BY postedOn DESC");

      while ( $article = $result->fetch(PDO::FETCH_OBJ) )
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
              <?= $article->teaser; ?>
            </p>
          </div>
          <footer>
            <a href="<?= "article.php?id=$article->id" ?>" class="btn btn-primary">Read more</a>
          </footer>
        </article>
        <?php
      }
      ?>
    </div>
  </body>
</html>
