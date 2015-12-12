<?php
$dsn = "sqlite:shopping.sqlite";
$pdoOptions = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
);
$db = new PDO($dsn, '', '', $pdoOptions);
