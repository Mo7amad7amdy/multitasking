<?php
$result = [];
$allowedSize = 2 * 1024 * 1024; // 2MB

if ($_FILES['image']['size'] > $allowedSize) {
    // Image size is larger than 2MB
    $result['error'] = 'Image size exceeds the allowed limit of 2MB';
    $result['status'] = 400;
    return $result;
}

$imagedata = $_FILES['image'];
$filename = md5(date("dmYhisA"));
$first_name = $_POST['firstName'];
$last_name = $_POST['lastName'];

include 'frontend_task/connection.inc';
if(!$link || mysqli_connect_errno()){

    $result['error'] = 'Failed to connect to MySQL: ' . mysqli_connect_error();
    $result['status'] = 400;
    return $result;
}else{

    $file_name = 'images/'.$filename.'.png';
    file_put_contents($file_name,$imagedata);
    mysqli_query($link, "INSERT INTO USERS VALUES(NULL, '$first_name', '$last_name', '$file_name')")or die('Error:'.mysqli_error($link));

    $result['status'] = 201;
    $result['file_name'] = $file_name;
    return $result;
}