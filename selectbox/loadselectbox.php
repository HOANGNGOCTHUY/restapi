<?php 

    include "../dbconnect.php";
    $type = $_POST['type'];
    $str = "";

    if($type == ""){
        $sql = "SELECT * FROM `country_tb`";

        $result = mysqli_query($conn, $sql);

        while($row = mysqli_fetch_assoc($result)){
            $str .= "<option value='{$row['cid']}'>{$row['cname']}</option>";
        }
    }else if($type == "stateData"){
        $sql = "SELECT * FROM `state_tb` WHERE cid ={$_POST['id']}";

        $result = mysqli_query($conn, $sql);

        while($row = mysqli_fetch_assoc($result)){
            $str .= "<option value='{$row['sid']}'>{$row['sname']}</option>";
        }
    }
    
    echo $str;
?>