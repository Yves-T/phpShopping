<?php

include '../includes/db_inc.php';

if (!isset($_SESSION[USER])) {
    $errorCookie = "errorMessage";
    $errorCookieValue = "U hebt geen toegang tot de pagina die u hebt getracht te bezoeken!";
    setcookie($errorCookie, $errorCookieValue, time() + (60), "/");
    header('location: ../index.php');
}


$json = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {


    if (isset($_POST['id'])) {
        $query = "DELETE FROM product WHERE id=:id";

        $stmt = $db->prepare($query);

        $stmt->execute([
            'id' => $_POST['id']
        ]);
    }

    $json = json_encode($_POST);
} else {
    $json = json_encode('NOK');
}

echo $json;
