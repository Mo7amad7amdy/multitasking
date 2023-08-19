<?php
$result = [];
$imagedata = base64_decode($_POST['image']);
$filename = md5(date("dmYhisA"));
$first_name = $_POST['firstName'];
$last_name = $_POST['lastName'];

include 'frontend_task/connection.inc';
if(!$link || mysqli_connect_errno()){

    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();

    $result['status'] = mysqli_connect_error();
}else{

    $file_name = 'images/'.$filename.'.png';
    file_put_contents($file_name,$imagedata);
    mysqli_query($link, "INSERT INTO USERS VALUES(NULL, '$first_name', '$last_name', '$file_name')")or die('Error:'.mysqli_error($link));

    $result['status'] = 1;
    $result['file_name'] = $file_name;
}
echo json_encode($result);
