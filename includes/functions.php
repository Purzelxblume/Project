<?php



/**
 * getFeedback — Creates a Bootstrap alert panel based on a class name and feedback
 * @param  String $feedback     The feedback to display
 * @param  String $feedbackType Bootstrap class {danger|warning|success|info}
 * @return String               The HTML fragment for the alert panel
 */
function getFeedback ($feedback, $feedbackType)
{
  return "<div class='alert alert-$feedbackType'>$feedback</div>";
}

function hasRights ($rights=10)
{

if ( isset($_SESSION['rights'])) 

{


return $_SESSION['rights'];

}
return NULL;
}

function isActivePage($currentPage, $expectPage) {

	return ($currentPage === $expectPage) ? 'active' : '';
}