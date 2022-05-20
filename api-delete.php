<?php 
    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-Width');

    
    $data = json_decode(file_get_contents("php://input"),true);

    $id = $data['sid'];

    include "dbconnect.php";

    $sql = "DELETE FROM `students` WHERE `id`='{$id}'";
    

    if(mysqli_query($conn,$sql)){

        echo json_encode(array(
            'message' => 'Delete thành công!!^^',
            'status' =>  'true',
        ));

    }else{

        echo json_encode(array(
            'message' => 'Delete thất bại!',
            'status' =>  'false',
        ));

    }
?>