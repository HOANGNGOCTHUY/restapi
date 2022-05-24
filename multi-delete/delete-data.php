<?php 
    include "../dbconnect.php";
    
    $student_id = $_POST['id'];

    $str = implode("," , $student_id ); // Noối phần tử mảng thành một chuổi implode
    $sql = "DELETE FROM `students` WHERE  id IN ({$str})";

    if(mysqli_query($conn,$sql)){
        echo 1;
    }else{
        echo 0;
    }

?>