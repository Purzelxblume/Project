<?php

require_once('../includes/db-connect.php');

	try {
		$dbMgr = new DBManager();
		acceptJob($_GET[job_id], $_GET[user_id]);
	} catch (Exception $e) {
		echo getFeedback($e->getMessage(),'danger');
	}

?>