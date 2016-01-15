<?php
session_start();

define('USER', 'user');
define('ERRORMESSAGE', 'errorMessage');

$dsn = "sqlite:" . "shopping.sqlite";
if (strrpos($_SERVER['REQUEST_URI'], 'admin')) {
    $dsn = "sqlite:../shopping.sqlite";
} else {
    $dsn = "sqlite:shopping.sqlite";
}

$pdoOptions = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
);
$db = new PDO($dsn, '', '', $pdoOptions);
