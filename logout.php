<?php

require_once('includes/db-connect.php');

$_SESSION = array();

session_destroy();

header('Location: index.php');
exit;