<?php
function handleFileUpload($files) {
    $imageBaseName = basename($files['image']['name']);
    $tempName = $files['image']['tmp_name'];
    $uploadDir = 'productImages/';
    $uploadFile = $uploadDir . $imageBaseName;
    return move_uploaded_file($tempName, $uploadFile);
}