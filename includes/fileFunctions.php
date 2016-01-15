<?php
function handleFileUpload($files) {
    $imageBaseName = basename($files['image']['name']);
    $tempName = $files['image']['tmp_name'];
    $uploadDir = '../productImages/';
    $uploadFile = $uploadDir . $imageBaseName;
    return move_uploaded_file($tempName, $uploadFile);
}

function handleDeleteFile($file)
{
    if (file_exists('../productImages/' . $file)) {
        unlink('../productImages/' . $file);
    }
}
