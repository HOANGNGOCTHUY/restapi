<?php 
    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-Width');

    
    $data = json_decode(file_get_contents("php://input"),true);

    $id = $data['sid'];
    $name = $data['sname'];
    $age = $data['sage'];
    $city = $data['scity'];

    include "dbconnect.php";

    $sql = "UPDATE `students` SET `name`='{$name}',`age`='{$age}',`city`='$city' WHERE `id`='{$id}'";
    

    if(mysqli_query($conn,$sql)){

        echo json_encode(array(
            'message' => 'Update thành công!!^^',
            'status' =>  'true',
        ));

    }else{

        echo json_encode(array(
            'message' => 'Update thất bại!',
            'status' =>  'false',
        ));

    }
?>