<?php

require_once('includes/db-connect.php');
require_once('includes/functions.php');
require_once('../prettyprint/index.php');

# Wurde das Formular abgeschickt?
if ( isset($_POST['username']) )
{
  extract($_POST); # $username, $password

  # Sind beide Felder ausgefüllt worden?
  if ( !empty($username) && !empty($password) )

  { $statement = $conn->prepare("SELECT * FROM users WHERE username = :username");

    $statement->execute(array(
      ':username' => $username

      ));


    # Existiert der User überhaupt?
    # SQL Injection übergehen
    #$username = mysql_real_escape_string($username);

    # Datenbank nach dem User befragen
    #$result = mysql_query("SELECT * FROM users WHERE username = '$username'");

    # Gibt es einen Datensatz zu diesem Usernamen?
    if ($statement->rowCount())
    {
      # Hole die Userdaten des Users
      $user = $statement->fetch(PDO::FETCH_OBJ);

      # Stimmt sein Passwort mit dem eingegeben PW überein?
      if ( $user->password === $password )
      {
        # Logge den User ein
        $_SESSION['id'] = $user->id;
        $_SESSION['username'] = $user->username;
        $_SESSION['rights'] = $user->rights;
        header('Location: admin.php');
        exit;
      }
      else
      {
        $feedback = getFeedback('Please correct your log–in data.', 'danger');
      }
    }
    else
    {
      $feedback = getFeedback('This user does not exist.', 'danger');
    }
  }
  else
  {
    $feedback = getFeedback('Please fill out all fields.', 'warning');
  }
}

?><!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>littleBlog | Login</title>
    <link rel="stylesheet" href="http://getbootstrap.com/dist/css/bootstrap.css">
    <link rel="stylesheet" href="css/main.css">
  </head>
  <body>
    <div id="site-wrap">
      <h2>Little Blog</h2>
      <?php require_once('includes/include.nav.php'); ?>
      <hr>
      <h3>Login</h3>
      <?php

      if ( isset($feedback) )
      {
        echo $feedback;
      }

      ?>
      <form action="login.php" class="form-inline" method="post">
        <div class="form-group">
          <label class="sr-only" for="username">Username</label>
          <input type="text" class="form-control" name="username" id="username" placeholder="Username">
        </div>
        <div class="form-group">
          <label class="sr-only" for="password">Password</label>
          <input type="password" class="form-control" name="password" id="password" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary">Log in</button>
      </form>
    </div>
  </body>
</html>