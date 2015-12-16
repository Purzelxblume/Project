<?php
if (isset($_GET[job_id]) && isset($_GET[user_id])) {
	try {

  		$statement = $conn->prepare("UPDATE jobs SET job_state='accepted' WHERE (job_id = :job_id) AND (job_fotographer_id = :user_id)");
  		$statement->execute(array(
    		':user_id' => $_GET['user_id'],
    		':job_id' => $_GET['job_id']
    		));
  		$statement->execute();

	} catch(PDOException $e) {
  		$feedback = getFeedback($e->getMessage(),'danger');
	}
}

?>