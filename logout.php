<?php
// Logout code

include 'includes/db_inc.php';
unset($_SESSION[USER]);
header('location: index.php');
