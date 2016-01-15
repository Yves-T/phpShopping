<?php
include "../includes/db_inc.php";
include "../includes/html_start_admin_inc.php";
include '../includes/formatFunctions_inc.php';
include "../includes/ResultPager.php";

if (!isset($_SESSION[USER])) {
    $errorCookie = "errorMessage";
    $errorCookieValue = "U hebt geen toegang tot de pagina die u hebt getracht te bezoeken!";
    setcookie($errorCookie, $errorCookieValue, time() + (60), "/");
    header('location: ../index.php');
}

?>

<div class="container">
    <div class="row text-center generatedImage">
        <div class="col-md-12">
            <img src="balansTable.php" alt="balans tabel">
        </div>
    </div>

    <div class="row text-center">
        <div class="col-md-12">
            <img src="balansGraph.php" alt="balans staafgrafiek">
        </div>
    </div>
</div>





<?php
include "../includes/html_stop_admin_inc.php";
?>

