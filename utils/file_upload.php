<?php
include_once('../config/index.php');

if (!empty($_FILES['file']['name'])) {
    $upload_dir = "../uploads/";
    $file_name = '';
    $files_count = count($_FILES['file']['name']);
    print($files_count);

    for ($i = 0; $i < $files_count; $i++) {
        $file_name = $_FILES['file']['name'][$i];
        $file_size = $_FILES['file']['size'][$i];
        print($file_name);
        $uploaded_file = $upload_dir . $file_name;
        if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $uploaded_file)) {
            $mysql_insert = "INSERT INTO models (file_name, scale, active)VALUES('" . $file_name . "'," . $file_size . ", true)";
            if (!$link->query($mysql_insert)) {
                echo "false";
            }
        }
    }
    echo "true";
}
