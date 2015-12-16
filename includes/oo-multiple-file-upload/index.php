<?php

require_once('class/FileUpload.class.php');
require_once('../prettyprint/index.php');

if ( isset($_POST['submit']) )
{
  foreach ( $_FILES as $key => $value ) {
    $f = new FileUpload('uploads/');
    $f->file($_FILES[$key]);
    $f->setMaxFileSize(3);
    $f->setAllowedTypes(array('image/jpg', 'image/jpeg', 'image/gif', 'image/png'));
    prettyPrint($f->upload());
  }
}

?><!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <form action="index.php" method="post" enctype="multipart/form-data">
      <input type="file" name="avatar"><br>
      <input type="file" name="foo"><br>
      <input type="file" name="bar"><br>
      <input type="file" name="fizz"><br>
      <input type="submit" name="submit" value="Upload">
    </form>
  </body>
</html>