<?php 
    header('Content-Type: application/json');
    header('Acess-Control-Allow-Origin: *');
    
    // $data = json_decode(file_get_contents("php://input"),true);

    // $search_value = $data['search'];
    $search_value = isset($_GET['search']) ? $_GET['search'] : die();

    include "dbconnect.php";

    $sql = "SELECT * FROM `students` WHERE `name` LIKE '%{$search_value}%' ";
    
    $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result) >0){

        $output = mysqli_fetch_all($result, MYSQLI_ASSOC);
        echo json_encode($output);

    }else{

        echo json_encode(array(
            'message' => 'Không tìm thấy bản ghi!',
            'status' =>  'false',
        ));

    }
?>