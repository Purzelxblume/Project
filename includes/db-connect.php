<?php
session_start();
require_once('functions.php');

class DBManager {

	public $conn;
	
	function __construct () {
		try {
			$conn = new PDO('mysql:host=localhost;dbname=sanja_stovl', 'sanja', 'password', array(
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
		));

		} catch (PDOException $error) {
			$error->getMessage();
			$line = $error->getLine();
			$line = $error->getFile();
			throw $error;
		}
	}

	function acceptJob($job_id, $user_id) {
		if (!isset($job_id)) {
			throw new Exception('JobID missing.');
		}
		if (!isset($user_id)) {
			throw new Exception('UserID missing.');
		}

		try {

  			$statement = $this->conn->prepare("UPDATE jobs SET job_state='accepted' WHERE (job_id = :job_id) AND (job_fotographer_id = :user_id)");
  			$statement->execute(array(
    			':user_id' => $user_id,
    			':job_id' => $job_id
    		));
  			$statement->execute();

		} catch(PDOException $e) {
  			throw $e;
		}

		return 0;
	}
}



?>
