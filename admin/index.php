<?php
include "../includes/db_inc.php";
include "../includes/html_start_admin_inc.php";
if (!isset($_SESSION[USER])) {
    $errorCookie = "errorMessage";
    $errorCookieValue = "U hebt geen toegang tot de pagina die u hebt getracht te bezoeken!";
    setcookie($errorCookie, $errorCookieValue, time() + (60), "/");
    header('location: ../index.php');
}

?>

<h1>Welkom admin</h1>

<?php
include "../includes/html_stop_admin_inc.php";
?>
