
  <?php 

  require_once('class/FileUpload.class.php');
  require_once('../prettyprint/index.php');

  if ( isset($_POST['submit']) )
  {
    $fileUpload = new FileUpload('uploads/'); # Erzeuge einen neuen Fileupload und übergebe den Zielordner
    $fileUpload->file($_FILES['upload']); # Übergebe das $_FILES an die Klasse (darin sind alle wertvollen Infos)
    $fileUpload->setMaxFileSize(2); # Limitiere den Upload auf 2MB max. Filesize
    $fileUpload->setAllowedTypes(array(
      'image/jpeg',
      'image/jpg',
      'image/gif',
      'image/png'
    ));
    prettyPrint($fileUpload->upload());
  }

  ?><!DOCTYPE html>

  <html lang="en">
    <head>
      <meta charset="utf-8">
      <title>OOP file upload < 333 for Jiri–love < 333</title>
    </head>
    <body>
      <form action="index.php" method="post" enctype="multipart/form-data">
        <input type="file" name="upload"><br>
        <input type="submit" name="submit" value="Upload">
      </form>
    </body>
  </html>