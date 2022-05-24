<?php 
    include "../dbconnect.php";

    $sql = "SELECT * FROM `students`";

    $result = mysqli_query($conn,$sql);

    $output = "";

    if(mysqli_num_rows($result) >0){
            $output .= "<table>
                    <tr>
                        <th></th>
                        <th>S.No</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>City</th>
                    </tr>";
                while($row = mysqli_fetch_assoc($result)){
                    $output .= "<tr>
                                <td><input type='checkbox' value='{$row['id']}'></td>
                                <td>{$row['id']}</td>
                                <td>{$row['name']}</td>
                                <td>{$row['age']}</td>
                                <td>{$row['city']}</td>
                                </tr>";
                }
            $output .=  "</table>";
            echo $output;
    }else{
        echo "No found!!!";
    }

?>
