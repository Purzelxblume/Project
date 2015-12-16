        <?php


        require_once('includes/db-connect.php');
        require_once('includes/functions.php');

        if (!hasRights(100)) {

        header('Location: index.php');
        exit;
        }

        if (isset($_POST['title']))
        {
          extract($_POST);



            if ( !empty($title) && !empty($teaser) && !empty($content))

            {

              if ( !isset($_GET['edit'])) {



             $statement = $conn->prepare("INSERT INTO articles(title, teaser, content, postedOn, teaserIMG) VALUES(:title, :teaser, :content, :postedOn, :teaserIMG
          )"
              );

                $statement->execute(array(
                  ':title' => $title,
                  ':teaser' => $teaser,
                  ':content' => $content,
                  ':postedOn' => time(),
                  ':teaserIMG' => '',
                  ));

                $id = $conn->lastInsertId();

                $feedback = getFeedback("Your article has been posted. See it <a href='article.php?id=$id'>here</a>.", 'success');
           }
           else
           {
        $statement = $conn->prepare(
        "UPDATE articles SET
        title = :title,
        teaser = :teaser,
        content = :content
        WHERE id = :id"

          );

        $statement->execute(array(
          ':title' => $title,
          ':teaser' => $teaser,
          ':content' => $content,
          ':id' => $_GET['edit']

          ));

        $feedback = getFeedback("Your article has been updated. See it <a href='article.php?id=$_GET[edit]'>here</a>.", 'success');

           }

            }

            else
            {
              $feedback = getFeedback('Please add a title, teaser and image to your blog post.', 'warning');
          }
        }





        if ( isset($_GET['deleteId']))

        {

        $statement = $conn->prepare("DELETE FROM articles WHERE id = :id");
        $statement->execute(array(
        ':id' => $_GET['deleteId']
          ));
        $feedback = getFeedback('Your Post has been deleted.', 'success');
        }





        if (isset($_GET['edit'])) {

        $statement = $conn->prepare("SELECT * FROM articles WHERE id = :id");
        $statement->execute(array(
        ':id' => $_GET['edit']
          ));

        $articleToEdit = $statement->fetch(PDO::FETCH_OBJ);

        }







        ?><!DOCTYPE html>

        <html lang="en">
          <head>
            <meta charset="utf-8">
            <title>littleBlog | Startseite</title>
            <link rel="stylesheet" href="http://getbootstrap.com/dist/css/bootstrap.css">
            <link rel="stylesheet" href="css/main.css">
            <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
            <script src='//cdn.tinymce.com/4/tinymce.min.js'></script>
            <script src="js/tinymce-placeholder.js"></script>
            <script>
          tinymce.init({
            selector: '.mytextarea',
            plugins: 'link, image, placeholder',
            menubar: false
          });
          </script>
          
          </head>
          <body>
            <div id="site-wrap">
              <h2>Adminbereich</h2>
              <?php require_once('includes/include.nav.php'); ?>
              <hr>
              <h3><?php if ( isset($_GET['edit'])){ echo 'Edit this'; } else { echo 'Create a new'; } ?> Post</h3>

               <?php

              if ( isset($feedback) )
              {
                echo $feedback;
              }

              ?>

              <form action="<?= $_SERVER['REQUEST_URI']; ?>" method="post">
            <div class="form-group">
              <input
              type="text"
              class="form-control"
              name="title"
              placeholder="Title"
              value="<?php if ( isset($_GET['edit'])) { echo $articleToEdit->title;} ?>"
              >
            </div>

            <div class="form-group">
            <input type="text" class="form-control" name="teaser" placeholder="Teaser" value="<?php if ( isset($_GET['edit'])) { echo $articleToEdit->teaser;} ?>">
            </div>

            <textarea class="mytextarea form-control" name="content" rows="3" placeholder="Content"><?php if ( isset($_GET['edit'])) { echo $articleToEdit->content;} ?></textarea>

            <input type="submit" class="btn btn-primary" value="<?php if ( isset($_GET['edit'])){ echo 'Update'; } else { echo 'Post'; } ?>"
        >

            </form>
            <h3>Edit existing posts</h3>
            <table class="table table-striped">
              <thead>
                <td>Date</td>
                <td>Title</td>
                <td>Edit / Delete</td>
              </thead>

              <?php
              $result = $conn->query("SELECT * FROM articles ORDER BY postedOn DESC");

              while ( $article = $result->fetch(PDO::FETCH_OBJ)) {

                ?>
               

              <tr>
                <td><?= date('H:i, d.m', $article->postedOn)?></td>
                <td><?= substr($article->title, 0, 80).'...'; ?></td>
                <td>
                  <a href="<?="article.php?id=$article->id"; ?>" class="btn btn-primary btn-xs">View</a>

                  <a href="<?="admin.php?edit=$article->id"; ?>" class="btn btn-primary btn-xs">Edit</a>

                  <button class="btn btn-warning btn-xs" data-toggle="modal" data-target=".bs-example-modal-sm<?= $article->id; ?>">Delete</button>
        <div class="modal fade bs-example-modal-sm<?= $article->id; ?>" tabindex="-1" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><?= $article->title; ?></h4>
              </div>
              <div class="modal-body">
                <p>Would you really like to delete this post</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <a href="admin.php?deleteId=<?= $article->id; ?>" class="btn btn-warning">Delete</a>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        </td>
              </tr>
        <?php
        }
        ?>

            </table>


        </div>


          </body>
        </html>