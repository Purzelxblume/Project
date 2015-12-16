<?php

/**
 * FileUpload
 * A class that simplifies file uploads;
 * also an exercise to practice OOP
 *
 * @author Miloš Sutanovac
 */
class FileUpload
{
  /**
   * uploadFolder
   * The directory the files will be uploaded to
   * @var String
   */
  private $uploadFolder;

  /**
   * file
   * The raw superglobal data array
   * @var Array
   */
  private $file;

  /**
   * $errors
   * Caches all errors that could happen / come up
   * @var Array
   */
  private $errors = array();

  /**
   * $fileSizeInMb
   * Filesize in megabytes
   * @var Integer
   */
  private $fileSizeInMb;

  /**
   * isAllowedType
   * Is the MIME type an accepted type?
   * @var Boolean
   */
  private $isAllowedType;

  /**
   * $uniqueFileName
   * New, randomly generated and (hopefully) unique file name
   * @var String
   */
  private $uniqueFileName;
  
  /**
   * __construct
   * @param String $uploadFolder Directory to use for uploads
   */
  public function __construct ($uploadFolder)
  {
    $this->uploadFolder = $uploadFolder;
  }

  /**
   * setError
   * Pushes an error into the $errors array, used for caching of errors
   * @param String $error The error to cache
   */
  private function setError ($error)
  {
    $this->errors[] = $error;
  }

  /**
   * checkForNativeErrors
   * Checks for native errors (0, 1, 2, 3, 4, 6, 7, 8)
   * See: http://php.net/manual/en/features.file-upload.errors.php
   * @param  Array $fileToCheckForErrors Raw $_FILES
   */
  private function checkForNativeErrors ($fileToCheckForErrors)
  {
    switch ($fileToCheckForErrors['error'])
    {
      case 1:
        $this->setError('Error: UPLOAD_ERR_INI_SIZE');
      break;
      case 2:
        $this->setError('Error: UPLOAD_ERR_FORM_SIZE');
      break;
      case 3:
        $this->setError('Error: UPLOAD_ERR_PARTIAL');
      break;
      case 4:
        $this->setError('Error: UPLOAD_ERR_NO_FILE');
      break;
      case 6:
        $this->setError('Error: UPLOAD_ERR_NO_TMP_DIR');
      break;
      case 7:
        $this->setError('Error: UPLOAD_ERR_CANT_WRITE');
      break;
      case 8:
        $this->setError('Error: UPLOAD_ERR_EXTENSION');
      break;
    }
  }

  /**
   * byteToMb
   * A helper method to convert byte into megabyte
   * @param  Integer $byteToConvert Byte to be converted
   * @return Float                  Megabytes
   */
  private function byteToMb ($byteToConvert)
  {
    return $byteToConvert / pow(1024, 2);
  }

  /**
   * setMaxFileSize
   * Checks if the filesize exceeds the expected filesize
   * @param Integer $maxFileSizeInMb Filesize in megabytes
   */
  public function setMaxFileSize ($maxFileSizeInMb)
  {
    $this->fileSizeInMb = $this->byteToMb($this->file['size']);

    if ( $this->fileSizeInMb > $maxFileSizeInMb )
    {
      $this->setError("Error: The filesize of {$this->fileSizeInMb}MB exceeds the allowed size of {$maxFileSizeInMb}MB.");
    }
  }

  /**
   * uploadExists
   * Helper function to check whether or not an upload actually happened
   * @return Boolean
   */
  private function uploadExists ()
  {
    return !empty($this->file['name']) && !empty($this->file['type']) && !empty($this->file['tmp_name']);
  }

  /**
   * setAllowedTypes
   * Method to filter through an array of types and see 
   * whether the current file is allowed / accepted 
   * @param Array $allowedTypes Array of allowed MIME types
   */
  public function setAllowedTypes ($allowedTypes)
  {
    if ( $this->uploadExists() )
    {
      if ( in_array($this->file['type'], $allowedTypes) ) {
        $this->isAllowedType = true;
      }
      else
      {
        $this->setError("Error: Type {$this->file['type']} is not allowed.");
      }
    }
  }

  /**
   * file
   * Sets the file to work with (raw $_FILES)
   * @param  Array $rawSuperglobalData $_FILES array
   */
  public function file ($rawSuperglobalData)
  {
    $this->file = $rawSuperglobalData;
    $this->checkForNativeErrors($this->file);
  }

  /**
   * uniquifyFileName
   * Creates a unique file based on a small algorithm
   * @param  String $originalFileName   The old file name, i.e. "dog.jpg"
   * @return String                     The new, unique file name  
   */
  private function uniquifyFileName ($originalFileName)
  {
    if ( $this->uploadExists() && $this->isAllowedType )
    {
      # Extract the details from the file
      $originalFileDetails = pathinfo($originalFileName);

      # Create a unique name based on timestamp, random number
      # and a shuffled version of a sha1 encryption
      $timestamp = time();
      $rand = rand(999, 99999999);
      $rawOldName = $originalFileDetails['filename'];
      return str_shuffle(sha1("{$timestamp}{$rand}{$rawOldName}")) . '.' . $originalFileDetails['extension'];
    }
  }

  /**
   * validateUploadDirectory
   * Checks if $this->uploadFolder…
   * 1. exists and is a directory; if not creates it
   * 2. is writeable; if not, sets the rights
   * @param String Upload folder
   */
  private function validateUploadDirectory ($uploadFolder)
  {
    if ( !file_exists($uploadFolder) || !is_dir($uploadFolder) )
    {
      mkdir($uploadFolder, 0777);
    }
    else if ( !is_writeable($uploadFolder) )
    {
      chmod($uploadFolder, 0777);
    }
  }

  /**
   * prepareUpload
   * Prepares the upload (also delegates to multiple helper functions)
   */
  private function prepareUpload ()
  {
    $this->uniqueFileName = $this->uniquifyFileName($this->file['name']);

    $this->validateUploadDirectory($this->uploadFolder);
  }

  /**
   * hasErrors
   * Helper function to check whether or not any errors have occurred
   * …at any given time during the process of uploading
   * @return Boolean
   */
  private function hasErrors ()
  {
    return !empty($this->errors);
  }

  /**
   * moveFile
   * Responsible for permanently moving the file to the server
   */
  private function moveFile ()
  {
    if ( !$this->hasErrors() )
    {
      if ( !move_uploaded_file($this->file['tmp_name'], "{$this->uploadFolder}$this->uniqueFileName") )
      {
        $this->setError('Error: Moving the file to a permanent location has failed.');
      }
    }
  }

  /**
   * giveResult
   * The final feedback array returned from the FileUpload class
   * @return Array Feedback array
   */
  private function giveResult ()
  {
    return array(
      'status'        => (!$this->hasErrors()) ? 'success' : 'fail' ,
      'original-name' => $this->file['name'],
      'new-name'      => $this->uniqueFileName,
      'size'          => $this->file['size'],
      'size-in-mb'    => $this->fileSizeInMb,
      'type'          => $this->file['type'],
      'directory'     => $this->uploadFolder,
      'errors'        => $this->errors
    );
  }

  /**
   * upload
   * Delegates the functionality to several other methods
   * @return Array
   */
  public function upload ()
  {
    $this->prepareUpload();

    $this->moveFile();

    return $this->giveResult();
  }
}