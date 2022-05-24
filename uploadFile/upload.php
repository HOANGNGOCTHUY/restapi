<?php
    // include "../dbconnect.php";

    if($_FILES['file']['name'] != ''){

        $file_name = $_FILES['file']['name'];

        $extension = pathinfo($file_name, PATHINFO_EXTENSION);

        $valid_extension = array("jpg","jpeg","png","gif");

        if(in_array($extension,$valid_extension)){
            $new_name = rand() . "." . $extension;
            $path = "../images/" . $new_name;

            if(move_uploaded_file($_FILES['file']['tmp_name'],$path )){
                echo '<img src="'.$path.'" /> <br><br><button data-path = "'.$path.'" id="delete-btn">Delete</button>';
            }
        }else{
            echo '<cript> alert("Invalid file Format.")</script>'; 
        }

    }else{
        echo '<cript> alert("Please Select File")</script>'; 
    }


    
?>